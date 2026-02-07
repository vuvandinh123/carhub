<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->defaultImageUrl(url('/images/placeholder.png'))
                    
                    ->size(50),

                TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->description(fn ($record) => $record->excerpt ? \Illuminate\Support\Str::limit($record->excerpt, 60) : null)
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->wrap()
                    ->limit(50),

                TextColumn::make('category.name')
                    ->label('Danh mục')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('tags.name')
                    ->label('Tags')
                    ->badge()
                    ->color('success')
                    ->separator(',')
                    ->limit(2)
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('is_published')
                    ->label('Trạng thái')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Đã xuất bản' : 'Nháp')
                    ->color(fn ($state): string => match ($state) {
                        true => 'success',
                        false => 'warning',
                    })
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('published_at')
                    ->label('Ngày xuất bản')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('Chưa xuất bản')
                    ->toggleable()
                    ->description(fn ($record) => $record->published_at ? $record->published_at->diffForHumans() : null),

                TextColumn::make('views_count')
                    ->label('Lượt xem')
                    ->numeric()
                    ->sortable()
                    ->toggleable()
                    ->alignCenter()
                    ->default(0)
                    ->icon('heroicon-o-eye'),

                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->description(fn ($record) => $record->created_at->diffForHumans()),

                TextColumn::make('updated_at')
                    ->label('Cập nhật')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->description(fn ($record) => $record->updated_at->diffForHumans()),
            ])
            ->filters([
                // Filter theo trạng thái xuất bản
                TernaryFilter::make('is_published')
                    ->label('Trạng thái xuất bản')
                    ->placeholder('Tất cả bài viết')
                    ->trueLabel('Đã xuất bản')
                    ->falseLabel('Nháp')
                    ->native(false),

                // Filter theo danh mục
                SelectFilter::make('category_id')
                    ->label('Danh mục')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->native(false),

                // Filter theo tags
                SelectFilter::make('tags')
                    ->label('Tags')
                    ->relationship('tags', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->native(false),

                // Filter theo ngày xuất bản
                Filter::make('published_at')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('published_from')
                            ->label('Từ ngày')
                            ->native(false),
                        \Filament\Forms\Components\DatePicker::make('published_until')
                            ->label('Đến ngày')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['published_from'] ?? null) {
                            $indicators[] = 'Từ ngày: ' . \Carbon\Carbon::parse($data['published_from'])->format('d/m/Y');
                        }

                        if ($data['published_until'] ?? null) {
                            $indicators[] = 'Đến ngày: ' . \Carbon\Carbon::parse($data['published_until'])->format('d/m/Y');
                        }

                        return $indicators;
                    }),

                // Filter bài viết đã xóa
                TrashedFilter::make()
                    ->label('Bài viết đã xóa')
                    ->native(false),
            ])
            ->filtersLayout(FiltersLayout::Modal)
            ->filtersFormColumns(3)
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Bộ lọc')
                    ->icon('heroicon-m-funnel')
            )
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label('Xem')
                        ->icon('heroicon-m-eye'),
                    
                    EditAction::make()
                        ->label('Sửa')
                        ->icon('heroicon-m-pencil'),
                        
                    Action::make('publish')
                        ->label('Xuất bản')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn (Post $record) => $record->update([
                            'is_published' => true,
                            'published_at' => now(),
                        ]))
                        ->visible(fn (Post $record) => !$record->is_published),
                    
                    Action::make('unpublish')
                        ->label('Gỡ xuất bản')
                        ->icon('heroicon-m-x-circle')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(fn (Post $record) => $record->update(['is_published' => false]))
                        ->visible(fn (Post $record) => $record->is_published),
                    
                    DeleteAction::make()
                        ->label('Xóa')
                        ->icon('heroicon-m-trash'),
                    
                    ForceDeleteAction::make()
                        ->label('Xóa vĩnh viễn'),
                    
                    RestoreAction::make()
                        ->label('Khôi phục'),
                ])
                ->label('Thao tác')
                ->color('gray')
                ->button()
                ->size('sm'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Xóa đã chọn'),
                    
                    ForceDeleteBulkAction::make()
                        ->label('Xóa vĩnh viễn'),
                    
                    RestoreBulkAction::make()
                        ->label('Khôi phục'),
                    
                    BulkAction::make('publish')
                        ->label('Xuất bản hàng loạt')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $records->each(fn ($record) => $record->update([
                                'is_published' => true,
                                'published_at' => now(),
                            ]));

                            Notification::make()
                                ->title('Đã xuất bản ' . $records->count() . ' bài viết')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                    
                    BulkAction::make('unpublish')
                        ->label('Gỡ xuất bản hàng loạt')
                        ->icon('heroicon-m-x-circle')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $records->each(fn ($record) => $record->update(['is_published' => false]));

                            Notification::make()
                                ->title('Đã gỡ xuất bản ' . $records->count() . ' bài viết')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('30s')
            ->deferLoading()
            ->searchOnBlur();
    }
}
