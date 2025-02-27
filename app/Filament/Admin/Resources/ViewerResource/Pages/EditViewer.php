<?php

namespace App\Filament\Admin\Resources\ViewerResource\Pages;

use App\Filament\Admin\Resources\ViewerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditViewer extends EditRecord
{
    protected static string $resource = ViewerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
