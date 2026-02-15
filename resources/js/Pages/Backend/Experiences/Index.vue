<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
          <h1 class="text-2xl font-bold text-gray-900">Experience Management</h1>
          <div class="flex items-center space-x-4">
            <a href="/profile/index" class="text-blue-600 hover:text-blue-700 font-medium">Profile</a>
            <a href="/about/index" class="text-blue-600 hover:text-blue-700 font-medium">About</a>
            <a href="/skills/index" class="text-blue-600 hover:text-blue-700 font-medium">Skills</a>
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
        <!-- Left Column - Add/Edit Form -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-lg border border-gray-200 p-6 sticky top-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">
              {{ editingExperience ? 'Edit Experience' : 'Add New Experience' }}
            </h2>
            
            <form @submit.prevent="submitForm" class="space-y-4">
              <!-- Job Title -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Job Title <span class="text-red-500">*</span>
                </label>
                <input 
                  v-model="form.title"
                  type="text" 
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Web Developer Intern"
                />
              </div>

              <!-- Company -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Company <span class="text-red-500">*</span>
                </label>
                <input 
                  v-model="form.company"
                  type="text"
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="eManagerIT"
                />
              </div>

              <!-- Duration -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Duration <span class="text-red-500">*</span>
                </label>
                <input 
                  v-model="form.duration"
                  type="text"
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="6 Months"
                />
              </div>

              <!-- Description -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Description <span class="text-red-500">*</span>
                </label>
                <textarea 
                  v-model="form.description"
                  rows="4"
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Describe your role and responsibilities..."
                ></textarea>
              </div>

              <!-- Technologies -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Technologies</label>
                <input 
                  v-model="form.technologies"
                  type="text"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Vue.js, Laravel, MySQL (comma-separated)"
                />
                <p class="text-xs text-gray-500 mt-1">Separate each technology with a comma</p>
              </div>

              <!-- Order -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                <input 
                  v-model.number="form.order"
                  type="number"
                  min="0"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="0"
                />
              </div>

              <!-- Buttons -->
              <div class="flex space-x-2">
                <button 
                  type="submit"
                  :disabled="processing"
                  class="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 disabled:opacity-50 transition-all"
                >
                  {{ processing ? 'Saving...' : (editingExperience ? 'Update' : 'Add Experience') }}
                </button>
                <button 
                  v-if="editingExperience"
                  type="button"
                  @click="cancelEdit"
                  class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50"
                >
                  Cancel
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Right Column - Experiences List -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Your Experiences ({{ experiences.length }})</h2>
            
            <!-- Empty State -->
            <div v-if="experiences.length === 0" class="text-center py-12">
              <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
              <p class="text-gray-500">No experiences added yet. Add your first experience!</p>
            </div>

            <!-- Experiences List -->
            <div v-else class="space-y-4">
              <div 
                v-for="experience in experiences" 
                :key="experience.id"
                class="p-4 border border-gray-200 rounded-lg hover:border-blue-300 transition-colors"
              >
                <div class="flex justify-between items-start mb-2">
                  <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">{{ experience.title }}</h3>
                    <p class="text-sm text-gray-600">{{ experience.company }} • {{ experience.duration }}</p>
                    <p class="text-xs text-gray-500 mt-1">Order: {{ experience.order }}</p>
                  </div>
                  
                  <!-- Actions -->
                  <div class="flex items-center space-x-2">
                    <button 
                      @click="editExperience(experience)"
                      class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg"
                      title="Edit"
                    >
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                      </svg>
                    </button>
                    <button 
                      @click="deleteExperience(experience)"
                      class="p-2 text-red-600 hover:bg-red-50 rounded-lg"
                      title="Delete"
                    >
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                      </svg>
                    </button>
                  </div>
                </div>

                <p class="text-sm text-gray-700 mb-2">{{ experience.description }}</p>

                <!-- Technologies -->
                <div v-if="experience.technologies" class="flex flex-wrap gap-2">
                  <span 
                    v-for="(tech, index) in getTechnologies(experience.technologies)" 
                    :key="index"
                    class="px-2 py-1 bg-blue-50 text-blue-700 rounded text-xs"
                  >
                    {{ tech }}
                  </span>
                </div>
              </div>
            </div>
          </div>
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
    experiences: Array
  },
  setup(props) {
    const processing = ref(false)
    const editingExperience = ref(null)

    const form = reactive({
      title: '',
      company: '',
      duration: '',
      description: '',
      technologies: '',
      order: 0
    })

    const getTechnologies = (techString) => {
      return techString ? techString.split(',').map(t => t.trim()) : []
    }

    const submitForm = () => {
      processing.value = true
      
      const data = {
        title: form.title,
        company: form.company,
        duration: form.duration,
        description: form.description,
        technologies: form.technologies || null,
        order: form.order
      }

      if (editingExperience.value) {
        Inertia.put(`/experiences/${editingExperience.value.id}`, data, {
          onFinish: () => {
            processing.value = false
          },
          onSuccess: () => {
            resetForm()
          }
        })
      } else {
        Inertia.post('/experiences/store', data, {
          onFinish: () => {
            processing.value = false
          },
          onSuccess: () => {
            resetForm()
          }
        })
      }
    }

    const editExperience = (experience) => {
      editingExperience.value = experience
      form.title = experience.title
      form.company = experience.company
      form.duration = experience.duration
      form.description = experience.description
      form.technologies = experience.technologies || ''
      form.order = experience.order
      
      window.scrollTo({ top: 0, behavior: 'smooth' })
    }

    const deleteExperience = (experience) => {
      if (confirm(`Are you sure you want to delete "${experience.title}"?`)) {
        Inertia.delete(`/experiences/${experience.id}`)
      }
    }

    const cancelEdit = () => {
      resetForm()
    }

    const resetForm = () => {
      editingExperience.value = null
      form.title = ''
      form.company = ''
      form.duration = ''
      form.description = ''
      form.technologies = ''
      form.order = 0
    }

    const logout = () => {
      Inertia.post('/logout')
    }

    return {
      form,
      processing,
      editingExperience,
      getTechnologies,
      submitForm,
      editExperience,
      deleteExperience,
      cancelEdit,
      logout
    }
  }
}
</script>
