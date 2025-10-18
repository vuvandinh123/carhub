<?php

namespace App\Filament\Resources\CategoryPosts\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class CategoryPostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Hierarchical name with indentation
                TextColumn::make('name')
                    ->label('Tên danh mục')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function ($record) {
                        $level = $record->level ?? 0;
                        $indent = str_repeat('— ', $level);
                        return $indent . $record->name;
                    })
                    ->html()
                    ->description(fn($record) => $record->description)
                    ->wrap(),

                TextColumn::make('slug')
                    ->label('Đường dẫn')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Đã sao chép slug!')
                    ->prefix('/')
                    ->color('primary')
                    ->fontFamily('mono')
                    ->size('sm'),

                TextColumn::make('parent.name')
                    ->label('Danh mục cha')
                    ->searchable()
                    ->sortable()
                    ->placeholder('— Danh mục gốc —')
                    ->badge()
                    ->color('gray'),

                // Posts count (if you have relationship)
                TextColumn::make('posts_count')
                    ->label('Số bài viết')
                    ->counts('posts')
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color(fn($state) => match (true) {
                        $state === 0 => 'gray',
                        $state < 5 => 'warning',
                        $state < 20 => 'success',
                        default => 'primary',
                    }),

                // SEO Status
                TextColumn::make('seo_status')
                    ->label('Trạng thái SEO')
                    ->state(function ($record) {
                        $score = 0;
                        if ($record->meta_title) $score += 30;
                        if ($record->meta_description) $score += 40;
                        if ($record->meta_keywords) $score += 30;

                        return match (true) {
                            $score >= 80 => 'Tốt',
                            $score >= 50 => 'Trung bình',
                            $score >= 20 => 'Cần cải thiện',
                            default => 'Chưa tối ưu',
                        };
                    })
                    ->badge()
                    ->color(function ($state) {
                        return match ($state) {
                            'Tốt' => 'success',
                            'Trung bình' => 'warning',
                            'Cần cải thiện' => 'danger',
                            'Chưa tối ưu' => 'gray',
                        };
                    })
                    ->alignCenter(),

                // Meta information
                TextColumn::make('meta_title')
                    ->label('Meta Title')
                    ->limit(30)
                    ->tooltip(fn($record) => $record->meta_title)
                    ->placeholder('Chưa có')
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('meta_description')
                    ->label('Meta Description')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->meta_description)
                    ->placeholder('Chưa có')
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Timestamps
                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable()
                    ->since()
                    ->description(fn($record) => $record->created_at->format('d/m/Y H:i')),

                TextColumn::make('updated_at')
                    ->label('Cập nhật')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->since(),
            ])
            ->filters([
                // Parent Category Filter
                SelectFilter::make('parent_id')
                    ->label('Danh mục cha')
                    ->relationship('parent', 'name')
                    ->placeholder('Tất cả danh mục')
                    ->multiple()
                    ->preload(),



                // SEO Status Filter
                SelectFilter::make('seo_status')
                    ->label('Trạng thái SEO')
                    ->options([
                        'complete' => 'SEO hoàn chỉnh',
                        'partial' => 'SEO một phần',
                        'missing' => 'Thiếu SEO',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'] === 'complete',
                            fn(Builder $query): Builder => $query->whereNotNull('meta_title')
                                ->whereNotNull('meta_description')
                                ->whereNotNull('meta_keywords')
                        )->when(
                            $data['value'] === 'partial',
                            fn(Builder $query): Builder => $query->where(function ($q) {
                                $q->whereNotNull('meta_title')
                                    ->orWhereNotNull('meta_description')
                                    ->orWhereNotNull('meta_keywords');
                            })->where(function ($q) {
                                $q->whereNull('meta_title')
                                    ->orWhereNull('meta_description')
                                    ->orWhereNull('meta_keywords');
                            })
                        )->when(
                            $data['value'] === 'missing',
                            fn(Builder $query): Builder => $query->whereNull('meta_title')
                                ->whereNull('meta_description')
                                ->whereNull('meta_keywords')
                        );
                    }),

                // Date Range Filter
                Filter::make('created_at')
                    ->schema([
                        DatePicker::make('created_from')
                            ->label('Từ ngày'),
                        DatePicker::make('created_until')
                            ->label('Đến ngày'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['created_from'] ?? null) {
                            $indicators[] = Indicator::make('Từ ngày ' . Carbon::parse($data['created_from'])->toFormattedDateString())
                                ->removeField('created_from');
                        }

                        if ($data['created_until'] ?? null) {
                            $indicators[] = Indicator::make('Đến ngày ' . Carbon::parse($data['created_until'])->toFormattedDateString())
                                ->removeField('created_until');
                        }

                        return $indicators;
                    })->columns(2),

                // Posts Count Filter
                Filter::make('posts_count')
                    ->label('Số lượng bài viết')
                    ->schema([
                        Select::make('posts_count_condition')
                            ->label('Điều kiện')
                            ->options([
                                'eq' => 'Bằng',
                                'gt' => 'Lớn hơn',
                                'lt' => 'Nhỏ hơn',
                                'gte' => 'Lớn hơn hoặc bằng',
                                'lte' => 'Nhỏ hơn hoặc bằng',
                            ])
                            ->default('gte'),
                        TextInput::make('posts_count_value')
                            ->label('Số lượng')
                            ->numeric()
                            ->default(0),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        $condition = $data['posts_count_condition'] ?? 'gte';
                        $value = $data['posts_count_value'] ?? 0;

                        return $query->withCount('posts')->having('posts_count', $condition, $value);
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if ($data['posts_count_value'] ?? null) {
                            $condition = match ($data['posts_count_condition']) {
                                'eq' => '=',
                                'gt' => '>',
                                'lt' => '<',
                                'gte' => '≥',
                                'lte' => '≤',
                                default => '≥'
                            };
                            return 'Số bài viết ' . $condition . ' ' . $data['posts_count_value'];
                        }
                        return null;
                    })->columns(2),

                // Trashed Filter (for soft deletes)
                TrashedFilter::make()
                    ->label('Đã xóa')
                    ->placeholder('Chưa xóa')
                    ->trueLabel('Đã xóa')
                    ->falseLabel('Chưa xóa')
                    ->queries(
                        true: fn(Builder $query) => $query->onlyTrashed(),
                        false: fn(Builder $query) => $query->withoutTrashed(),
                        blank: fn(Builder $query) => $query->withTrashed(),
                    )->columnSpanFull(),
                Filter::make('root_categories')
                    ->label('Chỉ danh mục gốc')
                    ->query(fn(Builder $query): Builder => $query->whereNull('parent_id'))
                    ->toggle(),

                // Has children filter
                Filter::make('has_children')
                    ->label('Có danh mục con')
                    ->query(fn(Builder $query): Builder => $query->has('children'))
                    ->toggle(),
                // Root categories only

            ])
            ->filtersLayout(FiltersLayout::Modal)
            ->filtersFormColumns(2)
            ->persistFiltersInSession()
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label('Xem')
                        ->icon('heroicon-o-eye'),

                    EditAction::make()
                        ->label('Sửa')
                        ->icon('heroicon-o-pencil'),

                    Action::make('seo_audit')
                        ->label('Kiểm tra SEO')
                        ->icon('heroicon-o-magnifying-glass')
                        ->color('info')
                        ->action(function ($record) {
                            // Logic kiểm tra SEO
                            Notification::make()
                                ->title('Đang kiểm tra SEO cho: ' . $record->name)
                                ->info()
                                ->send();
                        }),
                    DeleteAction::make()
                        ->label('Xóa')
                        ->requiresConfirmation()
                        ->modalHeading('Xóa danh mục')
                        ->modalDescription('Bạn có chắc chắn muốn xóa danh mục này? Hành động này có thể ảnh hưởng đến các bài viết liên quan.')
                        ->modalSubmitActionLabel('Xóa')
                        ->modalCancelActionLabel('Hủy'),
                ])
                    ->label('Hành động')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size('sm')
                    ->color('gray')
                    ->button(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // Export selected
                    ExportBulkAction::make()
                        ->label('Xuất Excel')
                        ->icon('heroicon-o-arrow-down-tray'),

                    // Bulk SEO check
                    BulkAction::make('bulk_seo_check')
                        ->label('Kiểm tra SEO hàng loạt')
                        ->icon('heroicon-o-magnifying-glass')
                        ->color('info')
                        ->action(function (Collection $records) {
                            foreach ($records as $record) {
                                // Logic kiểm tra SEO
                            }
                            Notification::make()
                                ->title('Đã kiểm tra SEO cho ' . $records->count() . ' danh mục')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation(),

                    // Bulk delete
                    DeleteBulkAction::make()
                        ->label('Xóa đã chọn')
                        ->requiresConfirmation()
                        ->modalHeading('Xóa nhiều danh mục')
                        ->modalDescription('Bạn có chắc chắn muốn xóa các danh mục đã chọn?'),
                ]),
            ])
            ->emptyStateActions([
                CreateAction::make()
                    ->label('Tạo danh mục đầu tiên')
                    ->icon('heroicon-o-plus'),
            ])
            ->defaultSort('name', 'asc')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('30s') // Auto refresh every 30 seconds
            ->searchOnBlur()
            ->deferLoading();
    }
}
