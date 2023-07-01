<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    pins: {
        Type: Object,
        default: () => {}
    }
})

let form = useForm({
    id: 0
});

const destroy = (params) => {
    form.id = params;
    if (confirm('Are you sure want to delete this data?')) {
        form.post('/pins/destroy');
    }
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
                <div class="mb-6">
                    <div class="flex w-full justify-between mb-4">
                        <h1 class="text-xl mb-2 font-semibold">Create your pins</h1>
                        <Link :href="route('pins_create')">
                            <primary-button>
                                + Add New
                            </primary-button>
                        </Link>
                    </div>
                    <hr/>
                </div>
                <div class="body mb-6">
                    <div v-for="pin in pins" :key="pin.id" class="mb-4 border flex w-full justify-between p-4 rounded-lg">
                        <div>
                            <h1 class="mb-2 font-semibold">{{pin.title}}</h1>
                            <p>{{pin.description}}</p>
                        </div>
                        <div class="flex gap-4">
                            <Link :href="route('pin_edit', pin.id)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-500 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </Link>
                            <form @submit.prevent="destroy(pin.id)">
                                <button>
                                    <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>