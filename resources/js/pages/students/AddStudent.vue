<script setup>
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import Sidebar from '@/components/Sidebar.vue';

const props = defineProps({
  classes: Array,
  errors: Object,
});

const form = reactive({
  name: '',
  email: '',
  gender: '',
  class_id: '',
});

function submit() {
  router.post('/students', form);
}
</script>

<template>
  <div class="flex min-h-screen">
    <Sidebar />

    <div class="ml-16 md:ml-64 w-full transition-all duration-300">
      <div class="max-w-4xl mx-auto p-4 md:p-6">
        <h1 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Add New Student</h1>

        <div class="bg-white rounded-lg shadow p-6">
          <form @submit.prevent="submit" class="space-y-4">
            <div>
              <label for="name" class="block font-semibold mb-1">Name</label>
              <input v-model="form.name" type="text" id="name" class="w-full border p-2 rounded">
              <span class="text-red-500 text-sm" v-if="errors.name">{{ errors.name }}</span>
            </div>

            <div>
              <label for="email" class="block font-semibold mb-1">Email</label>
              <input v-model="form.email" type="email" id="email" class="w-full border p-2 rounded">
              <span class="text-red-500 text-sm" v-if="errors.email">{{ errors.email }}</span>
            </div>

            <div>
              <label for="gender" class="block font-semibold mb-1">Gender</label>
              <select v-model="form.gender" id="gender" class="w-full border p-2 rounded">
                <option disabled value="">-- Select Gender --</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
              <span class="text-red-500 text-sm" v-if="errors.gender">{{ errors.gender }}</span>
            </div>

            <div>
              <label for="class_id" class="block font-semibold mb-1">Class</label>
              <select v-model="form.class_id" id="class_id" class="w-full border p-2 rounded">
                <option disabled value="">-- Select Class --</option>
                <option v-for="kelas in classes" :key="kelas.id" :value="kelas.id">
                  {{ kelas.class_name }}
                </option>
              </select>
              <span class="text-red-500 text-sm" v-if="errors.class_id">{{ errors.class_id }}</span>
            </div>

            <div class="mt-6">
              <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>