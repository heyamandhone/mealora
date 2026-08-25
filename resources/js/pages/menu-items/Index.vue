<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import { Pencil, Plus, Trash2 } from '@lucide/vue';
import { create, edit, index, destroy } from '@/routes/menu-items';

interface Restaurant {
    id: number;
    name: string;
}

interface MenuCategory {
    id: number;
    name: string;
}

interface MenuItem {
    id: number;
    name: string;
    slug: string;
    description: string | null;
    price: string | number;
    discount_price: string | number | null;
    image: string | null;
    is_vegetarian: boolean;
    is_available: boolean;
    is_featured: boolean;
    sort_order: number;
    restaurant: Restaurant;
    menu_category: MenuCategory;
}

interface PaginatedMenuItems {
    data: MenuItem[];
    current_page: number;
    last_page: number;
    total: number;
}

const props = defineProps<{
    menuItems: PaginatedMenuItems;
}>();

const deleteMenuItem = (id: number) => {
    if (confirm('Delete this menu item?')) {
        router.delete(destroy(id).url);
    }
};
</script>

<template>
    <div class="p-6">
        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-foreground">
                    Menu Items
                </h1>

                <p class="mt-1 text-sm text-muted-foreground">
                    Manage restaurant menu items.
                </p>
            </div>

            <Link :href="create().url"
                class="inline-flex items-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-sm font-medium text-primary-foreground hover:opacity-90">
                <Plus class="h-4 w-4" />
                Add Menu Item
            </Link>
        </div>

        <!-- Table -->
        <div class="overflow-hidden rounded-xl border border-border bg-card">
            <table class="w-full">
                <thead class="border-b border-border bg-muted/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-foreground">
                            Name
                        </th>

                        <th class="px-4 py-3 text-left text-sm font-semibold text-foreground">
                            Restaurant
                        </th>

                        <th class="px-4 py-3 text-left text-sm font-semibold text-foreground">
                            Category
                        </th>

                        <th class="px-4 py-3 text-left text-sm font-semibold text-foreground">
                            Price
                        </th>

                        <th class="px-4 py-3 text-left text-sm font-semibold text-foreground">
                            Type
                        </th>

                        <th class="px-4 py-3 text-left text-sm font-semibold text-foreground">
                            Status
                        </th>

                        <th class="px-4 py-3 text-right text-sm font-semibold text-foreground">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-border">
                    <tr v-for="item in props.menuItems.data" :key="item.id" class="hover:bg-muted/30">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-lg bg-muted">
                                    <img v-if="item.image" :src="item.image" :alt="item.name"
                                        class="h-full w-full object-cover" />

                                    <span v-else class="text-xs text-muted-foreground">
                                        N/A
                                    </span>
                                </div>

                                <div>
                                    <p class="font-medium text-foreground">
                                        {{ item.name }}
                                    </p>

                                    <p class="text-xs text-muted-foreground">
                                        {{ item.slug }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-4 text-sm text-foreground">
                            {{ item.restaurant?.name }}
                        </td>

                        <td class="px-4 py-4 text-sm text-foreground">
                            {{ item.menu_category?.name }}
                        </td>

                        <td class="px-4 py-4">
                            <div class="text-sm font-medium text-foreground">
                                ₹{{ item.price }}
                            </div>

                            <div v-if="item.discount_price" class="text-xs text-green-500">
                                ₹{{ item.discount_price }}
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            <span :class="item.is_vegetarian
                                    ? 'bg-green-500/10 text-green-500'
                                    : 'bg-red-500/10 text-red-500'
                                " class="rounded-full px-2.5 py-1 text-xs font-medium">
                                {{
                                    item.is_vegetarian
                                        ? 'Vegetarian'
                                        : 'Non-Vegetarian'
                                }}
                            </span>
                        </td>

                        <td class="px-4 py-4">
                            <span :class="item.is_available
                                    ? 'bg-green-500/10 text-green-500'
                                    : 'bg-muted text-muted-foreground'
                                " class="rounded-full px-2.5 py-1 text-xs font-medium">
                                {{
                                    item.is_available
                                        ? 'Available'
                                        : 'Unavailable'
                                }}
                            </span>
                        </td>

                        <td class="px-4 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <Link :href="edit(item.id).url"
                                    class="rounded-lg p-2 text-blue-500 hover:bg-blue-500/10">
                                    <Pencil class="h-4 w-4" />
                                </Link>

                                <button type="button" @click="deleteMenuItem(item.id)"
                                    class="rounded-lg p-2 text-red-500 hover:bg-red-500/10">
                                    <Trash2 class="h-4 w-4" />
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr v-if="props.menuItems.data.length === 0">
                        <td colspan="7" class="px-4 py-10 text-center text-sm text-muted-foreground">
                            No menu items found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div v-if="props.menuItems.last_page > 1" class="mt-4 flex items-center justify-between">
            <p class="text-sm text-muted-foreground">
                Total: {{ props.menuItems.total }}
            </p>

            <div class="flex gap-2">
                <Link v-for="page in props.menuItems.last_page" :key="page" :href="index({ query: { page } }).url"
                    class="rounded-lg border border-border px-3 py-1.5 text-sm" :class="page === props.menuItems.current_page
                            ? 'bg-primary text-primary-foreground'
                            : 'text-foreground hover:bg-muted'
                        ">
                    {{ page }}
                </Link>
            </div>
        </div>
    </div>
</template>