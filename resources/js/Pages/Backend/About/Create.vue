<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
          <h1 class="text-2xl font-bold text-gray-900">About Section Management</h1>
          <div class="flex items-center space-x-4">
            <a href="/profile/index" class="text-blue-600 hover:text-blue-700 font-medium">Profile</a>
            <a href="/skills/index" class="text-blue-600 hover:text-blue-700 font-medium">Skills</a>
            <a href="/experiences/index" class="text-blue-600 hover:text-blue-700 font-medium">Experiences</a>
            <a href="/projects/index" class="text-blue-600 hover:text-blue-700 font-medium">Projects</a>
            <a href="/" class="text-blue-600 hover:text-blue-700 font-medium">Portfolio</a>
            <form @submit.prevent="logout" class="inline">
              <button type="submit" class="text-red-600 hover:text-red-700 font-medium">Logout</button>
            </form>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Success Message -->
      <div v-if="$page.props.flash?.success" class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
        <div class="flex items-center">
          <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
          </svg>
          <p class="text-green-700 font-medium">{{ $page.props.flash.success }}</p>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Preview -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-lg border border-gray-200 p-6 sticky top-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Preview</h2>
            
            <!-- Title & Description -->
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ form.title || 'About Title' }}</h3>
            <p class="text-sm text-gray-600 mb-4">{{ form.description || 'About description...' }}</p>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-2 pt-4 border-t border-gray-200">
              <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">{{ form.years_experience || 0 }}</div>
                <div class="text-xs text-gray-500">Years</div>
              </div>
              <div class="text-center">
                <div class="text-2xl font-bold text-green-600">{{ form.projects_completed || 0 }}</div>
                <div class="text-xs text-gray-500">Projects</div>
              </div>
              <div class="text-center">
                <div class="text-2xl font-bold text-purple-600">{{ form.happy_clients || 0 }}</div>
                <div class="text-xs text-gray-500">Clients</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column - Form -->
        <div class="lg:col-span-2">
          <form @submit.prevent="submitForm" class="space-y-6">
            <!-- Basic Information Card -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
              <h2 class="text-lg font-semibold text-gray-900 mb-4">About Information</h2>
              
              <div class="space-y-4">
                <!-- Title -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                  <input 
                    v-model="form.title"
                    type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="About Me"
                  />
                </div>

                <!-- Description -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                  <textarea 
                    v-model="form.description"
                    rows="6"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Tell your story..."
                  ></textarea>
                </div>
              </div>
            </div>

            <!-- Statistics Card -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
              <h2 class="text-lg font-semibold text-gray-900 mb-4">Statistics</h2>
              
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
                <!-- Years of Experience -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Years of Experience</label>
                  <input 
                    v-model.number="form.years_experience"
                    type="number"
                    min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="5"
                  />
                </div>

                <!-- Projects Completed -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Projects Completed</label>
                  <input 
                    v-model.number="form.projects_completed"
                    type="number"
                    min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="50"
                  />
                </div>

                <!-- Happy Clients -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Happy Clients</label>
                  <input 
                    v-model.number="form.happy_clients"
                    type="number"
                    min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="30"
                  />
                </div>

                <!-- Technologies Count -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Technologies Count</label>
                  <input 
                    v-model.number="form.technologies_count"
                    type="number"
                    min="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="12"
                  />
                </div>

                <!-- Server Management -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Server Management</label>
                  <div class="flex items-center h-[42px]">
                    <input 
                      v-model="form.has_server_management"
                      type="checkbox"
                      class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
                    />
                    <span class="ml-2 text-sm text-gray-600">Has server management skills</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
              <button 
                type="submit"
                :disabled="processing"
                class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 disabled:opacity-50 disabled:cursor-not-allowed transition-all"
              >
                {{ processing ? 'Saving...' : (about ? 'Update About Section' : 'Create About Section') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import { ref, reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
  props: {
    about: Object
  },
  setup(props) {
    const processing = ref(false)

    const form = reactive({
      title: props.about?.title || '',
      description: props.about?.description || '',
      years_experience: props.about?.years_experience || 0,
      projects_completed: props.about?.projects_completed || 0,
      happy_clients: props.about?.happy_clients || 0,
      technologies_count: props.about?.technologies_count || 0,
      has_server_management: props.about?.has_server_management || false,
    })

    const submitForm = () => {
      processing.value = true
      
      const formData = new FormData()
      formData.append('title', form.title || '')
      formData.append('description', form.description || '')
      formData.append('years_experience', form.years_experience || 0)
      formData.append('projects_completed', form.projects_completed || 0)
      formData.append('happy_clients', form.happy_clients || 0)
      formData.append('technologies_count', form.technologies_count || 0)
      formData.append('has_server_management', form.has_server_management ? '1' : '0')

      Inertia.post('/about/store', formData, {
        forceFormData: true,
        onFinish: () => {
          processing.value = false
        }
      })
    }

    const logout = () => {
      Inertia.post('/logout')
    }

    return {
      form,
      processing,
      submitForm,
      logout
    }
  }
}
</script>
