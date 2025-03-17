<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Aeroport;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\AeroportResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AeroportResource\RelationManagers;
use App\Filament\Resources\AeroportResource\RelationManagers\VolsRelationManager;

class AeroportResource extends Resource
{
    protected static ?string $model = Aeroport::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-pointing-in';

    protected static ?string $navigationGroup = 'Section 1';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'success' : 'warning' ;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Ajouter les informations sur l\'aéroport')
                ->description('')
                ->schema([
                    Forms\Components\TextInput::make('nom')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('ville')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('pays')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('latitude')
                    ->required()
                    ->numeric(),
                    Forms\Components\TextInput::make('longitude')
                    ->required()
                    ->numeric()
                    ->columnSpanFull()
                ])->columns(2)
            ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('ville')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('pays')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Voir'),
                Tables\Actions\EditAction::make()->label('Modifier'),
                Tables\Actions\DeleteAction::make()->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
                ->schema([
                    Section::make('Informations sur l\'aéroport')
                    ->schema([
                        TextEntry::make('nom'),
                        TextEntry::make('ville'),
                        TextEntry::make('pays'),
                        TextEntry::make('latitude'),
                        TextEntry::make('longitude')
                    ])->columns(3)
                ]);
    }

    public static function getRelations(): array
    {
        return [
            VolsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAeroports::route('/'),
            'create' => Pages\CreateAeroport::route('/create'),
            //'view' => Pages\ViewAeroport::route('/{record}'),
            'edit' => Pages\EditAeroport::route('/{record}/edit'),
        ];
    }
}
