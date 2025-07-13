<!-- ExperienceItem.vue -->
<template>
  <div class="relative pl-20" :class="{ 'pb-12': !isLast }">
    <div class="absolute left-6 top-0 w-4 h-4 bg-blue-500 rounded-full border-4 border-black"></div>
    <div class="bg-gradient-to-br from-black to-gray-900 p-6 rounded-2xl border border-gray-800">
      <h3 class="text-xl font-semibold mb-2 text-blue-400">{{ experience.title }}</h3>
      <p class="text-gray-400 mb-3">{{ experience.company }} • {{ experience.duration }}</p>
      <p class="text-gray-300 mb-4">{{ experience.description }}</p>
      <div class="flex flex-wrap gap-2">
        <span 
          v-for="tech in experience.technologies" 
          :key="tech"
          class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm"
        >
          {{ tech }}
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ExperienceItem',
  props: {
    experience: {
      type: Object,
      required: true
    },
    isLast: {
      type: Boolean,
      default: false
    }
  }
}
</script>
