<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '~/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { update } from '@/routes/password/index';
import { Form, Head } from '@inertiajs/vue3';
import { ArrowRight, Lock, Mail } from 'lucide-vue-next';
import { ref } from 'vue';

interface Props {
    token: string;
    email: string;
}

const props = defineProps<Props>();

const inputEmail = ref(props.email);
</script>

<template>
    <AuthLayout
        title="Redefinir senha"
        description="Por favor, digite sua nova senha abaixo"
    >
        <Head title="Redefinir senha" />

        <Form
            v-bind="update.form()"
            :transform="(data) => ({ ...data, token, email })"
            :reset-on-success="['password', 'password_confirmation']"
            v-slot="{ errors, processing }"
        >
            <div class="grid gap-4">
                <!-- Email (readonly) -->
                <div class="grid gap-2">
                    <Label
                        for="email"
                        class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                    >
                        E-mail
                    </Label>
                    <div class="relative group">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"
                        >
                            <Mail class="w-4 h-4 text-muted-foreground/50" />
                        </div>
                        <Input
                            id="email"
                            type="email"
                            name="email"
                            autocomplete="email"
                            v-model="inputEmail"
                            readonly
                            class="pl-11 h-10 bg-muted/30 border-transparent rounded-lg font-medium opacity-70"
                        />
                    </div>
                    <InputError :message="errors.email" class="mt-2" />
                </div>

                <!-- New Password -->
                <div class="grid gap-2">
                    <Label
                        for="password"
                        class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                    >
                        Nova Senha
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
                            autocomplete="new-password"
                            autofocus
                            placeholder="Nova senha"
                            class="pl-11 h-10 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                        />
                    </div>
                    <InputError :message="errors.password" />
                </div>

                <!-- Confirm Password -->
                <div class="grid gap-2">
                    <Label
                        for="password_confirmation"
                        class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                    >
                        Confirmar Senha
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
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            autocomplete="new-password"
                            placeholder="Confirmar senha"
                            class="pl-11 h-10 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                        />
                    </div>
                    <InputError :message="errors.password_confirmation" />
                </div>

                <Button
                    type="submit"
                    class="w-full btn-gradient h-10 text-sm font-bold rounded-lg flex items-center justify-center gap-2 group"
                    :disabled="processing"
                >
                    <Spinner v-if="processing" class="h-4 w-4 animate-spin" />
                    <template v-else>
                        Redefinir senha
                        <ArrowRight
                            class="w-4 h-4 group-hover:translate-x-1 transition-transform"
                        />
                    </template>
                </Button>
            </div>
        </Form>
    </AuthLayout>
</template>
