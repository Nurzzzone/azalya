<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;
    protected $prices = [9000, 12000, 8000, 3000, 15000];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Berry Love',
            'description' => '<p>Букет из роз и садовых роз "Александра" S состоит из гортензия 1, лизиантус 3, пионовидная роза 2, роза 5, садовая роза 3, эвкалипт 5. Букет из роз и садовых роз "Александра" Состав: розы, гортензии, лизиантусы, садовые розы, пионовидные розы сорта Tsumugi, зелень эвкалипта. Букет в нежных тонах, собранный из лучших цветов в своем роде, прекрасно подходит для милых, дивных и тонких натур.</p>',
            'image' => null,
            'price' => $this->prices[$this->faker->numberBetween(0, 4)],
            'discount' => null,
            'in_stock' => true,
            'is_active' => true,
            'is_popular' => $this->faker->numberBetween(0, 1),
            'in_homepage' => false,
            'type_id' => $this->faker->numberBetween(1, 4),
            'category_id' => $this->faker->numberBetween(1, 4),
        ];
    }
}
