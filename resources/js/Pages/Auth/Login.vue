<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
    <div class="max-w-md w-full mx-4">
      <!-- Logo/Title -->
      <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">Portfolio Dashboard</h1>
        <p class="text-gray-400">Sign in to manage your portfolio</p>
      </div>

      <!-- Login Card -->
      <div class="bg-white rounded-lg shadow-xl p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Login</h2>

        <!-- Error Message -->
        <div v-if="$page.props.errors?.email" class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded">
          <p class="text-red-700 text-sm">{{ $page.props.errors.email }}</p>
        </div>

        <!-- Login Form -->
        <form @submit.prevent="submit">
          <!-- Email -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input 
              v-model="form.email"
              type="email" 
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="admin@portfolio.com"
            />
          </div>

          <!-- Password -->
          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input 
              v-model="form.password"
              type="password" 
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              placeholder="••••••••"
            />
          </div>

          <!-- Remember Me -->
          <div class="mb-6">
            <label class="flex items-center">
              <input 
                v-model="form.remember"
                type="checkbox" 
                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
              />
              <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
          </div>

          <!-- Submit Button -->
          <button 
            type="submit"
            :disabled="processing"
            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 disabled:opacity-50 disabled:cursor-not-allowed transition-all"
          >
            {{ processing ? 'Signing in...' : 'Sign In' }}
          </button>
        </form>

        <!-- Back to Home -->
        <div class="mt-6 text-center">
          <a href="/" class="text-sm text-blue-600 hover:text-blue-700">
            ← Back to Portfolio
          </a>
        </div>
      </div>

      <!-- Default Credentials Info -->
      <div class="mt-6 bg-blue-900 bg-opacity-50 border border-blue-500 rounded-lg p-4">
        <p class="text-blue-200 text-sm text-center">
          <strong>Default credentials:</strong><br>
          Email: admin@portfolio.com<br>
          Password: password
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
  setup() {
    const processing = ref(false)

    const form = reactive({
      email: '',
      password: '',
      remember: false
    })

    const submit = () => {
      processing.value = true
      
      Inertia.post('/login', form, {
        onFinish: () => {
          processing.value = false
        }
      })
    }

    return {
      form,
      processing,
      submit
    }
  }
}
</script>
