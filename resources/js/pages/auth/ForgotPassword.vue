<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '~/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { email } from '@/routes/password/index';
import { Form, Head } from '@inertiajs/vue3';
import { ArrowRight, Mail } from 'lucide-vue-next';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthLayout
        title="Esqueceu a senha"
        description="Digite seu e-mail para receber um link de redefinição de senha"
    >
        <Head title="Esqueceu a senha" />

        <div
            v-if="status"
            class="mb-6 text-center text-sm font-medium text-green-600 dark:text-green-400"
        >
            {{ status }}
        </div>

        <div class="space-y-6">
            <Form v-bind="email.form()" v-slot="{ errors, processing }">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label
                            for="email"
                            class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                        >
                            Endereço de e-mail
                        </Label>
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"
                            >
                                <Mail
                                    class="w-4 h-4 text-muted-foreground/50 group-focus-within:text-primary transition-colors"
                                />
                            </div>
                            <Input
                                id="email"
                                type="email"
                                name="email"
                                autocomplete="off"
                                autofocus
                                placeholder="email@exemplo.com"
                                class="pl-11 h-12 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                            />
                        </div>
                        <InputError :message="errors.email" />
                    </div>

                    <Button
                        class="w-full btn-gradient h-12 text-base font-bold rounded-lg flex items-center justify-center gap-2 group"
                        :disabled="processing"
                        data-test="email-password-reset-link-button"
                        type="submit"
                    >
                        <Spinner v-if="processing" class="h-4 w-4 animate-spin" />
                        <template v-else>
                            Enviar link de redefinição
                            <ArrowRight
                                class="w-4 h-4 group-hover:translate-x-1 transition-transform"
                            />
                        </template>
                    </Button>
                </div>
            </Form>

            <div class="text-center text-sm text-muted-foreground">
                <span>Ou, voltar para</span>
                <TextLink :href="login()" class="ml-1 text-primary font-bold">Entrar</TextLink>
            </div>
        </div>
    </AuthLayout>
</template>
