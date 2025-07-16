<template>
  <header class="flex items-center justify-end py-1 px-4 md:py-2 md:px-6 bg-white shadow relative">
    <div class="flex items-center space-x-3">
      <div class="flex items-center space-x-1">
        <ChevronDownIcon class="w-4 h-4 text-black" />
        <span class="font-medium text-sm text-black">{{ user?.name }}</span>
      </div>

      <div class="relative" ref="menuWrapper">
        <div
          class="w-11 h-11 bg-green-100 rounded-full flex items-center justify-center hover:bg-green-200 transition-colors duration-200 cursor-pointer"
          @click="toggleMenu"
        >
          <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center font-bold text-xs">
            {{ initials }}
          </div>
        </div>

        <div
          v-if="menuOpen"
          class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg py-2 z-50 border"
        >
          <a :href="`/profile?id=${user?.id}`" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
          <a href="/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'
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

const menuOpen = ref(false)
const toggleMenu = () => {
  menuOpen.value = !menuOpen.value
}

const menuWrapper = ref(null)
const handleClickOutside = (event) => {
  if (menuWrapper.value && !menuWrapper.value.contains(event.target)) {
    menuOpen.value = false
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>
