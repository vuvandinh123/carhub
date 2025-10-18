<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Ảnh')
                    ->defaultImageUrl(fn ($record) => "https://ui-avatars.com/api/?name=" . urlencode($record->name) . "&background=random")
                    ->circular(),

                TextColumn::make('name')
                    ->label('Tên danh mục')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('parent.name')
                    ->label('Danh mục cha')
                    ->sortable(),

                ToggleColumn::make('is_active')
                    ->label('Trạng thái')
                    ->onColor('success')
                    ->offColor('danger')
                    ->disabledClick(), // chặn click mở trang sửa

                TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Cập nhật')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Trạng thái')
                    ->placeholder('Tất cả')
                    ->trueLabel('Đang hoạt động')
                    ->falseLabel('Đã tạm dừng'),

                TrashedFilter::make()->label('Đã xóa'),
                // filter theo danh muc
                SelectFilter::make('parent_id')
                    ->label('Danh mục cha')
                    ->relationship('parent', 'name'),
            ])
            ->recordActions([
                EditAction::make()->label('Sửa'),
                DeleteAction::make()->label('Xóa'),
                RestoreAction::make()->label('Khôi phục'),
                ForceDeleteAction::make()->label('Xóa vĩnh viễn'),
            ])
            ->toolbarActions([
                DeleteBulkAction::make()->label('Xóa đã chọn'),
                RestoreBulkAction::make()->label('Khôi phục'),
                ForceDeleteBulkAction::make()->label('Xóa vĩnh viễn'),
            ])
            ->defaultSort('sort_order')
            ->striped();
    }
}
