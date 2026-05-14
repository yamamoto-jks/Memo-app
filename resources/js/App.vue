<template>
    <div v-if="showToast" role="status" class="toast toast-end">
        <div class="alert alert-success">
            <span>{{ flashSuccessMessage }}</span>
        </div>
    </div>

    <slot></slot>
</template>

<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import { computed, watch, ref } from "vue";

const page = usePage();
const flashSuccessMessage = computed(() => {
    const flash = page.props.flash;
    if (
        flash &&
        typeof flash === "object" &&
        "success" in flash &&
        typeof flash.success === "string"
    ) {
        return flash.success;
    }

    return null;
});

const showToast = ref(false);

watch(flashSuccessMessage, (message) => {
    if (message) {
        showToast.value = true;
        setTimeout(() => {
            showToast.value = false;
        }, 3000);
    }
});
</script>
