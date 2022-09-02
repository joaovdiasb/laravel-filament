<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            'description'    => $this->faker->text(),
            'amount'         => $this->faker->randomFloat(2, 0, 10000),
            'attachment'     => $this->faker->word(),
            'reference_date' => Carbon::today()->subDays(random_int(0, 365)),
            'created_at'     => Carbon::now(),
            'updated_at'     => Carbon::now(),
        ];
    }
}
