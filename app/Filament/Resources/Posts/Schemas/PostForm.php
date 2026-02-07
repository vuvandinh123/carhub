<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
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
                                    ->label('Tiêu đề')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Nhập tiêu đề bài viết...')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $set('slug', Str::slug($state));
                                    })
                                    ->columnSpanFull(),

                                TextInput::make('slug')
                                    ->label('Đường dẫn (Slug)')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('duong-dan-bai-viet')
                                    ->helperText('URL thân thiện cho bài viết')
                                    ->columnSpanFull(),

                                Select::make('category_id')
                                    ->label('Danh mục')
                                    ->required()
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Tên danh mục')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('slug')
                                            ->label('Slug')
                                            ->required()
                                            ->maxLength(255),
                                        Textarea::make('description')
                                            ->label('Mô tả')
                                            ->rows(3),
                                    ])
                                    ->native(false),

                                Select::make('tags')
                                    ->label('Tags')
                                    ->multiple()
                                    ->relationship('tags', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Tên tag')
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('slug')
                                            ->label('Slug')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->native(false)
                                    ->helperText('Chọn hoặc tạo tags mới cho bài viết'),
                            ])
                            ->columns(2),

                        Section::make('Nội dung bài viết')
                            ->description('Viết nội dung chi tiết cho bài viết của bạn')
                            ->schema([
                                Textarea::make('excerpt')
                                    ->label('Mô tả ngắn (Excerpt)')
                                    ->rows(3)
                                    ->maxLength(500)
                                    ->columnSpanFull()
                                    ->placeholder('Tóm tắt ngắn gọn về nội dung bài viết...')
                                    ->helperText('Mô tả này sẽ hiển thị trong danh sách bài viết và trang kết quả tìm kiếm'),

                                RichEditor::make('content')
                                    ->label('Nội dung chi tiết')
                                    ->required()
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ])
                                    ->placeholder('Viết nội dung bài viết tại đây...')
                                    ->helperText('Sử dụng các công cụ định dạng để tạo nội dung phong phú')
                                    ->fileAttachmentsDirectory('posts/attachments')
                                    ->fileAttachmentsVisibility('public'),
                            ])
                            ->collapsible()
                            ->persistCollapsed(),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Trạng thái xuất bản')
                            ->schema([
                                Toggle::make('is_published')
                                    ->label('Xuất bản')
                                    ->helperText('Bật để hiển thị bài viết ra ngoài')
                                    ->default(false)
                                    ->live(),

                                DateTimePicker::make('published_at')
                                    ->label('Ngày xuất bản')
                                    ->native(false)
                                    ->displayFormat('d/m/Y H:i')
                                    ->seconds(false)
                                    ->default(now())
                                    ->helperText('Thời gian bài viết được xuất bản')
                                    ->visible(fn ($get) => $get('is_published')),

                                Toggle::make('is_featured')
                                    ->label('Bài viết nổi bật')
                                    ->helperText('Hiển thị trong mục bài viết nổi bật')
                                    ->default(false),
                            ]),

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
                                    ->directory('posts/thumbnails')
                                    ->visibility('public')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                    ->helperText('Kích thước khuyến nghị: 1200x630px (16:9)')
                                    ->columnSpanFull(),
                            ]),

                        Section::make('SEO')
                            ->description('Tối ưu hóa công cụ tìm kiếm')
                            ->schema([
                                TextInput::make('seo_title')
                                    ->label('SEO Title')
                                    ->maxLength(60)
                                    ->placeholder('Tiêu đề tối ưu SEO...')
                                    ->helperText('Tối đa 60 ký tự cho SEO tốt')
                                    ->suffixIcon('heroicon-o-pencil'),

                                Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->maxLength(160)
                                    ->rows(3)
                                    ->placeholder('Mô tả trang cho công cụ tìm kiếm...')
                                    ->helperText('Tối đa 160 ký tự cho SEO tốt'),

                                TextInput::make('meta_keywords')
                                    ->label('Meta Keywords')
                                    ->placeholder('từ khóa 1, từ khóa 2, từ khóa 3')
                                    ->helperText('Các từ khóa cách nhau bởi dấu phẩy'),
                            ])
                            ->collapsible()
                            ->collapsed(),
                        // user id
                        Hidden::make('user_id')
                            ->default(auth()->user()->id),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
