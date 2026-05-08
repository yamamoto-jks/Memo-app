<template>
    <h1 class="text-4xl mb-8">メモ新規作成</h1>

    <div class="mb-6">
        <label>
            メモ内容:<br />
            <textarea class="textarea" v-model="form.content"></textarea>
        </label>
        <div v-if="error" role="alert" class="alert alert-error">
            {{ error }}
        </div>
    </div>

    <button @click="onCreate" class="btn btn-primary">作成する</button>
</template>
<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm<{
    content: string;
}>({
    content: "",
});
const error = ref<string | null>(null);

const onCreate = () => {
    if (!form.content) {
        error.value = "メモを入力してください。";
        return;
    }

    form.post("/", {
        onError: (err) => {
            switch (err.content) {
                case "contentNotFound":
                    error.value = "メモを入力してください。";
                    return;
                case "contentNotCorrectType":
                    error.value = "入力したメモに不備があります。";
                    return;
                default:
                    error.value =
                        "保存に失敗しました。サーバー側でエラーが発生しました。";
                    return;
            }
        },
    });
};
</script>
