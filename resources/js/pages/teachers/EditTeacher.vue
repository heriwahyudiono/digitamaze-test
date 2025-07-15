<template>
  <AppLayout>
    <div class="max-w-4xl mx-auto p-4 md:p-6">
      <h1 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Edit Teacher</h1>

      <div class="bg-white rounded-lg shadow p-6">
        <form @submit.prevent="submitForm" class="space-y-4">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input 
              v-model="form.name" 
              id="name" 
              type="text" 
              class="mt-1 block w-full border px-3 py-2 rounded"
            >
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input 
              v-model="form.email" 
              id="email" 
              type="email" 
              class="mt-1 block w-full border px-3 py-2 rounded"
            >
          </div>

          <div>
            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
            <select 
              v-model="form.gender" 
              id="gender" 
              class="mt-1 block w-full border px-3 py-2 rounded"
            >
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>

          <div>
            <label for="class_id" class="block text-sm font-medium text-gray-700">Class</label>
            <select 
              v-model="form.class_id" 
              id="class_id" 
              class="mt-1 block w-full border px-3 py-2 rounded"
            >
              <option 
                v-for="kelas in classes" 
                :key="kelas.id" 
                :value="kelas.id"
              >
                {{ kelas.class_name }}
              </option>
            </select>
          </div>

          <div class="pt-4">
            <button 
              type="submit" 
              class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
            >
              Update
            </button>
          </div>
        </form>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
  teacher: Object,
  classes: Array
});

const form = reactive({
  name: props.teacher.name,
  email: props.teacher.email,
  gender: props.teacher.gender,
  class_id: props.teacher.class_id
});

function submitForm() {
  router.put(`/teachers/${props.teacher.id}`, form);
}
</script>