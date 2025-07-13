<!-- ScrollIndicator.vue -->
<template>
  <div class="absolute bottom-4 sm:bottom-6 md:bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
    <div class="w-5 h-8 sm:w-6 sm:h-10 border-2 border-gray-400/60 rounded-full flex justify-center backdrop-blur-sm">
      <div class="w-1 h-2 sm:h-3 bg-gradient-to-b from-blue-400 to-cyan-400 rounded-full mt-1 sm:mt-2 animate-pulse"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ScrollIndicator'
}
</script>