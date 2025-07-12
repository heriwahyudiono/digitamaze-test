<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded shadow">
      <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

      <form @submit.prevent="submit">
        <div class="mb-4">
          <label for="email" class="block text-gray-700">Email</label>
          <input v-model="form.email" type="email" id="email" class="w-full mt-1 p-2 border rounded" required />
          <div v-if="errors.email" class="text-red-500 text-sm mt-1">{{ errors.email }}</div>
        </div>

        <div class="mb-4">
          <label for="password" class="block text-gray-700">Password</label>
          <input v-model="form.password" type="password" id="password" class="w-full mt-1 p-2 border rounded" required />
          <div v-if="errors.password" class="text-red-500 text-sm mt-1">{{ errors.password }}</div>
        </div>

        <div class="mb-4 flex items-center">
          <input v-model="form.remember" type="checkbox" id="remember" class="mr-2" />
          <label for="remember" class="text-gray-700">Remember me</label>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
          Login
        </button>
      </form>

      <div class="mt-4 text-center">
        <span>Belum punya akun?</span>
        <Link href="/register" class="text-blue-600 hover:underline ml-1">Register</Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post('/login');
};

const errors = form.errors;
</script>