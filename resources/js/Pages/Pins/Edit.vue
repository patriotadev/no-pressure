<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    pin: Object
})

let form = useForm({
    id: props.pin.id,
    title: props.pin.title,
    description: props.pin.description
});

const update = () => {
    form.post('/pins/update');
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pins
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 shadow-lg rounded-lg bg-white p-8">
                <form @submit.prevent="update">
                <div class="mb-6">
                    <div class="flex gap-4">
                        <Link :href="route('pins')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 rounded-full border p-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                            </svg>
                        </Link>
                        <h1 class="text-xl mb-2 font-semibold">Edit Pin</h1>
                    </div>
                    <hr/>
                </div>
                    <div class="body mb-6">
                        <input type="hidden" v-model="form.id" name="id">
                        <div class="mb-4">
                            <input-label class="mb-1" value="Title" />
                            <text-input v-model="form.title" name="title" class="w-full h-10" />
                        </div>
                        <div >
                            <input-label class="mb-1" value="Description" />
                            <text-input v-model="form.description" name="description" class="w-full h-10" />
                        </div>
                    </div>
                <div class="w-full flex justify-end mt-8">
                    <primary-button>Update</primary-button>
                </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>