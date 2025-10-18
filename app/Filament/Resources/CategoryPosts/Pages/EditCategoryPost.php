<?php

namespace App\Filament\Resources\CategoryPosts\Pages;

use App\Filament\Resources\CategoryPosts\CategoryPostResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditCategoryPost extends EditRecord
{
    protected static string $resource = CategoryPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
