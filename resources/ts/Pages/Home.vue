<template>
  <div>
    <!-- eslint-disable-next-line vue/no-v-html -->
    <div v-html="sanitizeReadme" />
  </div>
</template>

<script setup lang="ts">
import sanitizeHtml from 'sanitize-html'
import DashboardLayout from '@/Layouts/DashboardLayout.vue'

defineOptions({ layout: DashboardLayout, title: 'ホーム' })

const props = defineProps<{
  readme: string
}>()

const sanitizeReadme = computed(() => sanitizeHtml(props.readme))
</script>
