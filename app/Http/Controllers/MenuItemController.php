<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuItemStoreRequest;
use App\Http\Requests\MenuItemUpdateRequest;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class MenuItemController extends Controller
{
    public function index(): Response
    {
        $menuItems = MenuItem::query()
            ->with([
                'restaurant:id,name',
                'menuCategory:id,name',
            ])
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('menu-items/Index', [
            'menuItems' => $menuItems,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('menu-items/Create', [
            'restaurants' => Restaurant::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get(['id', 'name']),

            'menuCategories' => MenuCategory::query()
                ->where('is_active', true)
                ->with('restaurant:id,name')
                ->orderBy('name')
                ->get(['id', 'restaurant_id', 'name']),
        ]);
    }

    public function store(MenuItemStoreRequest $request): RedirectResponse
    {
        MenuItem::create($request->validated());
    
        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Menu item created successfully.');
    }

    public function edit(MenuItem $menuItem): Response
    {
        return Inertia::render('menu-items/Edit', [
            'menuItem' => $menuItem,

            'restaurants' => Restaurant::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get(['id', 'name']),

            'menuCategories' => MenuCategory::query()
                ->where('is_active', true)
                ->with('restaurant:id,name')
                ->orderBy('name')
                ->get(['id', 'restaurant_id', 'name']),
        ]);
    }

    public function update(
        MenuItemUpdateRequest $request,
        MenuItem $menuItem
    ): RedirectResponse {
        $menuItem->update($request->validated());

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem): RedirectResponse
    {
        $menuItem->delete();

        return redirect()
            ->route('menu-items.index')
            ->with('success', 'Menu item deleted successfully.');
    }
}
