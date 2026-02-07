<?php

namespace App\Filament\Resources\Cars\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
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
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, callable $set, $record) {
                                        if (!$state) return;
                                        
                                        $slug = \Illuminate\Support\Str::slug($state);
                                        
                                        // Check if slug exists
                                        $query = \App\Models\Car::where('slug', $slug);
                                        if ($record) {
                                            $query->where('id', '!=', $record->id);
                                        }
                                        
                                        // If slug exists, add random string
                                        if ($query->exists()) {
                                            $slug = $slug . '-' . \Illuminate\Support\Str::random(6);
                                        }
                                        
                                        $set('slug', $slug);
                                    })
                                    ->columnSpan(2),

                                TextInput::make('slug')
                                    ->label('Slug (URL thân thiện)')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Ví dụ: toyota-vios-2024')
                                    ->dehydrated()
                                    ->unique(ignoreRecord: true),

                                Select::make('brand_id')
                                    ->label('Thương hiệu')
                                    ->required()
                                    ->relationship('brand', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Tên thương hiệu')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                if (!$state) return;
                                                $slug = \Illuminate\Support\Str::slug($state);
                                                
                                                // Check if slug exists in brands
                                                if (\App\Models\Brand::where('slug', $slug)->exists()) {
                                                    $slug = $slug . '-' . \Illuminate\Support\Str::random(4);
                                                }
                                                
                                                $set('slug', $slug);
                                            })
                                            ->maxLength(255),
                                        TextInput::make('slug')
                                            ->required()
                                            ->hidden()
                                            ->dehydrated()
                                            ->maxLength(255),
                                    ])
                                    ->native(false),

                                Select::make('category_id')
                                    ->label('Danh mục')
                                    ->relationship('categories', 'name') // Quan hệ many-to-many
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Tên danh mục')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                if (!$state) return;
                                                $slug = \Illuminate\Support\Str::slug($state);
                                                
                                                // Check if slug exists in categories
                                                if (\App\Models\Category::where('slug', $slug)->exists()) {
                                                    $slug = $slug . '-' . \Illuminate\Support\Str::random(4);
                                                }
                                                
                                                $set('slug', $slug);
                                            })
                                            ->maxLength(255),
                                        TextInput::make('slug')
                                            ->required()
                                            // ->hidden()
                                            ->dehydrated()
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
                                Select::make('fuel')
                                    ->label('Loại nhiên liệu')
                                    ->options([
                                        'Xăng' => 'Xăng',
                                        'Dầu diesel' => 'Dầu diesel',
                                        'Điện' => 'Điện',
                                        'Hybrid' => 'Hybrid',
                                        'Khác' => 'Khác',
                                    ])
                                    ->helperText('Thông tin về loại nhiên liệu sử dụng'),

                                TextInput::make('seats')
                                    ->label('Số chỗ ngồi')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(50)
                                    ->step(1)
                                    ->placeholder('5')
                                    ->suffix('chỗ'),

                                Repeater::make('specifications')
                                    ->label('Chi tiết thông số kỹ thuật')
                                    ->relationship('specifications')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Tên thông số')
                                            ->required()
                                            ->datalist([
                                                'Hộp số',
                                                'Dẫn động',
                                                'Nhiên liệu',
                                                'Mức tiêu thụ nhiên liệu',
                                                'Xuất xứ',
                                                'Kiểu dáng',
                                                'Màu ngoại thất',
                                                'Màu nội thất',
                                                'Kích thước tổng thể',
                                                'Chiều dài',
                                                'Chiều rộng',
                                                'Chiều cao',
                                                'Chiều dài cơ sở',
                                                'Khoảng sáng gầm',
                                                'Bán kính vòng quay',
                                                'Trọng lượng không tải',
                                                'Dung tích bình nhiên liệu',
                                                'Dung tích khoang hành lý',
                                                'Loại động cơ',
                                                'Công suất tối đa',
                                                'Mô-men xoắn cực đại',
                                                'Dung tích xy-lanh',
                                                'Hệ thống treo trước',
                                                'Hệ thống treo sau',
                                                'Phanh trước',
                                                'Phanh sau',
                                                'Lốp xe',
                                                'La-zăng',
                                                'Túi khí',
                                                'ABS',
                                                'EBD',
                                                'BA',
                                                'ESC',
                                                'TCS',
                                                'HSA',
                                                'Camera lùi',
                                                'Cảm biến lùi',
                                                'Cảm biến áp suất lốp',
                                                'Đèn LED',
                                                'Đèn chiếu tự động',
                                                'Đèn ban ngày',
                                                'Gương chiếu hậu tự động',
                                                'Cửa sổ trời',
                                                'Điều hòa tự động',
                                                'Màn hình cảm ứng',
                                                'Kết nối Apple CarPlay',
                                                'Kết nối Android Auto',
                                                'Hệ thống âm thanh',
                                                'Cruise Control',
                                                'Khởi động từ xa',
                                                'Cửa cốp tự động',
                                            ])
                                            ->placeholder('Chọn hoặc nhập tên thông số...')
                                            ->helperText('Chọn từ danh sách hoặc nhập tên mới')
                                            ->columnSpan(1),

                                        TextInput::make('value')
                                            ->label('Giá trị')
                                            ->required()
                                            ->placeholder('Ví dụ: Tự động 6 cấp, Xăng, 5 chỗ...')
                                            ->columnSpan(1),
                                    ])
                                    ->columns(2)
                                    ->reorderable()
                                    ->collapsible()
                                    ->itemLabel(fn(array $state): ?string => $state['name'] ?? null)
                                    ->addActionLabel('Thêm thông số')
                                    ->defaultItems(0)
                                    ->columnSpanFull(),
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

                                FileUpload::make('images')
                                    ->label('Thư viện ảnh')
                                    ->multiple()
                                    ->image()
                                    ->reorderable()
                                    ->appendFiles()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->directory('cars/gallery')
                                    ->visibility('public')
                                    ->maxSize(2048)
                                    ->maxFiles(10)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->helperText('Tải lên tối đa 10 ảnh. Kéo thả để sắp xếp thứ tự')
                                    ->columnSpanFull()
                                    ->saveRelationshipsUsing(function ($component, $state, $record) {
                                        if (!$record) {
                                            return;
                                        }

                                        // Xóa các ảnh cũ nếu có
                                        $existingImages = $record->images()->pluck('image_url')->toArray();
                                        $newImages = is_array($state) ? $state : [];

                                        // Tìm các ảnh cần xóa
                                        $imagesToDelete = array_diff($existingImages, $newImages);
                                        if (!empty($imagesToDelete)) {
                                            $record->images()->whereIn('image_url', $imagesToDelete)->delete();

                                            // Xóa file vật lý
                                            foreach ($imagesToDelete as $imageUrl) {
                                                if (\Storage::disk('public')->exists($imageUrl)) {
                                                    \Storage::disk('public')->delete($imageUrl);
                                                }
                                            }
                                        }

                                        // Thêm ảnh mới
                                        foreach ($newImages as $index => $imageUrl) {
                                            if (!in_array($imageUrl, $existingImages)) {
                                                $record->images()->create([
                                                    'image_url' => $imageUrl,
                                                    'is_primary' => $index === 0 && $record->images()->count() === 0,
                                                ]);
                                            }
                                        }
                                    })
                                    ->dehydrated(false)
                                    ->afterStateHydrated(function ($component, $state, $record) {
                                        if ($record) {
                                            $component->state($record->images()->pluck('image_url')->toArray());
                                        }
                                    }),
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
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
