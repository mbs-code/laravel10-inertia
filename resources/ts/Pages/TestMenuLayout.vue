<template>
  <div class="h-screen flex flex-col">
    <AppHeader
      v-model:sidebar="sidebar"
      class="
        flex-shrink-0
        h-[var(--app-header-height)]
        border-b border-solid border-zinc-300
      "
    />

    <div class="flex-grow flex">
      <Transition name="sidebar">
        <AppSidebar
          v-if="sidebar"
          class="
            w-screen xs:w-[var(--app-sidebar-width)]
            flex-shrink-0 overflow-x-auto overflow-y-screen
            border-r border-solid border-zinc-300
          "
        />
      </Transition>

      <div
        class="
          flex-grow overflow-x-auto overflow-y-screen
          bg-blue-50
        "
      >
        bodbodybodybodybodybodybodybodybodybodybodybodybodybodybodybodybodybodybodybodyy<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
        body<br>
      </div>
    </diV>
  </div>
</template>

<script setup lang="ts">
const sidebar = ref<boolean>(false)
</script>

<style lang="scss">
:root {
  --app-header-height: 2.5rem;
  --app-sidebar-width: 12rem;
}

.sidebar-enter-active,
.sidebar-leave-active {
  transition: transform 0.2s ease;
}
.sidebar-enter-from,
.sidebar-leave-to {
  transform: translateX(-100%);
  transition: all 150ms ease-in 0s;
}
</style>
