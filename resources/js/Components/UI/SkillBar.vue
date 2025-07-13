<!-- SkillBar.vue -->
<template>
  <div class="flex items-center justify-between">
    <span class="text-gray-300">{{ skill.name }}</span>
    <div class="w-24 bg-gray-800 rounded-full h-2">
      <div 
        class="bg-blue-500 h-2 rounded-full skill-bar transition-all duration-1000 ease-out"
        :style="{ width: skill.level + '%' }"
      ></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SkillBar',
  props: {
    skill: {
      type: Object,
      required: true
    }
  }
}
</script>
