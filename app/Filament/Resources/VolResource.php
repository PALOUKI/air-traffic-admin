<?php

namespace App\Filament\Resources;

use App\Models\Vol;
use Filament\Forms;
use Filament\Tables;
use App\Models\Avion;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\VolResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VolResource\RelationManagers;
use App\Filament\Resources\VolResource\RelationManagers\ControleAeriensRelationManager;
use App\Filament\Resources\VolResource\RelationManagers\PassagersRelationManager;
use Filament\Tables\Filters\SelectFilter;

class VolResource extends Resource
{
    protected static ?string $model = Vol::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Section 2';

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

                Forms\Components\Section::make('Ajouter les informations de relations')
                ->description('')
                ->schema([
                    Forms\Components\Select::make('compagnie_aerienne_id')
                    ->relationship(name:'compagnieAerienne', titleAttribute:'nom')
                        ->preload()
                        ->required()
                        ->live()
                        ->afterStateUpdated(function(Set $set){
                            $set('avion_id', null);
                        }),
                    Forms\Components\Select::make('aeroport_id')
                    ->options(\App\Models\Aeroport::pluck('nom', 'id'))
                        ->required(),
                      
                    Forms\Components\Select::make('avion_id')
                    ->options(fn(Get $get): Collection => Avion::query()
                        ->where('compagnie_aerienne_id', $get('compagnie_aerienne_id'))
                        ->pluck('modele', 'id')
                    )
                        ->preload()
                        ->searchable()
                        ->required(),
                ])->columns(3),

                Forms\Components\Section::make('Ajouter les informations du vol')
                ->schema([
                    Forms\Components\DateTimePicker::make('dateHeureDepart')
                        ->required(),
                    Forms\Components\DateTimePicker::make('dateHeureArrivee')
                        ->required(),
                    Forms\Components\TimePicker::make('dureeEstimee')
                        ->required(),
                    /*Forms\Components\TextInput::make('statut')
                        ->required()
                        ->maxLength(255),*/
                    Forms\Components\Select::make('statut')
                        ->label('Statut')
                        ->options(\App\Models\Vol::STATUSES) // Options provenant du modèle
                        ->searchable()
                        ->default('')
                        ->required(),
                ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('compagnieAerienne.nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('aeroport.nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('avion.modele')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id')
                    ->label('Numero du vol')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dateHeureDepart')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('dateHeureArrivee')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('dureeEstimee')
                ->sortable(),
                Tables\Columns\TextColumn::make('statut')
                ->sortable()
                    ->searchable(),
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
                Section::make('Informations de relation')
                ->schema([
                    TextEntry::make('compagnieAerienne.nom'),
                    TextEntry::make('aeroport.nom'),
                    TextEntry::make('avion.modele')
        
                ])->columns(3),

                Section::make('Informations de vol')
                ->schema([
                    TextEntry::make('dateHeureDepart'),
                    TextEntry::make('dateHeureArrivee'),
                    TextEntry::make('dureeEstimee'),
                    TextEntry::make('statut')
                ])->columns(2),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PassagersRelationManager::class,
            ControleAeriensRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVols::route('/'),
            'create' => Pages\CreateVol::route('/create'),
            //'view' => Pages\ViewVol::route('/{record}'),
            'edit' => Pages\EditVol::route('/{record}/edit'),
        ];
    }
}
