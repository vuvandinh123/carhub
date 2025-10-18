<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Columns\Layout\Split;
use Illuminate\Support\HtmlString;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            // Header Section với Avatar và thông tin chính
            Section::make()->schema([
                Grid::make(3)->schema([
                    Group::make([
                        ImageEntry::make('avatar')
                            ->hiddenLabel()
                            ->circular()
                            ->size(120)
                            ->defaultImageUrl(fn($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&color=7F9CF5&background=EBF4FF&size=200')
                            ->extraAttributes(['class' => 'mx-auto']),
                    ])->columnSpan(1),

                    Grid::make(columns: 2)
                        ->schema([
                            TextEntry::make('name')->label('Họ và tên')->size('lg')->weight(FontWeight::Bold)->color('primary')->icon('heroicon-o-user'),

                            TextEntry::make('username')->label('Tên đăng nhập')->prefix('@')->placeholder('Chưa đặt')->color('gray')->icon('heroicon-o-at-symbol'),

                            TextEntry::make('role')
                                ->label('Vai trò')
                                ->badge()
                                ->color(
                                    fn(string $state): string => match ($state) {
                                        'admin' => 'danger',
                                        'consultant' => 'warning',
                                        'customer' => 'success',
                                    },
                                )
                                ->formatStateUsing(
                                    fn(string $state): string => match ($state) {
                                        'admin' => '👑 Quản trị viên',
                                        'consultant' => '💼 Tư vấn viên',
                                        'customer' => '👤 Khách hàng',
                                    },
                                ),

                            TextEntry::make('is_active')->label('Trạng thái')->badge()->color(fn(bool $state): string => $state ? 'success' : 'danger')->formatStateUsing(fn(bool $state): string => $state ? '✅ Đang hoạt động' : '❌ Bị khóa'),
                        ])
                        ->columnSpan(span: 2),
                ]),
            ]),
            Section::make('📞 Thông tin liên hệ')
                ->description('Các phương thức liên lạc với người dùng')
                ->icon('heroicon-o-phone')
                ->schema([Grid::make(2)->schema([TextEntry::make('email')->label('Địa chỉ Email')->placeholder('Chưa cung cấp')->icon('heroicon-o-envelope')->iconPosition(IconPosition::Before)->copyable()->copyMessage('Đã sao chép email!')->copyMessageDuration(1500)->url(fn($record) => $record->email ? "mailto:{$record->email}" : null)->color('primary'), TextEntry::make('phone')->label('Số điện thoại')->icon('heroicon-o-device-phone-mobile')->iconPosition(IconPosition::Before)->copyable()->copyMessage('Đã sao chép số điện thoại!')->copyMessageDuration(1500)->url(fn($record) => "tel:{$record->phone}")->color('success')])]),
            Grid::make(columns: 2)
                ->schema([
                    Group::make([
                        // Thông tin liên hệ
                    ]),
                ])
                ->columnSpanFull(),

            // Trạng thái xác thực
            Section::make('✅ Trạng thái xác thực')
                ->description('Tình trạng xác minh thông tin liên hệ')
                ->icon('heroicon-o-shield-check')
                ->schema([Grid::make(2)->schema([Group::make([TextEntry::make('email_verified_at')->label('Email đã xác thực')->dateTime('d/m/Y H:i')->placeholder('❌ Chưa xác thực')->icon('heroicon-o-envelope-open')->color(fn($record) => $record->email_verified_at ? 'success' : 'danger')->badge(fn($record) => !is_null($record->email_verified_at))->formatStateUsing(fn($record) => $record->email_verified_at ? '✅ ' . $record->email_verified_at->format('d/m/Y H:i') : '❌ Chưa xác thực')]), Group::make([TextEntry::make('phone_verified_at')->label('Số điện thoại đã xác thực')->dateTime('d/m/Y H:i')->placeholder('❌ Chưa xác thực')->icon('heroicon-o-device-phone-mobile')->color(fn($record) => $record->phone_verified_at ? 'success' : 'danger')->badge(fn($record) => !is_null($record->phone_verified_at))->formatStateUsing(fn($record) => $record->phone_verified_at ? '✅ ' . $record->phone_verified_at->format('d/m/Y H:i') : '❌ Chưa xác thực')])])])
                ->collapsible(),

            // Thông tin bảo mật
            Section::make('🔐 Thông tin bảo mật & Đăng nhập')
                ->description('Lịch sử và thông tin đăng nhập')
                ->icon('heroicon-o-lock-closed')
                ->schema([Grid::make(3)->schema([TextEntry::make('last_login_at')->label('Đăng nhập gần nhất')->dateTime('d/m/Y H:i')->placeholder('Chưa từng đăng nhập')->icon('heroicon-o-clock')->color('info')->since()->tooltip(fn($record) => $record->last_login_at ? 'Chính xác: ' . $record->last_login_at->format('d/m/Y H:i:s') : 'Người dùng chưa từng đăng nhập'), TextEntry::make('last_login_ip')->label('Địa chỉ IP cuối cùng')->placeholder('Không có thông tin')->icon('heroicon-o-globe-alt')->color('gray')->copyable()->copyMessage('Đã sao chép IP!')->formatStateUsing(fn($state) => $state ?: 'N/A'), TextEntry::make('created_at')->label('Ngày tạo tài khoản')->dateTime('d/m/Y H:i')->icon('heroicon-o-calendar-days')->color('success')->since()->tooltip(fn($record) => 'Chính xác: ' . $record->created_at->format('d/m/Y H:i:s'))])])
                ->collapsible(),

            // Thống kê hoạt động
            Section::make('📊 Thống kê & Hoạt động')
                ->description('Thông tin chi tiết về hoạt động của người dùng')
                ->icon('heroicon-o-chart-bar')
                ->schema([
                    KeyValueEntry::make('statistics')->label('Thống kê tổng quan')->hiddenLabel()->keyLabel('Chỉ số')->valueLabel('Giá trị')->getStateUsing(
                        fn($record) => [
                            '⏱️ Thời gian tham gia' => $record->created_at->diffForHumans(),
                            '🔑 Số lần đăng nhập' => $record->last_login_at ? 'Có hoạt động' : 'Chưa hoạt động',
                            '📧 Trạng thái email' => $record->hasVerifiedEmail() ? '✅ Đã xác thực' : '❌ Chưa xác thực',
                            '🏷️ Cấp độ truy cập' => match ($record->role) {
                                'admin' => '🔴 Quản trị viên (Cao nhất)',
                                'consultant' => '🟡 Tư vấn viên (Trung bình)',
                                'customer' => '🟢 Khách hàng (Cơ bản)',
                            },
                            '🔒 Trạng thái tài khoản' => $record->is_active ? '🟢 Hoạt động bình thường' : '🔴 Bị tạm khóa',
                        ],
                    ),
                ])
                ->collapsible(),

            // Thông tin hệ thống
            Section::make('⚙️ Thông tin hệ thống')
                ->description('Dữ liệu kỹ thuật và quản trị')
                ->icon('heroicon-o-cog-6-tooth')
                ->schema([Grid::make(3)->schema([TextEntry::make('id')->label('ID người dùng')->badge()->color('gray')->prefix('#')->copyable(), TextEntry::make('updated_at')->label('Cập nhật cuối')->dateTime('d/m/Y H:i')->icon('heroicon-o-arrow-path')->color('warning')->since(), TextEntry::make('deleted_at')->label('Thời gian xóa')->dateTime('d/m/Y H:i')->placeholder('Chưa bị xóa')->icon('heroicon-o-trash')->color('danger')->visible(fn($record) => $record->trashed())]), TextEntry::make('remember_token')->label('Token nhớ đăng nhập')->placeholder('Không có token')->formatStateUsing(fn($state) => $state ? '✅ Có token hoạt động' : '❌ Không có token')->color(fn($state) => $state ? 'success' : 'gray')->icon('heroicon-o-key')])
                ->collapsible(),

            // Timeline hoạt động (nếu bạn có dữ liệu)
            Section::make('📅 Lịch sử hoạt động')
                ->description('Dòng thời gian các sự kiện quan trọng')
                ->columnSpanFull()
                ->icon('heroicon-o-clock')
                ->schema([
                    TextEntry::make('activity_timeline')
                        ->hiddenLabel()
                        ->formatStateUsing(function ($record) {
                            $timeline = [];

                            if ($record->created_at) {
                                $timeline[] = "🎉 <strong>Tài khoản được tạo</strong><br><small class='text-gray-500'>📅 " . $record->created_at->format('d/m/Y H:i') . ' (' . $record->created_at->diffForHumans() . ')</small>';
                            }

                            if ($record->email_verified_at) {
                                $timeline[] = "✅ <strong>Email được xác thực</strong><br><small class='text-gray-500'>📧 " . $record->email_verified_at->format('d/m/Y H:i') . ' (' . $record->email_verified_at->diffForHumans() . ')</small>';
                            }

                            if ($record->phone_verified_at) {
                                $timeline[] = "✅ <strong>Số điện thoại được xác thực</strong><br><small class='text-gray-500'>📱 " . $record->phone_verified_at->format('d/m/Y H:i') . ' (' . $record->phone_verified_at->diffForHumans() . ')</small>';
                            }

                            if ($record->last_login_at) {
                                $timeline[] = "🔑 <strong>Đăng nhập gần nhất</strong><br><small class='text-gray-500'>⏰ " . $record->last_login_at->format('d/m/Y H:i') . ' (' . $record->last_login_at->diffForHumans() . ")</small><br><small class='text-gray-500'>🌐 IP: " . ($record->last_login_ip ?: 'N/A') . '</small>';
                            }

                            if ($record->updated_at && $record->updated_at != $record->created_at) {
                                $timeline[] = "✏️ <strong>Thông tin được cập nhật</strong><br><small class='text-gray-500'>📝 " . $record->updated_at->format('d/m/Y H:i') . ' (' . $record->updated_at->diffForHumans() . ')</small>';
                            }

                            if ($record->trashed()) {
                                $timeline[] = "🗑️ <strong>Tài khoản bị xóa</strong><br><small class='text-gray-500'>❌ " . $record->deleted_at->format('d/m/Y H:i') . ' (' . $record->deleted_at->diffForHumans() . ')</small>';
                            }

                            return new HtmlString('<div class="space-y-4">' . implode('<hr class="my-3 border-gray-200">', $timeline) . '</div>');
                        }),
                ])
                ->collapsible()
                ->collapsed(),
        ]);
    }
}
