<!-- ContactCard.vue -->
<template>
  <div class="bg-gradient-to-br from-black to-gray-900 p-6 rounded-2xl border border-gray-800">
    <div class="w-12 h-12 bg-blue-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
      <component :is="iconComponent" class="w-6 h-6 text-blue-400" />
    </div>
    <h3 class="text-lg font-semibold mb-2">{{ contact.title }}</h3>
    <p class="text-gray-400">{{ contact.value }}</p>
  </div>
</template>

<script>
export default {
  name: 'ContactCard',
  props: {
    contact: {
      type: Object,
      required: true
    }
  },
  computed: {
    iconComponent() {
      const icons = {
        mail: 'MailIcon',
        phone: 'PhoneIcon',
        location: 'LocationIcon'
      }
      return icons[this.contact.icon] || 'MailIcon'
    }
  },
  components: {
    MailIcon: {
      template: `
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
      `
    },
    PhoneIcon: {
      template: `
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
        </svg>
      `
    },
    LocationIcon: {
      template: `
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
      `
    }
  }
}
</script>
