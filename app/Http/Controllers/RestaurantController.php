<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantStoreRequest;
use App\Http\Requests\RestaurantUpdateRequest;
use App\Models\Restaurant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class RestaurantController extends Controller
{
    public function index(): Response
    {
        $restaurants = Restaurant::query()
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('restaurants/Index', [
            'restaurants' => $restaurants,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('restaurants/Create');
    }

    public function store(RestaurantStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['slug'] ??= Str::slug($data['name']);

        Restaurant::create($data);

        return redirect()
            ->route('restaurants.index')
            ->with('success', 'Restaurant created successfully.');
    }

    public function edit(Restaurant $restaurant): Response
    {
        return Inertia::render('restaurants/Edit', [
            'restaurant' => $restaurant,
        ]);
    }

    public function update(
        RestaurantUpdateRequest $request,
        Restaurant $restaurant
    ): RedirectResponse {
        $data = $request->validated();

        $data['slug'] ??= Str::slug($data['name']);

        $restaurant->update($data);

        return redirect()
            ->route('restaurants.index')
            ->with('success', 'Restaurant updated successfully.');
    }

    public function destroy(Restaurant $restaurant): RedirectResponse
    {
        $restaurant->delete();

        return redirect()
            ->route('restaurants.index')
            ->with('success', 'Restaurant deleted successfully.');
    }
}
