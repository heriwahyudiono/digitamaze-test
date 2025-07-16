<template>
  <header class="flex items-center justify-end py-1 px-4 md:py-2 md:px-6 bg-white shadow">
    <div class="flex items-center space-x-3">
      <div class="flex items-center space-x-1">
        <ChevronDownIcon class="w-4 h-4 text-black" />
        <span class="font-medium text-sm text-black">{{ user?.name }}</span>
      </div>

      <div
        class="w-11 h-11 bg-green-100 rounded-full flex items-center justify-center hover:bg-green-200 transition-colors duration-200"
      >
        <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold text-xs">
          {{ initials }}
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { ChevronDownIcon } from '@heroicons/vue/24/solid'

const page = usePage()
const user = computed(() => page.props.auth?.user || {})

const initials = computed(() => {
  if (!user.value.name) return ''
  return user.value.name
    .split(' ')
    .map(n => n[0])
    .join('')
    .toUpperCase()
})
</script>
