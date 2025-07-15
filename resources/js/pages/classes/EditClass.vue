<template>
  <AppLayout>
    <div class="max-w-4xl mx-auto p-4 md:p-6 text-black">
      <h1 class="text-xl md:text-2xl font-bold mb-4 md:mb-6 text-black">Edit Class</h1>

      <div class="bg-white rounded-lg shadow p-6 text-black">
        <form @submit.prevent="submit" class="space-y-4 text-black">
          <div>
            <label class="block font-semibold mb-1 text-black">Class Name</label>
            <input
              v-model="form.class_name"
              type="text"
              class="w-full px-4 py-2 border rounded text-black placeholder-gray-500"
            />
            <p v-if="form.errors.class_name" class="text-red-500 text-sm mt-1">
              {{ form.errors.class_name }}
            </p>
          </div>

          <button
            type="submit"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
          >
            Update
          </button>
        </form>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { defineProps } from 'vue'
import AppLayout from '@/layouts/AppLayout.vue'

const props = defineProps({
  classData: Object
})

const form = useForm({
  class_name: props.classData.class_name
})

function submit() {
  form.put(`/classes/${props.classData.id}`, {
    preserveScroll: true
  })
}
</script>
