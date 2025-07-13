<!-- ProjectCard.vue -->
<template>
  <div class="bg-gradient-to-br from-gray-900 to-black rounded-2xl border border-gray-800 overflow-hidden hover:border-blue-500/50 transition-all duration-300 transform hover:scale-105">
    <div class="h-48 bg-gradient-to-br from-blue-600 to-blue-700 flex items-center justify-center">
      <component :is="getProjectIcon(project.icon)" class="w-16 h-16 text-white" />
    </div>
    <div class="p-6">
      <h3 class="text-xl font-semibold mb-2">{{ project.title }}</h3>
      <p class="text-gray-400 mb-4">{{ project.description }}</p>
      <div class="flex flex-wrap gap-2 mb-4">
        <span 
          v-for="tech in project.technologies" 
          :key="tech"
          class="px-2 py-1 bg-blue-500/20 text-blue-300 rounded text-xs"
        >
          {{ tech }}
        </span>
      </div>
      <div class="flex space-x-3">
        <a 
          v-for="(url, linkType) in project.links" 
          :key="linkType"
          :href="url" 
          class="text-blue-400 hover:text-blue-300 transition-colors capitalize"
        >
          {{ linkType }}
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProjectCard',
  props: {
    project: {
      type: Object,
      required: true
    }
  },
  methods: {
    getProjectIcon(iconName) {
      const icons = {
        'shopping-cart': 'ShoppingCartIcon',
        'chart': 'ChartIcon',
        'mobile': 'MobileIcon'
      }
      return icons[iconName] || 'ShoppingCartIcon'
    }
  },
  components: {
    ShoppingCartIcon: {
      template: `
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 9M7 13l-1.5-9M20 13v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6"></path>
        </svg>
      `
    },
    ChartIcon: {
      template: `
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
        </svg>
      `
    },
    MobileIcon: {
      template: `
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
        </svg>
      `
    }
  }
}
</script>
