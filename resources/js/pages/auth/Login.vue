<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100 text-black">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md text-black">
      <h2 class="text-2xl font-bold text-center mb-6 text-black">Login</h2>

      <form @submit.prevent="submit" class="text-black">
        <div class="mb-4">
          <label for="email" class="block mb-1 text-black">Email</label>
          <input
            v-model="form.email"
            type="email"
            id="email"
            class="w-full px-4 py-2 border border-gray-300 rounded-md text-black placeholder:text-gray-400"
            required
            autofocus
          />
          <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
        </div>

        <div class="mb-6">
          <label for="password" class="block mb-1 text-black">Password</label>
          <input
            v-model="form.password"
            type="password"
            id="password"
            class="w-full px-4 py-2 border border-gray-300 rounded-md text-black placeholder:text-gray-400"
            required
          />
          <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
        </div>

        <button
          type="submit"
          class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md"
          :disabled="form.processing"
        >
          <span v-if="form.processing">Processing...</span>
          <span v-else>Login</span>
        </button>
      </form>

      <div class="mt-6 text-center text-black">
        <span class="text-black">Don't have an account?</span>
        <Link 
          href="/register" 
          class="text-blue-600 hover:underline ml-1 font-medium"
        >
          Register
        </Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
  email: '',
  password: '',
});

const submit = () => {
  form.post('/login');
};
</script>
