<!-- 6. SkillCategory.vue Component -->
<template>
  <div class="bg-gradient-to-br from-gray-900 to-black p-6 rounded-2xl border border-gray-800 hover:border-blue-500/50 transition-all duration-300">
    <h3 class="text-xl font-semibold mb-4 text-blue-400">{{ category.title }}</h3>
    <div class="space-y-3">
      <SkillBar 
        v-for="skill in category.skills" 
        :key="skill.name"
        :skill="skill"
      />
    </div>
  </div>
</template>

<script>
import SkillBar from './SkillBar.vue'

export default {
  name: 'SkillCategory',
  components: {
    SkillBar
  },
  props: {
    category: {
      type: Object,
      required: true
    }
  }
}
</script>
