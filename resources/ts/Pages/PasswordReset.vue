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
        <template v-if="form.errors?.email">
          <span
            class="mb-2 text-red-500"
          >
            {{ form.errors?.email }}
          </span>

          <div class="h-10 flex items-center gap-2">
            <Link :href="route('login.view')">
              <small>
                <span class="underline text-blue-500">ログインページに戻る</span>
              </small>
            </Link>
          </div>
        </template>

        <template v-else>
          <div class="mb-2">
            新しいパスワードを入力してください。
          </div>

          <FormField v-slot="slotProps" label="新しいパスワード" :error="form.errors?.password">
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

          <div class="h-10 flex items-center gap-2">
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
        </template>
      </form>
    </template>
  </Card>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import CenterLayout from '@/Layouts/CenterLayout.vue'
import { User } from '@/types/model'

defineOptions({ layout: CenterLayout })

const props = defineProps<{
  user?: User
  token?: string
  email?: string
}>()

// ///

const form = useForm({
  email: '',
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form
    .transform(item => ({
      ...item,
      email: props.email,
      token: props.token,
    }))
    .post(route('password_reset.store'))
}

onMounted(() => {
  if (!props.user) {
    form.setError('email', 'このトークンは無効です。')
  }
})
</script>
