<template>
  <Card class="w-[32rem]" :pt="{ content: 'pb-0' }">
    <template #title>
      <div class="flex gap-2">
        <div>
          アカウントの作成
        </div>
      </div>
    </template>

    <template #content>
      <form class="flex flex-col gap-2" @submit.prevent="submit">
        <div class="mb-4">
          新しくアカウントを作成します。
        </div>

        <FormField v-slot="slotProps" label="メールアドレス" :error="form.errors?.email">
          <InputText
            v-model="form.email"
            v-bind="slotProps"
            name="email"
            type="email"
            size="small"
          />
        </FormField>

        <FormField v-slot="slotProps" label="名前" :error="form.errors?.name">
          <InputText
            v-model="form.name"
            v-bind="slotProps"
            name="name"
            size="small"
          />
        </FormField>

        <FormField v-slot="slotProps" label="パスワード" :error="form.errors?.password">
          <InputText
            v-model="form.password"
            v-bind="slotProps"
            name="password"
            type="password"
            size="small"
          />
        </FormField>

        <FormField v-slot="slotProps" label="再入力" :error="form.errors?.password_confirmation">
          <InputText
            v-model="form.password_confirmation"
            v-bind="slotProps"
            name="password_confirmation"
            type="password"
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
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post(route('register.store'))
}
</script>
