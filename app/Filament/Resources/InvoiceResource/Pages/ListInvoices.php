<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use App\Models\Invoice;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ListInvoices extends ListRecords
{
    protected function getHeaderWidgets(): array
    {
        return [
            InvoiceResource\Widgets\StatsOverview::class
        ];
    }

    protected static string $resource = InvoiceResource::class;

    protected function getTableQuery(): Builder
    {
        return Invoice::query();
    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableEmptyStateIcon(): ?string
    {
        return 'heroicon-o-document-text';
    }

    protected function getTableEmptyStateHeading(): ?string
    {
        return 'Nenhuma nota fiscal ainda.';
    }

    protected function getTableEmptyStateDescription(): ?string
    {
        return 'Você pode criar uma nota fiscal utilizando o botão abaixo.';
    }

    protected function getTableEmptyStateActions(): array
    {
        return [
            Tables\Actions\Action::make('create')
                                 ->label('Criar nota fiscal')
                                 ->url(route('filament.resources.invoices.create'))
                                 ->icon('heroicon-o-plus')
                                 ->button(),
        ];
    }
}
