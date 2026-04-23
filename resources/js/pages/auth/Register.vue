<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '~/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { Form, Head } from '@inertiajs/vue3';
</script>

<template>
    <AuthBase
        title="Criar uma conta"
        description="Digite seus dados abaixo para criar sua conta"
    >
        <Head title="Cadastro" />

        <Form
            action="/register"
            method="post"
            :reset-on-success="['password', 'password_confirmation']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-4"
        >
            <div class="grid gap-4">
                <div class="grid gap-2">
                    <Label
                        for="name"
                        class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                    >
                        Nome completo
                    </Label>
                    <Input
                        id="name"
                        type="text"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="name"
                        name="name"
                        placeholder="Seu nome completo"
                        class="h-10 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                    />
                    <InputError :message="errors.name" />
                </div>

                <div class="grid gap-2">
                    <Label
                        for="email"
                        class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                    >
                        Endereço de e-mail
                    </Label>
                    <Input
                        id="email"
                        type="email"
                        required
                        :tabindex="2"
                        autocomplete="email"
                        name="email"
                        placeholder="email@exemplo.com"
                        class="h-10 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <Label
                        for="password"
                        class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                    >
                        Senha
                    </Label>
                    <Input
                        id="password"
                        type="password"
                        required
                        :tabindex="3"
                        autocomplete="new-password"
                        name="password"
                        placeholder="••••••••"
                        class="h-10 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="grid gap-2">
                    <Label
                        for="password_confirmation"
                        class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                    >
                        Confirmar senha
                    </Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        required
                        :tabindex="4"
                        autocomplete="new-password"
                        name="password_confirmation"
                        placeholder="••••••••"
                        class="h-10 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                    />
                    <InputError :message="errors.password_confirmation" />
                </div>

                <Button
                    type="submit"
                    class="w-full btn-gradient h-10 text-sm font-bold rounded-lg flex items-center justify-center gap-2 group"
                    :tabindex="5"
                    :disabled="processing"
                >
                    <Spinner v-if="processing" class="h-4 w-4 animate-spin" />
                    <template v-else>Criar conta</template>
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Já tem uma conta?
                <TextLink
                    :href="login()"
                    class="text-primary font-bold hover:underline"
                    :tabindex="6"
                    >Entrar</TextLink
                >
            </div>
        </Form>
    </AuthBase>
</template>
