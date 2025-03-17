<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use App\Models\CompagnieAerienne;
use Filament\Navigation\NavigationGroup;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CompagnieAerienneResource\Pages;
use App\Filament\Resources\CompagnieAerienneResource\RelationManagers;
use App\Filament\Resources\CompagnieAerienneResource\RelationManagers\AvionsRelationManager;
use App\Filament\Resources\CompagnieAerienneResource\RelationManagers\PersonnelsRelationManager;
use App\Filament\Resources\CompagnieAerienneResource\RelationManagers\PilotesRelationManager;
use App\Filament\Resources\CompagnieAerienneResource\RelationManagers\VolsRelationManager;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Htmlable;

class CompagnieAerienneResource extends Resource
{
    protected static ?string $model = CompagnieAerienne::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Section 1';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'pays';

        public static function getGlobalSearchResultTitle(Model $record): string|Htmlable
        {
            return $record->nom;
        }


    public static function getGloballySearchableAttributes(): array
    {
        return ['nom', 'pays'];
    }

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
                Forms\Components\Section::make('Ajouter les informations de votre compagnie')
                ->description('')
                ->schema([
                    Forms\Components\TextInput::make('nom')
                    ->required()
                    
                    ->maxLength(255),
                Forms\Components\TextInput::make('pays')
                    ->required()
                    ->maxLength(255),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nom')
                ->label('Nom de la compagnie')
                ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('pays')
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
               // SelectFilter::make('Pays')
                //->relationship('')
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

    public static function infolist(Infolist $infolist):Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informations sur la compagnie aérienne')
                ->schema([
                    TextEntry::make('nom')->label('Nom'),
                    TextEntry::make('pays')->label('Pays'),
                ])->columns(2),
                
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AvionsRelationManager::class,
            PersonnelsRelationManager::class,
            PilotesRelationManager::class,
            VolsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompagnieAeriennes::route('/'),
            'create' => Pages\CreateCompagnieAerienne::route('/create'),
            //'view' => Pages\ViewCompagnieAerienne::route('/{record}'),
            'edit' => Pages\EditCompagnieAerienne::route('/{record}/edit'),
        ];
    }
}
