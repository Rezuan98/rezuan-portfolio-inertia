<!-- StatsCard.vue -->
<template>
  <div class="bg-gradient-to-br from-black to-gray-900 p-8 rounded-2xl border border-gray-800">
    <h3 class="text-2xl font-semibold mb-6 text-blue-400">{{ stats.title }}</h3>
    <div class="space-y-4">
      <div v-for="item in stats.items" :key="item.label" class="flex justify-between">
        <span class="text-gray-300">{{ item.label }}</span>
        <span class="text-white font-semibold">{{ item.value }}</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'StatsCard',
  props: {
    stats: {
      type: Object,
      required: true
    }
  }
}
</script>
