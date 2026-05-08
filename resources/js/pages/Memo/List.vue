<template>
    <div class="flex justify-between items-center">
        <h1 class="text-4xl mb-8">メモ一覧</h1>
        <Link href="/new" class="btn btn-primary">新規作成</Link>
    </div>
    <div class="bg-base-100 rounded-box shadow-md">
        <ul v-if="memos.length" class="list list-disc">
            <li v-for="memo in memos" :key="memo.id" class="list-row">
                {{ memo.content }}
            </li>
        </ul>
        <div v-else class="p-5">メモが見つかりません。</div>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

const { memos } = defineProps<{
    memos: {
        id: number;
        content: string;
        created_at: string;
        updated_at: string;
    }[];
}>();
</script>
