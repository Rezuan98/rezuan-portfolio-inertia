<!-- AboutSection.vue - Fully dynamic about section using profile and about data -->
<template>
  <section id="about" class="py-20 px-4 bg-gray-950">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-16 bg-gradient-to-r from-teal-400 to-teal-500 bg-clip-text text-transparent">
        {{ about?.title || 'About Me' }}
      </h2>
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <div class="">
          <!-- Use about description first, then profile bio, then fallback -->
          <p v-if="about?.description" class="text-lg text-gray-300 mb-6 leading-relaxed whitespace-pre-line">
            {{ about.description }}
          </p>
          <p v-else-if="profile?.bio" class="text-lg text-gray-300 mb-6 leading-relaxed whitespace-pre-line">
            {{ profile.bio }}
          </p>
          <p v-else class="text-lg text-gray-300 mb-6 leading-relaxed">
            I'm a passionate full-stack developer with expertise in modern web technologies. 
            With 6 months of professional internship experience, I've developed a strong foundation 
            in both frontend and backend development.
          </p>
        </div>
        <div class="bg-gradient-to-br from-black to-gray-900 p-8 rounded-2xl border border-gray-800 ">
          <h3 class="text-2xl font-semibold mb-6 text-teal-400">Quick Stats</h3>
          <div class="space-y-4">
            <div v-if="about?.years_experience" class="flex justify-between">
              <span class="text-gray-300">Experience</span>
              <span class="text-white font-semibold">{{ about.years_experience }} Year{{ about.years_experience > 1 ? 's' : '' }}+</span>
            </div>
            <div v-else class="flex justify-between">
              <span class="text-gray-300">Experience</span>
              <span class="text-white font-semibold">1 Year+</span>
            </div>
            
            <div v-if="about?.projects_completed" class="flex justify-between">
              <span class="text-gray-300">Projects Completed</span>
              <span class="text-white font-semibold">{{ about.projects_completed }}+</span>
            </div>
            <div v-else class="flex justify-between">
              <span class="text-gray-300">Personal Project</span>
              <span class="text-white font-semibold">15+</span>
            </div>
            
            <div v-if="about?.happy_clients" class="flex justify-between">
              <span class="text-gray-300">Happy Clients</span>
              <span class="text-white font-semibold">{{ about.happy_clients }}+</span>
            </div>
            <div v-else class="flex justify-between">
              <span class="text-gray-300">Professional Project</span>
              <span class="text-white font-semibold">9</span>
            </div>
            
            <div v-if="about?.technologies_count" class="flex justify-between">
              <span class="text-gray-300">Technologies</span>
              <span class="text-white font-semibold">{{ about.technologies_count }}+</span>
            </div>
            <div v-else class="flex justify-between">
              <span class="text-gray-300">Technologies</span>
              <span class="text-white font-semibold">12+</span>
            </div>
            
            <div class="flex justify-between">
              <span class="text-gray-300">Server Management</span>
              <span class="text-white font-semibold">{{ about?.has_server_management ? 'Yes' : 'No' }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'AboutSection',
  props: {
    profile: {
      type: Object,
      default: null
    },
    about: {
      type: Object,
      default: null
    }
  }
}
</script>
