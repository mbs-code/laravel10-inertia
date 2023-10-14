<template>
  <Card class="m-2 w-96" :pt="{ content: 'pb-0' }">
    <template #title>
      {{ appConfig.name }}
    </template>

    <template #content>
      <form class="flex flex-col gap-1" @submit.prevent="submit">
        <FormField v-slot="slotProps" label="メール" :error="form.errors?.email">
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

        <FormField hide-details>
          <Button
            type="submit"
            label="ログイン"
            size="small"
            :disabled="!canPost"
          />
        </FormField>
      </form>
    </template>
  </Card>
</template>

<script setup lang="ts">
import CenterLayout from '@/Layouts/CenterLayout.vue'

defineOptions({ layout: CenterLayout })

const page = usePage()
const appConfig = computed(() => page.props.app)

///

const form = useForm({
  email: '',
  password: '',
})

const canPost = computed(() =>
  form.email && form.password
)

const submit = () => {
  form.post(route('login.store'), {
    onFinish: () => {
      form.reset('password')
    },
  })
}
</script>
