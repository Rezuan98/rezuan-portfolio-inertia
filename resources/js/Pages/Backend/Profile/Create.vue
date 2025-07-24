<template>
  <div class="min-h-screen bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
      <h1 class="text-2xl font-bold mb-6">Profile Management</h1>

      <!-- Success Message -->
      <div v-if="$page.props.flash?.success" class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ $page.props.flash.success }}
      </div>

      <!-- Show Current Profile -->
      <div v-if="profile" class="mb-6 p-4 bg-blue-50 rounded">
        <h3 class="font-semibold mb-2">Current Profile:</h3>
        <div class="flex items-center space-x-4">
          <img 
            v-if="profile.image" 
            :src="`/storage/${profile.image}`" 
            :alt="profile.name"
            class="w-16 h-16 rounded-full object-cover"
          />
          <div>
            <p><strong>Name:</strong> {{ profile.name }}</p>
            <p><strong>Image:</strong> {{ profile.image ? 'Uploaded' : 'No image' }}</p>
          </div>
        </div>
      </div>

      <!-- Form -->
      <form @submit.prevent="submitForm">
        <!-- Name Input -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
          <input 
            v-model="form.name"
            type="text" 
            required
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
            placeholder="Enter your name"
          />
          <div v-if="$page.props.errors?.name" class="text-red-500 text-sm mt-1">
            {{ $page.props.errors.name }}
          </div>
        </div>

        <!-- Image Input -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-2">Profile Image</label>
          <input 
            ref="imageInput"
            type="file" 
            accept="image/*"
            @change="handleImageChange"
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
          />
          <div v-if="$page.props.errors?.image" class="text-red-500 text-sm mt-1">
            {{ $page.props.errors.image }}
          </div>
        </div>

        <!-- Image Preview -->
        <div v-if="imagePreview" class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-2">Preview:</label>
          <img :src="imagePreview" alt="Preview" class="w-32 h-32 rounded object-cover" />
        </div>

        <!-- Submit Button -->
        <button 
          type="submit"
          :disabled="processing"
          class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 disabled:opacity-50"
        >
          {{ processing ? 'Saving...' : (profile ? 'Update Profile' : 'Create Profile') }}
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { ref, reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
  props: {
    profile: Object
  },
  setup(props) {
    const processing = ref(false)
    const imagePreview = ref(null)
    const imageInput = ref(null)

    const form = reactive({
      name: props.profile?.name || '',
      image: null
    })

    const handleImageChange = (event) => {
      const file = event.target.files[0]
      if (file) {
        form.image = file
        
        const reader = new FileReader()
        reader.onload = (e) => {
          imagePreview.value = e.target.result
        }
        reader.readAsDataURL(file)
      }
    }

    const submitForm = () => {
      processing.value = true
      
      const formData = new FormData()
      formData.append('name', form.name)
      if (form.image) {
        formData.append('image', form.image)
      }

      Inertia.post('/profile/store', formData, {
        forceFormData: true,
        onFinish: () => {
          processing.value = false
        },
        onSuccess: () => {
          imagePreview.value = null
          form.image = null
          if (imageInput.value) {
            imageInput.value.value = ''
          }
        }
      })
    }

    return {
      form,
      processing,
      imagePreview,
      imageInput,
      handleImageChange,
      submitForm
    }
  }
}
</script>