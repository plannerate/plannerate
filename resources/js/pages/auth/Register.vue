<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { index, store } from '@/actions/App/Http/Controllers/Auth/RequestAccessController';
import { Button } from '~/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { login } from '@/routes';
import { Form, Head } from '@inertiajs/vue3';
import { ArrowRight, Building2, Mail, MessageSquare, User } from 'lucide-vue-next';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthBase
        title="Solicitar Acesso"
        description="Preencha o formulário abaixo e entraremos em contato em breve"
    >
        <Head title="Solicitar Acesso" />

        <div
            v-if="status"
            class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-950/30 border border-green-200 dark:border-green-800 text-sm font-medium text-green-700 dark:text-green-300"
        >
            {{ status }}
        </div>

        <Form
            v-bind="store.form()"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-4"
        >
            <div class="grid gap-4">
                <!-- Nome -->
                <div class="grid gap-2">
                    <Label
                        for="name"
                        class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                    >
                        Nome completo
                    </Label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <User class="w-4 h-4 text-muted-foreground/50 group-focus-within:text-primary transition-colors" />
                        </div>
                        <Input
                            id="name"
                            type="text"
                            name="name"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="name"
                            placeholder="Seu nome completo"
                            class="pl-11 h-10 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                        />
                    </div>
                    <InputError :message="errors.name" />
                </div>

                <!-- E-mail -->
                <div class="grid gap-2">
                    <Label
                        for="email"
                        class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                    >
                        E-mail corporativo
                    </Label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <Mail class="w-4 h-4 text-muted-foreground/50 group-focus-within:text-primary transition-colors" />
                        </div>
                        <Input
                            id="email"
                            type="email"
                            name="email"
                            required
                            :tabindex="2"
                            autocomplete="email"
                            placeholder="email@empresa.com"
                            class="pl-11 h-10 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                        />
                    </div>
                    <InputError :message="errors.email" />
                </div>

                <!-- Empresa -->
                <div class="grid gap-2">
                    <Label
                        for="company"
                        class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                    >
                        Empresa <span class="normal-case font-normal text-muted-foreground/50">(opcional)</span>
                    </Label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <Building2 class="w-4 h-4 text-muted-foreground/50 group-focus-within:text-primary transition-colors" />
                        </div>
                        <Input
                            id="company"
                            type="text"
                            name="company"
                            :tabindex="3"
                            placeholder="Nome da sua empresa"
                            class="pl-11 h-10 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                        />
                    </div>
                    <InputError :message="errors.company" />
                </div>

                <!-- Mensagem -->
                <div class="grid gap-2">
                    <Label
                        for="message"
                        class="text-xs font-bold uppercase tracking-widest text-muted-foreground"
                    >
                        Mensagem <span class="normal-case font-normal text-muted-foreground/50">(opcional)</span>
                    </Label>
                    <textarea
                        id="message"
                        name="message"
                        :tabindex="4"
                        rows="3"
                        placeholder="Conte-nos um pouco sobre sua necessidade..."
                        class="w-full rounded-lg px-4 py-2.5 text-sm font-medium bg-muted/30 border border-transparent focus:border-primary focus:ring-0 focus:outline-none resize-none placeholder:text-muted-foreground/40 transition-colors"
                    />
                    <InputError :message="errors.message" />
                </div>

                <!-- Submit -->
                <Button
                    type="submit"
                    class="w-full btn-gradient h-10 text-sm font-bold rounded-lg flex items-center justify-center gap-2 group"
                    :tabindex="5"
                    :disabled="processing"
                >
                    <Spinner v-if="processing" class="h-4 w-4 animate-spin" />
                    <template v-else>
                        Enviar Solicitação
                        <ArrowRight class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                    </template>
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Já tem acesso?
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
