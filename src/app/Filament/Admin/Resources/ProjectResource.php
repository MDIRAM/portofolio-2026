<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';

    protected static ?string $navigationGroup = 'Portfolio';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(1),

                Forms\Components\TextInput::make('slug')
                    ->helperText('Boleh dikosongkan, sistem akan membuat slug dari judul.')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi singkat')
                    ->required()
                    ->rows(4)
                    ->columnSpan('full'),

                Forms\Components\TagsInput::make('technologies')
                    ->placeholder('Laravel')
                    ->columnSpan('full'),

                Forms\Components\Select::make('status')
                    ->options([
                        'Proposal' => 'Proposal',
                        'Progress' => 'Progress',
                        'Testing' => 'Testing',
                        'Selesai' => 'Selesai',
                    ])
                    ->default('Proposal')
                    ->required(),

                Forms\Components\TextInput::make('progress')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->suffix('%')
                    ->default(0)
                    ->required(),

                Forms\Components\Textarea::make('problem_analysis')
                    ->label('Analisis masalah')
                    ->rows(5)
                    ->columnSpan('full'),

                Forms\Components\TagsInput::make('system_requirements')
                    ->label('Kebutuhan sistem / fitur utama')
                    ->placeholder('CRUD project')
                    ->columnSpan('full'),

                Forms\Components\Textarea::make('architecture')
                    ->label('Arsitektur & tech stack')
                    ->rows(5)
                    ->columnSpan('full'),

                Forms\Components\TagsInput::make('diagram_steps')
                    ->label('Flowchart sistem')
                    ->placeholder('User membuka portfolio')
                    ->helperText('Isi langkah-langkah flowchart. Akan tampil sebagai diagram di halaman detail.')
                    ->columnSpan('full'),

                Forms\Components\FileUpload::make('report_file')
                    ->label('PDF laporan awal')
                    ->directory('reports')
                    ->acceptedFileTypes(['application/pdf'])
                    ->downloadable()
                    ->openable()
                    ->columnSpan('full'),

                Forms\Components\TextInput::make('github_url')
                    ->label('GitHub URL')
                    ->url()
                    ->maxLength(255),

                Forms\Components\TextInput::make('live_url')
                    ->label('Live URL')
                    ->url()
                    ->maxLength(255),

                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Tampilkan')
                    ->default(true),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('progress')
                    ->suffix('%')
                    ->sortable(),

                Tables\Columns\TextColumn::make('technologies')
                    ->badge()
                    ->separator(',')
                    ->searchable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Tampil')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
