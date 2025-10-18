<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(6)
            ->components([
                Section::make('Thông tin cơ bản')
                    ->columnSpan(6)
                    ->description('Thông tin cá nhân của người dùng')
                    ->schema([
                        TextInput::make('name')
                            ->label('Họ và tên')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Nhập họ và tên đầy đủ'),

                        TextInput::make('username')
                            ->label('Tên đăng nhập')
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder('Nhập tên đăng nhập')
                            ->alphaDash()
                            ->helperText('Chỉ sử dụng chữ cái, số, dấu gạch ngang và gạch dưới'),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder('example@domain.com'),

                        TextInput::make('phone')
                            ->label('Số điện thoại')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->tel()
                            ->maxLength(15)
                            ->placeholder('0987654321'),

                        FileUpload::make('avatar')
                            ->label('Ảnh đại diện')
                            ->image()
                            ->directory('avatars')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                            ])
                            ->maxSize(2048)
                            ->helperText('Kích thước tối đa: 2MB. Định dạng: JPG, PNG, GIF'),
                    ])->columns(2),
                Section::make('Thông tin bảo mật')
                    ->columnSpan(3)
                    ->description('Mật khẩu và quyền truy cập')
                    ->schema([
                        TextInput::make('password')
                            ->label('Mật khẩu')
                            ->password()
                            ->required(fn(string $context): bool => $context === 'create')
                            ->dehydrated(fn($state) => filled($state))
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->minLength(8)
                            ->placeholder('Tối thiểu 8 ký tự')
                            ->helperText('Để trống nếu không muốn thay đổi mật khẩu'),

                        Select::make('role')
                            ->label('Vai trò')
                            ->required()
                            ->options([
                                'admin' => 'Quản trị viên',
                                'consultant' => 'Tư vấn viên',
                                'customer' => 'Khách hàng',
                            ])
                            ->default('customer')
                            ->native(false),

                        Toggle::make('is_active')
                            ->label('Trạng thái hoạt động')
                            ->helperText('Bật/tắt để cho phép/khóa người dùng đăng nhập')
                            ->default(true),
                    ]),
                Section::make('Thông tin xác thực')
                    ->columnSpan(3)
                    ->description('Thời điểm xác thực email và số điện thoại')
                    ->schema([
                        DateTimePicker::make('email_verified_at')
                            ->label('Thời điểm xác thực email')
                            ->displayFormat('d/m/Y H:i'),

                        DateTimePicker::make('phone_verified_at')
                            ->label('Thời điểm xác thực số điện thoại')
                            ->displayFormat('d/m/Y H:i'),
                    ])
                    ->collapsible(),

                Section::make('Thông tin đăng nhập')
                    ->description('Lịch sử đăng nhập gần nhất')
                    ->schema([
                        DateTimePicker::make('last_login_at')
                            ->label('Lần đăng nhập gần nhất')
                            ->displayFormat('d/m/Y H:i')
                            ->disabled(),

                        TextInput::make('last_login_ip')
                            ->label('Địa chỉ IP cuối cùng')
                            ->disabled()
                            ->placeholder('Chưa có thông tin'),
                    ])->columns(2)
                    ->collapsible()
                    ->collapsed()
                    ->visibleOn('edit'),
            ]);
    }
}
