<template>
    Welcome!

    {{ count }}
    <br />
    <button @click="countUp">Count Up</button>
</template>
<script setup>
import { ref } from "vue";

const count = ref(0);
const countUp = () => {
    count.value++;
};
</script>
