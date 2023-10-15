<template>
  <div class="p-1 pr-3 flex items-center gap-2">
    <Button
      :pt="{ root: 'focus:shadow-none h-2', label: 'hidden' }"
      :icon=" sidebar ? 'pi pi-angle-left' : 'pi pi-bars'"
      size="small"
      severity="secondary"
      rounded
      text
      @click="toggleSidebar"
    />

    <div class="px-2 text-xl font-bold">
      {{ appConfig.name }}
    </div>

    <div class="px-2 text-xl">
      {{ title }}
    </div>

    <div class="flex-grow" />

    <DevChip />

    <Button
      :pt="{ root: 'focus:shadow-none h-2', label: 'hidden' }"
      icon="pi pi-user"
      size="small"
      severity="secondary"
      rounded
      outlined
      @click="toggleMenu"
    />

    <Menu
      ref="menuRef"
      :pt="{
        action: '!px-4 !py-2',
        separator: 'border-b border-solid border-zinc-300',
      }"
      :model="items"
      :popup="true"
    />
  </div>
</template>

<script setup lang="ts">
import Menu from 'primevue/menu'

const props = defineProps<{
  sidebar: boolean
  title?: string
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

const menuRef = ref<Menu>()
const toggleMenu = (event: MouseEvent) => {
  menuRef.value?.toggle(event)
}

const items = ref([
  {
    label: 'ダミー',
    icon: 'pi pi-refresh',
    command: () => {
      console.log('test')
    },
  },
  {
    separator: true
  },
  {
    label: 'ログアウト',
    icon: 'pi pi-sign-out',
    command: () => {
      router.delete(route('login.destroy'))
    }
  },
])
</script>
