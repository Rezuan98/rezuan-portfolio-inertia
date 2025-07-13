<!-- FooterSection.vue -->
<template>
  <footer class="py-8 px-4 border-t border-gray-900 bg-black">
    <div class="max-w-6xl mx-auto text-center text-gray-400">
      <p>&copy; {{ currentYear }} {{ footerData.name }}. All rights reserved.</p>
      <div v-if="footerData.additionalLinks" class="mt-4 flex justify-center space-x-6">
        <a 
          v-for="link in footerData.additionalLinks" 
          :key="link.name"
          :href="link.url" 
          class="hover:text-blue-400 transition-colors text-sm"
        >
          {{ link.name }}
        </a>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'FooterSection',
  data() {
    return {
      footerData: {
        name: 'Rezuan Ahmmed',
        additionalLinks: [
          { name: 'Privacy Policy', url: '#' },
          { name: 'Terms of Service', url: '#' }
        ]
      }
    }
  },
  computed: {
    currentYear() {
      return new Date().getFullYear()
    }
  }
}
</script>