<!-- SectionTitle.vue -->
<template>
  <h2 class="text-4xl font-bold text-center mb-16 bg-gradient-to-r from-blue-400 to-blue-500 bg-clip-text text-transparent">
    {{ title }}
  </h2>
</template>

<script>
export default {
  name: 'SectionTitle',
  props: {
    title: {
      type: String,
      required: true
    }
  }
}
</script>
