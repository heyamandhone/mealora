<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RestaurantTest extends TestCase
{
    use RefreshDatabase;

    public function test_restaurant_can_be_created(): void
    {
        $restaurant = Restaurant::factory()->create([
            'name' => 'Pizza Palace',
        ]);

        $this->assertDatabaseHas('restaurants', [
            'id' => $restaurant->id,
            'name' => 'Pizza Palace',
        ]);
    }

    public function test_restaurant_factory_creates_valid_data(): void
    {
        $restaurant = Restaurant::factory()->create();

        $this->assertNotNull($restaurant->name);
        $this->assertNotNull($restaurant->slug);
        $this->assertTrue($restaurant->is_active);
    }
}
