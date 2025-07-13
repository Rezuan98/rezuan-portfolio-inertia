<!-- 3. AboutSection.vue - Exact copy of your about section -->
<template>
  <section id="about" class="py-20 px-4 bg-gray-950">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-16 bg-gradient-to-r from-teal-400 to-teal-500 bg-clip-text text-transparent">
        About Me
      </h2>
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <div class="">
          <p class="text-lg text-gray-300 mb-6 leading-relaxed">
            I'm a passionate full-stack developer with expertise in modern web technologies. 
            With 6 months of professional internship experience, I've developed a strong foundation 
            in both frontend and backend development.
          </p>
          <p class="text-lg text-gray-300 mb-6 leading-relaxed">
            I specialize in creating responsive, user-friendly applications using cutting-edge 
            technologies like Vue.js, React, Laravel, and modern CSS frameworks. Additionally, 
            I have experience managing hosting servers and cloud infrastructure.
          </p>
          <div class="flex flex-wrap gap-3">
            <span class="px-3 py-1 bg-black rounded-full text-sm border border-gray-800">6 Months Professional Experience</span>
            <span class="px-3 py-1 bg-black rounded-full text-sm border border-gray-800">Multiple Projects</span>
            <span class="px-3 py-1 bg-black rounded-full text-sm border border-gray-800">Server Management</span>
          </div>
        </div>
        <div class="bg-gradient-to-br from-black to-gray-900 p-8 rounded-2xl border border-gray-800 ">
          <h3 class="text-2xl font-semibold mb-6 text-teal-400">Quick Stats</h3>
          <div class="space-y-4">
            <div class="flex justify-between">
              <span class="text-gray-300">Experience</span>
              <span class="text-white font-semibold">1 Year+</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-300">Personal  Project</span>
              <span class="text-white font-semibold">15+</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-300">Professional Project</span>
              <span class="text-white font-semibold">9</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-300">Technologies</span>
              <span class="text-white font-semibold">12+</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-300">Server Management</span>
              <span class="text-white font-semibold">Yes</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'AboutSection'
}
</script>
