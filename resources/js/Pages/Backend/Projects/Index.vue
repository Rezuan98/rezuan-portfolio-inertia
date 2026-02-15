<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
          <h1 class="text-2xl font-bold text-gray-900">Projects Management</h1>
          <div class="flex items-center space-x-4">
            <a href="/profile/index" class="text-blue-600 hover:text-blue-700 font-medium">Profile</a>
            <a href="/about/index" class="text-blue-600 hover:text-blue-700 font-medium">About</a>
            <a href="/skills/index" class="text-blue-600 hover:text-blue-700 font-medium">Skills</a>
            <a href="/experiences/index" class="text-blue-600 hover:text-blue-700 font-medium">Experiences</a>
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
              {{ editingProject ? 'Edit Project' : 'Add New Project' }}
            </h2>
            
            <form @submit.prevent="submitForm" class="space-y-4">
              <!-- Project Title -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Project Title <span class="text-red-500">*</span>
                </label>
                <input 
                  v-model="form.title"
                  type="text" 
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="E-commerce Platform"
                />
              </div>

              <!-- Category -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Category <span class="text-red-500">*</span>
                </label>
                <input 
                  v-model="form.category"
                  type="text"
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="E-commerce, Portfolio, POS System"
                />
              </div>

              <!-- Description -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Description <span class="text-red-500">*</span>
                </label>
                <textarea 
                  v-model="form.description"
                  rows="3"
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Brief description of the project..."
                ></textarea>
              </div>

              <!-- Features -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Key Features</label>
                <textarea 
                  v-model="form.features"
                  rows="3"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Feature 1, Feature 2, Feature 3 (comma-separated)"
                ></textarea>
                <p class="text-xs text-gray-500 mt-1">Separate each feature with a comma</p>
              </div>

              <!-- Technologies -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Technologies</label>
                <input 
                  v-model="form.technologies"
                  type="text"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="Laravel, Vue.js, MySQL (comma-separated)"
                />
                <p class="text-xs text-gray-500 mt-1">Separate each technology with a comma</p>
              </div>

              <!-- Live Demo URL -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Live Demo URL</label>
                <input 
                  v-model="form.live_demo_url"
                  type="text"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="https://example.com"
                />
              </div>

              <!-- GitHub URL -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">GitHub URL</label>
                <input 
                  v-model="form.github_url"
                  type="text"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="https://github.com/username/repo"
                />
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
                  {{ processing ? 'Saving...' : (editingProject ? 'Update' : 'Add Project') }}
                </button>
                <button 
                  v-if="editingProject"
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

        <!-- Right Column - Projects List -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Your Projects ({{ projects.length }})</h2>
            
            <!-- Empty State -->
            <div v-if="projects.length === 0" class="text-center py-12">
              <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
              </svg>
              <p class="text-gray-500">No projects added yet. Add your first project!</p>
            </div>

            <!-- Projects List -->
            <div v-else class="space-y-4">
              <div 
                v-for="project in projects" 
                :key="project.id"
                class="p-4 border border-gray-200 rounded-lg hover:border-blue-300 transition-colors"
              >
                <div class="flex justify-between items-start mb-2">
                  <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                      <h3 class="font-semibold text-gray-900">{{ project.title }}</h3>
                      <span class="text-xs bg-teal-100 text-teal-700 px-2 py-1 rounded">{{ project.category }}</span>
                    </div>
                    <p class="text-xs text-gray-500">Order: {{ project.order }}</p>
                  </div>
                  
                  <!-- Actions -->
                  <div class="flex items-center space-x-2">
                    <button 
                      @click="editProject(project)"
                      class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg"
                      title="Edit"
                    >
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                      </svg>
                    </button>
                    <button 
                      @click="deleteProject(project)"
                      class="p-2 text-red-600 hover:bg-red-50 rounded-lg"
                      title="Delete"
                    >
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                      </svg>
                    </button>
                  </div>
                </div>

                <p class="text-sm text-gray-700 mb-2">{{ project.description }}</p>

                <!-- Technologies & Links -->
                <div class="flex flex-wrap gap-2 items-center">
                  <span 
                    v-for="(tech, index) in getTechnologies(project.technologies)" 
                    :key="index"
                    class="px-2 py-1 bg-blue-50 text-blue-700 rounded text-xs"
                  >
                    {{ tech }}
                  </span>
                  <a v-if="project.live_demo_url" :href="project.live_demo_url" target="_blank" class="text-xs text-teal-600 hover:underline">Live Demo</a>
                  <a v-if="project.github_url" :href="project.github_url" target="_blank" class="text-xs text-teal-600 hover:underline">GitHub</a>
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
    projects: Array
  },
  setup(props) {
    const processing = ref(false)
    const editingProject = ref(null)

    const form = reactive({
      title: '',
      category: '',
      description: '',
      features: '',
      technologies: '',
      live_demo_url: '',
      github_url: '',
      order: 0
    })

    const getTechnologies = (techString) => {
      return techString ? techString.split(',').map(t => t.trim()) : []
    }

    const submitForm = () => {
      processing.value = true
      
      const data = {
        title: form.title,
        category: form.category,
        description: form.description,
        features: form.features || null,
        technologies: form.technologies || null,
        live_demo_url: form.live_demo_url || null,
        github_url: form.github_url || null,
        order: form.order
      }

      if (editingProject.value) {
        Inertia.put(`/projects/${editingProject.value.id}`, data, {
          onFinish: () => {
            processing.value = false
          },
          onSuccess: () => {
            resetForm()
          }
        })
      } else {
        Inertia.post('/projects/store', data, {
          onFinish: () => {
            processing.value = false
          },
          onSuccess: () => {
            resetForm()
          }
        })
      }
    }

    const editProject = (project) => {
      editingProject.value = project
      form.title = project.title
      form.category = project.category
      form.description = project.description
      form.features = project.features || ''
      form.technologies = project.technologies || ''
      form.live_demo_url = project.live_demo_url || ''
      form.github_url = project.github_url || ''
      form.order = project.order
      
      window.scrollTo({ top: 0, behavior: 'smooth' })
    }

    const deleteProject = (project) => {
      if (confirm(`Are you sure you want to delete "${project.title}"?`)) {
        Inertia.delete(`/projects/${project.id}`)
      }
    }

    const cancelEdit = () => {
      resetForm()
    }

    const resetForm = () => {
      editingProject.value = null
      form.title = ''
      form.category = ''
      form.description = ''
      form.features = ''
      form.technologies = ''
      form.live_demo_url = ''
      form.github_url = ''
      form.order = 0
    }

    const logout = () => {
      Inertia.post('/logout')
    }

    return {
      form,
      processing,
      editingProject,
      getTechnologies,
      submitForm,
      editProject,
      deleteProject,
      cancelEdit,
      logout
    }
  }
}
</script>
