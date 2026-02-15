<template>
  <section id="hero" class="hero-section">
    <!-- Hero Content -->
    <div class="hero-container">
      <!-- Image - Shows on top for mobile -->
      <div class="hero-image">
        <div class="profile-image-wrapper">
          <img 
            :src="getProfileImage()" 
            :alt="getProfileName()" 
            class="profile-image"
            @error="handleImageError"
          />
        </div>
      </div>
      
      <!-- Text Content -->
      <div class="hero-content">
        <h1 class="hero-title">
          <span class="hero-name">{{ getProfileName() }}</span>
        </h1>
        
        <p class="hero-subtitle">
          <span class="hero-role">{{ profile?.title || 'Full Stack Developer' }}</span>
        </p>

        <!-- Navigation Items -->
        <div class="hero-nav">
          <div class="nav-container">
            <a href="#about" class="nav-link">About</a>
            <a href="#skills" class="nav-link">Skills</a>
            <a href="#experience" class="nav-link">Experience</a>
            <a href="#projects" class="nav-link">Projects</a>
            <a href="#contact" class="cta-button">Contact</a>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="hero-buttons">
          <a href="#projects" class="primary-button">
            <span>View Projects</span>
            <svg class="button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
          </a>
          <a href="#contact" class="secondary-button">
            <span>Get In Touch</span>
          </a>
        </div>
      </div>
    </div>
    
    <!-- Scroll Indicator -->
    <!-- <div class="scroll-indicator">
      <div class="scroll-indicator-inner">
        <div class="scroll-indicator-dot"></div>
      </div>
    </div> -->
  </section>
</template>

<script>
export default {
  name: 'HeroSection',
  props: {
    profile: {
      type: Object,
      default: null
    }
  },
  
  mounted() {
    this.$nextTick(() => {
      this.setupSmoothScrolling()
    })
  },
  
  methods: {
    setupSmoothScrolling() {
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault()
          const target = document.querySelector(this.getAttribute('href'))
          if (target) {
            target.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            })
          }
        })
      })
    },

    handleImageError() {
      console.log('Profile image failed to load')
    },

    getProfileName() {
      return this.profile?.name || 'Rezuan Ahmmed'
    },
    
    getProfileImage() {
      if (this.profile?.image) {
        return `/storage/${this.profile.image}`
      }
      return '/rezuan.jpg' // fallback to original image
    }
  }
}
</script>

<style scoped>
/* Hero Section */
.hero-section {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  background: #000000;
  padding: 2rem 1rem;
}

.hero-container {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  max-width: 1200px;
  width: 100%;
  margin: 0 auto;
  align-items: center;
}

@media (min-width: 768px) {
  .hero-container {
    flex-direction: row;
    gap: 4rem;
  }
}

/* Image Section - Top on mobile, left on desktop */
.hero-image {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-shrink: 0;
}

.profile-image-wrapper {
  position: relative;
  width: 200px;
  height: 200px;
  animation: gentleFloat 6s ease-in-out infinite;
}

@media (min-width: 640px) {
  .profile-image-wrapper {
    width: 320px;
    height: 320px;
  }
}

@media (min-width: 1024px) {
  .profile-image-wrapper {
    width: 400px;
    height: 400px;
  }
}

