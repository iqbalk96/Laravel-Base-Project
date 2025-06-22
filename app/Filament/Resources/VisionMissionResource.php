<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisionMissionResource\Pages;
use App\Models\VisionMission;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VisionMissionResource extends Resource
{
    protected static ?string $model = VisionMission::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?string $navigationGroup = 'Pages';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('vision')
                    ->label('Visi')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'blockquote',
                        'codeBlock',
                        'h2',
                        'h3',
                        'bulletList',
                        'orderedList',
                        'undo',
                        'redo',
                    ])
                    ->columnSpan('full'),

                RichEditor::make('mission')
                    ->label('Misi')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'blockquote',
                        'codeBlock',
                        'h2',
                        'h3',
                        'bulletList',
                        'orderedList',
                        'undo',
                        'redo',
                    ])
                    ->columnSpan('full'),

                FileUpload::make('image')->image()->directory('vision'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('vision')->limit(50)->label('Visi'),
                TextColumn::make('mission')->limit(50)->label('Misi'),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // 
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
            'index' => Pages\ListVisionMissions::route('/'),
            'create' => Pages\CreateVisionMission::route('/create'),
            'edit' => Pages\EditVisionMission::route('/{record}/edit'),
        ];
    }
}
