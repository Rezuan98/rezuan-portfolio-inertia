<!-- 1. Main Home.vue Component -->
<template>
  <div class="bg-black text-white min-h-screen pb-16">
    <HeroSection />
    <AboutSection />
    <SkillsSection />
    <ExperienceSection />
    <ProjectsSection />
    <ContactSection />
    <FooterSection />
  </div>
</template>

<script>
import HeroSection from '../Components/Portfolio/HeroSection.vue'
import AboutSection from '../Components/Portfolio/AboutSection.vue'
import SkillsSection from '../Components/Portfolio/SkillsSection.vue'
import ExperienceSection from '../Components/Portfolio/ExperienceSection.vue'
import ProjectsSection from '../Components/Portfolio/ProjectsSection.vue'
import ContactSection from '../Components/Portfolio/ContactSection.vue'
import FooterSection from '../Components/Portfolio/FooterSection.vue'

export default {
  name: 'Home',
  components: {
    HeroSection,
    AboutSection,
    SkillsSection,
    ExperienceSection,
    ProjectsSection,
    ContactSection,
    FooterSection
  }
}
</script>