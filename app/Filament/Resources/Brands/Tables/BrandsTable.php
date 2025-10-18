<?php

namespace App\Filament\Resources\Brands\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\IconColumn;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter as FiltersSelectFilter;
use Filament\Tables\Filters\TernaryFilter as FiltersTernaryFilter;
use Filament\Tables\Filters\TrashedFilter as FiltersTrashedFilter;
use Filament\Tables\SelectFilter;
use Filament\TernaryFilter;
use Filament\TrashedFilter;
use Filament\Tables\Table;

class BrandsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Logo
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->circular()
                    ->imageSize(40)
                    ->defaultImageUrl(fn($record) => "https://ui-avatars.com/api/?name=" . urlencode($record->name) . "&background=random")
                    ->alignCenter(),

                // Tên thương hiệu
                TextColumn::make('name')
                    ->label('Tên thương hiệu')
                    ->weight(FontWeight::Bold)
                    ->searchable()
                    ->sortable(),

                // Mô tả
                TextColumn::make('description')
                    ->label('Mô tả')
                    ->limit(60)
                    ->color('gray')
                    ->wrap(),

                // Quốc gia
                TextColumn::make('country')
                    ->label('Quốc gia')
                    ->badge()
                    ->color('primary')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'vn' => '🇻🇳 Việt Nam',
                        'jp' => '🇯🇵 Nhật Bản',
                        'kr' => '🇰🇷 Hàn Quốc',
                        'de' => '🇩🇪 Đức',
                        'us' => '🇺🇸 Hoa Kỳ',
                        'fr' => '🇫🇷 Pháp',
                        'it' => '🇮🇹 Ý',
                        'uk' => '🇬🇧 Anh',
                        'cn' => '🇨🇳 Trung Quốc',
                        'in' => '🇮🇳 Ấn Độ',
                        'se' => '🇸🇪 Thụy Điển',
                        default => $state,
                    }),

                // Năm thành lập
                TextColumn::make('founded_year')
                    ->label('Thành lập')
                    ->sortable()
                    ->icon('heroicon-m-calendar')
                    ->alignCenter(),

                // Thứ tự
                TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('info'),
            ])

            // Hiển thị dạng grid card đẹp
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                FiltersTernaryFilter::make('is_active')
                    ->label('Trạng thái')
                    ->placeholder('Tất cả')
                    ->trueLabel('Đang hoạt động')
                    ->falseLabel('Tạm dừng'),

                FiltersSelectFilter::make('country')
                    ->label('Quốc gia')
                    ->searchable()
                    ->options([
                        'vn' => 'Việt Nam',
                        'jp' => 'Nhật Bản',
                        'kr' => 'Hàn Quốc',
                        'de' => 'Đức',
                        'us' => 'Hoa Kỳ',
                        'fr' => 'Pháp',
                        'it' => 'Ý',
                        'uk' => 'Anh',
                        'cn' => 'Trung Quốc',
                        'in' => 'Ấn Độ',
                        'se' => 'Thụy Điển',
                    ]),

                FiltersTrashedFilter::make()->label('Đã xóa'),
            ])
            ->recordActions([
                EditAction::make()->label('Sửa'),
                DeleteAction::make()->label('Xóa'),
                ForceDeleteAction::make()->label('Xóa vĩnh viễn'),
                RestoreAction::make()->label('Khôi phục'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Xóa đã chọn'),
                    ForceDeleteBulkAction::make()->label('Xóa vĩnh viễn'),
                    RestoreBulkAction::make()->label('Khôi phục'),
                ]),
            ])
            ->defaultSort('sort_order')
            ->poll('30s')
            ->striped()
            ->recordClasses(fn($record) => 'hover:shadow-lg transition-all duration-300 rounded-xl bg-white');
    }
}
