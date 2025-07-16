<template>
  <AppLayout>
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow text-black">
      <h2 class="text-xl font-bold mb-4 text-black">Update Password</h2>

      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-black">Current Password</label>
          <input v-model="form.current_password" type="password" class="w-full border rounded px-3 py-2 text-black" />
          <p v-if="form.errors.current_password" class="text-red-500 text-sm">{{ form.errors.current_password }}</p>
        </div>

        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-black">New Password</label>
          <input v-model="form.new_password" type="password" class="w-full border rounded px-3 py-2 text-black" />
          <p v-if="form.errors.new_password" class="text-red-500 text-sm">{{ form.errors.new_password }}</p>
        </div>

        <div class="mb-4">
          <label class="block mb-1 text-sm font-medium text-black">Confirm New Password</label>
          <input v-model="form.new_password_confirmation" type="password" class="w-full border rounded px-3 py-2 text-black" />
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
          Update Password
        </button>

        <p v-if="success" class="text-green-600 mt-2 text-sm">Password updated successfully</p>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

const form = useForm({
  current_password: '',
  new_password: '',
  new_password_confirmation: '',
})

const success = ref(false)

const submit = () => {
  success.value = false
  form.post('/update-password', {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
      success.value = true
    },
  })
}
</script>