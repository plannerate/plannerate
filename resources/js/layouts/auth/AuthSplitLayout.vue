<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { BarChart3, LayoutDashboard } from 'lucide-vue-next';

defineProps<{
    title?: string;
    description?: string;
}>();

const currentYear = new Date().getFullYear();
</script>

<template>
    <div class="relative flex min-h-dvh">
        <!-- Left Side: Dark Brand Panel -->
        <section
            class="hidden lg:flex w-9/12 bg-sidebar relative overflow-hidden flex-col p-16 justify-between border-r border-white/5"
        >
            <!-- Store Image Background -->
            <div
                class="absolute inset-0 object-cover opacity-20 grayscale"
                style="
                    background-image: url('/img/auth.png');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    filter: blur(8px);
                "
            />

            <!-- Blueprint grid background texture -->
            <div class="absolute inset-0 opacity-[0.07] pointer-events-none">
                <div
                    class="absolute w-full h-full"
                    style="
                        background-image: radial-gradient(
                            circle at 2px 2px,
                            oklch(0.85 0.21 131.43) 1px,
                            transparent 0
                        );
                        background-size: 40px 40px;
                    "
                />
            </div>

            <!-- Logo -->
            <div class="relative z-10">
                <div class="flex items-center gap-3">
                    
                    <AppLogoIcon
                        variant="dark"
                        class="h-16 w-auto max-w-[160px] object-contain object-left"
                    />
                </div>
            </div>

            <!-- Main Content -->
            <div class="relative z-10 max-w-2xl">
                <div
                    class="mb-6 inline-flex items-center gap-2 bg-sidebar-primary/10 px-4 py-2 rounded-full border border-sidebar-primary/20"
                >
                    <BarChart3 class="w-3 h-3 text-sidebar-primary" />
                    <span
                        class="text-sidebar-primary text-xs font-bold tracking-widest uppercase"
                        >Retail Precision Engine</span
                    >
                </div>

                <h1
                    class="font-bold text-5xl xl:text-6xl leading-tight text-white mb-8"
                >
                    Organize. Integre. Controle.
                    <span
                        class="text-sidebar-primary italic block mt-2"
                        style="
                            text-shadow: 0 0 20px oklch(0.85 0.21 131.43 / 40%);
                        "
                    >
                        Onde quiser. Quando quiser.
                    </span>
                </h1>

                <p
                    class="text-sidebar-foreground/60 text-lg max-w-lg font-light leading-relaxed"
                >
                    Eleve seu espaço de varejo com planogramas de precisão.
                    Transforme dados em excelência estratégica e impulsione a
                    conversão com layouts otimizados.
                </p>
            </div>

            <!-- Stats -->
            <div
                class="relative z-10 flex gap-12 border-t border-white/10 pt-12"
            >
                <div class="flex flex-col gap-1">
                    <span class="text-sidebar-primary font-bold text-3xl"
                        >99.8%</span
                    >
                    <span
                        class="text-sidebar-foreground/40 text-xs uppercase tracking-widest"
                        >Precisão de Inventário</span
                    >
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-sidebar-primary font-bold text-3xl"
                        >24/7</span
                    >
                    <span
                        class="text-sidebar-foreground/40 text-xs uppercase tracking-widest"
                        >Sincronização na Nuvem</span
                    >
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-sidebar-primary font-bold text-3xl"
                        >15k+</span
                    >
                    <span
                        class="text-sidebar-foreground/40 text-xs uppercase tracking-widest"
                        >Implantações Globais</span
                    >
                </div>
            </div>
        </section>

        <!-- Right Side: Clean Form Area -->
        <section
            class="flex-1 bg-background flex flex-col justify-center items-center px-8 sm:px-16 lg:px-24 py-16"
        >
            <div class="w-full max-w-md">
                <!-- Mobile Logo (hidden on desktop) -->
                <div class="lg:hidden flex items-center gap-2 mb-12">
                    <AppLogoIcon
                        variant="auto"
                        class="h-8 w-auto max-w-[140px] object-contain object-left"
                    />
                </div>

                <!-- Title & Description -->
                <div v-if="title || $slots.header" class="mb-10">
                    <slot name="header">
                        <h2
                            v-if="title"
                            class="text-3xl font-bold text-foreground mb-3 tracking-tight"
                        >
                            {{ title }}
                        </h2>
                        <p
                            v-if="description"
                            class="text-muted-foreground font-medium"
                        >
                            {{ description }}
                        </p>
                    </slot>
                </div>

                <!-- Slot (form content) -->
                <slot />
            </div>

            <!-- Footer -->
            <footer class="w-full max-w-md mt-16 pt-8 border-t border-border">
                <div
                    class="flex flex-col md:flex-row justify-between items-center gap-4"
                >
                    <span
                        class="text-[10px] uppercase tracking-widest text-muted-foreground/60"
                    >
                        © {{ currentYear }} Plannerate. Precision by Design.
                    </span>
                    <div class="flex gap-6">
                        <a
                            href="#"
                            class="text-[10px] uppercase tracking-widest text-muted-foreground/60 hover:text-primary transition-colors"
                            >Privacidade</a
                        >
                        <a
                            href="#"
                            class="text-[10px] uppercase tracking-widest text-muted-foreground/60 hover:text-primary transition-colors"
                            >Segurança</a
                        >
                    </div>
                </div>
            </footer>
        </section>
    </div>
</template>
