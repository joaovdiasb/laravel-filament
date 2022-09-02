<?php

namespace Database\Seeders;

use App\Models\InvoiceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        InvoiceType::insert([
                                ['title' => 'NF-e Nota Fiscal Eletrônica de Produtos ou Mercadorias'],
                                ['title' => 'CT-e Conhecimento de Transporte Eletrônico'],
                                ['title' => 'NFS-e Nota Fiscal Eletrônica de Serviços)'],
                                ['title' => 'NFC-e Nota Fiscal ao Consumidor Eletrônica'],
                                ['title' => 'Cupom Fiscal Eletrônico (CF-e)'],
                                ['title' => 'Módulo Fiscal Eletrônico (MF-e)'],
                                ['title' => 'MDF-e Manifesto de Documentos Fiscais Eletrônicos'],
                                ['title' => 'Nota Fiscal Avulsa (NFAe)'],
                                ['title' => 'Nota Fiscal Complementar'],
                                ['title' => 'Nota Fiscal Denegada'],
                                ['title' => 'Nota Fiscal Rejeitada'],
                                ['title' => 'Nota Fiscal de Exportação'],
                                ['title' => 'Nota Fiscal de Remessa'],
                            ]);
    }
}
