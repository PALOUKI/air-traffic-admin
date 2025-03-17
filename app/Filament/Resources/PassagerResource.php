<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Passager;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\PassagerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PassagerResource\RelationManagers;

class PassagerResource extends Resource
{
    protected static ?string $model = Passager::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?int $navigationSort = 2;

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
                Forms\Components\Section::make('Ajouter le vol relié au passager')
                ->description('')
                ->schema([
                    Forms\Components\Select::make('vol_id')
                    ->label('Numero du vol')
                    ->relationship('vols', 'id')
                    //->options(\App\Models\Vol::pluck('id', 'id'))
                    ->required(),
                ]),

                Forms\Components\Section::make('Ajouter les informations du passager')
                ->description('')
                ->schema([
                    Forms\Components\TextInput::make('nom')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('prenom')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\DatePicker::make('dateDeNaissance')
                        ->required(),
                    Forms\Components\TextInput::make('nationalite')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),
                ])->columns(2)


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vol_id')
                ->label('Vol N°')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('nom')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('prenom')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('dateDeNaissance')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nationalite')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
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
                Section::make('Informations sur le passager')
                ->schema([
                    TextEntry::make('vol_id')->label('Numéro du vol'),
                    TextEntry::make('nom'),
                    TextEntry::make('prenom'),
                    TextEntry::make('dateDeNaissance'),
                    TextEntry::make('nationalite'),
                    TextEntry::make('email')
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
            'index' => Pages\ListPassagers::route('/'),
            'create' => Pages\CreatePassager::route('/create'),
            //'view' => Pages\ViewPassager::route('/{record}'),
            'edit' => Pages\EditPassager::route('/{record}/edit'),
        ];
    }
}
