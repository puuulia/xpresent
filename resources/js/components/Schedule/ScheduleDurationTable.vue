<template>
    <table class="w-full border border-collapse border-gray-200 rounded-lg text-center">
        <thead class="bg-gray-100">
        <tr>
            <th class="p-2 border-b">Дата</th>
            <th class="p-2 border-b">Слоты</th>
        </tr>
        </thead>
        <tbody>
        <tr
            v-for="schedule in schedules"
            :key="schedule.id"
            class="border-b align-top"
        >
            <td class="p-2 font-medium whitespace-nowrap align-middle">
                {{ formatDateWithShortWeekday(schedule.date) }}
            </td>
            <td class="p-2">
                <div class="flex gap-2 w-full justify-around">
                    <button
                        v-for="item in schedule.serviceScheduleItems"
                        :key="item.id"
                        :disabled="item.disabled"
                        @click="toggleSlot(item.id)"
                        :class="[
                            item.disabled ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'hover:bg-gray-100',
                            selectedSlots.includes(item.id) ? 'bg-orange-500 text-white border-orange-500 hover:bg-orange-400' : '',
                        ]"
                        class="px-3 py-1 rounded-lg border text-sm  transition"
                        type="button"
                    >
                        {{ formatTime(item.start_time, item.end_time) }}
                    </button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script setup>
import {reactive} from "vue";

const props = defineProps({
    schedules: {
        type: Array,
        required: true,
    },
    serviceScheduleItems: {
        type: Array,
        default: []
    }
})

const selectedSlots = reactive(props.serviceScheduleItems);

const toggleSlot = (newId) => {
    if (!selectedSlots.includes(newId)) {
        selectedSlots.push(newId)
        return;
    }

    const index = selectedSlots.indexOf(newId);
    if (index !== -1) {
        selectedSlots.splice(index, 1);
    }
}

const formatDateWithShortWeekday = date => {
    const d = new Date(date)
    const weekday = d.toLocaleDateString('ru-RU', { weekday: 'short' })
    const day = d.getDate().toString().padStart(2, '0')
    const month = (d.getMonth() + 1).toString().padStart(2, '0')
    return `${day}.${month} (${weekday})`
}

const formatTime = (start, end) => {
    if (!start || !end) return 'Время не указано'
    const s = start.slice(0, 5)
    const e = end.slice(0, 5)
    return `${s} - ${e}`
}
</script>

<style scoped>

</style>
