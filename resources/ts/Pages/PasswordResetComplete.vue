<template>
  <Card class="w-[32rem]" :pt="{ content: 'pb-0' }">
    <template #title>
      <div class="flex gap-2">
        <div>
          パスワードのリセット
        </div>
      </div>
    </template>

    <template #content>
      <form class="flex flex-col gap-2">
        <div class="mb-2">
          パスワードを変更しました。
        </div>

        <div class="min-h-10 flex items-center gap-2 flex-wrap">
          <Link :href="route('login.view')">
            <small>
              <span class="underline text-blue-500">ログインページに戻る</span>
            </small>
          </Link>
        </div>
      </form>
    </template>
  </Card>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import CenterLayout from '@/Layouts/CenterLayout.vue'

defineOptions({ layout: CenterLayout })
</script>
