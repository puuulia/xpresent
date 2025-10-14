<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <h1 class="text-3xl font-bold text-blue-600 mb-4">Inertia + Tailwind Test</h1>
            <p class="text-gray-700">Если вы видите этот текст, Tailwind и Inertia работают!</p>
            <button @click="increment" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                Clicked {{ count }} times
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const count = ref(0)

function increment() {
    count.value++
}
</script>

<style scoped>
</style>
