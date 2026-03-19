<script setup lang="ts">
import { Head, useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';

import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

import type { BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Workshops',
        href: '/workshops',
    },
    {
        title: 'Create',
        href: '/workshops/create',
    },
];

const form = useForm({
    title: '',
    description: '',
    starts_at: '',
    capacity: 1,
});

const submit = () => {
    form.post(route('workshops.store'));
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Create Workshop" />
        <div class="flex justify-center pt-10">
            <div class="w-full max-w-2xl">
                
                <div class="flex flex-col space-y-6">
                    
                    <HeadingSmall 
                        title="Create Workshop" 
                        description="Create a new workshop for your internal academy" 
                    />

                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <!-- TITLE -->
                        <div class="grid gap-2">
                            <Label for="title">Title</Label>
                            <Input 
                                id="title"
                                v-model="form.title"
                                placeholder="Workshop title"
                            />
                            <InputError :message="form.errors.title" />
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="grid gap-2">
                            <Label for="description">Description</Label>
                            <textarea
                                id="description"
                                v-model="form.description"
                                class="mt-1 block w-full rounded-md border border-neutral-300 bg-white px-3 py-2 text-sm shadow-sm
                                       dark:border-neutral-700 dark:bg-neutral-900 dark:text-white"
                                rows="4"
                                placeholder="Describe the workshop..."
                            ></textarea>
                            <InputError :message="form.errors.description" />
                        </div>

                        <!-- DATE -->
                        <div class="grid gap-2">
                            <Label for="starts_at">Date & Time</Label>
                            <Input 
                                id="starts_at"
                                type="datetime-local"
                                v-model="form.starts_at"
                            />
                            <InputError :message="form.errors.starts_at" />
                        </div>

                        <!-- CAPACITY -->
                        <div class="grid gap-2">
                            <Label for="capacity">Capacity</Label>
                            <Input 
                                id="capacity"
                                type="number"
                                min="1"
                                v-model="form.capacity"
                            />
                            <InputError :message="form.errors.capacity" />
                        </div>

                        <!-- BUTTON -->
                        <div class="flex items-center gap-4">
                            <Button :disabled="form.processing">
                                Create
                            </Button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </AppLayout>
</template>