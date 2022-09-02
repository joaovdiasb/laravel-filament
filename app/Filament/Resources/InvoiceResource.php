<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use App\Models\InvoiceType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Notas fiscais';
    protected static ?string $pluralLabel = 'Notas fiscais';
    protected static ?string $modelLabel = 'Nota fiscal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                         Forms\Components\Select::make('Categoria')
                                                ->options(
                                                    InvoiceType::all(['title', 'id'])
                                                               ->mapToGroups(fn($item) => [$item['id'] => $item['title']])
                                                )
                                                ->searchable()
                                                ->placeholder('Selecione uma categoria'),
                         Forms\Components\TextInput::make('amount')
                                                   ->label('Valor')
                                                   ->mask(fn(TextInput\Mask $mask) => $mask
                                                       ->patternBlocks([
                                                                           'money' => fn(TextInput\Mask $mask) => $mask
                                                                               ->numeric()
                                                                               ->decimalSeparator('.'),
                                                                       ])
                                                       ->pattern('R$ money'),
                                                   )
                                                   ->required(),
                         Forms\Components\TextInput::make('description')
                                                   ->label('Descrição')
                                                   ->required(),
                         Forms\Components\DatePicker::make('reference_date')
                                                    ->label('Data de referência')
                                                    ->required()
                                                    ->displayFormat('d/m/Y'),
                         Forms\Components\FileUpload::make('attachment')
                                                    ->label('Anexe a nota fiscal')
                                                    ->hint('Tamanho máximo 6MB')
                                                    ->acceptedFileTypes([
                                                                            'application/pdf',
                                                                            'application/octet-stream',
                                                                            'application/x-rar-compressed',
                                                                            'application/zip',
                                                                            'application/octet-stream',
                                                                            'application/x-zip-compressed',
                                                                            'multipart/x-zip',
                                                                        ])
                                                    ->maxSize(6144)
                                                    ->disk('local')
                                                    ->directory('notas-fiscais')
                                                    ->visibility('private')
                                                    ->enableDownload(),
                     ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                          Tables\Columns\TextColumn::make('created_at')
                                                   ->label('Cadastrado em')
                                                   ->date('d/m/Y')
                                                   ->sortable()
                                                   ->searchable(isIndividual: true),
                          Tables\Columns\TextColumn::make('reference_date')
                                                   ->label('Data de referência')
                                                   ->date('d/m/Y')
                                                   ->sortable()
                                                   ->searchable(isIndividual: true),
                          Tables\Columns\TextColumn::make('amount')
                                                   ->label('Valor')
                                                   ->sortable()
                                                   ->searchable(isIndividual: true),
                      ])
            ->filters([
                          //
                      ])
            ->actions([
                          Tables\Actions\EditAction::make(),
                          Tables\Actions\ViewAction::make(),
                      ])
            ->bulkActions([
                              Tables\Actions\DeleteBulkAction::make(),
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
            'index'  => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit'   => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
