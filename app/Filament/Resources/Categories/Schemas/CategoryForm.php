<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;

use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(12)
            ->components([
                Group::make()->schema([
                    Section::make('Thông tin cơ bản')
                        ->schema([
                            TextInput::make('name')
                                ->label('Tên danh mục')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(
                                    fn($state, callable $set) =>
                                    $set('slug', \Illuminate\Support\Str::slug($state))
                                ),

                            TextInput::make('slug')
                                ->label('Slug (URL)')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->helperText('Chỉ sử dụng chữ thường, số và dấu gạch ngang'),

                            Select::make('parent_id')
                                ->label('Danh mục cha')
                                ->relationship('parent', 'name')
                                ->searchable()
                                ->preload()
                                ->nullable()
                                ->helperText('Nếu không chọn thì đây là danh mục gốc')->columnSpanFull(),
                        ])->columns(2),

                    Section::make('Mô tả & Nội dung')
                        ->schema([
                            Textarea::make('description')
                                ->label('Mô tả ngắn')
                                ->rows(3)
                                ->columnSpanFull(),

                            RichEditor::make('content')
                                ->label('Nội dung chi tiết')
                                
                                ->columnSpanFull(),
                        ]),




                ])->columnSpan(8),

                Group::make()->schema([
                    Section::make('Hình ảnh & Hiển thị')
                        ->schema([
                            FileUpload::make('thumbnail')
                                ->label('Ảnh đại diện')
                                ->image()
                                ->directory('categories/thumbnails')
                                ->imageEditor(),

                            

                            TextInput::make('sort_order')
                                ->label('Thứ tự hiển thị')
                                ->numeric()
                                ->default(0),
                        ])->columnSpan(4),
                    Section::make('Nâng cao')
                        ->schema([
                            Toggle::make('is_active')
                                ->label('Kích hoạt')
                                ->default(true),
                            Toggle::make('is_featured')
                                ->label('Nổi bật')
                                ->default(false),
                        ])->columns(2)->columnSpan(4),
                    Section::make('SEO')
                        ->schema([
                            TextInput::make('meta_title')
                                ->label('Meta Title')
                                ->maxLength(255),

                            TextInput::make('meta_description')
                                ->label('Meta Description')
                                ->maxLength(255),

                            TextInput::make('meta_keywords')
                                ->helperText('Các từ khóa liên quan, cách nhau bằng dấu phẩy')
                                ->label('Meta Keywords')
                                ->maxLength(255),
                        ])
                        ->columns(1)
                        ->columnSpan(4)
                        ->description('Thông tin SEO cho danh mục'),

                ])->columnSpan(4),
            ]);
    }
}
