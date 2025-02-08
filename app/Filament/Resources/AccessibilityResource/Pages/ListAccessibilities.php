<?php

namespace App\Filament\Resources\AccessibilityResource\Pages;

use App\Filament\Resources\AccessibilityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccessibilities extends ListRecords
{
    protected static string $resource = AccessibilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
