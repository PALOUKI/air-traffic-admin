<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pilote;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\PiloteResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PiloteResource\RelationManagers;

class PiloteResource extends Resource
{
    protected static ?string $model = Pilote::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Section 3';

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
                    //->multiple()
                    ->label('Nom des compagnies')
                    ->options(\App\Models\CompagnieAerienne::pluck('nom', 'id'))
                        ->required(),  
                ]),
                Forms\Components\Section::make('Ajouter les informations du pilote')
                ->schema([
                    Forms\Components\TextInput::make('nom')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('prenom')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('licence')
                    ->required()
                    ->maxLength(255),
                   /* Forms\Components\Select::make('licence')
                    ->label('Licence')
                    ->options(\App\Models\Personnel::FONCTIONS) 
                    ->searchable()
                    ->default('')
                    ->required(),*/
                ]),




            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('compagnie_aerienne_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nom')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('prenom')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('licence')
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
                SelectFilter::make('CompagnieAerienne')
                ->relationship('compagnieAeriennes', 'nom'),

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
                    Section::make('Informations du pilote')
                    ->schema([
                        TextEntry::make('compagnie_aerienne_id'),
                        TextEntry::make('nom'),
                        TextEntry::make('prenom'),
                        TextEntry::make('licence')
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
            'index' => Pages\ListPilotes::route('/'),
            'create' => Pages\CreatePilote::route('/create'),
            //'view' => Pages\ViewPilote::route('/{record}'),
            'edit' => Pages\EditPilote::route('/{record}/edit'),
        ];
    }
}
