<!-- Enhanced ExperienceSection.vue with dynamic data from database -->
<template>
  <section id="experience" class="py-20 px-4 bg-gray-950">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-16 bg-gradient-to-r from-blue-400 to-blue-500 bg-clip-text text-transparent">
        Experience
      </h2>
      
      <div class="max-w-3xl mx-auto">
        <div class="relative">
          <!-- Timeline line -->
          <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gradient-to-b from-blue-500 to-blue-600"></div>
          
          <!-- Experience Items -->
          <div 
            v-for="experience in experiences" 
            :key="experience.id"
            class="relative pl-20 pb-12"
          >
            <div class="absolute left-6 top-0 w-4 h-4 bg-blue-500 rounded-full border-4 border-black"></div>
            <div class="bg-gradient-to-br from-black to-gray-900 p-6 rounded-2xl border border-gray-800">
              <h3 class="text-xl font-semibold mb-2 text-blue-400">{{ experience.title }}</h3>
              <p class="text-gray-400 mb-3">{{ experience.company }} • {{ experience.duration }}</p>
              <p class="text-gray-300 mb-4">{{ experience.description }}</p>
              <div v-if="experience.technologies" class="flex flex-wrap gap-2">
                <span 
                  v-for="(tech, index) in getTechnologies(experience.technologies)" 
                  :key="index"
                  class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm"
                >
                  {{ tech }}
                </span>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-if="experiences.length === 0" class="text-center py-12">
            <p class="text-gray-500">No experience added yet</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'ExperienceSection',
  props: {
    experiences: {
      type: Array,
      default: () => []
    }
  },
  methods: {
    getTechnologies(techString) {
      return techString ? techString.split(',').map(t => t.trim()) : []
    }
  }
}
</script>
