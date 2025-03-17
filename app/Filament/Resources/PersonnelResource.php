<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Personnel;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\PersonnelResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PersonnelResource\RelationManagers;

class PersonnelResource extends Resource
{
    protected static ?string $model = Personnel::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 3;

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

                Forms\Components\Section::make('Choisir la compagnie')
                ->schema([
                    Forms\Components\Select::make('compagnie_aerienne_id')
                    ->label('Nom de la compagnie')
                    ->options(\App\Models\CompagnieAerienne::pluck('nom', 'id'))
                        ->required(),
                ]),

                Forms\Components\Section::make('Ajouter les informations du personnel')
                ->schema([
                    Forms\Components\TextInput::make('nom')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('prenom')
                    ->required()
                    ->maxLength(255),
                    /*Forms\Components\TextInput::make('fonction')
                    ->required()
                    ->maxLength(255),*/
                    Forms\Components\Select::make('fonction')
                    ->label('Fonction')
                    ->options(\App\Models\Personnel::FONCTIONS) 
                    ->searchable()
                    ->default('')
                    ->required(),
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('compagnieAerienne.nom')
                    
                    ->sortable(),
                Tables\Columns\TextColumn::make('nom')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('prenom')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('fonction')
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
                    Section::make('Informations du personnel')
                    ->schema([
                        TextEntry::make('compagnieAerienne.nom'),
                        TextEntry::make('nom'),
                        TextEntry::make('prenom'),
                        TextEntry::make('fonction'),
                    ])->columns(2)
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
            'index' => Pages\ListPersonnels::route('/'),
            'create' => Pages\CreatePersonnel::route('/create'),
            //'view' => Pages\ViewPersonnel::route('/{record}'),
            'edit' => Pages\EditPersonnel::route('/{record}/edit'),
        ];
    }
}
