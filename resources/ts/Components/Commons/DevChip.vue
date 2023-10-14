<template>
  <Chip
    v-if="appConfig.env !== 'production'"
    :pt="{ label: '!m-0' }"
    class="bg-teal-500 text-white text-base font-medium"
    :label="appConfig.env"
  />

  <Chip
    v-if="appConfig.debug"
    :pt="{ label: '!m-0' }"
    class="bg-red-500 text-white text-base font-medium"
    label="debug"
  />
</template>

<script setup lang="ts">
const page = usePage()
const appConfig = computed(() => page.props.app)
</script>
