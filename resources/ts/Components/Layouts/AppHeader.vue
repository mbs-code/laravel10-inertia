<template>
  <div class="p-1 pr-3 flex items-center gap-2 flex-wrap">
    <Button
      :pt="{ root: 'focus:shadow-none h-2', label: 'hidden' }"
      :icon=" sidebar ? 'pi pi-angle-left' : 'pi pi-bars'"
      size="small"
      severity="secondary"
      rounded
      text
      @click="toggleSidebar"
    />

    <div>
      {{ appConfig.name }}
    </div>

    <Chip
      v-if="appConfig.env !== 'production'"
      :pt="{ label: '!m-0' }"
      class="bg-teal-500 text-white"
      :label="appConfig.env"
    />

    <Chip
      v-if="appConfig.debug"
      :pt="{ label: '!m-0' }"
      class="bg-red-500 text-white"
      label="DEBUG"
    />

    <div class="flex-grow" />

    <Button
      :pt="{ root: 'focus:shadow-none h-2', label: 'hidden' }"
      icon="pi pi-user"
      size="small"
      severity="secondary"
      rounded
      outlined
    />
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{
  sidebar: boolean
}>()

// eslint-disable-next-line func-call-spacing
const emit = defineEmits<{
  (e: 'update:sidebar', newValue: boolean): void
}>()

const _sidebar = computed({
  get: () => props.sidebar,
  set: newValue => emit('update:sidebar', newValue)
})

const page = usePage()
const appConfig = computed(() => page.props.app)

///

const toggleSidebar = () => {
  _sidebar.value = !_sidebar.value
}
</script>
