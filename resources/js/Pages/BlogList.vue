<template>
  <div class="min-h-screen bg-black text-white">
    <!-- Header -->
    <header class="bg-gradient-to-r from-gray-900 to-black border-b border-gray-800 py-16">
      <div class="max-w-6xl mx-auto px-4">
        <a href="/" class="inline-flex items-center text-teal-400 hover:text-teal-300 mb-6">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
          Back to Home
        </a>
        <h1 class="text-5xl font-bold bg-gradient-to-r from-teal-400 to-teal-500 bg-clip-text text-transparent">
          Blog
        </h1>
        <p class="text-gray-400 mt-4 text-lg">Thoughts, tutorials, and insights</p>
      </div>
    </header>

    <!-- Blog Grid -->
    <main class="max-w-6xl mx-auto px-4 py-16">
      <div v-if="blogs.data && blogs.data.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <a 
          v-for="blog in blogs.data" 
          :key="blog.id"
          :href="`/blog/${blog.slug}`"
          class="group bg-gradient-to-br from-gray-900 to-black rounded-2xl overflow-hidden border border-gray-800 hover:border-teal-500/50 transition-all duration-300 hover:transform hover:scale-105"
        >
          <!-- Featured Image -->
          <div class="relative h-48 bg-gray-800 overflow-hidden">
            <img 
              v-if="blog.featured_image" 
              :src="`/storage/${blog.featured_image}`" 
              :alt="blog.title"
              class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
            />
            <div v-else class="w-full h-full flex items-center justify-center">
              <svg class="w-16 h-16 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
              </svg>
            </div>
          </div>
          
          <!-- Content -->
          <div class="p-6">
            <div class="flex items-center text-sm text-gray-500 mb-3">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              {{ formatDate(blog.published_at) }}
            </div>
            
            <h2 class="text-xl font-bold mb-3 text-white group-hover:text-teal-400 transition-colors">
              {{ blog.title }}
            </h2>
            
            <p v-if="blog.excerpt" class="text-gray-400 mb-4 line-clamp-3">
              {{ blog.excerpt }}
            </p>
            
            <div class="flex items-center text-teal-400 font-semibold">
              Read More
              <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
              </svg>
            </div>
          </div>
        </a>
      </div>

      <!-- Empty State -->
      <div v-else class="text-center text-gray-500 py-20">
        <svg class="w-20 h-20 mx-auto mb-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
        </svg>
        <p class="text-xl">No blog posts yet. Check back soon!</p>
      </div>

      <!-- Pagination -->
      <div v-if="blogs.data && blogs.data.length > 0 && (blogs.prev_page_url || blogs.next_page_url)" class="flex justify-center items-center space-x-4 mt-12">
        <a 
          v-if="blogs.prev_page_url" 
          :href="blogs.prev_page_url"
          class="px-6 py-3 bg-gray-900 border border-gray-800 rounded-lg hover:border-teal-500 transition-colors"
        >
          Previous
        </a>
        <span class="text-gray-500">Page {{ blogs.current_page }} of {{ blogs.last_page }}</span>
        <a 
          v-if="blogs.next_page_url" 
          :href="blogs.next_page_url"
          class="px-6 py-3 bg-gray-900 border border-gray-800 rounded-lg hover:border-teal-500 transition-colors"
        >
          Next
        </a>
      </div>
    </main>
  </div>
</template>

<script>
export default {
  name: 'BlogList',
  props: {
    blogs: {
      type: Object,
      required: true
    }
  },
  methods: {
    formatDate(date) {
      if (!date) return '';
      const d = new Date(date);
      return d.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    }
  }
}
</script>

<style scoped>
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
