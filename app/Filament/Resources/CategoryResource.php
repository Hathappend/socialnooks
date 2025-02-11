<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

                FileUpload::make('thumbnail')
                ->image()
                ->required()
                ->disk('public')
                ->directory('categories'),

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
                    ->searchable()
                    ->formatStateUsing(fn ($state): string => Str::headline($state)),

                ImageColumn::make('thumbnail'),
                ImageColumn::make('icon')
                    ->size(20)
                    ->circular(),
                ToggleColumn::make('highlight')
                    ->label('Highlight')
                    ->onColor('success')
                    ->offColor('gray')
                    ->afterStateUpdated(fn ($record, $state) => $record->update(['highlight' => $state])),
            ])
            ->filters([
                TernaryFilter::make('highlight')
                    ->label('Filter Highlight')
                    ->trueLabel('With Highlight')
                    ->falseLabel('Not Filter Highlight')
                    ->queries(
                        true: fn ($query) => $query->where('highlight', true),
                        false: fn ($query) => $query->where('highlight', false),
                    ),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
