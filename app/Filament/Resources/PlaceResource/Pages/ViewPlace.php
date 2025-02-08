<?php

namespace App\Filament\Resources\PlaceResource\Pages;

use App\Filament\Resources\PlaceResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\HtmlString;

class ViewPlace extends ViewRecord
{
    protected static string $resource = PlaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view_map')
                ->label('View on Google Maps')
                ->url(fn ($record) => "https://www.google.com/maps?q={$record->latitude},{$record->longitude}")
                ->openUrlInNewTab()
                ->icon('heroicon-o-map'),

            Action::make('approve')
                ->label('Approve')
                ->color('success')
                ->icon('heroicon-o-check-circle') // Perbaikan ikon
                ->requiresConfirmation()
                ->action(fn ($record) => $record->update(['status' => 'approved']))
                ->visible(fn ($record) => $record->status === 'pending'),

            Action::make('reject')
                ->label('Reject')
                ->color('danger')
                ->icon('heroicon-o-x-circle') // Perbaikan ikon
                ->requiresConfirmation()
                ->action(fn ($record) => $record->update(['status' => 'rejected']))
                ->visible(fn ($record) => $record->status === 'pending'),
        ];
    }

    public function infoList(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name')
                    ->label('Place Name')
                    ->weight('bold')
                    ->color('primary'),
                TextEntry::make('description')
                    ->label('Description')
                    ->limit(100),
                TextEntry::make('start_price')
                    ->label('Starting Price')
                    ->numeric(decimalPlaces: 0)
                    ->prefix('Rp '),
                TextEntry::make('end_price')
                    ->label('Starting Price')
                    ->numeric(decimalPlaces: 0)
                    ->prefix('Rp '),
                TextEntry::make('address')
                    ->label('Address')
                    ->icon('heroicon-o-map'),
                TextEntry::make('phone_number')
                    ->label('Phone Number')
                    ->icon('heroicon-o-phone')
                    ->copyable(),
                TextEntry::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('info'),
                TextEntry::make('creator.name')
                    ->label('Created By')
                    ->icon('heroicon-o-user'),
                TextEntry::make('created_at')
                    ->label('Date Submitted')
                    ->date()
                    ->since(),
                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    }),

                Section::make('Services')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('services.name')
                            ->label('')
                            ->badge()
                            ->color('success')
                            ->icon('heroicon-o-cog'),
                    ]),

                Section::make('Payments')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('payments.name')
                            ->label('')
                            ->badge()
                            ->color('success')
                            ->icon('heroicon-o-cog'),
                    ]),

                Section::make('Payments')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('payments.name')
                            ->label('')
                            ->badge()
                            ->color('success')
                            ->icon('heroicon-o-cog'),
                    ]),

                Section::make('Accessibility')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('accessibilities.name')
                            ->label('')
                            ->badge()
                            ->color('success')
                            ->icon('heroicon-o-cog'),
                    ]),

                Section::make('Place Photos')
                    ->collapsible()
                    ->schema([
                        ImageEntry::make('photos.photo')
                            ->label('')
                            ->size(200)
                            ->columnSpanFull()
                    ])

            ]);
    }


}
