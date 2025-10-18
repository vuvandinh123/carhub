<?php

namespace App\Filament\Resources\Brands\Schemas;

use App\Models\Brand;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Thông tin cơ bản')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Tên thương hiệu')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(
                                        fn(string $context, $state, callable $set) =>
                                        $context === 'create' ? $set('slug', Str::slug($state)) : null
                                    ),

                                TextInput::make('slug')
                                    ->label('Slug URL')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Brand::class, 'slug', ignoreRecord: true)
                                    ->rules(['regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'])
                                    ->helperText('Chỉ sử dụng chữ thường, số và dấu gạch ngang'),

                                Select::make('country')
                                    ->label('Quốc gia')
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
                                    ])
                                    ->searchable()
                                    ->preload(),

                                TextInput::make('founded_year')
                                    ->label('Năm thành lập')
                                    ->numeric()
                                    ->minValue(1800)
                                    ->maxValue(date('Y'))
                                    ->placeholder('Ví dụ: 1937'),

                                TextInput::make('website')
                                    ->label('Website chính thức')
                                    ->url()
                                    ->placeholder('https://example.com')
                                    ->prefixIcon('heroicon-m-globe-alt')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        Section::make('Mô tả & Nội dung')
                            ->schema([
                                Textarea::make('description')
                                    ->label('Mô tả ngắn')
                                    ->rows(3)
                                    ->columnSpanFull()
                                    ->helperText('Mô tả ngắn gọn về thương hiệu (hiển thị trong danh sách)'),

                                RichEditor::make('content')
                                    ->label('Giới thiệu chi tiết')
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
                                    ])
                                    ->helperText('Nội dung chi tiết về lịch sử và đặc điểm của thương hiệu'),
                            ]),
                    ])
                    ->columnSpan(8),
                Group::make()
                    ->schema([
                        Section::make('Logo & Hình ảnh')
                            ->schema([
                                FileUpload::make('logo')
                                    ->label('Logo thương hiệu')
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '1:1',
                                        '16:9',
                                        '4:3',
                                    ])
                                    ->directory('brands/logos')
                                    ->visibility('public')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->helperText('Kích thước khuyến nghị: 300x300px. Định dạng: JPG, PNG, WebP'),
                            ]),

                        Section::make('Cài đặt hiển thị')
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Kích hoạt')
                                    ->default(true)
                                    ->helperText('Cho phép hiển thị thương hiệu trên website'),

                                TextInput::make('sort_order')
                                    ->label('Thứ tự hiển thị')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Số nhỏ hơn sẽ hiển thị trước'),
                            ]),

                        Section::make('SEO')
                            ->schema([
                                TextInput::make('meta_title')
                                    ->label('Meta Title')
                                    ->maxLength(60)
                                    ->helperText('Tối đa 60 ký tự'),

                                TextInput::make('meta_description')
                                    ->label('Meta Description')
                                    ->maxLength(160)
                                    ->helperText('Tối đa 160 ký tự'),

                                TextInput::make('meta_keywords')
                                    ->label('Meta Keywords')
                                    ->helperText('Các từ khóa cách nhau bởi dấu phẩy'),
                            ])
                            ->collapsible()
                            ->collapsed(),
                    ])->columnSpan(['lg' => 4]),
            ]);
    }
}
