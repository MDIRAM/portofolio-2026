<?php

namespace App\Filament\Admin\Resources\SiteContentResource\Pages;

use App\Filament\Admin\Resources\SiteContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteContents extends ListRecords
{
    protected static string $resource = SiteContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
