<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccessibilityResource\Pages;
use App\Filament\Resources\AccessibilityResource\RelationManagers;
use App\Models\Accessibility;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccessibilityResource extends Resource
{
    protected static ?string $model = Accessibility::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('icon')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('icon')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                ImageColumn::make('icon')
                    ->square()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListAccessibilities::route('/'),
            'create' => Pages\CreateAccessibility::route('/create'),
            'edit' => Pages\EditAccessibility::route('/{record}/edit'),
        ];
    }
}
