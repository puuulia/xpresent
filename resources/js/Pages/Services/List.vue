<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Доступные услуги</h1>

        <ul class="space-y-4">
            <li
                v-for="service in services.data"
                :key="service.id"
                class="border p-4 rounded flex justify-between items-center"
            >
                <div>
                    <h2 class="text-xl font-semibold">{{ service.name }}</h2>
                    <p class="text-gray-600">{{ service.description }}</p>
                </div>
                <Link
                    :href="route('services.show', { service: service.id })"
                    class="text-blue-500 hover:underline"
                >
                    Подробнее
                </Link>
            </li>
        </ul>

        <div class="flex justify-center mt-6 space-x-2">
            <template v-for="link in services.meta.links" :key="link.label">
                <Link
                    v-if="link.url"
                    :href="link.url"
                    v-html="link.label"
                    preserve-scroll
                    class="px-3 py-1 border rounded text-gray-700"
                    :class="{
                        'bg-blue-500 text-white': link.active,
                        'opacity-50 pointer-events-none': !link.url,
                    }"
                />
                <span
                    v-else
                    v-html="link.label"
                    class="px-3 py-1 border rounded text-gray-400 cursor-not-allowed"
                />
            </template>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import {ref} from "vue";

const on = ref(true);

const props = defineProps({
    services: Object,
})
</script>
