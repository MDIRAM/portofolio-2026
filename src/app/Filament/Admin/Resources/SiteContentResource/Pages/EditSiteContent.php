<?php

namespace App\Filament\Admin\Resources\SiteContentResource\Pages;

use App\Filament\Admin\Resources\SiteContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteContent extends EditRecord
{
    protected static string $resource = SiteContentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->visible(fn (): bool => ! $this->record->is_locked),
        ];
    }
}
