<?php

namespace App\Filament\Admin\Resources\SiteContentResource\Pages;

use App\Filament\Admin\Resources\SiteContentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSiteContent extends CreateRecord
{
    protected static string $resource = SiteContentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->moveUploadedImagePathToValue($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    private function moveUploadedImagePathToValue(array $data): array
    {
        if (($data['type'] ?? null) === 'image' && filled($data['photo_upload'] ?? null)) {
            $upload = $data['photo_upload'];

            if (is_array($upload)) {
                $upload = collect($upload)->filter()->first();
            }

            $data['value'] = $upload;
        }

        unset($data['photo_upload']);

        return $data;
    }
}
