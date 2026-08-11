<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuCategoryStoreRequest;
use App\Http\Requests\MenuCategoryUpdateRequest;
use App\Models\MenuCategory;
use App\Models\Restaurant;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class MenuCategoryController extends Controller
{
    public function index(): Response
    {
        $menuCategories = MenuCategory::query()
            ->with('restaurant:id,name')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('menu-categories/Index', [
            'menuCategories' => $menuCategories,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('menu-categories/Create', [
            'restaurants' => Restaurant::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get(['id', 'name']),
        ]);
    }

    public function store(MenuCategoryStoreRequest $request): RedirectResponse
    {
        MenuCategory::create($request->validated());

        return redirect()
            ->route('menu-categories.index')
            ->with('success', 'Menu category created successfully.');
    }

    public function edit(MenuCategory $menuCategory): Response
    {
        return Inertia::render('menu-categories/Edit', [
            'menuCategory' => $menuCategory,
            'restaurants' => Restaurant::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get(['id', 'name']),
        ]);
    }

    public function update(
        MenuCategoryUpdateRequest $request,
        MenuCategory $menuCategory
    ): RedirectResponse {
        $menuCategory->update($request->validated());

        return redirect()
            ->route('menu-categories.index')
            ->with('success', 'Menu category updated successfully.');
    }

    public function destroy(MenuCategory $menuCategory): RedirectResponse
    {
        $menuCategory->delete();

        return redirect()
            ->route('menu-categories.index')
            ->with('success', 'Menu category deleted successfully.');
    }
}
