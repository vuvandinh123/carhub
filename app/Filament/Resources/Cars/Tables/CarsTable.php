<?php

namespace App\Filament\Resources\Cars\Tables;

use App\Models\Car;
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
use Filament\Forms\Components\Select as ComponentsSelect;
use Filament\Forms\Components\TextInput;
use Filament\Select;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
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

class CarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->imageSize(60)
                    ->defaultImageUrl(fn($record) => "https://ui-avatars.com/api/?name=" . urlencode($record->name) . "&background=random")
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->circular(),

                TextColumn::make('title')
                    ->label('Tên xe')
                    ->weight(500)
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('brand.name')
                    ->label('Thương hiệu')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->color('primary'),

                TextColumn::make('categories.name')
                    ->label('Danh mục')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->color('secondary')
                    ->separator(', '), // Ngăn cách các tên danh mục

                TextColumn::make('year')
                    ->label('Năm SX')
                    ->sortable()
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->color('gray'),

                TextColumn::make('price')
                    ->label('Giá bán')
                    ->money('VND')
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->color('success')
                    ->formatStateUsing(fn($state) => $state ? number_format($state) . ' ₫' : 'Liên hệ'),

                TextColumn::make('quantity')
                    ->label('Số lượng')
                    ->badge()
                    ->color(fn(int $state): string => match (true) {
                        $state > 10 => 'success',
                        $state > 5 => 'warning',
                        $state > 0 => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(int $state): string => $state . ' xe'),

                TextColumn::make('fuelType.name')
                    ->label('Nhiên liệu')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->color('info'),

                TextColumn::make('transmission.name')
                    ->label('Hộp số')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->color('warning'),

                TextColumn::make('seats')
                    ->label('Chỗ ngồi')
                    ->badge()
                    ->color('purple')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->suffix(' chỗ'),

                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'available' => 'success',
                        'sold' => 'danger',
                        'coming_soon' => 'warning',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'available' => 'Còn bán',
                        'sold' => 'Đã bán',
                        'coming_soon' => 'Sắp ra mắt',
                    }),

                TextColumn::make('mileage')
                    ->label('Số km')
                    ->formatStateUsing(fn($state) => $state ? number_format($state) . ' km' : 'Xe mới')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->color(fn($state) => $state ? 'warning' : 'success'),

                TextColumn::make('created_at')
                    ->label('Ngày đăng')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->color('gray'),
                TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->color('gray'),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                // Filter theo thương hiệu
                SelectFilter::make('brand_id')
                    ->label('Thương hiệu')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple(),

                // Filter theo danh mục
                SelectFilter::make('category_id')
                    ->label('Danh mục')
                    ->relationship('categories', 'name')
                    ->searchable()
                    ->preload(),

                // Filter theo trạng thái
                SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'available' => 'Còn bán',
                        'sold' => 'Đã bán',
                        'coming_soon' => 'Sắp ra mắt',
                    ])
                    ->multiple(),

                // Filter theo năm sản xuất
                Filter::make('year_range')
                    ->form([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('year_from')
                                    ->label('Từ năm')
                                    ->numeric()
                                    ->placeholder(date('Y') - 10),
                                TextInput::make('year_to')
                                    ->label('Đến năm')
                                    ->numeric()
                                    ->placeholder(date('Y')),
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['year_from'] ?? null,
                                fn(Builder $query, $year): Builder => $query->where('year', '>=', $year),
                            )
                            ->when(
                                $data['year_to'] ?? null,
                                fn(Builder $query, $year): Builder => $query->where('year', '<=', $year),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['year_from'] ?? null) {
                            $indicators['year_from'] = 'Từ năm: ' . $data['year_from'];
                        }
                        if ($data['year_to'] ?? null) {
                            $indicators['year_to'] = 'Đến năm: ' . $data['year_to'];
                        }
                        return $indicators;
                    }),

                // Filter theo giá
                Filter::make('price_range')
                    ->form([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('price_from')
                                    ->label('Giá từ')
                                    ->numeric()
                                    ->prefix('₫')
                                    ->placeholder('500,000,000'),
                                TextInput::make('price_to')
                                    ->label('Giá đến')
                                    ->numeric()
                                    ->prefix('₫')
                                    ->placeholder('2,000,000,000'),
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['price_from'] ?? null,
                                fn(Builder $query, $price): Builder => $query->where('price', '>=', $price),
                            )
                            ->when(
                                $data['price_to'] ?? null,
                                fn(Builder $query, $price): Builder => $query->where('price', '<=', $price),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['price_from'] ?? null) {
                            $indicators['price_from'] = 'Giá từ: ' . number_format($data['price_from']) . ' ₫';
                        }
                        if ($data['price_to'] ?? null) {
                            $indicators['price_to'] = 'Giá đến: ' . number_format($data['price_to']) . ' ₫';
                        }
                        return $indicators;
                    }),

                // Filter theo loại nhiên liệu
                SelectFilter::make('fuel_type_id')
                    ->label('Nhiên liệu')
                    ->relationship('fuelType', 'name')
                    ->searchable()
                    ->preload(),

                // Filter theo hộp số
                SelectFilter::make('transmission_id')
                    ->label('Hộp số')
                    ->relationship('transmission', 'name')
                    ->searchable()
                    ->preload(),

                // Filter xe cũ/mới
                TernaryFilter::make('is_used')
                    ->label('Tình trạng')
                    ->placeholder('Tất cả')
                    ->trueLabel('Xe cũ')
                    ->falseLabel('Xe mới')
                    ->queries(
                        true: fn(Builder $query) => $query->whereNotNull('mileage')->where('mileage', '>', 0),
                        false: fn(Builder $query) => $query->where('mileage', 0)->orWhereNull('mileage'),
                    ),

                // Filter xóa mềm
                TrashedFilter::make()
                    ->label('Đã xóa'),
            ])
            ->filtersLayout(FiltersLayout::Modal)
            ->filtersFormColumns(3)
            ->filtersTriggerAction(
                fn(Action $action) => $action
                    ->button()
                    ->label('Bộ lọc')
                    ->icon('heroicon-m-funnel')
            )
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label('Xem chi tiết')
                        ->icon('heroicon-m-eye'),
                    EditAction::make()
                        ->label('Chỉnh sửa')
                        ->icon('heroicon-m-pencil'),
                    Action::make('duplicate')
                        ->label('Nhân bản')
                        ->icon('heroicon-m-document-duplicate')
                        ->action(function (Car $record) {
                            $newCar = $record->replicate();
                            $newCar->title = $record->title . ' (Bản sao)';
                            $newCar->save();

                            Notification::make()
                                ->title('Đã nhân bản xe')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation(),
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

                    // Bulk action thay đổi trạng thái
                    BulkAction::make('updateStatus')
                        ->label('Cập nhật trạng thái')
                        ->icon('heroicon-m-check-circle')
                        ->schema([
                            ComponentsSelect::make('status')
                                ->label('Trạng thái mới')
                                ->options([
                                    'available' => 'Còn bán',
                                    'sold' => 'Đã bán',
                                    'coming_soon' => 'Sắp ra mắt',
                                ])
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $records->each(function ($record) use ($data) {
                                $record->update(['status' => $data['status']]);
                            });

                            Notification::make()
                                ->title('Đã cập nhật trạng thái cho ' . $records->count() . ' xe')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('60s')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->searchOnBlur()
            ->deferLoading();
    }
}
