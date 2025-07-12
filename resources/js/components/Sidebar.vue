<template>
  <aside class="fixed top-0 left-0 h-full bg-gray-800 text-white w-16 md:w-64 transition-all duration-300">
    <div class="p-4 border-b border-gray-700 flex justify-center md:justify-start">
      <span class="text-xl font-bold hidden md:inline">Menu</span>
      <Bars3Icon class="w-6 h-6 md:hidden" />
    </div>

    <nav class="flex flex-col mt-4 px-2 md:px-4 space-y-2">
      <Link href="/home" class="flex items-center gap-3 hover:bg-gray-700 rounded px-3 py-2">
        <HomeIcon class="w-5 h-5" />
        <span class="hidden md:inline">Dashboard</span>
      </Link>
      <Link href="/students" class="flex items-center gap-3 hover:bg-gray-700 rounded px-3 py-2">
        <UserGroupIcon class="w-5 h-5" />
        <span class="hidden md:inline">Students</span>
      </Link>
      <Link href="/teachers" class="flex items-center gap-3 hover:bg-gray-700 rounded px-3 py-2">
        <AcademicCapIcon class="w-5 h-5" />
        <span class="hidden md:inline">Teachers</span>
      </Link>
      <Link href="/classes" class="flex items-center gap-3 hover:bg-gray-700 rounded px-3 py-2">
        <BuildingLibraryIcon class="w-5 h-5" />
        <span class="hidden md:inline">Classes</span>
      </Link>

      <div class="mt-auto">
        <Link 
          as="button"
          method="POST"
          href="/logout"
          class="w-full flex items-center gap-3 hover:bg-gray-700 rounded px-3 py-2 mt-10 text-red-300"
        >
          <ArrowLeftOnRectangleIcon class="w-5 h-5" />
          <span class="hidden md:inline">Logout</span>
        </Link>
      </div>
    </nav>
  </aside>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import {
  Bars3Icon,
  HomeIcon,
  UserGroupIcon,
  AcademicCapIcon,
  BuildingLibraryIcon,
  ArrowLeftOnRectangleIcon,
} from '@heroicons/vue/24/outline';
</script>

<style scoped>
a.router-link-active {
  background-color: #4b5563;
}
</style>