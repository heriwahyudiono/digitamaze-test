<template>
  <div class="flex flex-col min-h-screen bg-gray-50">
    <Sidebar />

    <div class="flex-1 ml-16 md:ml-64 transition-all duration-300">
      <Header />

      <main class="p-4 md:p-6">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import Sidebar from '@/components/Sidebar.vue';
import Header from '@/components/Header.vue';
</script>
