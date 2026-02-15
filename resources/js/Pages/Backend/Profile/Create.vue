<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between items-center">
          <h1 class="text-2xl font-bold text-gray-900">Portfolio Dashboard</h1>
          <div class="flex items-center space-x-4">
            <a href="/about/index" class="text-blue-600 hover:text-blue-700 font-medium">About</a>
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
        <!-- Left Column - Profile Preview -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-lg border border-gray-200 p-6 sticky top-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Profile Preview</h2>
            
            <!-- Profile Image -->
            <div class="flex justify-center mb-4">
              <div class="relative">
                <img 
                  v-if="imagePreview || profile?.image" 
                  :src="imagePreview || `/storage/${profile.image}`" 
                  :alt="form.name || 'Profile'"
                  class="w-32 h-32 rounded-full object-cover border-4 border-gray-100"
                />
                <div v-else class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center">
                  <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Profile Info -->
            <div class="text-center space-y-2">
              <h3 class="text-xl font-bold text-gray-900">{{ form.name || 'Your Name' }}</h3>
              <p class="text-blue-600 font-medium">{{ form.title || 'Your Title' }}</p>
              <p class="text-sm text-gray-600">{{ form.location || 'Location' }}</p>
            </div>

            <!-- Bio -->
            <div v-if="form.bio" class="mt-4 pt-4 border-t border-gray-200">
              <p class="text-sm text-gray-700">{{ form.bio }}</p>
            </div>

            <!-- Contact Info -->
            <div class="mt-4 pt-4 border-t border-gray-200 space-y-2">
              <div v-if="form.email" class="flex items-center text-sm text-gray-600">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                </svg>
                {{ form.email }}
              </div>
              <div v-if="form.phone" class="flex items-center text-sm text-gray-600">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                </svg>
                {{ form.phone }}
              </div>
            </div>

            <!-- Social Links -->
            <div v-if="form.github || form.linkedin || form.twitter || form.website" class="mt-4 pt-4 border-t border-gray-200">
              <div class="flex justify-center space-x-3">
                <a v-if="form.github" :href="form.github" target="_blank" class="text-gray-600 hover:text-gray-900">
                  <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                </a>
                <a v-if="form.linkedin" :href="form.linkedin" target="_blank" class="text-gray-600 hover:text-blue-600">
                  <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                </a>
                <a v-if="form.twitter" :href="form.twitter" target="_blank" class="text-gray-600 hover:text-blue-400">
                  <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                </a>
                <a v-if="form.website" :href="form.website" target="_blank" class="text-gray-600 hover:text-green-600">
                  <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"/></svg>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column - Form -->
        <div class="lg:col-span-2">
          <form @submit.prevent="submitForm" class="space-y-6">
            <!-- Basic Information Card -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
              <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name <span class="text-red-500">*</span>
                  </label>
                  <input 
                    v-model="form.name"
                    type="text" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="John Doe"
                  />
                  <div v-if="$page.props.errors?.name" class="text-red-500 text-sm mt-1">
                    {{ $page.props.errors.name }}
                  </div>
                </div>

                <!-- Title -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Professional Title</label>
                  <input 
                    v-model="form.title"
                    type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Full Stack Developer"
                  />
                </div>

                <!-- Email -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                  <input 
                    v-model="form.email"
                    type="email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="john@example.com"
                  />
                </div>

                <!-- Phone -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                  <input 
                    v-model="form.phone"
                    type="tel"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="+1 234 567 8900"
                  />
                </div>

                <!-- Location -->
                <div class="md:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                  <input 
                    v-model="form.location"
                    type="text"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="New York, USA"
                  />
                </div>

                <!-- Bio -->
                <div class="md:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                  <textarea 
                    v-model="form.bio"
                    rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Tell us about yourself..."
                  ></textarea>
                </div>
              </div>
            </div>

            <!-- Profile Image Card -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
              <h2 class="text-lg font-semibold text-gray-900 mb-4">Profile Image</h2>
              
              <div class="space-y-4">
                <input 
                  ref="imageInput"
                  type="file" 
                  accept="image/*"
                  @change="handleImageChange"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                />
                <p class="text-sm text-gray-500">Recommended: Square image, at least 400x400px</p>
                <div v-if="$page.props.errors?.image" class="text-red-500 text-sm">
                  {{ $page.props.errors.image }}
                </div>
              </div>
            </div>

            <!-- Social Links Card -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
              <h2 class="text-lg font-semibold text-gray-900 mb-4">Social Links</h2>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- GitHub -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">GitHub URL</label>
                  <input 
                    v-model="form.github"
                    type="url"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="https://github.com/username"
                  />
                </div>

                <!-- LinkedIn -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                  <input 
                    v-model="form.linkedin"
                    type="url"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="https://linkedin.com/in/username"
                  />
                </div>

                <!-- Twitter -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Twitter URL</label>
                  <input 
                    v-model="form.twitter"
                    type="url"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="https://twitter.com/username"
                  />
                </div>

                <!-- Website -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Website URL</label>
                  <input 
                    v-model="form.website"
                    type="url"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="https://yourwebsite.com"
                  />
                </div>
              </div>
            </div>

            <!-- Skills Card -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
              <h2 class="text-lg font-semibold text-gray-900 mb-4">Skills</h2>
              
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Your Skills (comma-separated)</label>
                <textarea 
                  v-model="form.skills"
                  rows="3"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  placeholder="JavaScript, Vue.js, Laravel, PHP, MySQL, Tailwind CSS"
                ></textarea>
                <p class="text-sm text-gray-500 mt-1">Separate each skill with a comma</p>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
              <button 
                type="submit"
                :disabled="processing"
                class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 disabled:opacity-50 disabled:cursor-not-allowed transition-all"
              >
                {{ processing ? 'Saving...' : (profile ? 'Update Profile' : 'Create Profile') }}
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
    profile: Object
  },
  setup(props) {
    const processing = ref(false)
    const imagePreview = ref(null)
    const imageInput = ref(null)

    const form = reactive({
      name: props.profile?.name || '',
      title: props.profile?.title || '',
      bio: props.profile?.bio || '',
      email: props.profile?.email || '',
      phone: props.profile?.phone || '',
      location: props.profile?.location || '',
      github: props.profile?.github || '',
      linkedin: props.profile?.linkedin || '',
      twitter: props.profile?.twitter || '',
      website: props.profile?.website || '',
      skills: props.profile?.skills || '',
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
      formData.append('title', form.title || '')
      formData.append('bio', form.bio || '')
      formData.append('email', form.email || '')
      formData.append('phone', form.phone || '')
      formData.append('location', form.location || '')
      formData.append('github', form.github || '')
      formData.append('linkedin', form.linkedin || '')
      formData.append('twitter', form.twitter || '')
      formData.append('website', form.website || '')
      formData.append('skills', form.skills || '')
      
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

    const logout = () => {
      Inertia.post('/logout')
    }

    return {
      form,
      processing,
      imagePreview,
      imageInput,
      handleImageChange,
      submitForm,
      logout
    }
  }
}
</script>