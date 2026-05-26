<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ReportResource\Pages\CreateReport;
use App\Filament\Admin\Resources\ReportResource\Pages\EditReport;
use App\Filament\Admin\Resources\ReportResource\Pages\ListReports;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static ?string $navigationGroup = 'Portfolio';

    protected static ?string $recordTitleAttribute = 'project_title';

    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('project_title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan('full'),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\Toggle::make('is_published')
                    ->label('Publish')
                    ->default(true),

                Forms\Components\Textarea::make('short_description')
                    ->label('Deskripsi singkat')
                    ->required()
                    ->rows(4)
                    ->columnSpan('full'),

                Forms\Components\Textarea::make('problem_analysis')
                    ->label('Analisis masalah')
                    ->required()
                    ->rows(6)
                    ->columnSpan('full'),

                Forms\Components\TagsInput::make('system_features')
                    ->label('Fitur utama')
                    ->columnSpan('full'),

                Forms\Components\Textarea::make('architecture')
                    ->label('Arsitektur')
                    ->required()
                    ->rows(5)
                    ->columnSpan('full'),

                Forms\Components\Repeater::make('tech_stack')
                    ->label('Tech stack')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(3),
                    ])
                    ->columns(2)
                    ->columnSpan('full'),

                Forms\Components\Repeater::make('diagrams')
                    ->label('Diagram')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('image_path')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(3)
                            ->columnSpan('full'),
                    ])
                    ->columns(2)
                    ->columnSpan('full'),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project_title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publish')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReports::route('/'),
            'create' => CreateReport::route('/create'),
            'edit' => EditReport::route('/{record}/edit'),
        ];
    }
}
