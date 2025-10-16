<template>
    <div class="w-full flex flex-col gap-4">
        <Select :options="durationSelectValues" :default="selectedDuration" @change="selectDuration"/>
        <ScheduleDurationTable :selected-slots="selectedSlots" :schedules="serviceDurations[selectedDuration].futureServiceSchedules"/>
    </div>
</template>

<script setup>
import ScheduleDurationTable from "./ScheduleDurationTable.vue";
import Select from "../UI/Form/Select.vue";

const props = defineProps({
    serviceDurations: {
        type: Array,
        required: true,
    },
    selectedSlots: {
        type: Array,
        default: []
    },
    selectedDuration: {
        type: Number,
        default: 0,
    }
})

const selectDuration = (event) => {
    props.selectedDuration = event.target.value;
}

const durationSelectValues = props.serviceDurations.map((item, index) => ({
    value: index,
    text: `${item.duration} минут`
}))
</script>

<style scoped>

</style>
