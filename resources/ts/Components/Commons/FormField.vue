<template>
  <div class="flex flex-col gap-1">
    <div class="flex max-xs:flex-col xs:items-center gap-1">
      <label class="xs:w-[6rem]">{{ label }}</label>

      <div class="flex-grow flex justify-end">
        <slot :class="['w-full', {'p-invalid': hasError }]" />
      </div>
    </div>

    <small
      v-if="!hideDetails"
      class="h-5 xs:ml-[6.25rem]"
      :class="{ 'text-red-500': hasError }"
    >
      {{ message }}
    </small>
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{
  label?: string
  help?: string
  error?: string | string[]
  hideDetails?: boolean
}>()

const errors = computed(() =>
  Array.isArray(props.error)
    ? props.error
    : (props.error ? [props.error] : [])
)

const hasError = computed(() => errors.value.length > 0)

const message = computed(() => {
  if (hasError.value) { return errors.value.at(0) }
  if (props.help) { return props.help }
  return undefined
})
</script>
