<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import { Button } from '~/components/ui/button';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { logout } from '@/routes';
import { send } from '@/routes/verification/index';
import { Form, Head } from '@inertiajs/vue3';
import { ArrowRight, Mail } from 'lucide-vue-next';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthLayout
        title="Verificar e-mail"
        description="Por favor, verifique seu endereço de e-mail clicando no link que acabamos de enviar para você."
    >
        <Head title="Verificação de e-mail" />

        <div class="grid gap-6">
            <div
                v-if="status === 'verification-link-sent'"
                class="flex items-start gap-3 p-4 rounded-lg bg-green-50 dark:bg-green-950/30 border border-green-200 dark:border-green-800"
            >
                <Mail class="w-5 h-5 text-green-600 dark:text-green-400 shrink-0 mt-0.5" />
                <p class="text-sm font-medium text-green-700 dark:text-green-300">
                    Um novo link de verificação foi enviado para o endereço de e-mail
                    fornecido durante o cadastro.
                </p>
            </div>

            <Form
                v-bind="send.form()"
                class="grid gap-4"
                v-slot="{ processing }"
            >
                <Button
                    type="submit"
                    :disabled="processing"
                    class="w-full btn-gradient h-12 text-base font-bold rounded-lg flex items-center justify-center gap-2 group"
                >
                    <ArrowRight
                        v-if="!processing"
                        class="w-4 h-4 group-hover:translate-x-1 transition-transform"
                    />
                    Reenviar e-mail de verificação
                </Button>
            </Form>

            <div class="text-center">
                <TextLink
                    :href="logout()"
                    method="post"
                    as="button"
                    class="text-sm text-muted-foreground hover:text-foreground transition-colors"
                >
                    Sair da conta
                </TextLink>
            </div>
        </div>
    </AuthLayout>
</template>
