<?php

namespace App\Filament\Resources\CategoryPosts;

use App\Filament\Resources\CategoryPosts\Pages\CreateCategoryPost;
use App\Filament\Resources\CategoryPosts\Pages\EditCategoryPost;
use App\Filament\Resources\CategoryPosts\Pages\ListCategoryPosts;
use App\Filament\Resources\CategoryPosts\Schemas\CategoryPostForm;
use App\Filament\Resources\CategoryPosts\Tables\CategoryPostsTable;
use App\Models\CategoryPost;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryPostResource extends Resource
{
    protected static ?string $model = CategoryPost::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return CategoryPostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoryPostsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategoryPosts::route('/'),
            'create' => CreateCategoryPost::route('/create'),
            'edit' => EditCategoryPost::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
