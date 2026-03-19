<script setup lang="ts">
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
</script>

<template>
    <ul>
        <li v-for="w in workshops" :key="w.id">
            {{ w.title }}
        </li>
    </ul>
</template>