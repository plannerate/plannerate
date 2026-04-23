<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '~/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { store } from '@/routes/password/confirm/index';
import { Form, Head } from '@inertiajs/vue3';
import { ArrowRight, Lock } from 'lucide-vue-next';
</script>

<template>
    <AuthLayout
        title="Confirme sua senha"
        description="Esta é uma área segura do aplicativo. Por favor, confirme sua senha antes de continuar."
    >
        <Head title="Confirmar senha" />

        <Form
            v-bind="store.form()"
            reset-on-success
            v-slot="{ errors, processing }"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label
                        for="password"
                        class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                    >
                        Senha
                    </Label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"
                        >
                            <Lock
                                class="w-4 h-4 text-muted-foreground/50 group-focus-within:text-primary transition-colors"
                            />
                        </div>
                        <Input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            autofocus
                            placeholder="Sua senha"
                            class="pl-11 h-12 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                        />
                    </div>
                    <InputError :message="errors.password" />
                </div>

                <Button
                    type="submit"
                    class="w-full btn-gradient h-12 text-base font-bold rounded-lg flex items-center justify-center gap-2 group"
                    :disabled="processing"
                >
                    <Spinner v-if="processing" class="h-4 w-4 animate-spin" />
                    <template v-else>
                        Confirmar Senha
                        <ArrowRight
                            class="w-4 h-4 group-hover:translate-x-1 transition-transform"
                        />
                    </template>
                </Button>
            </div>
        </Form>
    </AuthLayout>
</template>
