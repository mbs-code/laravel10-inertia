<template>
  <Card class="w-[32rem]" :pt="{ content: 'pb-0' }">
    <template #title>
      <div class="flex items-center gap-2">
        <div>
          {{ appConfig.name }}
        </div>

        <div class="flex-grow" />

        <DevChip />
      </div>
    </template>

    <template #content>
      <form class="flex flex-col gap-1" @submit.prevent="submit">
        <FormField v-slot="slotProps" label="メールアドレス" :error="form.errors?.email">
          <InputText
            v-model="form.email"
            v-bind="slotProps"
            name="username"
            type="text"
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

        <div class="min-h-10 flex items-center gap-2 flex-wrap">
          <Link :href="route('password_forgot.view')">
            <small>
              パスワードをお忘れの方は
              <span class="underline text-blue-500">こちら</span>
            </small>
          </Link>

          <div class="flex-grow" />

          <Button
            type="submit"
            label="ログイン"
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

const page = usePage()
const appConfig = computed(() => page.props.app)

///

const form = useForm({
  email: '',
  password: '',
})

const submit = () => {
  form.post(route('login.store'))
}
</script>
