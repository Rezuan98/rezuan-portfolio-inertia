<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
          <h1 class="text-2xl font-bold text-gray-900">Skills Management</h1>
          <div class="flex items-center space-x-4">
            <a href="/profile/index" class="text-blue-600 hover:text-blue-700 font-medium">Profile</a>
            <a href="/about/index" class="text-blue-600 hover:text-blue-700 font-medium">About</a>
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
        <!-- Left Column - Add/Edit Form -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-lg border border-gray-200 p-6 sticky top-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">
              {{ editingSkill ? 'Edit Skill' : 'Add New Skill' }}
            </h2>
            
            <form @submit.prevent="submitForm" class="space-y-4">
              <!-- Skill Name -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  Skill Name <span class="text-red-500">*</span>
                </label>
                <input 
                  v-model="form.name"
                  type="text" 
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="JavaScript"
                />
              </div>

              <!-- Category -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select 
                  v-model="form.category"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                  <option value="">Select Category</option>
                  <option value="Frontend">Frontend</option>
                  <option value="Backend">Backend</option>
                  <option value="DevOps">DevOps</option>
                  <option value="Tools">Tools</option>
                </select>
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
                  {{ processing ? 'Saving...' : (editingSkill ? 'Update' : 'Add Skill') }}
                </button>
                <button 
                  v-if="editingSkill"
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

        <!-- Right Column - Skills List -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Your Skills ({{ skills.length }})</h2>
            
            <!-- Empty State -->
            <div v-if="skills.length === 0" class="text-center py-12">
              <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
              <p class="text-gray-500">No skills added yet. Add your first skill!</p>
            </div>

            <!-- Skills by Category -->
            <div v-else class="space-y-6">
              <div v-for="category in categorizedSkills" :key="category.name" class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
                  {{ category.name || 'Uncategorized' }}
                </h3>
                
                <div class="space-y-2">
                  <div 
                    v-for="skill in category.skills" 
                    :key="skill.id"
                    class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-blue-300 transition-colors"
                  >
                    <div class="flex-1">
                      <div class="flex items-center space-x-3">
                        <div>
                          <h4 class="font-semibold text-gray-900">{{ skill.name }}</h4>
                          <p class="text-xs text-gray-500">Order: {{ skill.order }}</p>
                        </div>
                      </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center space-x-2 ml-4">
                      <button 
                        @click="editSkill(skill)"
                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg"
                        title="Edit"
                      >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                      </button>
                      <button 
                        @click="deleteSkill(skill)"
                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg"
                        title="Delete"
                      >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                      </button>
                    </div>
                  </div>
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
import { ref, reactive, computed } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
  props: {
    skills: Array
  },
  setup(props) {
    const processing = ref(false)
    const editingSkill = ref(null)

    const form = reactive({
      name: '',
      category: '',
      order: 0
    })

    const categorizedSkills = computed(() => {
      const categories = {}
      
      props.skills.forEach(skill => {
        const cat = skill.category || 'Uncategorized'
        if (!categories[cat]) {
          categories[cat] = []
        }
        categories[cat].push(skill)
      })

      return Object.keys(categories).map(name => ({
        name,
        skills: categories[name]
      }))
    })

    const submitForm = () => {
      processing.value = true
      
      const data = {
        name: form.name,
        category: form.category || null,
        order: form.order
      }

      if (editingSkill.value) {
        Inertia.put(`/skills/${editingSkill.value.id}`, data, {
          onFinish: () => {
            processing.value = false
          },
          onSuccess: () => {
            resetForm()
          }
        })
      } else {
        Inertia.post('/skills/store', data, {
          onFinish: () => {
            processing.value = false
          },
          onSuccess: () => {
            resetForm()
          }
        })
      }
    }

    const editSkill = (skill) => {
      editingSkill.value = skill
      form.name = skill.name
      form.category = skill.category || ''
      form.order = skill.order
      
      // Scroll to form
      window.scrollTo({ top: 0, behavior: 'smooth' })
    }

    const deleteSkill = (skill) => {
      if (confirm(`Are you sure you want to delete "${skill.name}"?`)) {
        Inertia.delete(`/skills/${skill.id}`)
      }
    }

    const cancelEdit = () => {
      resetForm()
    }

    const resetForm = () => {
      editingSkill.value = null
      form.name = ''
      form.category = ''
      form.order = 0
    }

    const logout = () => {
      Inertia.post('/logout')
    }

    return {
      form,
      processing,
      editingSkill,
      categorizedSkills,
      submitForm,
      editSkill,
      deleteSkill,
      cancelEdit,
      logout
    }
  }
}
</script>
