<script setup>
import { ref, watch } from 'vue';
import { useI18n } from 'vue-i18n';
import { useForm } from '@inertiajs/vue3';
import { Plus, ChevronDown } from 'lucide-vue-next';
import Dropdown from '@/Components/Dropdown.vue';
import DialogModal from '@/Components/DialogModal.vue';
import colors from '@/Services/ColorService.js';

const { t } = useI18n();

const dialogModal = ref(null);
const selectColor = ref(null);

const form = useForm({
    name: null,
    color: null,
});

watch(selectColor, (newColor) => {
    form.color = newColor.name;
});

function submit() {
    form.post(route('table.create'), {
        preserveState: false,
    });
}

</script>

<template>
    <button
        @click="dialogModal.modal.showModal()"
        class="flex items-center gap-1.5 px-3 py-2 border rounded
        hover:bg-gray-100 ml-4"
    >
        <span class="first-letter:capitalize whitespace-nowrap">{{ t('table.create') }}</span>
        <Plus size="16"/>
    </button>
    <Teleport to="body">
        <DialogModal ref="dialogModal">
            <div class="px-16 py-8 border-b border-stone-300 first-letter:capitalize">
                {{ t('table.add') }}
            </div>
            <form
                method="dialog"
                class="px-16 py-12 flex flex-col gap-10"
            >
                <div class="flex flex-col gap-3">
                    <label for="table-name" class="first-letter:capitalize">
                        {{ t('table.name') }}
                    </label>
                    <input
                        v-model="form.name"
                        id="table-name"
                        required
                        class="rounded border-stone-300"
                        type="text"
                        autofocus
                    >
                </div>
                <div class="flex flex-col gap-2">
                    <Dropdown align="left" content-classes="py-1 bg-white overflow-scroll">
                        <template #trigger>
                            <span
                                class="inline-flex rounded-md border border-stone-300
                                items-center px-3 py-2 gap-4 hover:cursor-pointer
                                hover:bg-gray-100 transition w-full justify-between"
                            >
                                <div
                                    v-if="selectColor"
                                    class="flex items-center justify-between w-full"
                                >
                                    <button class="first-letter:capitalize">
                                        {{ t(`color.${selectColor.name}`) }}
                                    </button>
                                    <div
                                        class="w-20 h-5 rounded"
                                        :class="selectColor.color">
                                    </div>
                                </div>
                                <button v-else type="button" class="first-letter:capitalize">
                                    {{ t('table.color') }}
                                </button>
                                <ChevronDown :size="16" />
                            </span>
                        </template>

                        <template #content>
                            <div v-for="color in colors" @click="selectColor = color">
                                <div
                                    class="px-3 py-2 flex items-center justify-between
                                    hover:bg-gray-100 transition hover:cursor-pointer">
                                    <span class="first-letter:capitalize">
                                        {{ t(`color.${color.name}`) }}
                                    </span>
                                    <div class="w-20 h-5 rounded" :class="color.color"></div>
                                </div>
                            </div>
                        </template>
                    </Dropdown>
                </div>
                <button
                    class="border border-stone-300 rounded px-3 py-2 bg-white
                    hover:bg-gray-100 transition mb-2 capitalize"
                    type="submit"
                    @click.prevent="submit"
                    :disabled="!form.name || !form.color"
                >
                    {{ t('crud.create') }}
                </button>
            </form>
        </DialogModal>
    </Teleport>
</template>
