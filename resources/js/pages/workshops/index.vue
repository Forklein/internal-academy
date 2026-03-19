<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, usePage, router } from '@inertiajs/vue3';

import { Button } from '@/components/ui/button';
import type { BreadcrumbItem, SharedData } from '@/types';

interface Workshop {
    id: number;
    title: string;
    description: string;
    starts_at: string;
    capacity: number;
}

const props = defineProps<{
    workshops: Workshop[];
}>();

const page = usePage<SharedData>();
const user = page.props.auth.user;

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Workshops',
        href: '/workshops',
    },
];

const isAdmin = user?.role?.name === 'admin';

function destroy(id: number) {
    if (confirm('Are you sure?')) {
        router.delete(route('workshops.destroy', id));
    }
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Workshops" />

        <div class="flex justify-center pt-10">
            <div class="w-full max-w-3xl space-y-6">

                <h1 class="text-xl font-semibold">Workshops</h1>

                <!-- CREATE BUTTON -->
                <div v-if="isAdmin">
                    <Button as-child>
                        <a :href="route('workshops.create')">Create Workshop</a>
                    </Button>
                </div>

                <!-- LIST -->
                <div class="space-y-4">
                    <div 
                        v-for="w in workshops" 
                        :key="w.id"
                        class="rounded-xl border border-neutral-200 dark:border-neutral-800 p-4 bg-white dark:bg-neutral-900 shadow-sm"
                    >
                        <div class="flex justify-between items-start">

                            <!-- INFO -->
                            <div>
                                <h2 class="font-medium text-lg">
                                    {{ w.title }}
                                </h2>

                                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">
                                    {{ w.description }}
                                </p>

                                <p class="text-xs mt-2">
                                    {{ w.starts_at }}
                                </p>

                                <p class="text-xs">
                                    Capacity: {{ w.capacity }}
                                </p>
                            </div>

                            <!-- ACTIONS -->
                            <div v-if="isAdmin" class="flex gap-2">
                                <Button as-child>
                                    <a :href="route('workshops.edit', w.id)">Edit</a>
                                </Button>
                                <Button 
                                    variant="destructive"
                                    @click="destroy(w.id)"
                                >
                                    Delete
                                </Button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>