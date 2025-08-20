<!-- Updated ProjectsSection.vue with real project data -->
<template>
  <section id="projects" class="py-20 px-4 bg-black">
    <div class="max-w-6xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-16 bg-gradient-to-r from-teal-400 to-teal-600 bg-clip-text text-transparent">
        Featured Projects
      </h2>
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Project 1: REVENCOMM Business Portfolio -->
        <div class="bg-gradient-to-br from-gray-900 to-black rounded-2xl border border-gray-800 overflow-hidden hover:border-teal-500/50 transition-all duration-300 transform hover:scale-105">
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-semibold text-white">REVENCOMM Business Portfolio</h3>
              <span class="text-xs text-teal-400 bg-teal-500/20 px-2 py-1 rounded">Business</span>
            </div>
            <p class="text-gray-400 mb-4">Professional business portfolio website showcasing company services and information with responsive design and modern UI.</p>
            
            <!-- Features -->
            <div class="mb-4">
              <h4 class="text-sm font-semibold text-teal-300 mb-2">Key Features:</h4>
              <ul class="text-xs text-gray-400 space-y-1">
                <li>• Responsive business portfolio design</li>
                <li>• Company showcase and services</li>
                <li>• Contact and inquiry forms</li>
                <li>• SEO optimized content</li>
              </ul>
            </div>
            
            <!-- Technologies -->
            <div class="flex flex-wrap gap-2 mb-4">
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Laravel</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">CSS</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">JavaScript</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Bootstrap</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">MySQL</span>
            </div>
            
            <!-- Links -->
            <div class="flex space-x-3">
              <span class="text-gray-500 text-sm">Live Demo: In Production</span>
            </div>
          </div>
        </div>

        <!-- Project 2: Leaars E-commerce Website -->
        <div class="bg-gradient-to-br from-gray-900 to-black rounded-2xl border border-gray-800 overflow-hidden hover:border-teal-500/50 transition-all duration-300 transform hover:scale-105">
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-semibold text-white">Leaars E-commerce Platform</h3>
              <span class="text-xs text-teal-400 bg-teal-500/20 px-2 py-1 rounded">E-commerce</span>
            </div>
            <p class="text-gray-400 mb-4">Full-featured e-commerce platform with comprehensive shopping cart, product management, and order processing capabilities.</p>
            
            <!-- Features -->
            <div class="mb-4">
              <h4 class="text-sm font-semibold text-teal-300 mb-2">Key Features:</h4>
              <ul class="text-xs text-gray-400 space-y-1">
                <li>• Add to cart & checkout system</li>
                <li>• Product management & catalog</li>
                <li>• Order management system</li>
                <li>• Inventory tracking</li>
                <li>• User authentication & profiles</li>
              </ul>
            </div>
            
            <!-- Technologies -->
            <div class="flex flex-wrap gap-2 mb-4">
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Laravel</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">CSS</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Bootstrap</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">JavaScript</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">MySQL</span>
            </div>
            
            <!-- Links -->
            <div class="flex space-x-4">
              <a href="https://leaars.com/" target="_blank" rel="noopener noreferrer" class="text-teal-400 hover:text-teal-300 transition-colors text-sm flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                Live Demo
              </a>
              <a href="https://github.com/Rezuan98/leaars-updated-again" target="_blank" rel="noopener noreferrer" class="text-teal-400 hover:text-teal-300 transition-colors text-sm flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                </svg>
                GitHub
              </a>
            </div>
          </div>
        </div>

        <!-- Project 3: Personal Portfolio Website -->
        <div class="bg-gradient-to-br from-gray-900 to-black rounded-2xl border border-gray-800 overflow-hidden hover:border-teal-500/50 transition-all duration-300 transform hover:scale-105">
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-semibold text-white">Personal Portfolio Website</h3>
              <span class="text-xs text-teal-400 bg-teal-500/20 px-2 py-1 rounded">Portfolio</span>
            </div>
            <p class="text-gray-400 mb-4">Modern personal portfolio website built with Laravel and Vue.js, featuring interactive UI and responsive design.</p>
            
            <!-- Features -->
            <div class="mb-4">
              <h4 class="text-sm font-semibold text-teal-300 mb-2">Key Features:</h4>
              <ul class="text-xs text-gray-400 space-y-1">
                <li>• Interactive Vue.js components</li>
                <li>• Responsive design with TailwindCSS</li>
                <li>• Project showcase gallery</li>
                <li>• Contact form integration</li>
                <li>• Modern animations & transitions</li>
              </ul>
            </div>
            
            <!-- Technologies -->
            <div class="flex flex-wrap gap-2 mb-4">
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Laravel</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Vue.js</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">TailwindCSS</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">PostgreSQL</span>
            </div>
            
            <!-- Links -->
            <div class="flex space-x-4">
              <a href="https://sharifmezba.me/" target="_blank" rel="noopener noreferrer" class="text-teal-400 hover:text-teal-300 transition-colors text-sm flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                Live Demo
              </a>
              <a href="https://github.com/Rezuan98/portfolio-mezba" target="_blank" rel="noopener noreferrer" class="text-teal-400 hover:text-teal-300 transition-colors text-sm flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                </svg>
                GitHub
              </a>
            </div>
          </div>
        </div>

        <!-- Project 4: Juice Shop POS Software -->
        <div class="bg-gradient-to-br from-gray-900 to-black rounded-2xl border border-gray-800 overflow-hidden hover:border-teal-500/50 transition-all duration-300 transform hover:scale-105">
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-semibold text-white">Juice Shop POS Software</h3>
              <span class="text-xs text-teal-400 bg-teal-500/20 px-2 py-1 rounded">POS System</span>
            </div>
            <p class="text-gray-400 mb-4">Comprehensive Point of Sale software designed specifically for juice shops with inventory management and reporting features.</p>
            
            <!-- Features -->
            <div class="mb-4">
              <h4 class="text-sm font-semibold text-teal-300 mb-2">Key Features:</h4>
              <ul class="text-xs text-gray-400 space-y-1">
                <li>• Inventory for juice ingredients</li>
                <li>• Daily, weekly, monthly reports</li>
                <li>• Dynamic dashboard with analytics</li>
                <li>• Receipt printing with POS printer</li>
                <li>• Sales tracking & management</li>
              </ul>
            </div>
            
            <!-- Technologies -->
            <div class="flex flex-wrap gap-2 mb-4">
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Laravel</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">CSS</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Bootstrap</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">MySQL</span>
            </div>
            
            <!-- Links -->
            <div class="flex space-x-4">
              <span class="text-gray-500 text-sm">Live Demo: In Production</span>
              <a href="https://github.com/Rezuan98/folafol_pos_recovery" target="_blank" rel="noopener noreferrer" class="text-teal-400 hover:text-teal-300 transition-colors text-sm flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.30.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                </svg>
                GitHub
              </a>
            </div>
          </div>
        </div>

        <!-- Project 5: Neurology Consultation System -->
        <div class="bg-gradient-to-br from-gray-900 to-black rounded-2xl border border-gray-800 overflow-hidden hover:border-teal-500/50 transition-all duration-300 transform hover:scale-105">
          <div class="p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-semibold text-white">Neurology Consultation System</h3>
              <span class="text-xs text-teal-400 bg-teal-500/20 px-2 py-1 rounded">AI Integration</span>
            </div>
            <p class="text-gray-400 mb-4">AI-powered consultation system with Gemini API integration for neurology-related questions and responses.</p>
            
            <!-- Features -->
            <div class="mb-4">
              <h4 class="text-sm font-semibold text-teal-300 mb-2">Key Features:</h4>
              <ul class="text-xs text-gray-400 space-y-1">
                <li>• Neurology-specific question filtering</li>
                <li>• Gemini API integration</li>
                <li>• Custom prompt implementation</li>
                <li>• Relevant question validation</li>
                <li>• Smart response generation</li>
              </ul>
            </div>
            
            <!-- Technologies -->
            <div class="flex flex-wrap gap-2 mb-4">
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Laravel</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">API Integration</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Gemini AI</span>
              <span class="px-2 py-1 bg-teal-500/20 text-teal-300 rounded text-xs">Custom Prompts</span>
            </div>
            
            <!-- Links -->
            <div class="flex space-x-4">
              <span class="text-gray-500 text-sm">Live Demo: Not Available</span>
            </div>
          </div>
        </div>

      </div>

      <div class="text-center mt-12">
        <a href="https://github.com/Rezuan98" target="_blank" rel="noopener noreferrer" class="bg-gradient-to-r from-teal-500 to-teal-600 px-8 py-3 rounded-full font-semibold hover:shadow-lg hover:shadow-teal-500/25 transition-all duration-300 transform hover:scale-105 inline-flex items-center">
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
          </svg>
          View All Projects on GitHub
        </a>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'ProjectsSection'
}
</script>