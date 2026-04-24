<script setup>
import { ref } from 'vue'
import { router, Head } from '@inertiajs/vue3'
import InputError from '@/components/InputError.vue'
import TextLink from '@/components/TextLink.vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Spinner } from '@/components/ui/spinner'
import AuthBase from '@/layouts/AuthLayout.vue'

const code = ref('')
defineProps({
    errors: Object,
    flash: Object
})

function submit() {
    router.post('/check-invitation', {
        code: code.value,
    }, {
        onSuccess: () => {
            window.location.href = '/register'
        }
    })
}
</script>

<template>

   <AuthBase title="Code d’invitation" description="Entrez votre code pour continuer l’inscription">
        <Head title="Code d’accès" />
            <div v-if="flash?.success" class="mb-4 text-center text-sm font-medium text-green-600">{{ flash.success }}</div>
            <div class="flex flex-col gap-6">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="code">Code d’accès</Label>
                        <Input id="code" v-model="code" type="text" required autofocus placeholder="Entrez votre code"/>
                        <InputError :message="errors?.code" />
                    </div>
                    <Button class="mt-4 w-full"  :disabled="!code" @click="submit" >
                        <Spinner v-if="false" /> Continuer
                    </Button>

                </div>

                <div class="text-center text-sm text-muted-foreground"> Vous avez déjà un compte ?
                    <a href="/admin/login" class="underline underline-offset-4 hover:text-primary"> Se connecter </a>
                </div>
            </div>
    </AuthBase>

</template>
