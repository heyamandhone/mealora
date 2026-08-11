<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { create, edit, destroy as destroyRestaurant } from '@/routes/restaurants';

defineProps<{
    restaurants: {
        data: Array<{
            id: number;
            name: string;
            city: string | null;
            delivery_fee: string;
            is_active: boolean;
            is_featured: boolean;
        }>;
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
    };
}>();

const destroy = (id: number) => {
    if (confirm('Delete this restaurant?')) {
        router.delete(destroyRestaurant(id).url);
    }
};
</script>

<template>

    <Head title="Restaurants" />

    <div class="p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Restaurants</h1>
                <p class="text-sm text-gray-500">
                    Manage restaurants available on Mealora.
                </p>
            </div>

            <Link :href="create().url">
                Add Restaurant
            </Link>
        </div>

        <div class="overflow-hidden rounded-xl border bg-dark">
            <table class="w-full text-left text-sm">
                <thead class="border-b bg-dark-gray-50">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">City</th>
                        <th class="px-4 py-3">Delivery Fee</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Featured</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="restaurant in restaurants.data" :key="restaurant.id" class="border-b last:border-0">
                        <td class="px-4 py-3 font-medium">
                            {{ restaurant.name }}
                        </td>

                        <td class="px-4 py-3">
                            {{ restaurant.city || '-' }}
                        </td>

                        <td class="px-4 py-3">
                            ₹{{ restaurant.delivery_fee }}
                        </td>

                        <td class="px-4 py-3">
                            <span :class="restaurant.is_active
                                    ? 'text-green-600'
                                    : 'text-red-600'
                                ">
                                {{ restaurant.is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td class="px-4 py-3">
                            {{ restaurant.is_featured ? 'Yes' : 'No' }}
                        </td>

                        <td class="px-4 py-3 text-right">
                            <Link :href="edit(restaurant.id).url" class="mr-3 text-blue-600">
                                Edit
                            </Link>

                            <button type="button" class="text-red-600" @click="destroy(restaurant.id)">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>