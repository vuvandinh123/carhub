<?php

namespace App\Filament\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Form;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class ProfilePage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserCircle;
    protected static string|\UnitEnum|null $navigationGroup = 'Hệ thống';

    protected static ?string $title = 'Thông tin cá nhân';
    protected static ?string $navigationLabel = 'Hồ sơ cá nhân';
    protected static ?string $slug = 'profile';
    protected string $view = 'filament.pages.profile-page';

    // Khai báo các properties tương ứng với fields trong form
    public ?array $data = [];

    // Hoặc khai báo từng field riêng lẻ
    public ?string $name = null;
    public ?string $username = null;
    public ?string $email = null;
    public ?string $phone = null;
    public string|array|null $avatar = null;
    public ?string $role = null;
    public ?bool $is_active = null;
    public ?string $last_login_at = null;
    public ?string $email_verified_at = null;
    public ?string $phone_verified_at = null;
    public ?string $current_password = null;
    public ?string $password = null;
    public ?string $password_confirmation = null;

    protected function getFormModel(): User
    {
        return Auth::user();
    }

    public function mount(): void
    {
        $user = User::find(Auth::id());


        $data = $user->toArray();


        $this->form->fill($data);

        // Cách 2: Fill từng property riêng lẻ (nếu dùng cách này thì comment cách 1)
        /*
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->avatar = $user->avatar;
        $this->role = $user->role;
        $this->is_active = $user->is_active;
        $this->last_login_at = $user->last_login_at?->format('Y-m-d H:i:s');
        $this->email_verified_at = $user->email_verified_at;
        $this->phone_verified_at = $user->phone_verified_at;
        */

        // Fill form với data
        $this->form->fill($this->data);
    }

    // public function form(Form $form): Form
    // {
    //     return $form
    //         ->schema($this->getFormSchema())
    //         ->statePath('data') // Quan trọng: phải set statePath
    //         ->model($this->getFormModel());
    // }

    protected function getFormSchema(): array
    {
        return [
            // Basic Information Section
            Section::make('Thông tin cơ bản')
                ->description('Cập nhật thông tin cá nhân của bạn')
                ->icon('heroicon-o-user')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('name')
                                ->label('Họ và tên')
                                ->required()
                                ->maxLength(255)
                                ->prefixIcon('heroicon-o-user')
                                ->placeholder('Nhập họ và tên đầy đủ'),

                            TextInput::make('username')
                                ->label('Tên đăng nhập')
                                ->disabled()
                                ->prefixIcon('heroicon-o-at-symbol')
                                ->helperText('Tên đăng nhập không thể thay đổi')
                                ->dehydrated(false),
                        ]),

                    Grid::make(2)
                        ->schema([
                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->disabled()
                                ->prefixIcon('heroicon-o-envelope')
                                ->helperText('Email không thể thay đổi')
                                ->dehydrated(false),

                            TextInput::make('phone')
                                ->label('Số điện thoại')
                                ->tel()
                                ->disabled()
                                ->prefixIcon('heroicon-o-phone')
                                ->helperText('Số điện thoại không thể thay đổi')
                                ->dehydrated(false),
                        ]),
                ]),

            // Security Section
            Section::make('Bảo mật')
                ->description('Thay đổi mật khẩu để bảo vệ tài khoản')
                ->icon('heroicon-o-lock-closed')
                ->schema([
                    Grid::make(1)
                        ->schema([
                            TextInput::make('current_password')
                                ->label('Mật khẩu hiện tại')
                                ->password()
                                ->prefixIcon('heroicon-o-key')
                                ->placeholder('Nhập mật khẩu hiện tại')
                                ->dehydrated(false)
                                ->nullable()
                                ->helperText('Bắt buộc khi thay đổi mật khẩu')
                                ->requiredWith('password'),

                            TextInput::make('password')
                                ->label('Mật khẩu mới')
                                ->password()
                                ->prefixIcon('heroicon-o-lock-closed')
                                ->placeholder('Nhập mật khẩu mới')
                                ->dehydrateStateUsing(fn($state) => !empty($state) ? Hash::make($state) : null)
                                ->dehydrated(fn($state) => filled($state))
                                ->minLength(8)
                                ->nullable()
                                ->same('password_confirmation')
                                ->helperText('Tối thiểu 8 ký tự, bao gồm chữ và số'),

                            TextInput::make('password_confirmation')
                                ->label('Xác nhận mật khẩu mới')
                                ->password()
                                ->prefixIcon('heroicon-o-lock-closed')
                                ->placeholder('Nhập lại mật khẩu mới')
                                ->dehydrated(false)
                                ->nullable()
                                ->requiredWith('password'),
                        ]),
                ]),

            // Account Information Section (Read-only)
            Section::make('Thông tin tài khoản')
                ->description('Thông tin hệ thống và trạng thái tài khoản')
                ->icon('heroicon-o-information-circle')
                ->collapsible()
                ->collapsed()
                ->schema([
                    Grid::make(3)
                        ->schema([
                            TextInput::make('role')
                                ->label('Vai trò')
                                ->disabled()
                                ->formatStateUsing(fn($state) => match ($state) {
                                    'admin' => 'Quản trị viên',
                                    'consultant' => 'Tư vấn viên',
                                    'customer' => 'Khách hàng',
                                    default => $state
                                })
                                ->dehydrated(false),

                            Toggle::make('is_active')
                                ->label('Trạng thái hoạt động')
                                ->disabled()
                                ->dehydrated(false),

                            DateTimePicker::make('last_login_at')
                                ->label('Lần đăng nhập cuối')
                                ->disabled()
                                ->displayFormat('d/m/Y H:i')
                                ->dehydrated(false),
                        ]),

                    Grid::make(2)
                        ->schema([
                            TextInput::make('email_verified_at')
                                ->label('Email đã xác thực')
                                ->disabled()
                                ->formatStateUsing(fn($state) => $state ? 'Đã xác thực' : 'Chưa xác thực')
                                ->dehydrated(false),

                            TextInput::make('phone_verified_at')
                                ->label('Số điện thoại đã xác thực')
                                ->disabled()
                                ->formatStateUsing(fn($state) => $state ? 'Đã xác thực' : 'Chưa xác thực')
                                ->dehydrated(false),
                        ]),
                ]),
        ];
    }

    public function save(): void
    {
        $user = User::find(Auth::id());
        $data = $this->form->getState();

        // Validate current password nếu user muốn đổi password
        if (!empty($data['password'])) {
            if (empty($data['current_password']) || !Hash::check($data['current_password'], $user->password)) {
                Notification::make()
                    ->title('Lỗi xác thực')
                    ->body('Mật khẩu hiện tại không chính xác')
                    ->danger()
                    ->send();
                return;
            }
        }

        // Remove password fields để không update nếu rỗng
        if (empty($data['password'])) {
            unset($data['password']);
        }

        // Remove non-fillable fields
        unset($data['current_password'], $data['password_confirmation']);

        $user->update($data);

        Notification::make()
            ->title('Cập nhật thành công')
            ->body('Thông tin cá nhân đã được cập nhật')
            ->success()
            ->send();

        // Refresh form data
        $this->data = $user->fresh()->toArray();
        $this->form->fill($this->data);
    }
}
