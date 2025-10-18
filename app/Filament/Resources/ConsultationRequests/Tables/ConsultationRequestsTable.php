<?php

namespace App\Filament\Resources\ConsultationRequests\Tables;

use Filament\Tables\Table;
use Filament\TrashedFilter;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Actions\ForceDeleteBulkAction;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Filters\TrashedFilter as FiltersTrashedFilter;

class ConsultationRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // ID
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable()
                    ->prefix('#')
                    ->weight(FontWeight::Bold)
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Tên khách hàng
                TextColumn::make('name')
                    ->label('Khách hàng')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->icon('heroicon-m-user')
                    ->color('primary')
                    ->copyable()
                    ->copyMessage('Đã sao chép tên'),

                // Số điện thoại
                TextColumn::make('phone')
                    ->label('Số điện thoại')
                    ->icon('heroicon-m-phone')
                    ->color('success')
                    ->copyable()
                    ->copyMessage('Đã sao chép SĐT')
                    ->formatStateUsing(
                        fn(string $state): string =>
                        substr($state, 0, 4) . '***' . substr($state, -3)
                    )
                    ->tooltip(fn($record) => $record->phone),

                // Email
                TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->color('info')
                    ->copyable()
                    ->copyMessage('Đã sao chép email')
                    ->placeholder('Chưa có email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit(25),

                // Xe quan tâm
                TextColumn::make('car.title')
                    ->label('Xe quan tâm')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function ($record) {
                        if (!$record->car) return 'Tư vấn chung';
                        return $record->car->title . ' - ' . number_format($record->car->price) . '₫';
                    })
                    ->description(fn($record) => $record->car?->brand?->name ?? '')
                    ->icon('heroicon-m-truck')
                    ->color('secondary')
                    ->limit(40)
                    ->tooltip(fn($record) => $record->car?->title)
                    ->toggleable(),

                // Nguồn khách hàng
                TextColumn::make('source')
                    ->label('Nguồn')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'website' => 'Website',
                        'facebook' => 'Facebook',
                        'zalo' => 'Zalo',
                        'offline' => 'Showroom',
                        'other' => 'Khác',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'website' => 'primary',
                        'facebook' => 'info',
                        'zalo' => 'warning',
                        'offline' => 'success',
                        'other' => 'gray',
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'website' => 'heroicon-m-globe-alt',
                        'facebook' => 'heroicon-m-chat-bubble-left',
                        'zalo' => 'heroicon-m-device-phone-mobile',
                        'offline' => 'heroicon-m-building-storefront',
                        'other' => 'heroicon-m-ellipsis-horizontal',
                    })
                    ->sortable()
                    ->toggleable(),

                // Trạng thái (chỉnh sửa inline)
                SelectColumn::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending' => 'Chờ xử lý',
                        'contacted' => 'Đã liên hệ',
                        'in_progress' => 'Đang tư vấn',
                        'closed' => 'Đã đóng',
                    ])
                    ->selectablePlaceholder(false)
                    ->beforeStateUpdated(function ($record, $state) {
                        if ($state === 'contacted' && !$record->contacted_at) {
                            $record->contacted_at = now();
                            $record->save();
                        }
                        if ($state === 'closed' && !$record->closed_at) {
                            $record->closed_at = now();
                            $record->save();
                        }
                    })
                    ->afterStateUpdated(function () {
                        Notification::make()
                            ->title('Đã cập nhật trạng thái')
                            ->success()
                            ->send();
                    })
                    ->rules(['required'])
                    ->sortable(),

                // Nhân viên phụ trách
                TextColumn::make('assignedTo.name')
                    ->label('NV phụ trách')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Chưa phân công')
                    ->badge()
                    ->color('success')
                    ->icon('heroicon-m-user-circle')
                    ->toggleable(),

                // Ghi chú
                TextColumn::make('note')
                    ->label('Ghi chú')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(fn($record) => $record->note)
                    ->placeholder('Không có ghi chú')
                    ->icon('heroicon-m-document-text')
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Thời gian liên hệ mong muốn
                TextColumn::make('preferred_contact_time')
                    ->label('Thời gian liên hệ')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'morning' => '🌅 Sáng',
                        'afternoon' => '☀️ Chiều',
                        'evening' => '🌆 Tối',
                        'anytime' => '⏰ Bất kỳ',
                        'weekend' => '🎯 Cuối tuần',
                        default => $state ?? 'Chưa chọn',
                    })
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // User liên kết
                TextColumn::make('user.name')
                    ->label('Tài khoản')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Khách vãng lai')
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-m-identification')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Thời gian đã liên hệ
                TextColumn::make('contacted_at')
                    ->label('Đã liên hệ lúc')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('Chưa liên hệ')
                    ->color('success')
                    ->icon('heroicon-m-phone')
                    ->toggleable(),

                // Thời gian đóng
                TextColumn::make('closed_at')
                    ->label('Đóng lúc')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('Chưa đóng')
                    ->color('primary')
                    ->icon('heroicon-m-check-circle')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Ngày tạo
                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->since()
                    ->description(fn($record) => $record->created_at->format('d/m/Y H:i'))
                    ->icon('heroicon-m-calendar')
                    ->color('gray')
                    ->toggleable(),

                // Ngày cập nhật
                TextColumn::make('updated_at')
                    ->label('Cập nhật lần cuối')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->since()
                    ->icon('heroicon-m-arrow-path')
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                // Filter theo trạng thái
                SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending' => '⏳ Chờ xử lý',
                        'contacted' => '📞 Đã liên hệ',
                        'in_progress' => '🔄 Đang tư vấn',
                        'closed' => '✅ Đã đóng',
                    ])
                    ->multiple()
                    ->placeholder('Tất cả trạng thái'),

                // Filter theo nguồn
                SelectFilter::make('source')
                    ->label('Nguồn khách hàng')
                    ->options([
                        'website' => '🌐 Website',
                        'facebook' => '📘 Facebook',
                        'zalo' => '💬 Zalo',
                        'offline' => '🏪 Showroom',
                        'other' => '📞 Khác',
                    ])
                    ->multiple()
                    ->placeholder('Tất cả nguồn'),

                // Filter theo nhân viên phụ trách
                SelectFilter::make('assigned_to')
                    ->label('Nhân viên phụ trách')
                    ->relationship('assignedTo', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->placeholder('Tất cả nhân viên'),

                // Filter theo thương hiệu xe
                SelectFilter::make('car_brand')
                    ->label('Thương hiệu xe')
                    ->relationship('car.brand', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->placeholder('Tất cả thương hiệu'),

                // Filter có tài khoản hay không
                TernaryFilter::make('has_user_account')
                    ->label('Tài khoản')
                    ->placeholder('Tất cả')
                    ->trueLabel('Có tài khoản')
                    ->falseLabel('Khách vãng lai')
                    ->queries(
                        true: fn(Builder $query) => $query->whereNotNull('user_id'),
                        false: fn(Builder $query) => $query->whereNull('user_id'),
                    ),

                // Filter đã liên hệ chưa
                TernaryFilter::make('is_contacted')
                    ->label('Đã liên hệ')
                    ->placeholder('Tất cả')
                    ->trueLabel('Đã liên hệ')
                    ->falseLabel('Chưa liên hệ')
                    ->queries(
                        true: fn(Builder $query) => $query->whereNotNull('contacted_at'),
                        false: fn(Builder $query) => $query->whereNull('contacted_at'),
                    ),

                // Filter theo thời gian tạo
                Filter::make('created_date_range')
                    ->schema([
                        DatePicker::make('created_from')
                            ->label('Từ ngày')
                            ->placeholder('Chọn ngày bắt đầu')
                            ->native(false),
                        DatePicker::make('created_until')
                            ->label('Đến ngày')
                            ->placeholder('Chọn ngày kết thúc')
                            ->native(false),
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
                            $indicators['created_from'] = 'Từ: ' . \Carbon\Carbon::parse($data['created_from'])->format('d/m/Y');
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Đến: ' . \Carbon\Carbon::parse($data['created_until'])->format('d/m/Y');
                        }
                        return $indicators;
                    }),

                // Filter theo thời gian liên hệ mong muốn
                SelectFilter::make('preferred_contact_time')
                    ->label('Thời gian liên hệ mong muốn')
                    ->options([
                        'morning' => '🌅 Buổi sáng',
                        'afternoon' => '☀️ Buổi chiều',
                        'evening' => '🌆 Buổi tối',
                        'anytime' => '⏰ Bất cứ lúc nào',
                        'weekend' => '🎯 Cuối tuần',
                    ])
                    ->multiple(),

                // Filter xóa mềm
                FiltersTrashedFilter::make()
                    ->label('Đã xóa'),
            ])
            ->filtersLayout(FiltersLayout::Modal)
            ->filtersFormColumns(3)
            ->filtersTriggerAction(
                fn(Action $action) => $action
                    ->button()
                    ->label('Bộ lọc')
                    ->icon('heroicon-m-funnel')
                    ->badge(fn($livewire) => count($livewire->tableFilters))
            )
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label('Xem chi tiết')
                        ->icon('heroicon-m-eye')
                        ->color('info'),

                    EditAction::make()
                        ->label('Chỉnh sửa')
                        ->icon('heroicon-m-pencil')
                        ->color('warning'),

                    Action::make('call')
                        ->label('Gọi điện')
                        ->icon('heroicon-m-phone')
                        ->color('success')
                        ->url(fn($record) => 'tel:' . $record->phone)
                        ->openUrlInNewTab(false)
                        ->action(function ($record) {
                            if (!$record->contacted_at) {
                                $record->update([
                                    'contacted_at' => now(),
                                    'status' => $record->status === 'pending' ? 'contacted' : $record->status,
                                ]);
                            }
                        }),

                    Action::make('email')
                        ->label('Gửi email')
                        ->icon('heroicon-m-envelope')
                        ->color('info')
                        ->url(fn($record) => 'mailto:' . $record->email)
                        ->openUrlInNewTab(false)
                        ->visible(fn($record) => !empty($record->email)),

                    Action::make('assign')
                        ->label('Phân công')
                        ->icon('heroicon-m-user-plus')
                        ->color('primary')
                        ->schema([
                            Select::make('assigned_to')
                                ->label('Nhân viên phụ trách')
                                ->relationship('assignedTo', 'name')
                                ->searchable()
                                ->required()
                                ->native(false),
                        ])
                        ->action(function (array $data, $record) {
                            $record->update($data);
                            Notification::make()
                                ->title('Đã phân công thành công')
                                ->success()
                                ->send();
                        }),

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

                    // Bulk action cập nhật trạng thái
                    BulkAction::make('bulk_update_status')
                        ->label('Cập nhật trạng thái')
                        ->icon('heroicon-m-check-circle')
                        ->color('primary')
                        ->form([
                            Select::make('status')
                                ->label('Trạng thái mới')
                                ->options([
                                    'pending' => 'Chờ xử lý',
                                    'contacted' => 'Đã liên hệ',
                                    'in_progress' => 'Đang tư vấn',
                                    'closed' => 'Đã đóng',
                                ])
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $records->each(function ($record) use ($data) {
                                $updateData = ['status' => $data['status']];

                                if ($data['status'] === 'contacted' && !$record->contacted_at) {
                                    $updateData['contacted_at'] = now();
                                }
                                if ($data['status'] === 'closed' && !$record->closed_at) {
                                    $updateData['closed_at'] = now();
                                }

                                $record->update($updateData);
                            });

                            Notification::make()
                                ->title('Đã cập nhật trạng thái cho ' . $records->count() . ' yêu cầu')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),

                    // Bulk action phân công nhân viên
                    BulkAction::make('bulk_assign')
                        ->label('Phân công hàng loạt')
                        ->icon('heroicon-m-user-group')
                        ->color('warning')
                        ->schema([
                            Select::make('assigned_to')
                                ->label('Nhân viên phụ trách')
                                ->relationship('assignedTo', 'name')
                                ->searchable()
                                ->required()
                                ->native(false),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $records->each->update($data);

                            Notification::make()
                                ->title('Đã phân công ' . $records->count() . ' yêu cầu')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100, 'all'])
            ->poll('30s')
            ->searchOnBlur()
            ->deferLoading()
            ->persistFiltersInSession()
            ->persistSortInSession()
            ->persistSearchInSession()
            ->emptyStateHeading('Chưa có yêu cầu tư vấn')
            ->emptyStateDescription('Khi có yêu cầu tư vấn mới, chúng sẽ hiển thị tại đây.')
            ->emptyStateIcon('heroicon-o-chat-bubble-left-right');
    }
}
