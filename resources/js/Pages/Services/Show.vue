<template>
    <div class="container m-auto">
        <Link :href="route('services.index')" class="px-4 py-2 bg-blue-500 text-white rounded">
            Перейти списку услуг
        </Link>

        <FormSection @submitted="submitForm">
            <template #title>
                {{ service.name }}
            </template>

            <template #description>
                {{ service.description }}
            </template>

            <template #form>
                <div class="w-full flex flex-col gap-4">
                    <Select :options="durationSelectValues" :default="selectedDuration" @change="selectDuration"/>
                    <ScheduleDurationTable
                        :serviceScheduleItems="form.serviceScheduleItems"
                        :schedules="service.serviceDurations[selectedDuration]?.futureServiceSchedules"
                    />
                </div>

                <DialogModal :show="showPopupForm" @close="closeModal">
                    <template #title>
                        Пожалуйста, заполните свои данные
                    </template>
                    <template #content>
                        <div class="grid gap-y-2">
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="user_name" value="Имя" />
                                <TextInput
                                    id="user_name"
                                    v-model="form.user_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autofocus
                                />
                                <InputError :message="form.errors.user_name" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="user_phone" value="Номер телефона" />
                                <TextInput
                                    id="user_phone"
                                    v-model="form.user_phone"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autofocus
                                    required
                                />
                                <InputError :message="form.errors.user_phone" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="comment" value="Комментарий" />
                                <textarea
                                    class="mt-1 block w-full border border-neutral-300 px-3 py-1 rounded-md shadow-sm"
                                    placeholder="Комментарий"
                                    name="comment"
                                    v-model="form.comment"
                                ></textarea>
                                <InputError :message="form.errors.comment" class="mt-2" />
                            </div>

                            <div>
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Подтвердить
                                </PrimaryButton>
                            </div>
                        </div>
                    </template>
                </DialogModal>
            </template>

            <template #actions>
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    type="button"
                    @click="openUserInfoModal"
                >
                    Создать бронирование
                </PrimaryButton>
            </template>
        </FormSection>
        <DialogModal :show="error !== ''" @close="closeErrorModal">
            <template #title>
                {{ error }}
            </template>
        </DialogModal>
    </div>
</template>

<script setup>
import FormSection from "../../components/UI/Form/FormSection.vue";
import PrimaryButton from "../../components/UI/PrimaryButton.vue";
import {useForm} from "@inertiajs/vue3";
import Select from "../../components/UI/Form/Select.vue";
import ScheduleDurationTable from "../../components/Schedule/ScheduleDurationTable.vue";
import {ref} from "vue";
import DialogModal from "../../components/UI/DialogModal.vue";
import TextInput from "../../components/UI/Form/TextInput.vue";
import InputLabel from "../../components/UI/Form/InputLabel.vue";
import InputError from "../../components/UI/Form/InputError.vue";

const props = defineProps({
    service: {
        type: Object,
    }
})

const error = ref('');

const closeErrorModal = () => {
    error.value = '';
}

const showPopupForm = ref(false);

const closeModal =() => {
    showPopupForm.value = false;
}

const selectedDuration = ref(0);

const form = useForm({
    comment: '',
    user_name: '',
    user_phone: '',
    serviceScheduleItems: [],
});

const selectDuration = (event) => {
    if (selectedDuration.value === event.target.value) {
        return;
    }

    selectedDuration.value = event.target.value;
    form.serviceScheduleItems.splice(0, form.serviceScheduleItems.length)
}

const durationSelectValues = props.service.serviceDurations.map((item, index) => ({
    value: index,
    text: `${item.duration} минут`
}))

const submitForm = () => {
    form.post('/bookings', {
        onSuccess: (page) => {
            alert('Бронирование успешно создано!')
        },
        onError: (errors) => {
            console.log(errors)
        },
    })
}

const openUserInfoModal = () => {
    if (form.serviceScheduleItems.length === 0) {
        error.value = 'Пожалуйста, выберите хотя бы один вариант в расписании';
        return
    }

    showPopupForm.value = true;
}
</script>
