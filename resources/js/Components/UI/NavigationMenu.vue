<!-- 3. NavigationMenu.vue Component -->
<template>
  <div class="mb-6 md:mb-8">
    <div class="flex flex-wrap justify-center items-center gap-4 sm:gap-6 md:gap-8">
      <template v-for="item in menuItems" :key="item.name">
        <a 
          :href="item.href" 
          :class="item.isButton ? 'cta-button' : 'nav-link'"
        >
          {{ item.name }}
        </a>
      </template>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NavigationMenu',
  props: {
    menuItems: {
      type: Array,
      required: true
    }
  }
}
</script>
