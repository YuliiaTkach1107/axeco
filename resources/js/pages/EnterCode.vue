<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const code = ref('')
defineProps({
    errors: Object,
    flash: Object
})

function submit() {
    console.log('CLICK WORKS')
    router.post('/check-invitation', {
        code: code.value,
    })
}
</script>

<template>
    <div class="p-10">
        <p v-if="flash?.success" class="text-green-600">
            {{ flash.success }}
        </p>

        <p v-if="errors?.code" class="text-red-600">
            {{ errors.code }}
        </p>
        <h1 class="text-xl mb-4">Введите код</h1>

        <input
            v-model="code"
            type="text"
            placeholder="Введите код"
            class="border p-2 mr-2"
        />

        <button @click="submit" class="bg-blue-500 text-white px-4 py-2">
            Проверить
        </button>
    </div>
</template>