<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 px-6 py-4">
      <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Blog Management</h1>
        <div class="flex items-center space-x-4">
          <a href="/" class="text-gray-600 hover:text-gray-900">View Site</a>
          <a href="/profile/index" class="text-gray-600 hover:text-gray-900">Profile</a>
          <a href="/about/index" class="text-gray-600 hover:text-gray-900">About</a>
          <a href="/skills/index" class="text-gray-600 hover:text-gray-900">Skills</a>
          <a href="/experiences/index" class="text-gray-600 hover:text-gray-900">Experience</a>
          <a href="/projects/index" class="text-gray-600 hover:text-gray-900">Projects</a>
          <a href="/blogs/index" class="text-teal-600 hover:text-teal-700 font-semibold">Blogs</a>
          <button @click="logout" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
            Logout
          </button>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-8">
      <!-- Header with Add Button -->
      <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Manage Blogs</h2>
        <button 
          @click="showForm = true; editingBlog = null; resetForm()"
          class="px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-semibold flex items-center"
        >
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          Add New Blog
        </button>
      </div>

      <!-- Blog List -->
      <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
              <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="blog in blogs" :key="blog.id">
              <td class="px-6 py-4">
                <div class="text-sm font-medium text-gray-900">{{ blog.title }}</div>
                <div class="text-sm text-gray-500">{{ blog.slug }}</div>
              </td>
              <td class="px-6 py-4">
                <span 
                  :class="blog.is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'"
                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                >
                  {{ blog.is_published ? 'Published' : 'Draft' }}
                </span>
              </td>
              <td class="px-6 py-4 text-sm text-gray-500">
                {{ blog.published_at ? formatDate(blog.published_at) : '-' }}
              </td>
              <td class="px-6 py-4 text-sm text-gray-500">
                {{ blog.order }}
              </td>
              <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                <button 
                  @click="editBlog(blog)"
                  class="text-blue-600 hover:text-blue-900"
                >
                  Edit
                </button>
                <button 
                  @click="deleteBlog(blog)"
                  class="text-red-600 hover:text-red-900"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
        
        <div v-if="blogs.length === 0" class="text-center py-12 text-gray-500">
          No blogs yet. Click "Add New Blog" to create one.
        </div>
      </div>

      <!-- Blog Form Modal -->
      <div v-if="showForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 overflow-y-auto">
        <div class="bg-white rounded-lg max-w-4xl w-full my-8">
          <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-xl font-bold">{{ editingBlog ? 'Edit Blog' : 'Add New Blog' }}</h3>
            <button @click="showForm = false" class="text-gray-500 hover:text-gray-700">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
          
          <form @submit.prevent="submitForm" class="p-6 space-y-6 max-h-[calc(100vh-200px)] overflow-y-auto">
            <!-- Title -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
              <input 
                v-model="form.title"
                type="text"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                placeholder="Enter blog title"
              />
            </div>

            <!-- Slug -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Slug (auto-generated if empty)</label>
              <input 
                v-model="form.slug"
                type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                placeholder="blog-post-slug"
              />
            </div>

            <!-- Excerpt -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
              <textarea 
                v-model="form.excerpt"
                rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                placeholder="Brief summary of the blog post"
              ></textarea>
            </div>

            <!-- Content (TinyMCE) -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
              <textarea 
                ref="contentEditor"
                v-model="form.content"
                rows="15"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg"
              ></textarea>
            </div>

            <!-- Featured Image -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
              <input 
                ref="imageInput"
                type="file"
                accept="image/*"
                @change="handleImageChange"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100"
              />
              <div v-if="imagePreview || (editingBlog && editingBlog.featured_image)" class="mt-4">
                <img 
                  :src="imagePreview || `/storage/${editingBlog.featured_image}`"
                  alt="Preview"
                  class="w-full h-48 object-cover rounded-lg"
                />
              </div>
            </div>

            <!-- Author -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Author</label>
              <input 
                v-model="form.author"
                type="text"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                placeholder="Author name"
              />
            </div>

            <!-- Published At -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Publish Date</label>
              <input 
                v-model="form.published_at"
                type="datetime-local"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
              />
            </div>

            <!-- Is Published & Order -->
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="flex items-center">
                  <input 
                    v-model="form.is_published"
                    type="checkbox"
                    class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500"
                  />
                  <span class="ml-2 text-sm font-medium text-gray-700">Published</span>
                </label>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                <input 
                  v-model.number="form.order"
                  type="number"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                />
              </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
              <button 
                type="button"
                @click="showForm = false"
                class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50"
              >
                Cancel
              </button>
              <button 
                type="submit"
                :disabled="processing"
                class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 disabled:opacity-50"
              >
                {{ processing ? 'Saving...' : (editingBlog ? 'Update Blog' : 'Create Blog') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, ref, onMounted, nextTick } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
  name: 'BlogsIndex',
  props: {
    blogs: {
      type: Array,
      required: true
    }
  },
  setup(props) {
    const showForm = ref(false)
    const editingBlog = ref(null)
    const processing = ref(false)
    const imagePreview = ref(null)
    const imageInput = ref(null)
    const contentEditor = ref(null)
    let editorInstance = null

    const form = reactive({
      title: '',
      slug: '',
      excerpt: '',
      content: '',
      author: '',
      published_at: '',
      is_published: false,
      order: 0,
      featured_image: null
    })

    const initTinyMCE = () => {
      if (window.tinymce && contentEditor.value) {
        window.tinymce.init({
          target: contentEditor.value,
          height: 400,
          menubar: false,
          plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
          ],
          toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
          content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
          setup: (editor) => {
            editorInstance = editor
            editor.on('change', () => {
              form.content = editor.getContent()
            })
          }
        })
      }
    }

    const resetForm = () => {
      form.title = ''
      form.slug = ''
      form.excerpt = ''
      form.content = ''
      form.author = ''
      form.published_at = ''
      form.is_published = false
      form.order = 0
      form.featured_image = null
      imagePreview.value = null
      
      if (editorInstance) {
        editorInstance.setContent('')
      }
    }

    const editBlog = (blog) => {
      editingBlog.value = blog
      form.title = blog.title
      form.slug = blog.slug
      form.excerpt = blog.excerpt || ''
      form.content = blog.content
      form.author = blog.author || ''
      form.published_at = blog.published_at ? blog.published_at.slice(0, 16) : ''
      form.is_published = blog.is_published
      form.order = blog.order
      showForm.value = true
      
      nextTick(() => {
        initTinyMCE()
        if (editorInstance) {
          editorInstance.setContent(blog.content)
        }
      })
    }

    const handleImageChange = (event) => {
      const file = event.target.files[0]
      if (file) {
        form.featured_image = file
        const reader = new FileReader()
        reader.onload = (e) => {
          imagePreview.value = e.target.result
        }
        reader.readAsDataURL(file)
      }
    }

    const submitForm = () => {
      processing.value = true
      
      // Get content from TinyMCE
      if (editorInstance) {
        form.content = editorInstance.getContent()
      }
      
      const formData = new FormData()
      formData.append('title', form.title)
      formData.append('slug', form.slug || '')
      formData.append('excerpt', form.excerpt || '')
      formData.append('content', form.content)
      formData.append('author', form.author || '')
      formData.append('published_at', form.published_at || '')
      formData.append('is_published', form.is_published ? '1' : '0')
      formData.append('order', form.order)
      
      if (form.featured_image) {
        formData.append('featured_image', form.featured_image)
      }

      const url = editingBlog.value ? `/blogs/${editingBlog.value.id}` : '/blogs/store'
      const method = editingBlog.value ? 'put' : 'post'

      Inertia[method](url, formData, {
        forceFormData: true,
        onFinish: () => {
          processing.value = false
          showForm.value = false
          resetForm()
          if (editorInstance) {
            editorInstance.remove()
            editorInstance = null
          }
        }
      })
    }

    const deleteBlog = (blog) => {
      if (confirm(`Are you sure you want to delete "${blog.title}"?`)) {
        Inertia.delete(`/blogs/${blog.id}`)
      }
    }

    const logout = () => {
      Inertia.post('/logout')
    }

    const formatDate = (date) => {
      if (!date) return ''
      const d = new Date(date)
      return d.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })
    }

    onMounted(() => {
      // Load TinyMCE from CDN
      if (!window.tinymce) {
        const script = document.createElement('script')
        script.src = 'https://cdn.tiny.cloud/1/px1itsitpyrt4u7zf2clqulug5bkfrq4r8uqnvxpwoje65nf/tinymce/6/tinymce.min.js'
        script.referrerPolicy = 'origin'
        document.head.appendChild(script)
      }
    })

    return {
      showForm,
      editingBlog,
      processing,
      imagePreview,
      imageInput,
      contentEditor,
      form,
      resetForm,
      editBlog,
      handleImageChange,
      submitForm,
      deleteBlog,
      logout,
      formatDate,
      initTinyMCE
    }
  },
  watch: {
    showForm(newVal) {
      if (newVal) {
        this.$nextTick(() => {
          this.initTinyMCE()
        })
      }
    }
  }
}
</script>
