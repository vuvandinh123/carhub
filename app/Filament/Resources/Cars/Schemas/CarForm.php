<?php

namespace App\Filament\Resources\Cars\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CarForm
{

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Thông tin cơ bản')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Tên xe')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ví dụ: Toyota Vios 2024')
                                    ->columnSpan(2),

                                Select::make('brand_id')
                                    ->label('Thương hiệu')
                                    ->required()
                                    ->relationship('brand', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->native(false),

                                Select::make('categories')
                                    ->label('Danh mục')
                                    ->multiple() // Cho phép chọn nhiều
                                    ->relationship('categories', 'name') // Quan hệ many-to-many
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->native(false),

                                TextInput::make('price')
                                    ->label('Giá bán (VNĐ)')
                                    ->numeric()
                                    ->prefix('₫')
                                    ->minValue(0)
                                    ->step(100000)
                                    ->placeholder('1,500,000,000')
                                    ->formatStateUsing(fn($state) => $state ? number_format($state) : '')
                                    ->dehydrateStateUsing(fn($state) => str_replace(',', '', $state))
                                    ->helperText('Nhập giá không bao gồm dấu phẩy'),

                                TextInput::make('year')
                                    ->label('Năm sản xuất')
                                    ->numeric()
                                    ->minValue(1990)
                                    ->maxValue(date('Y') + 2)
                                    ->placeholder('2024')
                                    ->step(1),

                                TextInput::make('quantity')
                                    ->label('Số lượng')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(0)
                                    ->step(1)
                                    ->helperText('Số lượng xe có sẵn'),

                                TextInput::make('mileage')
                                    ->label('Số km đã đi')
                                    ->numeric()
                                    ->minValue(0)
                                    ->suffix('km')
                                    ->placeholder('50,000')
                                    ->helperText('Chỉ áp dụng cho xe cũ'),

                                Select::make('status')
                                    ->label('Trạng thái')
                                    ->required()
                                    ->options([
                                        'available' => 'Còn bán',
                                        'sold' => 'Đã bán',
                                        'coming_soon' => 'Sắp ra mắt',
                                    ])
                                    ->default('available')
                                    ->native(false),
                            ])
                            ->columns(2),

                        Section::make('Thông số kỹ thuật')
                            ->schema([
                                Select::make('fuel_type_id')
                                    ->label('Loại nhiên liệu')
                                    ->relationship('fuelType', 'name', fn($query) => $query->where('type', 'fuel'))
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Hidden::make('type')
                                            ->default('fuel'),
                                    ])
                                    ->native(false)
                                    ->placeholder('Chọn loại nhiên liệu'),

                                Select::make('body_type_id')
                                    ->label('Kiểu dáng')
                                    ->relationship('bodyType', 'name', fn($query) => $query->where('type', 'body'))
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Hidden::make('type')
                                            ->default('body'),
                                    ])
                                    ->native(false)
                                    ->placeholder('Sedan, SUV, Hatchback...'),

                                Select::make('transmission_id')
                                    ->label('Hộp số')
                                    ->relationship('transmission', 'name', fn($query) => $query->where('type', 'transmission'))
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Hidden::make('type')
                                            ->default('transmission'),
                                    ])
                                    ->native(false)
                                    ->placeholder('Số sàn, Số tự động...'),

                                Select::make('color_id')
                                    ->label('Màu xe')
                                    ->relationship('color', 'name', fn($query) => $query->where('type', 'color'))
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Hidden::make('type')
                                            ->default('color'),
                                    ])
                                    ->native(false)
                                    ->placeholder('Trắng, Đen, Bạc...'),

                                Select::make('origin_id')
                                    ->label('Xuất xứ')
                                    ->relationship('origin', 'name', fn($query) => $query->where('type', 'origin'))
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->required()
                                            ->maxLength(255),
                                        Hidden::make('type')
                                            ->default('origin'),
                                    ])
                                    ->native(false)
                                    ->placeholder('Nhập khẩu, Lắp ráp trong nước...'),

                                TextInput::make('engine')
                                    ->label('Động cơ')
                                    ->maxLength(255)
                                    ->placeholder('Ví dụ: 2.0L Turbo, 150kW')
                                    ->helperText('Thông tin về động cơ và công suất'),

                                TextInput::make('seats')
                                    ->label('Số chỗ ngồi')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(50)
                                    ->step(1)
                                    ->placeholder('5')
                                    ->suffix('chỗ'),
                                // ẩn khi chỉnh sửa
                                Select::make('created_by')
                                    ->label('Người tạo')
                                    ->relationship('creator', 'name')
                                    ->default(auth()->id())
                                    ->searchable()
                                    ->preload()
                                    ->native(false)
                                    ->disabled()
                                    ->hiddenOn('edit')
                                    ->dehydrated(),
                            ])
                            ->columns(2),

                        Section::make('Mô tả & Nội dung')
                            ->schema([
                                Textarea::make('description')
                                    ->label('Mô tả ngắn')
                                    ->rows(3)
                                    ->columnSpanFull()
                                    ->placeholder('Mô tả tóm tắt về chiếc xe...')
                                    ->helperText('Mô tả ngắn gọn sẽ hiển thị trong danh sách xe'),

                                RichEditor::make('content')
                                    ->label('Nội dung chi tiết')
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'bulletList',
                                        'orderedList',
                                        'link',
                                        'h2',
                                        'h3',
                                        'blockquote',
                                    ])
                                    ->placeholder('Viết bài giới thiệu chi tiết về xe...')
                                    ->helperText('Nội dung chi tiết về trang bị, tính năng, ưu điểm của xe'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Hình ảnh')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->label('Ảnh đại diện')
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->directory('cars/thumbnails')
                                    ->visibility('public')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->helperText('Kích thước khuyến nghị: 800x600px')
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Tính năng nổi bật')
                            ->schema([
                                TagsInput::make('features')
                                    ->label('Tính năng')
                                    ->placeholder('Nhấn Enter để thêm tính năng')
                                    ->helperText('Ví dụ: Cảm biến lùi, Camera hành trình, Cruise Control')
                                    ->columnSpanFull(),
                            ])
                            ->collapsible()
                            ->collapsed(),

                        Section::make('Cài đặt khác')
                            ->schema([
                                Toggle::make('is_featured')
                                    ->label('Xe nổi bật')
                                    ->helperText('Hiển thị trong mục xe nổi bật'),

                                Toggle::make('allow_contact')
                                    ->label('Cho phép liên hệ')
                                    ->default(true)
                                    ->helperText('Khách hàng có thể liên hệ về xe này'),

                                DatePicker::make('available_from')
                                    ->label('Có sẵn từ ngày')
                                    ->native(false)
                                    ->displayFormat('d/m/Y'),
                            ]),

                        Section::make('SEO')
                            ->schema([
                                TextInput::make('meta_title')
                                    ->label('Meta Title')
                                    ->maxLength(60)
                                    ->helperText('Tối đa 60 ký tự cho SEO tốt'),

                                Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->maxLength(160)
                                    ->rows(3)
                                    ->helperText('Tối đa 160 ký tự cho SEO tốt'),

                                TextInput::make('meta_keywords')
                                    ->label('Meta Keywords')
                                    ->helperText('Các từ khóa cách nhau bởi dấu phẩy'),
                            ])
                            ->collapsible()
                            ->collapsed(),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
