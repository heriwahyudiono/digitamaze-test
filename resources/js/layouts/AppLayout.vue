<template>
  <div class="flex min-h-screen bg-gray-50">
    <Sidebar />
    
    <div class="flex-1 ml-16 md:ml-64 transition-all duration-300">
      <main class="p-4 md:p-6">
        <slot /> 
      </main>
    </div>
  </div>
</template>

<script setup>
import Sidebar from '@/components/Sidebar.vue';
</script>