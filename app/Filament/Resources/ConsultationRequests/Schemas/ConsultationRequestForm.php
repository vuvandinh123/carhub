<?php

namespace App\Filament\Resources\ConsultationRequests\Schemas;

use Filament\DateTimePicker;
use Filament\Forms\Components\DateTimePicker as ComponentsDateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ConsultationRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            Group::make()
                ->schema([
                    Section::make('Thông tin khách hàng')
                        ->description('Thông tin liên hệ của khách hàng')
                        ->icon('heroicon-o-user-circle')
                        ->schema([
                            TextInput::make('name')
                                ->label('Họ và tên')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Nhập họ tên đầy đủ')
                                ->prefixIcon('heroicon-m-user')
                                ->autocomplete('name')
                                ->columnSpan(2),

                            TextInput::make('phone')
                                ->label('Số điện thoại')
                                ->required()
                                ->tel()
                                ->placeholder('0901234567')
                                ->prefixIcon('heroicon-m-phone')
                                ->mask('9999999999')
                                ->rules([
                                    'regex:/^(0[3|5|7|8|9])+([0-9]{8})$/',
                                ])
                                ->validationMessages([
                                    'regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại Việt Nam.',
                                ])
                                ->helperText('Ví dụ: 0901234567'),

                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->placeholder('khachhang@email.com')
                                ->prefixIcon('heroicon-m-envelope')
                                ->autocomplete('email')
                                ->helperText('Email để nhận thông tin tư vấn (không bắt buộc)'),

                            Select::make('user_id')
                                ->label('Tài khoản liên kết')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->placeholder('Chọn nếu khách hàng đã có tài khoản')
                                ->prefixIcon('heroicon-m-identification')
                                ->native(false)
                                ->helperText('Liên kết với tài khoản đã đăng ký (nếu có)')
                                ->columnSpan(2),
                        ])
                        ->columns(2),

                    Section::make('Thông tin xe quan tâm')
                        ->description('Xe mà khách hàng muốn tư vấn')
                        ->icon('heroicon-o-truck')
                        ->schema([
                            Select::make('car_id')
                                ->label('Xe quan tâm')
                                ->relationship('car', 'title')
                                ->searchable()
                                ->preload()
                                ->placeholder('Chọn xe mà khách hàng quan tâm')
                                ->prefixIcon('heroicon-m-truck')
                                ->native(false)
                                ->helperText('Có thể để trống nếu khách hàng chưa xác định xe cụ thể')
                                ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->title} - {$record->brand->name} ({$record->year})")
                                ->columnSpanFull(),
                        ]),

                    Section::make('Nội dung yêu cầu')
                        ->description('Chi tiết về yêu cầu tư vấn')
                        ->icon('heroicon-o-chat-bubble-left-right')
                        ->schema([
                            Textarea::make('note')
                                ->label('Ghi chú yêu cầu')
                                ->rows(4)
                                ->placeholder('Mô tả chi tiết về nhu cầu, câu hỏi hoặc yêu cầu tư vấn...')
                                ->helperText('Thông tin chi tiết giúp nhân viên tư vấn hiểu rõ nhu cầu')
                                ->columnSpanFull(),

                            Select::make('source')
                                ->label('Nguồn khách hàng')
                                ->required()
                                ->options([
                                    'website' => '🌐 Website',
                                    'facebook' => '📘 Facebook',
                                    'zalo' => '💬 Zalo',
                                    'offline' => '🏪 Tại showroom',
                                    'other' => '📞 Khác',
                                ])
                                ->default('website')
                                ->native(false)
                                ->prefixIcon('heroicon-m-globe-alt')
                                ->helperText('Khách hàng biết đến chúng tôi qua kênh nào?'),

                            Select::make('preferred_contact_time')
                                ->label('Thời gian liên hệ mong muốn')
                                ->options([
                                    'morning' => '🌅 Buổi sáng (8:00 - 12:00)',
                                    'afternoon' => '☀️ Buổi chiều (12:00 - 17:00)', 
                                    'evening' => '🌆 Buổi tối (17:00 - 21:00)',
                                    'anytime' => '⏰ Bất cứ lúc nào',
                                    'weekend' => '🎯 Cuối tuần',
                                ])
                                ->placeholder('Chọn thời gian thuận tiện')
                                ->native(false)
                                ->prefixIcon('heroicon-m-clock')
                                ->helperText('Thời gian nào khách hàng thuận tiện nhận cuộc gọi?'),
                        ])
                        ->columns(2),
                ])
                ->columnSpan(['lg' => 2]),

            Group::make()
                ->schema([
                    Section::make('Quản lý yêu cầu')
                        ->description('Thông tin xử lý yêu cầu')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Select::make('status')
                                ->label('Trạng thái xử lý')
                                ->required()
                                ->options([
                                    'pending' => 'Chờ xử lý',
                                    'contacted' => 'Đã liên hệ',
                                    'in_progress' => 'Đang tư vấn',
                                    'closed' => 'Đã đóng',
                                ])
                                ->default('pending')
                                ->native(false)
                                ->live()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    if ($state === 'contacted' || $state === 'in_progress') {
                                        $set('contacted_at', now());
                                    }
                                    if ($state === 'closed') {
                                        $set('closed_at', now());
                                    }
                                }),

                            Select::make('assigned_to')
                                ->label('Nhân viên phụ trách')
                                ->relationship('assignedTo', 'name')
                                ->searchable()
                                ->placeholder('Chọn nhân viên tư vấn')
                                ->prefixIcon('heroicon-m-user-circle')
                                ->native(false)
                                ->helperText('Giao yêu cầu cho nhân viên tư vấn'),

                            ComponentsDateTimePicker::make('contacted_at')
                                ->label('Thời gian đã liên hệ')
                                ->placeholder('Chọn thời gian đã liên hệ')
                                ->prefixIcon('heroicon-m-phone')
                                ->native(false)
                                ->displayFormat('d/m/Y H:i')
                                ->helperText('Thời điểm đã gọi điện cho khách hàng'),

                            ComponentsDateTimePicker::make('closed_at')
                                ->label('Thời gian đóng yêu cầu')
                                ->placeholder('Chọn thời gian đóng')
                                ->prefixIcon('heroicon-m-check-circle')
                                ->native(false)
                                ->displayFormat('d/m/Y H:i')
                                ->helperText('Thời điểm hoàn thành yêu cầu'),
                        ]),

                    Section::make('Thống kê nhanh')
                        ->description('Thông tin tổng quan')
                        ->icon('heroicon-o-chart-bar')
                        ->schema([
                            Placeholder::make('quick_stats')
                                ->label('')
                                ->content(function () {
                                    $total = \App\Models\ConsultationRequest::count();
                                    $pending = \App\Models\ConsultationRequest::where('status', 'pending')->count();
                                    $today = \App\Models\ConsultationRequest::whereDate('created_at', today())->count();
                                    
                                    return new \Illuminate\Support\HtmlString("
                                        <div class='grid grid-cols-3 gap-4 text-center'>
                                            <div class='bg-blue-50 p-3 rounded-lg'>
                                                <div class='text-2xl font-bold text-blue-600'>{$total}</div>
                                                <div class='text-xs text-blue-500'>Tổng yêu cầu</div>
                                            </div>
                                            <div class='bg-yellow-50 p-3 rounded-lg'>
                                                <div class='text-2xl font-bold text-yellow-600'>{$pending}</div>
                                                <div class='text-xs text-yellow-500'>Chờ xử lý</div>
                                            </div>
                                            <div class='bg-green-50 p-3 rounded-lg'>
                                                <div class='text-2xl font-bold text-green-600'>{$today}</div>
                                                <div class='text-xs text-green-500'>Hôm nay</div>
                                            </div>
                                        </div>
                                    ");
                                }),
                        ]),

                    Section::make('Ghi chú nội bộ')
                        ->description('Ghi chú cho nhân viên')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            Textarea::make('internal_note')
                                ->label('Ghi chú nội bộ')
                                ->rows(3)
                                ->placeholder('Ghi chú dành cho nội bộ, khách hàng sẽ không thấy...')
                                ->helperText('Thông tin này chỉ nhân viên mới thấy được'),
                        ])
                        ->collapsible()
                        ->collapsed(),

                    Section::make('Lịch sử liên hệ')
                        ->description('Theo dõi các lần liên hệ')
                        ->icon('heroicon-o-clock')
                        ->schema([
                            Placeholder::make('contact_history')
                                ->label('')
                                ->content(function ($record) {
                                    if (!$record || !$record->exists) {
                                        return 'Chưa có lịch sử liên hệ';
                                    }
                                    
                                    $history = [];
                                    if ($record->created_at) {
                                        $history[] = "📝 Tạo yêu cầu: " . $record->created_at->format('d/m/Y H:i');
                                    }
                                    if ($record->contacted_at) {
                                        $history[] = "📞 Đã liên hệ: " . $record->contacted_at->format('d/m/Y H:i');
                                    }
                                    if ($record->closed_at) {
                                        $history[] = "✅ Đã đóng: " . $record->closed_at->format('d/m/Y H:i');
                                    }
                                    
                                    return implode('<br>', $history) ?: 'Chưa có hoạt động';
                                })
                                ->columnSpanFull(),
                        ])
                        ->collapsible()
                        ->collapsed(),
                ])
                ->columnSpan(['lg' => 1]),
        ])
        ->columns(3);
    }
}
