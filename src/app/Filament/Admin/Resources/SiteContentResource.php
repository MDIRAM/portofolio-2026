<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SiteContentResource\Pages;
use App\Models\SiteContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteContentResource extends Resource
{
    protected static ?string $model = SiteContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Portfolio';

    protected static ?string $recordTitleAttribute = 'label';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('page')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('section')
                    ->maxLength(255),

                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('label')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('type')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'image' => 'Image',
                        'list' => 'List JSON',
                        'json' => 'JSON',
                    ])
                    ->live()
                    ->default('text')
                    ->required(),

                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Forms\Components\Textarea::make('value')
                    ->rows(8)
                    ->helperText('Untuk tipe List JSON atau JSON, isi sebagai JSON valid.')
                    ->hidden(fn (Get $get): bool => $get('type') === 'image')
                    ->dehydrated(fn (Get $get): bool => $get('type') !== 'image')
                    ->columnSpan('full'),

                Forms\Components\TextInput::make('value')
                    ->label('Path foto profile')
                    ->helperText('Path ini tersimpan di database. Upload foto baru lewat field di bawah.')
                    ->visible(fn (Get $get): bool => $get('type') === 'image')
                    ->dehydrated(fn (Get $get): bool => $get('type') === 'image')
                    ->columnSpan('full'),

                Forms\Components\FileUpload::make('photo_upload')
                    ->label('Upload foto profile')
                    ->disk('public')
                    ->directory('site-content')
                    ->image()
                    ->imageEditor()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(2048)
                    ->helperText('Kosongkan kalau tidak ingin mengganti foto.')
                    ->visible(fn (Get $get): bool => $get('type') === 'image')
                    ->columnSpan('full'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),

                Forms\Components\Toggle::make('is_locked')
                    ->label('Proteksi dari delete')
                    ->default(false),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('value')
                    ->limit(80)
                    ->wrap()
                    ->searchable(),

                Tables\Columns\TextColumn::make('page')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('section')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_locked')
                    ->label('Terkunci')
                    ->boolean(),
            ])
            ->defaultSort('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn (SiteContent $record): bool => ! $record->is_locked),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteContents::route('/'),
            'create' => Pages\CreateSiteContent::route('/create'),
            'edit' => Pages\EditSiteContent::route('/{record}/edit'),
        ];
    }
}
