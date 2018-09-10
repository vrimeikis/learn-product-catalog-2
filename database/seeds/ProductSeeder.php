<?php

declare(strict_types = 1);

use App\Product;
use Illuminate\Database\Seeder;

/**
 * Class ProductSeeder
 */
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Product::class, 7)->create();
    }
}
