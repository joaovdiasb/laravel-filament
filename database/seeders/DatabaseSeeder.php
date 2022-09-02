<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\Invoice::factory(1000)->create();

         \App\Models\User::factory()->create([
             'name' => 'João',
             'email' => 'joao@aprovalegal.com.br',
             'password' => bcrypt('minhasenha')
         ]);

         $this->call([InvoiceTypeSeeder::class]);
    }
}
