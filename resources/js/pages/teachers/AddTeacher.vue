<template>
  <div class="flex min-h-screen">
    <Sidebar />

    <div class="ml-16 md:ml-64 w-full transition-all duration-300">
      <div class="max-w-4xl mx-auto p-4 md:p-6">
        <h1 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Add Teacher</h1>

        <div class="bg-white rounded-lg shadow p-6">
          <form @submit.prevent="submitForm" class="space-y-4">
            <div>
              <label class="block mb-1 font-semibold">Name</label>
              <input v-model="form.name" type="text" class="w-full border p-2 rounded" required>
            </div>

            <div>
              <label class="block mb-1 font-semibold">Email</label>
              <input v-model="form.email" type="email" class="w-full border p-2 rounded" required>
            </div>

            <div>
              <label class="block mb-1 font-semibold">Gender</label>
              <select v-model="form.gender" class="w-full border p-2 rounded" required>
                <option value="" disabled>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>

            <div>
              <label class="block mb-1 font-semibold">Class</label>
              <select v-model="form.class_id" class="w-full border p-2 rounded" required>
                <option value="" disabled>Select Class</option>
                <option v-for="kelas in classes" :key="kelas.id" :value="kelas.id">
                  {{ kelas.class_name }}
                </option>
              </select>
            </div>

            <div class="pt-4">
              <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import Sidebar from '@/components/Sidebar.vue';
import { defineProps } from 'vue';

const props = defineProps({
  classes: Array,
});

const form = reactive({
  name: '',
  email: '',
  gender: '',
  class_id: '',
});

function submitForm() {
  router.post('/teachers', form);
}
</script>