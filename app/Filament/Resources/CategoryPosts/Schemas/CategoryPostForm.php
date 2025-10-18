<?php

namespace App\Filament\Resources\CategoryPosts\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class CategoryPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Section::make('Thông tin cơ bản')
                ->description('Thiết lập thông tin danh mục bài viết')
                ->icon('heroicon-o-folder')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('name')
                                ->label('Tên danh mục')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (string $context, $state, callable $set) => 
                                    $context === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null
                                )
                                ->prefixIcon('heroicon-o-tag')
                                ->placeholder('Nhập tên danh mục')
                                ->helperText('Tên hiển thị của danh mục'),

                            TextInput::make('slug')
                                ->label('Đường dẫn tĩnh')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(255)
                                ->rules(['regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'])
                                ->prefixIcon('heroicon-o-link')
                                ->placeholder('duong-dan-tinh')
                                ->helperText('URL thân thiện, chỉ chứa chữ thường, số và dấu gạch ngang')
                                ->suffixAction(
                                    Action::make('generateSlug')
                                        ->icon('heroicon-o-sparkles')
                                        ->action(function (Get $get, Set $set) {
                                            $name = $get('name');
                                            if ($name) {
                                                $set('slug', \Illuminate\Support\Str::slug($name));
                                            }
                                        })
                                        ->tooltip('Tạo slug tự động từ tên')
                                ),
                        ]),

                    Select::make('parent_id')
                        ->label('Danh mục cha')
                        ->placeholder('Chọn danh mục cha (tùy chọn)')
                        ->options(function () {
                            return \App\Models\CategoryPost::whereNull('parent_id')
                                ->pluck('name', 'id')
                                ->prepend('-- Danh mục gốc --', null);
                        })
                        ->searchable()
                        ->prefixIcon('heroicon-o-folder-open')
                        ->helperText('Để trống nếu là danh mục gốc')
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('Tên danh mục cha')
                                ->required(),
                            TextInput::make('slug')
                                ->label('Slug')
                                ->required(),
                        ])
                        ->createOptionUsing(function (array $data) {
                            return \App\Models\CategoryPost::create([
                                'name' => $data['name'],
                                'slug' => $data['slug'],
                            ])->id;
                        }),

                    Textarea::make('description')
                        ->label('Mô tả')
                        ->rows(3)
                        ->maxLength(500)
                        ->placeholder('Mô tả ngắn gọn về danh mục này...')
                        ->helperText('Mô tả sẽ hiển thị trong danh sách và trang danh mục')
                        ->columnSpanFull(),
                ]),

            // SEO Section
            Section::make('Tối ưu SEO')
                ->description('Cấu hình SEO cho danh mục')
                ->icon('heroicon-o-magnifying-glass')
                ->schema([
                    Grid::make(1)
                        ->schema([
                            TextInput::make('meta_title')
                                ->label('Tiêu đề SEO')
                                ->maxLength(60)
                                ->placeholder('Tiêu đề tối ưu cho công cụ tìm kiếm')
                                ->prefixIcon('heroicon-o-document-text')
                                ->helperText('Tối đa 60 ký tự. Để trống sẽ sử dụng tên danh mục')
                                ->suffixAction(
                                    Action::make('autoFillTitle')
                                        ->icon('heroicon-o-sparkles')
                                        ->action(function (Get $get, Set $set) {
                                            $name = $get('name');
                                            if ($name) {
                                                $set('meta_title', $name . ' - Danh mục bài viết');
                                            }
                                        })
                                        ->tooltip('Tạo tự động từ tên danh mục')
                                )
                                ->live(onBlur: true)
                                ->afterStateUpdated(function ($state, Set $set) {
                                    $length = strlen($state ?? '');
                                    $color = $length <= 60 ? 'success' : 'danger';
                                    $set('meta_title_length', $length);
                                })
                                ->hint(fn (Get $get) => 
                                    ($get('meta_title_length') ?? 0) . '/60 ký tự'
                                )
                                ->hintColor(fn (Get $get) => 
                                    ($get('meta_title_length') ?? 0) <= 60 ? 'success' : 'danger'
                                ),

                            Textarea::make('meta_description')
                                ->label('Mô tả SEO')
                                ->rows(3)
                                ->maxLength(160)
                                ->placeholder('Mô tả ngắn gọn, hấp dẫn cho kết quả tìm kiếm')
                                ->helperText('Tối đa 160 ký tự. Mô tả hiển thị trong kết quả Google')
                                ->live(onBlur: true)
                                ->afterStateUpdated(function ($state, Set $set) {
                                    $length = strlen($state ?? '');
                                    $set('meta_description_length', $length);
                                })
                                ->hint(fn (Get $get) => 
                                    ($get('meta_description_length') ?? 0) . '/160 ký tự'
                                )
                                ->hintColor(fn (Get $get) => 
                                    ($get('meta_description_length') ?? 0) <= 160 ? 'success' : 'danger'
                                ),

                            TextInput::make('meta_keywords')
                                ->label('Từ khóa SEO')
                                ->placeholder('từ khóa 1, từ khóa 2, từ khóa 3')
                                ->prefixIcon('heroicon-o-hashtag')
                                ->helperText('Các từ khóa liên quan, phân tách bằng dấu phẩy')
                                ->datalist([
                                    'tin tức',
                                    'bài viết',
                                    'blog',
                                    'thông tin',
                                    'kiến thức',
                                ])
                                ->suffixAction(
                                    Action::make('suggestKeywords')
                                        ->icon('heroicon-o-light-bulb')
                                        ->action(function (Get $get, Set $set) {
                                            $name = $get('name');
                                            $description = $get('description');
                                            if ($name) {
                                                $keywords = strtolower($name);
                                                if ($description) {
                                                    $keywords .= ', ' . strtolower(substr($description, 0, 20));
                                                }
                                                $set('meta_keywords', $keywords);
                                            }
                                        })
                                        ->tooltip('Gợi ý từ khóa tự động')
                                ),
                        ]),
                ]),
            ])->columns(2);
    }
}
