<script setup>
import { ref, watch } from 'vue';
import { useI18n } from 'vue-i18n';
import { Menu, X, Sheet } from 'lucide-vue-next';
import LanguageSelection from '@/Components/LanguageSelection.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import Date from '@/Components/Date.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    dateType: String,
    year: Number,
    month: Number,
    day: Number
});

const { t } = useI18n();

const showingNavigationDropdown = ref(false);

// Keep responsive dropdown menu open when filter date
const wasResponsiveMenuOpen = sessionStorage.getItem('wasResponsiveMenuOpen');
if (wasResponsiveMenuOpen) {
    showingNavigationDropdown.value = JSON.parse(wasResponsiveMenuOpen);
}

watch(showingNavigationDropdown, (newValue) => {
    sessionStorage.setItem('wasResponsiveMenuOpen', newValue);
});

</script>

<template>
    <header class="sticky top-0 z-80 h-full bg-gray-100">
        <nav class="bg-white border-b border-gray-100">
            <!-- Primary Navigation Menu -->
            <div class="mx-auto px-4 sm:px-8 lg:px-12">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Homepage -->
                        <div class="hidden shrink-0 sm:flex sm:items-center">
                            <Link
                                :href="route('inventorio')"
                                @click="dateType = 'always'"
                                class="flex items-end gap-1"
                            >
                                <Sheet />
                                Inventorio
                            </Link>
                        </div>

                    </div>

                    <div class="flex items-center gap-8">
                        <!-- Date Selection -->
                        <Date
                            v-if="dateType"
                            class="hidden sm:flex"
                            :dateType="dateType"
                            :year="year"
                            :month="month"
                            :day="day"
                        />

                        <!-- Language Selection -->
                        <LanguageSelection />

                        <!-- Profile Dropdown -->
                        <div class="hidden sm:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div class="relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent
                                                text-sm leading-4 font-medium rounded-md text-gray-500 bg-white
                                                hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            class="first-letter:capitalize"
                                            :href="route('profile.edit')"
                                        >
                                            {{ t('auth.profile') }}
                                        </DropdownLink>
                                        <DropdownLink
                                            class="first-letter:capitalize"
                                            :href="route('logout')" method="post" as="button"
                                        >
                                            {{ t('auth.logout') }}
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded
                                hover:bg-gray-100 transition duration-150 ease-in-out border h-10"
                                :class="showingNavigationDropdown ? 'bg-gray-100' : ''"
                            >
                                <Menu v-show="!showingNavigationDropdown"/>
                                <X v-show="showingNavigationDropdown" />
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div
                :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                class="sm:hidden"
            >
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink :href="route('inventorio')" :active="route().current('inventorio')">
                        Inventorio
                    </ResponsiveNavLink>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200 flex flex-col gap-3">

                    <div class="px-4 self-end">
                        <Date
                            v-if="dateType"
                            class="flex sm:hidden"
                            :dateType="dateType"
                            :year="year"
                            :month="month"
                            :day="day"
                        />
                    </div>

                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">
                            {{ $page.props.auth.user.name }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                    </div>

                    <ResponsiveNavLink :href="route('profile.edit')" class="first-letter:capitalize">
                        {{ t('auth.profile') }}
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="first-letter:capitalize">
                        {{ t('auth.logout') }}
                    </ResponsiveNavLink>
                </div>
            </div>
        </nav>
    </header>
</template>
