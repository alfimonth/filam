<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ViewerResource\Pages;
use App\Filament\Admin\Resources\ViewerResource\RelationManagers;
use App\Models\Viewer;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use stdClass;

class ViewerResource extends Resource
{
    protected static ?string $model = Viewer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('code'),
                    TextInput::make('name')->required(),
                    Select::make('gender')->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                    ]),
                    Select::make('religion')->options([
                        'Christianity' => 'Christianity',
                        'Islam' => 'Islam',
                        'Hinduism' => 'Hinduism',
                        'Buddhism' => 'Buddhism',
                        'Judaism' => 'Judaism',
                        'Other' => 'Other',
                    ]),
                    DatePicker::make('birthday')->label('Birthday')->required(),
                    TextInput::make('contact'),
                    FileUpload::make('profile')->directory('viewers'),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('code')->label('Code'),
                TextColumn::make('name'),
                TextColumn::make('gender')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('religion')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('birthday')->label('Birthday')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('contact')->toggleable(true),
                ImageColumn::make('profile'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListViewers::route('/'),
            'create' => Pages\CreateViewer::route('/create'),
            'edit' => Pages\EditViewer::route('/{record}/edit'),
        ];
    }
}
