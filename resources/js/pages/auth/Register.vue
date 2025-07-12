<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded shadow">
      <h2 class="text-2xl font-bold text-center mb-6">Register</h2>

      <form @submit.prevent="submit">
        <div class="mb-4">
          <label for="name" class="block text-gray-700">Name</label>
          <input
            v-model="form.name"
            type="text"
            id="name"
            class="w-full mt-1 p-2 border rounded"
            required
          />
          <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
        </div>

        <div class="mb-4">
          <label for="email" class="block text-gray-700">Email</label>
          <input
            v-model="form.email"
            type="email"
            id="email"
            class="w-full mt-1 p-2 border rounded"
            required
          />
          <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
        </div>

        <div class="mb-4">
          <label for="password" class="block text-gray-700">Password</label>
          <input
            v-model="form.password"
            type="password"
            id="password"
            class="w-full mt-1 p-2 border rounded"
            required
          />
          <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
        </div>

        <div class="mb-4">
          <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
          <input
            v-model="form.password_confirmation"
            type="password"
            id="password_confirmation"
            class="w-full mt-1 p-2 border rounded"
            required
          />
        </div>

        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded"
          :disabled="form.processing"
        >
          <span v-if="form.processing">Processing...</span>
          <span v-else>Register</span>
        </button>
      </form>

      <div class="mt-4 text-center">
        <span>Already have an account?</span>
        <Link href="/login" class="text-blue-600 hover:underline ml-1">Login</Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post('/register', {
    onSuccess: () => form.reset('password', 'password_confirmation'),
  });
};
</script>