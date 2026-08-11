<script setup lang="ts">
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { edit, destroy, create } from '@/routes/menu-categories';

defineProps<{
    menuCategories: {
        data: Array<{
            id: number;
            name: string;
            slug: string;
            description: string | null;
            sort_order: number;
            is_active: boolean;
            restaurant: {
                id: number;
                name: string;
            };
        }>;
        links: Array<any>;
    };
}>();

const deleteMenuCategory = (id: number) => {
    if (confirm('Delete this menu category?')) {
        router.delete(destroy(id).url);
    }
};
</script>

<template>

        <div class="p-6">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold">Menu Categories</h1>
                    <p class="text-sm text-dark-500">
                        Manage restaurant menu categories.
                    </p>
                </div>

                <Link :href="create().url" class="rounded-lg bg-primary px-4 py-2 text-sm font-medium text-dark">
                    Add Menu Category
                </Link>
            </div>

            <div class="overflow-hidden rounded-lg border bg-dark">
                <table class="w-full">
                    <thead class="border-b bg-dark-50">
                        <tr>
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Restaurant</th>
                            <th class="px-4 py-3 text-left">Sort Order</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="category in menuCategories.data" :key="category.id" class="border-b last:border-0">
                            <td class="px-4 py-3 font-medium">
                                {{ category.name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ category.restaurant?.name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ category.sort_order }}
                            </td>

                            <td class="px-4 py-3">
                                <span :class="category.is_active
                                        ? 'text-green-600'
                                        : 'text-red-600'
                                    ">
                                    {{ category.is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-right">
                                <Link :href="edit(category.id).url" class="mr-3 text-blue-600">
                                    Edit
                                </Link>

                                <button type="button" class="text-red-600" @click="deleteMenuCategory(category.id)">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <tr v-if="menuCategories.data.length === 0">
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                No menu categories found.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</template>