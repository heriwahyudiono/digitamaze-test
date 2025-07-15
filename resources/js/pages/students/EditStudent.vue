<template>
  <AppLayout>
    <div class="max-w-4xl mx-auto p-4 md:p-6">
      <h1 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Edit Student</h1>

      <div class="bg-white rounded-lg shadow p-6">
        <form @submit.prevent="submit" class="space-y-4">
          <div>
            <label for="name" class="block font-semibold mb-1">Name</label>
            <input 
              v-model="form.name" 
              type="text" 
              id="name" 
              class="w-full border p-2 rounded"
            >
            <span class="text-red-500 text-sm" v-if="errors.name">{{ errors.name }}</span>
          </div>

          <div>
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input 
              v-model="form.email" 
              type="email" 
              id="email" 
              class="w-full border p-2 rounded"
            >
            <span class="text-red-500 text-sm" v-if="errors.email">{{ errors.email }}</span>
          </div>

          <div>
            <label for="gender" class="block font-semibold mb-1">Gender</label>
            <select 
              v-model="form.gender" 
              id="gender" 
              class="w-full border p-2 rounded"
            >
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
            <span class="text-red-500 text-sm" v-if="errors.gender">{{ errors.gender }}</span>
          </div>

          <div>
            <label for="class_id" class="block font-semibold mb-1">Class</label>
            <select 
              v-model="form.class_id" 
              id="class_id" 
              class="w-full border p-2 rounded"
            >
              <option 
                v-for="kelas in classes" 
                :key="kelas.id" 
                :value="kelas.id"
              >
                {{ kelas.class_name }}
              </option>
            </select>
            <span class="text-red-500 text-sm" v-if="errors.class_id">{{ errors.class_id }}</span>
          </div>

          <div class="mt-6">
            <button 
              type="submit" 
              class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
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

const props = defineProps({
  student: Object,
  classes: Array,
  errors: Object
});

const form = reactive({
  name: props.student.name,
  email: props.student.email,
  gender: props.student.gender,
  class_id: props.student.class_id,
});

function submit() {
  router.put(`/students/${props.student.id}`, form);
}
</script>