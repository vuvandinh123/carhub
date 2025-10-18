<?php

namespace App\Filament\Resources\CategoryPosts\Pages;

use App\Filament\Resources\CategoryPosts\CategoryPostResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoryPost extends CreateRecord
{
    protected static string $resource = CategoryPostResource::class;
}
