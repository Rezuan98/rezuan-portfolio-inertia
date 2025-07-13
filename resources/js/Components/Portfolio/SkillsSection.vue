<!-- Enhanced SkillsSection.vue with RESTful API, Three.js, and beautiful progress bars -->
<template>
  <section id="skills" class="py-20 px-4 bg-black">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-16 bg-gradient-to-r from-teal-400 to-teal-600 bg-clip-text text-transparent">
        Technical Skills
      </h2>
      
      <div class="grid md:grid-cols-3 gap-8">
        <!-- Frontend -->
        <div class="bg-gradient-to-br from-gray-900 to-black p-6 rounded-2xl border border-gray-800 hover:border-teal-500/50 transition-all duration-300 group">
          <h3 class="text-xl font-semibold mb-6 text-teal-400">Frontend Development</h3>
          <div class="space-y-4">
            <div class="skill-item">
              <span class="text-gray-300 font-medium">HTML/CSS</span>
            </div>
            
            <div class="skill-item">
              <span class="text-gray-300 font-medium">JavaScript</span>
            </div>
            
            <div class="skill-item">
              <span class="text-gray-300 font-medium">Vue.js</span>
            </div>
            
            <div class="skill-item">
              <span class="text-gray-300 font-medium">React</span>
            </div>
            
            <div class="skill-item">
              <span class="text-gray-300 font-medium">Tailwind CSS</span>
            </div>
            
            <div class="skill-item">
              <span class="text-gray-300 font-medium">Three.js</span>
            </div>
            
            <div class="skill-item">
              <span class="text-gray-300 font-medium">Bootstrap</span>
            </div>
          </div>
        </div>

        <!-- Backend -->
        <div class="bg-gradient-to-br from-gray-900 to-black p-6 rounded-2xl border border-gray-800 hover:border-teal-500/50 transition-all duration-300 group">
          <h3 class="text-xl font-semibold mb-6 text-teal-400">Backend Development</h3>
          <div class="space-y-4">
            <div class="skill-item">
              <span class="text-gray-300 font-medium">PHP</span>
            </div>
            
            <div class="skill-item mb-3 p-3 bg-gray-800/50 rounded-lg border border-gray-700/50 hover:border-teal-500/30 transition-all duration-300">
              <span class="text-gray-300 font-medium">Laravel</span>
            </div>
            
            <div class="skill-item mb-3 p-3 bg-gray-800/50 rounded-lg border border-gray-700/50 hover:border-teal-500/30 transition-all duration-300">
              <span class="text-gray-300 font-medium">RESTful API</span>
            </div>
            
            <div class="skill-item mb-3 p-3 bg-gray-800/50 rounded-lg border border-gray-700/50 hover:border-teal-500/30 transition-all duration-300">
              <span class="text-gray-300 font-medium">MySQL</span>
            </div>
            
            <div class="skill-item mb-3 p-3 bg-gray-800/50 rounded-lg border border-gray-700/50 hover:border-teal-500/30 transition-all duration-300">
              <span class="text-gray-300 font-medium">PostgreSQL</span>
            </div>
            
            <div class="skill-item mb-3 p-3 bg-gray-800/50 rounded-lg border border-gray-700/50 hover:border-teal-500/30 transition-all duration-300">
              <span class="text-gray-300 font-medium">Ajax</span>
            </div>
            
            <div class="skill-item mb-3 p-3 bg-gray-800/50 rounded-lg border border-gray-700/50 hover:border-teal-500/30 transition-all duration-300">
              <span class="text-gray-300 font-medium">jQuery</span>
            </div>
          </div>
        </div>

        <!-- DevOps & Tools -->
        <div class="bg-gradient-to-br from-gray-900 to-black p-6 rounded-2xl border border-gray-800 hover:border-teal-500/50 transition-all duration-300 group">
          <h3 class="text-xl font-semibold mb-6 text-teal-400">DevOps & Tools</h3>
          <div class="space-y-4">
            <div class="skill-item">
              <span class="text-gray-300 font-medium">cPanel</span>
            </div>
            
            <div class="skill-item">
              <span class="text-gray-300 font-medium">Cloud VPS</span>
            </div>
            
            <div class="skill-item">
              <span class="text-gray-300 font-medium">Git</span>
            </div>
            
            <div class="skill-item">
              <span class="text-gray-300 font-medium">Linux</span>
            </div>
            
            <div class="skill-item">
              <span class="text-gray-300 font-medium">Docker</span>
            </div>
            
            <div class="skill-item">
              <span class="text-gray-300 font-medium">Nginx</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'SkillsSection',
  mounted() {
    // Component mounted - no animations needed
  },
  methods: {
    // Removed animation methods
  }
}
</script>

<style scoped>
.skill-item {
  @apply mb-3 p-3 bg-gray-800/50 rounded-lg border border-gray-700/50 hover:border-teal-500/30 transition-all duration-300;
}

.skill-item:hover {
  @apply bg-gray-800/70 transform translate-x-1;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .skill-item {
    @apply text-sm;
  }
}
</style>