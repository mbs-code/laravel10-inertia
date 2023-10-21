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
      <form class="flex flex-col gap-2" @submit.prevent="submit">
        <div class="mb-2">
          ご登録のメールアドレスを入力してください。
          パスワード再設定用のURLをお送りします。
        </div>

        <FormField v-slot="slotProps" label="メールアドレス" :error="form.errors?.email">
          <InputText
            v-model="form.email"
            v-bind="slotProps"
            name="username"
            type="text"
            size="small"
          />
        </FormField>

        <div class="min-h-10 flex items-center gap-2 flex-wrap">
          <Link :href="route('login.view')">
            <small>
              <span class="underline text-blue-500">ログインページに戻る</span>
            </small>
          </Link>

          <div class="flex-grow" />

          <Button
            type="submit"
            label="送信"
            size="small"
          />
        </div>
      </form>
    </template>
  </Card>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import CenterLayout from '@/Layouts/CenterLayout.vue'

defineOptions({ layout: CenterLayout })

// ///

const form = useForm({
  email: '',
})

const submit = () => {
  form.post(route('password_forgot.store'))
}
</script>
