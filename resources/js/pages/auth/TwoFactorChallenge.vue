<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Button } from '~/components/ui/button';
import { Input } from '@/components/ui/input';
import {
    PinInput,
    PinInputGroup,
    PinInputSlot,
} from '@/components/ui/pin-input';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { store } from '@/routes/two-factor/login/index';
import { Form, Head } from '@inertiajs/vue3';
import { ArrowRight, Key, ShieldCheck } from 'lucide-vue-next';
import { computed, ref } from 'vue';

interface AuthConfigContent {
    title: string;
    description: string;
    toggleText: string;
}

const authConfigContent = computed<AuthConfigContent>(() => {
    if (showRecoveryInput.value) {
        return {
            title: 'Código de Recuperação',
            description:
                'Por favor, confirme o acesso à sua conta inserindo um dos seus códigos de recuperação de emergência.',
            toggleText: 'entrar usando um código de autenticação',
        };
    }

    return {
        title: 'Código de Autenticação',
        description:
            'Digite o código de autenticação fornecido pelo seu aplicativo autenticador.',
        toggleText: 'entrar usando um código de recuperação',
    };
});

const showRecoveryInput = ref<boolean>(false);

const toggleRecoveryMode = (clearErrors: () => void): void => {
    showRecoveryInput.value = !showRecoveryInput.value;
    clearErrors();
    code.value = [];
};

const code = ref<number[]>([]);
const codeValue = computed<string>(() => code.value.join(''));
</script>

<template>
    <AuthLayout
        :title="authConfigContent.title"
        :description="authConfigContent.description"
    >
        <Head title="Autenticação de Dois Fatores" />

        <div class="grid gap-6">
            <!-- TOTP Code Input -->
            <template v-if="!showRecoveryInput">
                <Form
                    v-bind="store.form()"
                    class="grid gap-6"
                    reset-on-error
                    @error="code = []"
                    #default="{ errors, processing, clearErrors }"
                >
                    <div class="flex flex-col items-center gap-4">
                        <div class="p-3 rounded-full bg-primary/10">
                            <ShieldCheck class="w-8 h-8 text-primary" />
                        </div>
                        <input type="hidden" name="code" :value="codeValue" />
                        <PinInput
                            id="otp"
                            placeholder="○"
                            v-model="code"
                            type="number"
                            otp
                        >
                            <PinInputGroup>
                                <PinInputSlot
                                    v-for="(id, index) in 6"
                                    :key="id"
                                    :index="index"
                                    :disabled="processing"
                                    autofocus
                                />
                            </PinInputGroup>
                        </PinInput>
                        <InputError :message="errors.code" />
                    </div>

                    <Button
                        type="submit"
                        class="w-full btn-gradient h-12 text-base font-bold rounded-lg flex items-center justify-center gap-2 group"
                        :disabled="processing"
                    >
                        <template v-if="!processing">
                            Verificar e Entrar
                            <ArrowRight
                                class="w-4 h-4 group-hover:translate-x-1 transition-transform"
                            />
                        </template>
                    </Button>

                    <div class="text-center text-sm text-muted-foreground">
                        <span>ou você pode </span>
                        <button
                            type="button"
                            class="text-primary font-bold hover:underline transition-colors"
                            @click="() => toggleRecoveryMode(clearErrors)"
                        >
                            {{ authConfigContent.toggleText }}
                        </button>
                    </div>
                </Form>
            </template>

            <!-- Recovery Code Input -->
            <template v-else>
                <Form
                    v-bind="store.form()"
                    class="grid gap-6"
                    reset-on-error
                    #default="{ errors, processing, clearErrors }"
                >
                    <div class="grid gap-2">
                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"
                            >
                                <Key
                                    class="w-4 h-4 text-muted-foreground/50 group-focus-within:text-primary transition-colors"
                                />
                            </div>
                            <Input
                                name="recovery_code"
                                type="text"
                                placeholder="Digite o código de recuperação"
                                :autofocus="showRecoveryInput"
                                required
                                class="pl-11 h-12 bg-muted/30 border-transparent focus-visible:border-primary focus-visible:ring-0 rounded-lg font-medium"
                            />
                        </div>
                        <InputError :message="errors.recovery_code" />
                    </div>

                    <Button
                        type="submit"
                        class="w-full btn-gradient h-12 text-base font-bold rounded-lg flex items-center justify-center gap-2 group"
                        :disabled="processing"
                    >
                        <template v-if="!processing">
                            Verificar e Entrar
                            <ArrowRight
                                class="w-4 h-4 group-hover:translate-x-1 transition-transform"
                            />
                        </template>
                    </Button>

                    <div class="text-center text-sm text-muted-foreground">
                        <span>ou você pode </span>
                        <button
                            type="button"
                            class="text-primary font-bold hover:underline transition-colors"
                            @click="() => toggleRecoveryMode(clearErrors)"
                        >
                            {{ authConfigContent.toggleText }}
                        </button>
                    </div>
                </Form>
            </template>
        </div>
    </AuthLayout>
</template>
