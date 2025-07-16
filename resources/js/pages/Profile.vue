<template>
  <AppLayout>
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md mt-8 mx-auto text-center">
      <div class="w-20 h-20 bg-green-500 text-white rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-4">
        {{ initials }}
      </div>
      <h2 class="text-xl font-semibold mb-1">{{ user.name }}</h2>
      <p class="text-gray-600">{{ user.email }}</p>
    </div>
  </AppLayout>
</template>

<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

const page = usePage()
const user = computed(() => page.props.user || {})

const initials = computed(() => {
  if (!user.value.name) return ''
  return user.value.name
    .split(' ')
    .map(word => word[0])
    .join('')
    .toUpperCase()
})
</script>
