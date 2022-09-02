<?php

namespace App\Filament\Resources\InvoiceResource\Widgets;

use App\Models\Invoice;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $invoiceCurrentMonth = Invoice::query()
                                      ->whereMonth('reference_date', now()->month)
                                      ->sum('amount');

        $invoicePreviousMonth = Invoice::query()
                                       ->whereMonth('reference_date', now()->subMonth()->month)
                                       ->sum('amount');

        $invoicePercent     = $invoicePreviousMonth ? round((($invoiceCurrentMonth - $invoicePreviousMonth) / $invoicePreviousMonth) * 100, 2) : 100;
        $increaseOrDecrease = ($invoicePercent <=> 0) > 0;
        $description        = "{$invoicePercent}% em relação ao mês passado";

        return [
            Card::make('Valor total mensal', "R$ {$invoiceCurrentMonth}")
                ->description($description)
                ->descriptionIcon($increaseOrDecrease ? 'heroicon-s-trending-up' : 'heroicon-s-trending-down')
                ->chart([$invoicePreviousMonth, $invoiceCurrentMonth])
                ->color($increaseOrDecrease ? 'success' : 'danger'),
            Card::make('', '')
        ];
    }
}

