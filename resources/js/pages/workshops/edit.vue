<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import type { BreadcrumbItem } from '@/types';

interface Workshop {
    id: number;
    title: string;
    description: string;
    starts_at: string;
    capacity: number;
}

const props = defineProps<{
    workshop: Workshop;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Workshops', href: '/workshops' },
    { title: 'Edit', href: `/workshops/${props.workshop.id}/edit` },
];

const form = useForm({
    title: props.workshop.title,
    description: props.workshop.description,
    starts_at: props.workshop.starts_at,
    capacity: props.workshop.capacity,
});

function submit() {
    form.put(route('workshops.update', props.workshop.id));
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Edit Workshop" />

        <div class="flex justify-center pt-10">
            <div class="w-full max-w-2xl space-y-6">

                <HeadingSmall 
                    title="Edit Workshop" 
                    description="Update workshop details" 
                />

                <form @submit.prevent="submit" class="space-y-6">

                    <div class="grid gap-2">
                        <Label>Title</Label>
                        <Input v-model="form.title" />
                        <InputError :message="form.errors.title" />
                    </div>

                    <div class="grid gap-2">
                        <Label>Description</Label>
                        <textarea v-model="form.description"
                            class="mt-1 block w-full rounded-md border dark:bg-neutral-900"
                        ></textarea>
                        <InputError :message="form.errors.description" />
                    </div>

                    <div class="grid gap-2">
                        <Label>Date & Time</Label>
                        <Input type="datetime-local" v-model="form.starts_at" />
                        <InputError :message="form.errors.starts_at" />
                    </div>

                    <div class="grid gap-2">
                        <Label>Capacity</Label>
                        <Input type="number" v-model="form.capacity" />
                        <InputError :message="form.errors.capacity" />
                    </div>

                    <Button :disabled="form.processing">
                        Update
                    </Button>

                </form>
            </div>
        </div>
    </AppLayout>
</template>