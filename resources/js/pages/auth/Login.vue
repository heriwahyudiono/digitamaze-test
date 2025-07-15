<template>
  <div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="w-100" style="max-width: 400px;">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h2 class="text-center mb-4">Login</h2>

          <form @submit.prevent="submit">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input 
                v-model="form.email" 
                type="email" 
                id="email" 
                class="form-control" 
                :class="{ 'is-invalid': errors.email }"
                required 
              />
              <div v-if="errors.email" class="invalid-feedback">
                {{ errors.email }}
              </div>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input 
                v-model="form.password" 
                type="password" 
                id="password" 
                class="form-control" 
                :class="{ 'is-invalid': errors.password }"
                required 
              />
              <div v-if="errors.password" class="invalid-feedback">
                {{ errors.password }}
              </div>
            </div>

            <div class="mb-3 form-check">
              <input 
                v-model="form.remember" 
                type="checkbox" 
                id="remember" 
                class="form-check-input" 
              />
              <label for="remember" class="form-check-label">Remember me</label>
            </div>

            <button 
              type="submit" 
              class="btn btn-primary w-100 py-2"
              :disabled="form.processing"
            >
              <span v-if="form.processing" class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
              Login
            </button>
          </form>

          <div class="mt-3 text-center">
            <span>Belum punya akun?</span>
            <Link href="/register" class="ms-1 text-primary text-decoration-none">Register</Link>
          </div>
        </div>
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