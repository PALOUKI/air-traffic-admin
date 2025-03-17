<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Avion;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\AvionResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AvionResource\RelationManagers;
use App\Filament\Resources\AvionResource\RelationManagers\VolsRelationManager;

class AvionResource extends Resource
{
    protected static ?string $model = Avion::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';

    protected static ?string $navigationGroup = 'Section 1';

    protected static ?int $navigationSort = 3;

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
                Forms\Components\Section::make('Ajouter les informations de l\'avion')
                ->description('')
                ->schema([
                    Forms\Components\Select::make('compagnie_aerienne_id')
                    ->label('Compagnie Aerienne')
                    ->relationship(name: 'compagnieAerienne', titleAttribute: 'nom')
                        ->preload()
                        ->searchable()
                        ->required(),
                    Forms\Components\TextInput::make('modele')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('capacite')
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('anneeDeFabrication')
                    ->numeric()
                ])->columns(2)
              
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('compagnieAerienne.nom')
                    ->sortable(),
                Tables\Columns\TextColumn::make('modele')

                    ->searchable(),
                Tables\Columns\TextColumn::make('capacite')
                    ->numeric()
                    ->sortable(),
                /*Tables\Columns\TextColumn::make('anneeDeFabrication')
                    ->numeric()
                    ->sortable(),*/
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
                    Section::make('Informations sur l\'avion')
                    ->schema([
                        TextEntry::make('modele'),
                        TextEntry::make('capacite'),
                        //TextEntry::make('anneeDeFabrication')
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
            'index' => Pages\ListAvions::route('/'),
            'create' => Pages\CreateAvion::route('/create'),
            //'view' => Pages\ViewAvion::route('/{record}'),
            'edit' => Pages\EditAvion::route('/{record}/edit'),
        ];
    }
}
