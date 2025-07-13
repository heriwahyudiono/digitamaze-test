<template>
  <AppLayout>
    <div class="flex justify-between items-center mb-4 md:mb-6">
      <h1 class="text-xl md:text-2xl font-bold">Classes</h1>
      <Link 
        href="/classes/create" 
        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
      >
        + Add Class
      </Link>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border rounded shadow text-sm md:text-base">
        <thead class="bg-gray-100 text-left">
          <tr>
            <th class="px-4 py-2 border">#</th>
            <th class="px-4 py-2 border">Class Name</th>
            <th class="px-4 py-2 border">Total Students</th>
            <th class="px-4 py-2 border">Total Teachers</th>
            <th class="px-4 py-2 border">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(kelas, index) in classes"
            :key="kelas.id"
            class="hover:bg-gray-50"
          >
            <td class="px-4 py-2 border">{{ index + 1 }}</td>
            <td class="px-4 py-2 border">{{ kelas.class_name }}</td>
            <td class="px-4 py-2 border">{{ kelas.students?.length || 0 }}</td>
            <td class="px-4 py-2 border">{{ kelas.teachers?.length || 0 }}</td>
            <td class="px-4 py-2 border space-x-1">
              <button
                class="px-2 py-1 text-xs md:text-sm bg-blue-500 text-white rounded hover:bg-blue-600"
                @click="editClass(kelas.id)"
              >
                Edit
              </button>
              <button
                class="px-2 py-1 text-xs md:text-sm bg-red-500 text-white rounded hover:bg-red-600"
                @click="deleteClass(kelas.id)"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>

<script setup>
import { router, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

defineProps({
  classes: Array
});

function editClass(id) {
  router.visit(`/classes/${id}/edit`);
}

function deleteClass(id) {
  if (confirm('Are you sure you want to delete this class?')) {
    router.delete(`/classes/${id}`);
  }
}
</script>