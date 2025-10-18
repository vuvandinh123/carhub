<?php

namespace App\Filament\Resources\ConsultationRequests\Pages;

use App\Filament\Resources\ConsultationRequests\ConsultationRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateConsultationRequest extends CreateRecord
{
    protected static string $resource = ConsultationRequestResource::class;
}
