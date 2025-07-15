<template>
  <AppLayout>
    <div class="flex justify-between items-center mb-4 md:mb-6">
      <h1 class="text-xl md:text-2xl font-bold">Teachers</h1>
      <Link 
        href="/teachers/create" 
        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded"
      >
        + Add Teacher
      </Link>
    </div>

    <div class="mb-4">
      <label for="classFilter" class="block text-sm font-medium text-gray-700 mb-1">Filter by Class:</label>
      <select 
        id="classFilter" 
        v-model="selectedClass"
        @change="filterTeachers"
        class="block w-full md:w-64 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
      >
        <option value="">All Classes</option>
        <option v-for="classItem in classes" :key="classItem.id" :value="classItem.id">
          {{ classItem.class_name }}
        </option>
      </select>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border rounded shadow text-sm md:text-base">
        <thead class="bg-gray-100 text-left">
          <tr>
            <th class="px-4 py-2 border">#</th>
            <th class="px-4 py-2 border">Name</th>
            <th class="px-4 py-2 border">Gender</th>
            <th class="px-4 py-2 border">Email</th>
            <th class="px-4 py-2 border">Class</th>
            <th class="px-4 py-2 border">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(teacher, index) in teachers"
            :key="teacher.id"
            class="hover:bg-gray-50"
          >
            <td class="px-4 py-2 border">{{ index + 1 }}</td>
            <td class="px-4 py-2 border">{{ teacher.name }}</td>
            <td class="px-4 py-2 border capitalize">{{ teacher.gender }}</td>
            <td class="px-4 py-2 border">{{ teacher.email }}</td>
            <td class="px-4 py-2 border">{{ teacher.class?.class_name || '-' }}</td>
            <td class="px-4 py-2 border space-x-1">
              <button
                class="px-2 py-1 text-xs md:text-sm bg-blue-500 text-white rounded hover:bg-blue-600"
                @click="editTeacher(teacher.id)"
              >
                Edit
              </button>
              <button
                class="px-2 py-1 text-xs md:text-sm bg-red-500 text-white rounded hover:bg-red-600"
                @click="deleteTeacher(teacher.id)"
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
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
  teachers: Array,
  classes: Array,
  filters: Object,
});

const selectedClass = ref(props.filters.class_id || '');

function filterTeachers() {
  router.get('/teachers', { class_id: selectedClass.value }, {
    preserveState: true,
    replace: true
  });
}

function editTeacher(id) {
  router.visit(`/teachers/${id}/edit`);
}

function deleteTeacher(id) {
  if (confirm('Are you sure you want to delete this teacher?')) {
    router.delete(`/teachers/${id}`);
  }
}
</script>