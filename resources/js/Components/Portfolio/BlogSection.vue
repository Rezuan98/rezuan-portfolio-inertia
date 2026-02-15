<template>
  <section id="blog" class="py-20 px-4 bg-black">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-4 bg-gradient-to-r from-teal-400 to-teal-500 bg-clip-text text-transparent">
        Latest Blog Posts
      </h2>
      <p class="text-center text-gray-400 mb-12">Thoughts, tutorials, and insights</p>
      
      <div v-if="blogs && blogs.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <a 
          v-for="blog in blogs" 
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
            
            <h3 class="text-xl font-bold mb-3 text-white group-hover:text-teal-400 transition-colors">
              {{ blog.title }}
            </h3>
            
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
      
      <div v-else class="text-center text-gray-500 py-12">
        <svg class="w-16 h-16 mx-auto mb-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
        </svg>
        <p>No blog posts yet. Check back soon!</p>
      </div>
      
      <!-- View All Button -->
      <div v-if="blogs && blogs.length > 0" class="text-center mt-12">
        <a 
          href="/blog" 
          class="inline-block px-8 py-3 bg-gradient-to-r from-teal-500 to-teal-600 text-white font-semibold rounded-full hover:from-teal-600 hover:to-teal-700 transition-all duration-300 hover:scale-105"
        >
          View All Posts
        </a>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'BlogSection',
  props: {
    blogs: {
      type: Array,
      default: () => []
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