.profile-image-wrapper::before {
  content: '';
  position: absolute;
  inset: -10px;
  background: linear-gradient(135deg, #14b8a6, #0d9488, #14b8a6, #0d9488);
  border-radius: 50%;
}

.profile-image {
  position: relative;
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
  border: 2px solid rgba(255, 255, 255, 0.1);
  transition: transform 0.5s ease;
}

.profile-image:hover {
  transform: scale(1.05) rotate(5deg);
}

/* Content Section */
.hero-content {
  text-align: center;
  animation: fadeInUp 1s ease-out;
  flex: 1;
}

@media (min-width: 768px) {
  .hero-content {
    text-align: left;
  }
}

.hero-title {
  font-size: 2.5rem;
  font-weight: 800;
  margin-bottom: 1rem;
  color: white;
  line-height: 1.1;
}

@media (min-width: 640px) {
  .hero-title {
    font-size: 3rem;
  }
}

@media (min-width: 1024px) {
  .hero-title {
    font-size: 4rem;
  }
}

.hero-name {
  background: linear-gradient(135deg, #ffffff 0%, #14b8a6 25%, #0d9488 50%, #14b8a6 75%, #ffffff 100%);
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
  background-size: 300% auto;
  animation: textShimmer 4s linear infinite;
}

@keyframes textShimmer {
  0% {
    background-position: 0% center;
  }
  100% {
    background-position: 300% center;
  }
}

.hero-subtitle {
  font-size: 1.25rem;
  color: #cbd5e1;
  margin-bottom: 2rem;
  font-weight: 600;
}

@media (min-width: 640px) {
  .hero-subtitle {
    font-size: 1.5rem;
  }
}

@media (min-width: 1024px) {
  .hero-subtitle {
    font-size: 1.875rem;
  }
}

.hero-role {
  background: linear-gradient(135deg, #14b8a6, #0d9488, #14b8a6);
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
  background-size: 200% auto;
  animation: roleGlow 3s ease-in-out infinite alternate;
}

@keyframes roleGlow {
  0% {
    background-position: 0% center;
  }
  100% {
    background-position: 100% center;
  }
}

/* Navigation */
.hero-nav {
  margin-bottom: 2rem;
}

.nav-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  gap: 1rem;
  backdrop-filter: blur(10px);
  background: rgba(255, 255, 255, 0.05);
  border-radius: 50px;
  padding: 1rem 2rem;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

@media (min-width: 768px) {
  .nav-container {
    justify-content: flex-start;
  }
}

.nav-link {
  color: #cbd5e1;
  transition: all 0.3s ease;
  font-size: 0.875rem;
  font-weight: 500;
  text-decoration: none;
  padding: 0.5rem 1rem;
  border-radius: 25px;
}

.nav-link:hover {
  color: white;
  background: rgba(20, 184, 166, 0.2);
  transform: translateY(-2px);
}

@media (min-width: 640px) {
  .nav-link {
    font-size: 1rem;
  }
}

.cta-button {
  background: linear-gradient(135deg, #14b8a6, #0d9488);
  color: white;
  padding: 0.75rem 1.5rem;
  border-radius: 25px;
  font-size: 0.875rem;
  font-weight: 600;
  transition: all 0.4s ease;
  text-decoration: none;
  position: relative;
  overflow: hidden;
}

.cta-button:hover {
  transform: translateY(-3px) scale(1.05);
}

@media (min-width: 640px) {
  .cta-button {
    font-size: 1rem;
  }
}

/* Buttons */
.hero-buttons {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 1rem;
}

@media (min-width: 640px) {
  .hero-buttons {
    flex-direction: row;
    gap: 1.5rem;
  }
}

@media (min-width: 768px) {
  .hero-buttons {
    justify-content: flex-start;
  }
}

.primary-button {
  background: linear-gradient(135deg, #14b8a6, #0d9488, #14b8a6);
  color: white;
  padding: 1rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  transition: all 0.4s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  width: 100%;
  position: relative;
  overflow: hidden;
  background-size: 200% auto;
}

@media (min-width: 640px) {
  .primary-button {
    width: auto;
  }
}

.primary-button:hover {
  transform: translateY(-4px) scale(1.05);
  background-position: right center;
}

.secondary-button {
  border: 2px solid rgba(20, 184, 166, 0.5);
  color: #cbd5e1;
  padding: 1rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  transition: all 0.4s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  width: 100%;
}

@media (min-width: 640px) {
  .secondary-button {
    width: auto;
  }
}

.secondary-button:hover {
  color: white;
  border-color: #14b8a6;
  background: rgba(20, 184, 166, 0.1);
  transform: translateY(-3px) scale(1.05);
}

.button-icon {
  width: 1.25rem;
  height: 1.25rem;
  margin-left: 0.75rem;
  transition: transform 0.4s ease;
}

.primary-button:hover .button-icon {
  transform: translateX(0.5rem);
}

/* Scroll Indicator */
.scroll-indicator {
  position: absolute;
  bottom: 2rem;
  left: 50%;
  transform: translateX(-50%);
  animation: bounce 2s ease-in-out infinite;
}

.scroll-indicator-inner {
  width: 1.75rem;
  height: 3rem;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 25px;
  display: flex;
  justify-content: center;
  backdrop-filter: blur(10px);
  background: rgba(255, 255, 255, 0.05);
}

.scroll-indicator-dot {
  width: 0.375rem;
  height: 1rem;
  background: linear-gradient(to bottom, #14b8a6, #0d9488);
  border-radius: 25px;
  margin-top: 0.75rem;
  animation: scrollDotPulse 2s ease-in-out infinite;
}

/* Animations */
@keyframes gentleFloat {
  0%, 100% {
    transform: translateY(0px) rotate(0deg);
  }
  25% {
    transform: translateY(-12px) rotate(3deg);
  }
  50% {
    transform: translateY(-18px) rotate(0deg);
  }
  75% {
    transform: translateY(-12px) rotate(-3deg);
  }
}

@keyframes pulse {
  0%, 100% {
    opacity: 0.3;
    transform: scale(1);
  }
  50% {
    opacity: 0.5;
    transform: scale(1.1);
  }
}

@keyframes fadeInUp {
  0% {
    opacity: 0;
    transform: translateY(40px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateX(-50%) translateY(0);
  }
  40% {
    transform: translateX(-50%) translateY(-20px);
  }
  60% {
    transform: translateX(-50%) translateY(-10px);
  }
}

@keyframes scrollDotPulse {
  0% {
    opacity: 1;
    transform: translateY(0);
  }
  50% {
    opacity: 0.3;
    transform: translateY(15px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
  .hero-section *,
  .hero-section *::before,
  .hero-section *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
</style>