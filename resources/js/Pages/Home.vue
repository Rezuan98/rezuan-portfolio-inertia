<!-- Updated Home.vue Component -->
<template>
  <div class="bg-black text-white min-h-screen pb-16">
    <HeroSection :profile="profile" />
    <AboutSection :profile="profile" :about="about" />
    <SkillsSection :skills="skills" />
    <ExperienceSection :experiences="experiences" />
    <ProjectsSection :projects="projects" />
    <BlogSection :blogs="blogs" />
    <ContactSection :profile="profile" />
    <FooterSection :profile="profile" />
  </div>
</template>

<script>
import HeroSection from '../Components/Portfolio/HeroSection.vue'
import AboutSection from '../Components/Portfolio/AboutSection.vue'
import SkillsSection from '../Components/Portfolio/SkillsSection.vue'
import ExperienceSection from '../Components/Portfolio/ExperienceSection.vue'
import ProjectsSection from '../Components/Portfolio/ProjectsSection.vue'
import BlogSection from '../Components/Portfolio/BlogSection.vue'
import ContactSection from '../Components/Portfolio/ContactSection.vue'
import FooterSection from '../Components/Portfolio/FooterSection.vue'

export default {
  name: 'Home',
  props: {
    profile: {
      type: Object,
      default: null
    },
    about: {
      type: Object,
      default: null
    },
    skills: {
      type: Object,
      default: () => ({})
    },
    experiences: {
      type: Array,
      default: () => []
    },
    projects: {
      type: Array,
      default: () => []
    },
    blogs: {
      type: Array,
      default: () => []
    }
  },
  components: {
    HeroSection,
    AboutSection,
    SkillsSection,
    ExperienceSection,
    ProjectsSection,
    BlogSection,
    ContactSection,
    FooterSection
  }
}
</script>