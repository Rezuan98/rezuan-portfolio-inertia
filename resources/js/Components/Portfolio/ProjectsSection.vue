<!-- Updated ProjectsSection.vue with real project data from resume -->
<template>
  <section id="projects" class="py-20 px-4 bg-black">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-16 bg-gradient-to-r from-teal-400 to-teal-600 bg-clip-text text-transparent">
        Featured Projects
      </h2>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Project 1: REVENCOMM Business Portfolio -->
        <div class="bg-gradient-to-br from-gray-900 to-black rounded-2xl border border-gray-800 overflow-hidden hover:border-teal-500/50 transition-all duration-300 transform hover:scale-105">
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-semibold text-white">REVENCOMM Business Portfolio</h3>
              <span class="text-xs text-teal-400 bg-teal-500/20 px-2 py-1 rounded">Mar 2025</span>
            </div>
            <p class="text-gray-400 mb-4">Professional business website built with Laravel, Blade, and Bootstrap. Hosted on VPS with custom domain and implemented basic SEO.</p>
            <div class="flex flex-wrap gap-2 mb-4">
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Laravel</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Blade</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Bootstrap</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">VPS</span>
            </div>
            <div class="flex space-x-3">
              <a href="#" class="text-teal-400 hover:text-teal-300 transition-colors">Live Site</a>
            </div>
          </div>
        </div>

        <!-- Project 2: Real Estate Property Management -->
        <div class="bg-gradient-to-br from-gray-900 to-black rounded-2xl border border-gray-800 overflow-hidden hover:border-teal-500/50 transition-all duration-300 transform hover:scale-105">
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-semibold text-white">Real Estate Management System</h3>
              <span class="text-xs text-teal-400 bg-teal-500/20 px-2 py-1 rounded">Dec 2023</span>
            </div>
            <p class="text-gray-400 mb-4">Comprehensive property management system developed with Laravel, featuring role-based access control and user authentication.</p>
            <div class="flex flex-wrap gap-2 mb-4">
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Laravel</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">PHP</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">MySQL</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Authentication</span>
            </div>
            <div class="flex space-x-3">
              <a href="#" class="text-teal-400 hover:text-teal-300 transition-colors">GitHub</a>
            </div>
          </div>
        </div>

        <!-- Project 3: IELTS TREK LMS -->
        <div class="bg-gradient-to-br from-gray-900 to-black rounded-2xl border border-gray-800 overflow-hidden hover:border-teal-500/50 transition-all duration-300 transform hover:scale-105">
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-semibold text-white">IELTS TREK - LMS</h3>
              <span class="text-xs text-teal-400 bg-teal-500/20 px-2 py-1 rounded">Jan-Feb 2025</span>
            </div>
            <p class="text-gray-400 mb-4">Learning Management System designed specifically for IELTS preparation, built with modern React and TailwindCSS.</p>
            <div class="flex flex-wrap gap-2 mb-4">
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">React</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">TailwindCSS</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">LMS</span>
            </div>
            <div class="flex space-x-3">
              <a href="#" class="text-teal-400 hover:text-teal-300 transition-colors">Live Demo</a>
            </div>
          </div>
        </div>

        <!-- Project 4: E-commerce Website -->
        <div class="bg-gradient-to-br from-gray-900 to-black rounded-2xl border border-gray-800 overflow-hidden hover:border-teal-500/50 transition-all duration-300 transform hover:scale-105">
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-semibold text-white">E-commerce Platform</h3>
              <span class="text-xs text-teal-400 bg-teal-500/20 px-2 py-1 rounded">Oct-Dec 2024</span>
            </div>
            <p class="text-gray-400 mb-4">Full-featured e-commerce website with modern frontend and robust Laravel backend, including shopping cart and inventory management.</p>
            <div class="flex flex-wrap gap-2 mb-4">
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Laravel</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">CSS</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Bootstrap</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Cart System</span>
            </div>
            <div class="flex space-x-3">
              <a href="#" class="text-teal-400 hover:text-teal-300 transition-colors">Live Demo</a>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center mt-12">
        <a href="#" class="bg-gradient-to-r from-teal-500 to-teal-600 px-8 py-3 rounded-full font-semibold hover:shadow-lg hover:shadow-teal-500/25 transition-all duration-300 transform hover:scale-105">
          View All Projects
        </a>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'ProjectsSection'
}
</script>