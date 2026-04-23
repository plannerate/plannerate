<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '~/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { store } from '@/routes/login/index';
import { request } from '@/routes/password/index';
import { index as requestAccess } from '@/actions/App/Http/Controllers/Auth/RequestAccessController';
import SocialLoginButtons from '~/components/SocialLoginButtons.vue';
import { Form, Head, usePage } from '@inertiajs/vue3';
import { ArrowRight, Key, Lock, Mail } from 'lucide-vue-next';
import type { AppPageProps } from '@/types';

const page = usePage<AppPageProps<{ socialProviders?: { provider: string; label: string; url: string; icon: string }[] }>>();

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
    canRequestAccess: boolean;
}>();
</script>

<template>
    <AuthBase
        title="Acesso ao Sistema"
        description="Digite seu e-mail e senha para entrar"
    >
        <Head title="Entrar" />

        <div
            v-if="status"
            class="mb-6 text-center text-sm font-medium text-green-600 dark:text-green-400"
        >
            {{ status }}
        </div>

        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-4"
        >
            <div class="grid gap-4">
                <!-- Email -->
                <div class="grid gap-2">
                    <Label
                        for="email"
                        class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                    >
                        E-mail Corporativo
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
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="email"
                            placeholder="nome@organizacao.com"
                            class="pl-11 h-10 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                        />
                    </div>
                    <InputError :message="errors.email" />
                </div>

                <!-- Password -->
                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label
                            for="password"
                            class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                        >
                            Senha
                        </Label>
                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            class="text-xs font-bold text-primary hover:text-primary/80 transition-colors"
                            :tabindex="5"
                        >
                            Esqueceu a senha?
                        </TextLink>
                    </div>
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
                            :tabindex="2"
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="pl-11 h-10 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                        />
                    </div>
                    <InputError :message="errors.password" />
                </div>

                <!-- Remember me -->
                <div class="flex items-center gap-3 py-1">
                    <Checkbox id="remember" name="remember" :tabindex="3" />
                    <Label
                        for="remember"
                        class="text-sm text-muted-foreground font-medium select-none cursor-pointer"
                    >
                        Manter sessão ativa por 24 horas
                    </Label>
                </div>

                <!-- Submit -->
                <Button
                    type="submit"
                    class="w-full btn-gradient h-10 text-sm font-bold rounded-lg flex items-center justify-center gap-2 group"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="login-button"
                >
                    <Spinner v-if="processing" class="h-4 w-4 animate-spin" />
                    <template v-else>
                        Entrar no Sistema
                        <ArrowRight
                            class="w-4 h-4 group-hover:translate-x-1 transition-transform"
                        />
                    </template>
                </Button>
            </div>
        </Form>

        <!-- Identity Providers -->
        <template v-if="(page.props.socialProviders ?? []).length > 0">
            <div class="mt-10">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <span class="w-full border-t border-border" />
                    </div>
                    <div class="relative flex justify-center text-xs uppercase tracking-widest font-bold">
                        <span class="bg-background px-4 text-muted-foreground">
                            Provedores de Identidade
                        </span>
                    </div>
                </div>
                <div class="mt-6 flex flex-col gap-3">
                    <SocialLoginButtons :providers="page.props.socialProviders ?? []" />
                </div>
            </div>
        </template>

        <!-- Contact admin note -->
        <div v-if="canRequestAccess" class="mt-10 pt-8 border-t border-border text-center">
            <p class="text-muted-foreground text-sm font-medium">
                Novo na plataforma?
                <TextLink
                    :href="requestAccess()"
                    class="text-primary font-bold hover:underline"
                >
                    Solicitar Acesso
                </TextLink>
            </p>
        </div>
    </AuthBase>
</template>
