<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Ảnh')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&color=7F9CF5&background=EBF4FF')
                    ->size(50),

                TextColumn::make('name')
                    ->label('Họ và tên')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Medium)
                    ->description(fn (User $record): ?string => $record->username ? '@' . $record->username : null),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->copyMessage('Đã sao chép email!')
                    ->placeholder('Chưa có email'),

                TextColumn::make('phone')
                    ->label('Số điện thoại')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-m-phone')
                    ->copyable()
                    ->copyMessage('Đã sao chép số điện thoại!'),

                TextColumn::make('role')
                    ->label('Vai trò')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'consultant' => 'warning',
                        'customer' => 'success',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'admin' => 'Quản trị viên',
                        'consultant' => 'Tư vấn viên',
                        'customer' => 'Khách hàng',
                    })
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Trạng thái')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->tooltip(fn (User $record): string => $record->is_active ? 'Đang hoạt động' : 'Bị khóa'),

                IconColumn::make('email_verified_at')
                    ->label('Email xác thực')
                    ->boolean()
                    ->getStateUsing(fn (User $record): bool => !is_null($record->email_verified_at))
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-exclamation-triangle')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->tooltip(fn (User $record): string => $record->email_verified_at ? 'Đã xác thực' : 'Chưa xác thực'),

                TextColumn::make('last_login_at')
                    ->label('Đăng nhập gần nhất')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('Chưa đăng nhập')
                    ->description(fn (User $record): ?string => $record->last_login_ip),

                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Cập nhật cuối')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Vai trò')
                    ->options([
                        'admin' => 'Quản trị viên',
                        'consultant' => 'Tư vấn viên',
                        'customer' => 'Khách hàng',
                    ])
                    ->native(false),

                SelectFilter::make('is_active')
                    ->label('Trạng thái hoạt động')
                    ->options([
                        1 => 'Đang hoạt động',
                        0 => 'Bị khóa',
                    ])
                    ->native(false),

                SelectFilter::make('email_verified')
                    ->label('Xác thực email')
                    ->query(fn (Builder $query, array $data): Builder => 
                        match ($data['value'] ?? null) {
                            '1' => $query->whereNotNull('email_verified_at'),
                            '0' => $query->whereNull('email_verified_at'),
                            default => $query,
                        }
                    )
                    ->options([
                        '1' => 'Đã xác thực',
                        '0' => 'Chưa xác thực',
                    ])
                    ->native(false),

                SelectFilter::make('phone_verified')
                    ->label('Xác thực số điện thoại')
                    ->query(fn (Builder $query, array $data): Builder => 
                        match ($data['value'] ?? null) {
                            '1' => $query->whereNotNull('phone_verified_at'),
                            '0' => $query->whereNull('phone_verified_at'),
                            default => $query,
                        }
                    )
                    ->options([
                        '1' => 'Đã xác thực',
                        '0' => 'Chưa xác thực',
                    ])
                    ->native(false),

                TrashedFilter::make()
                    ->label('Trạng thái xóa')
                    ->native(false),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Xem'),
                EditAction::make()
                    ->label('Sửa'),
                DeleteAction::make()
                    ->label('Xóa'),
                ForceDeleteAction::make()
                    ->label('Xóa vĩnh viễn'),
                RestoreAction::make()
                    ->label('Khôi phục'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Xóa đã chọn'),
                    ForceDeleteBulkAction::make()
                        ->label('Xóa vĩnh viễn'),
                    RestoreBulkAction::make()
                        ->label('Khôi phục đã chọn'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}
