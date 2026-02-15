<!-- Enhanced SkillsSection.vue with dynamic data from database -->
<template>
  <section id="skills" class="py-20 px-4 bg-black">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-16 bg-gradient-to-r from-teal-400 to-teal-600 bg-clip-text text-transparent">
        Technical Skills
      </h2>
      
      <div class="grid md:grid-cols-3 gap-8">
        <!-- Frontend Development -->
        <div class="bg-gradient-to-br from-gray-900 to-black p-6 rounded-2xl border border-gray-800 hover:border-teal-500/50 transition-all duration-300 group">
          <h3 class="text-xl font-semibold mb-6 text-teal-400">Frontend Development</h3>
          <div class="space-y-4">
            <div 
              v-for="skill in getSkillsByCategory('Frontend')" 
              :key="skill.id"
              class="skill-item"
            >
              <span class="text-gray-300 font-medium">{{ skill.name }}</span>
            </div>
            <!-- Show message if no skills -->
            <div v-if="getSkillsByCategory('Frontend').length === 0" class="text-gray-500 text-sm italic">
              No skills added yet
            </div>
          </div>
        </div>

        <!-- Backend Development -->
        <div class="bg-gradient-to-br from-gray-900 to-black p-6 rounded-2xl border border-gray-800 hover:border-teal-500/50 transition-all duration-300 group">
          <h3 class="text-xl font-semibold mb-6 text-teal-400">Backend Development</h3>
          <div class="space-y-4">
            <div 
              v-for="skill in getSkillsByCategory('Backend')" 
              :key="skill.id"
              class="skill-item"
            >
              <span class="text-gray-300 font-medium">{{ skill.name }}</span>
            </div>
            <!-- Show message if no skills -->
            <div v-if="getSkillsByCategory('Backend').length === 0" class="text-gray-500 text-sm italic">
              No skills added yet
            </div>
          </div>
        </div>

        <!-- DevOps & Tools -->
        <div class="bg-gradient-to-br from-gray-900 to-black p-6 rounded-2xl border border-gray-800 hover:border-teal-500/50 transition-all duration-300 group">
          <h3 class="text-xl font-semibold mb-6 text-teal-400">DevOps & Tools</h3>
          <div class="space-y-4">
            <div 
              v-for="skill in getSkillsByCategory('DevOps')" 
              :key="skill.id"
              class="skill-item"
            >
              <span class="text-gray-300 font-medium">{{ skill.name }}</span>
            </div>
            <!-- Also include "Tools" category -->
            <div 
              v-for="skill in getSkillsByCategory('Tools')" 
              :key="skill.id"
              class="skill-item"
            >
              <span class="text-gray-300 font-medium">{{ skill.name }}</span>
            </div>
            <!-- Show message if no skills -->
            <div v-if="getSkillsByCategory('DevOps').length === 0 && getSkillsByCategory('Tools').length === 0" class="text-gray-500 text-sm italic">
              No skills added yet
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
  props: {
    skills: {
      type: Object,
      default: () => ({})
    }
  },
  methods: {
    getSkillsByCategory(category) {
      return this.skills[category] || []
    }
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