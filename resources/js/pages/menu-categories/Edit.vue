<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3';
import { index, update } from '@/routes/menu-categories';

interface Restaurant {
    id: number;
    name: string;
}

interface MenuCategory {
    id: number;
    restaurant_id: number;
    name: string;
    slug: string;
    description: string | null;
    image: string | null;
    sort_order: number;
    is_active: boolean;
}

const props = defineProps<{
    menuCategory: MenuCategory;
    restaurants: Restaurant[];
}>();

const form = useForm({
    restaurant_id: props.menuCategory.restaurant_id,
    name: props.menuCategory.name,
    slug: props.menuCategory.slug,
    description: props.menuCategory.description ?? '',
    image: props.menuCategory.image ?? '',
    sort_order: props.menuCategory.sort_order,
    is_active: props.menuCategory.is_active,
});

const submit = () => {
    form.put(update(props.menuCategory.id).url);
};
</script>

<template>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-foreground">
                Edit Menu Category
            </h1>

            <p class="mt-1 text-sm text-muted-foreground">
                Update menu category information.
            </p>
        </div>

        <form class="max-w-3xl space-y-6 rounded-xl border border-border bg-card p-6" @submit.prevent="submit">
            <div>
                <label for="restaurant_id" class="mb-2 block text-sm font-medium text-foreground">
                    Restaurant
                </label>

                <select id="restaurant_id" name="restaurant_id" v-model="form.restaurant_id"
                    class="w-full rounded-lg border border-input bg-background px-3 py-2 text-foreground">
                    <option v-for="restaurant in props.restaurants" :key="restaurant.id" :value="restaurant.id">
                        {{ restaurant.name }}
                    </option>
                </select>

                <p class="mt-1 text-sm text-destructive">
                    {{ form.errors.restaurant_id }}
                </p>
            </div>

            <div>
                <label for="name" class="mb-2 block text-sm font-medium text-foreground">
                    Name
                </label>

                <input id="name" name="name" v-model="form.name" type="text"
                    class="w-full rounded-lg border border-input bg-background px-3 py-2 text-foreground" />

                <p class="mt-1 text-sm text-destructive">
                    {{ form.errors.name }}
                </p>
            </div>

            <div>
                <label for="slug" class="mb-2 block text-sm font-medium text-foreground">
                    Slug
                </label>

                <input id="slug" name="slug" v-model="form.slug" type="text"
                    class="w-full rounded-lg border border-input bg-background px-3 py-2 text-foreground" />

                <p class="mt-1 text-sm text-destructive">
                    {{ form.errors.slug }}
                </p>
            </div>

            <div>
                <label for="description" class="mb-2 block text-sm font-medium text-foreground">
                    Description
                </label>

                <textarea id="description" name="description" v-model="form.description" rows="4"
                    class="w-full rounded-lg border border-input bg-background px-3 py-2 text-foreground" />

                <p class="mt-1 text-sm text-destructive">
                    {{ form.errors.description }}
                </p>
            </div>

            <div>
                <label for="image" class="mb-2 block text-sm font-medium text-foreground">
                    Image
                </label>

                <input id="image" name="image" v-model="form.image" type="text"
                    class="w-full rounded-lg border border-input bg-background px-3 py-2 text-foreground" />
            </div>

            <div>
                <label for="sort_order" class="mb-2 block text-sm font-medium text-foreground">
                    Sort Order
                </label>

                <input id="sort_order" name="sort_order" v-model="form.sort_order" type="number" min="0"
                    class="w-full rounded-lg border border-input bg-background px-3 py-2 text-foreground" />
            </div>

            <div class="flex items-center gap-3">
                <input id="is_active" name="is_active" v-model="form.is_active" type="checkbox" class="h-4 w-4" />

                <label for="is_active" class="text-sm font-medium text-foreground">
                    Active
                </label>
            </div>

            <div class="flex gap-3 border-t border-border pt-5">
                <button type="submit" :disabled="form.processing"
                    class="rounded-lg bg-primary px-5 py-2.5 text-sm font-medium text-primary-foreground hover:opacity-90 disabled:opacity-50">
                    {{ form.processing ? 'Updating...' : 'Update Category' }}
                </button>

                <Link :href="index().url"
                    class="rounded-lg border border-border px-5 py-2.5 text-sm font-medium text-foreground hover:bg-muted">
                    Cancel
                </Link>
            </div>
        </form>
    </div>
</template>