<!-- FooterSection.vue -->
<template>
  <footer class="py-8 px-4 border-t border-gray-900 bg-black">
    <div class="max-w-6xl mx-auto text-center text-gray-400">
      <p>&copy; {{ currentYear }} {{ profile?.name || 'Portfolio' }}. All rights reserved.</p>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'FooterSection',
  props: {
    profile: {
      type: Object,
      default: null
    }
  },
  computed: {
    currentYear() {
      return new Date().getFullYear()
    }
  }
}
</script>