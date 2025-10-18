<?php

namespace App\Filament\Resources\ConsultationRequests;

use App\Filament\Resources\ConsultationRequests\Pages\CreateConsultationRequest;
use App\Filament\Resources\ConsultationRequests\Pages\EditConsultationRequest;
use App\Filament\Resources\ConsultationRequests\Pages\ListConsultationRequests;
use App\Filament\Resources\ConsultationRequests\Schemas\ConsultationRequestForm;
use App\Filament\Resources\ConsultationRequests\Tables\ConsultationRequestsTable;
use App\Models\ConsultationRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsultationRequestResource extends Resource
{
    protected static ?string $model = ConsultationRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleLeftRight;
    // Đổi tên hiển thị trong sidebar
    protected static ?string $navigationLabel = 'Yêu cầu tư vấn';

    protected static string|\UnitEnum|null $navigationGroup = 'Quản lý khách hàng';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $modelLabel = 'Yêu cầu tư vấn';
    protected static ?string $pluralModelLabel = 'Danh sách yêu cầu tư vấn';

    public static function form(Schema $schema): Schema
    {
        return ConsultationRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConsultationRequestsTable::configure($table);
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
            'index' => ListConsultationRequests::route('/'),
            'create' => CreateConsultationRequest::route('/create'),
            'edit' => EditConsultationRequest::route('/{record}/edit'),
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
