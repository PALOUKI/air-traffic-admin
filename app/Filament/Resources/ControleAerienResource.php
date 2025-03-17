<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ControleAerien;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ControleAerienResource\Pages;
use App\Filament\Resources\ControleAerienResource\RelationManagers;

class ControleAerienResource extends Resource
{
    protected static ?string $model = ControleAerien::class;

    protected static ?string $navigationIcon = 'heroicon-o-signal';

    protected static ?int $navigationSort = 1;

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
                Forms\Components\Section::make('Vol relié au contrôle aérien')
                ->schema([
                    Forms\Components\Select::make('vol_id')
                    ->label('Vol N°')
                    ->relationship(name:'vol', titleAttribute:'id')
                        ->required(),
                ]),

                Forms\Components\Section::make('Ajouter les informations du contrôle aérien')
                ->schema([
                    Forms\Components\TextInput::make('nom')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('ville')
                        ->required()
                        ->maxLength(255),
                ])->columns(2)
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vol_id')
                ->label('Vol N°')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nom')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('ville')
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
                Section::make('Informations sur le contrôle aérien')
                ->schema([
                    TextEntry::make('vol_id')->label('Vol N°'),
                    TextEntry::make('nom'),
                    TextEntry::make('ville')
                ])->columns(3)
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
            'index' => Pages\ListControleAeriens::route('/'),
            'create' => Pages\CreateControleAerien::route('/create'),
            //'view' => Pages\ViewControleAerien::route('/{record}'),
            'edit' => Pages\EditControleAerien::route('/{record}/edit'),
        ];
    }
}
