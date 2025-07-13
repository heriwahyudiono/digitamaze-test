<template>
  <AppLayout>
    <h1 class="text-2xl md:text-3xl font-bold mb-4 md:mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-6">
      <div class="bg-blue-100 text-blue-900 p-6 rounded-lg shadow flex items-start">
        <div class="bg-blue-500 p-3 rounded-full text-white mr-4">
          <UserGroupIcon class="w-6 h-6" />
        </div>
        <div>
          <h2 class="text-base md:text-lg font-semibold flex items-center">Students</h2>
          <p class="text-xl md:text-2xl font-bold mt-1">{{ totalStudents }}</p>
        </div>
      </div>

      <div class="bg-green-100 text-green-900 p-6 rounded-lg shadow flex items-start">
        <div class="bg-green-500 p-3 rounded-full text-white mr-4">
          <AcademicCapIcon class="w-6 h-6" />
        </div>
        <div>
          <h2 class="text-base md:text-lg font-semibold flex items-center">Teachers</h2>
          <p class="text-xl md:text-2xl font-bold mt-1">{{ totalTeachers }}</p>
        </div>
      </div>

      <div class="bg-yellow-100 text-yellow-900 p-6 rounded-lg shadow flex items-start">
        <div class="bg-yellow-500 p-3 rounded-full text-white mr-4">
          <BuildingLibraryIcon class="w-6 h-6" />
        </div>
        <div>
          <h2 class="text-base md:text-lg font-semibold flex items-center">Classes</h2>
          <p class="text-xl md:text-2xl font-bold mt-1">{{ totalClasses }}</p>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { UserGroupIcon, AcademicCapIcon, BuildingLibraryIcon } from '@heroicons/vue/24/outline';
import AppLayout from '@/layouts/AppLayout.vue';

defineProps({
  totalStudents: Number,
  totalTeachers: Number,
  totalClasses: Number,
});
</script>