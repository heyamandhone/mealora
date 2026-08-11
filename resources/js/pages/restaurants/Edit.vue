<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { index, update } from '@/routes/restaurants';

const props = defineProps<{
    restaurant: {
        id: number;
        name: string;
        slug: string;
        description: string | null;
        phone: string | null;
        email: string | null;
        logo: string | null;
        cover_image: string | null;
        address: string | null;
        city: string | null;
        state: string | null;
        postal_code: string | null;
        latitude: number | null;
        longitude: number | null;
        delivery_fee: number | string;
        minimum_order_amount: number | string;
        delivery_time_min: number | null;
        delivery_time_max: number | null;
        is_active: boolean;
        is_featured: boolean;
    };
}>();

const form = useForm({
    name: props.restaurant.name,
    slug: props.restaurant.slug,
    description: props.restaurant.description ?? '',
    phone: props.restaurant.phone ?? '',
    email: props.restaurant.email ?? '',
    logo: props.restaurant.logo ?? '',
    cover_image: props.restaurant.cover_image ?? '',
    address: props.restaurant.address ?? '',
    city: props.restaurant.city ?? '',
    state: props.restaurant.state ?? '',
    postal_code: props.restaurant.postal_code ?? '',
    latitude: props.restaurant.latitude,
    longitude: props.restaurant.longitude,
    delivery_fee: props.restaurant.delivery_fee,
    minimum_order_amount: props.restaurant.minimum_order_amount,
    delivery_time_min: props.restaurant.delivery_time_min,
    delivery_time_max: props.restaurant.delivery_time_max,
    is_active: props.restaurant.is_active,
    is_featured: props.restaurant.is_featured,
});

const submit = () => {
    form.put(update(props.restaurant.id).url);
};
</script>

<template>

    <Head title="Edit Restaurant" />

    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold">Edit Restaurant</h1>
            <p class="text-sm text-muted-foreground">
                Update restaurant information.
            </p>
        </div>

        <form @submit.prevent="submit" class="max-w-5xl space-y-6 rounded-xl border bg-background p-6">
            <div>
                <h2 class="mb-4 text-lg font-semibold">Basic Information</h2>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label>Name</label>
                        <input v-model="form.name" type="text" class="mt-1 w-full rounded-lg border p-2" />
                        <p class="text-sm text-red-500">
                            {{ form.errors.name }}
                        </p>
                    </div>

                    <div>
                        <label>Slug</label>
                        <input v-model="form.slug" type="text" class="mt-1 w-full rounded-lg border p-2" />
                        <p class="text-sm text-red-500">
                            {{ form.errors.slug }}
                        </p>
                    </div>

                    <div>
                        <label>Phone</label>
                        <input v-model="form.phone" type="text" class="mt-1 w-full rounded-lg border p-2" />
                    </div>

                    <div>
                        <label>Email</label>
                        <input v-model="form.email" type="email" class="mt-1 w-full rounded-lg border p-2" />
                        <p class="text-sm text-red-500">
                            {{ form.errors.email }}
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="mb-4 text-lg font-semibold">Address</h2>

                <div class="space-y-4">
                    <div>
                        <label>Address</label>
                        <input v-model="form.address" type="text" class="mt-1 w-full rounded-lg border p-2" />
                    </div>

                    <div class="grid gap-4 md:grid-cols-3">
                        <div>
                            <label>City</label>
                            <input v-model="form.city" type="text" class="mt-1 w-full rounded-lg border p-2" />
                        </div>

                        <div>
                            <label>State</label>
                            <input v-model="form.state" type="text" class="mt-1 w-full rounded-lg border p-2" />
                        </div>

                        <div>
                            <label>Postal Code</label>
                            <input v-model="form.postal_code" type="text" class="mt-1 w-full rounded-lg border p-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label>Latitude</label>
                            <input v-model="form.latitude" type="number" step="any"
                                class="mt-1 w-full rounded-lg border p-2" />
                        </div>

                        <div>
                            <label>Longitude</label>
                            <input v-model="form.longitude" type="number" step="any"
                                class="mt-1 w-full rounded-lg border p-2" />
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="mb-4 text-lg font-semibold">Delivery</h2>

                <div class="grid gap-4 md:grid-cols-4">
                    <div>
                        <label>Delivery Fee</label>
                        <input v-model="form.delivery_fee" type="number" step="0.01" min="0"
                            class="mt-1 w-full rounded-lg border p-2" />
                    </div>

                    <div>
                        <label>Minimum Order</label>
                        <input v-model="form.minimum_order_amount" type="number" step="0.01" min="0"
                            class="mt-1 w-full rounded-lg border p-2" />
                    </div>

                    <div>
                        <label>Min Delivery Time</label>
                        <input v-model="form.delivery_time_min" type="number" min="1"
                            class="mt-1 w-full rounded-lg border p-2" />
                    </div>

                    <div>
                        <label>Max Delivery Time</label>
                        <input v-model="form.delivery_time_max" type="number" min="1"
                            class="mt-1 w-full rounded-lg border p-2" />
                    </div>
                </div>
            </div>

            <div>
                <h2 class="mb-4 text-lg font-semibold">Media</h2>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label>Logo URL</label>
                        <input v-model="form.logo" type="text" class="mt-1 w-full rounded-lg border p-2" />
                    </div>

                    <div>
                        <label>Cover Image URL</label>
                        <input v-model="form.cover_image" type="text" class="mt-1 w-full rounded-lg border p-2" />
                    </div>
                </div>
            </div>

            <div>
                <label>Description</label>

                <textarea v-model="form.description" rows="4" class="mt-1 w-full rounded-lg border p-2" />

                <p class="text-sm text-red-500">
                    {{ form.errors.description }}
                </p>
            </div>

            <div class="flex gap-6">
                <label class="flex items-center gap-2">
                    <input v-model="form.is_active" type="checkbox" />
                    Active
                </label>

                <label class="flex items-center gap-2">
                    <input v-model="form.is_featured" type="checkbox" />
                    Featured
                </label>
            </div>

            <div class="flex gap-3 border-t pt-6">
                <button type="submit" :disabled="form.processing"
                    class="rounded-lg bg-primary px-5 py-2 text-primary-foreground disabled:opacity-50">
                    {{ form.processing ? 'Updating...' : 'Update Restaurant' }}
                </button>

                <Link :href="index().url" class="rounded-lg border px-5 py-2">
                    Cancel
                </Link>
            </div>
        </form>
    </div>
</template>