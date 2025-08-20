<!-- 2. HeroSection.vue - Keep ALL your existing code -->
<template>
  <section id="hero" class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Three.js Canvas -->
    <canvas ref="heroCanvas" class="absolute inset-0 w-full h-full"></canvas>
    
    <!-- Hero Content -->
    <div class="relative z-10 text-center px-4 w-full max-w-7xl mx-auto">
      <div class="mb-8 animate-fade-in-up">
        <!-- Profile Image -->
        <div class="mb-6 sm:mb-8 pt-8 sm:pt-12 md:pt-16">
          <div class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 lg:w-40 lg:h-40 mx-auto rounded-full bg-gradient-to-r from-blue-500 to-blue-600 p-1 shadow-2xl shadow-blue-500/30">
            <div class="w-full h-full rounded-full overflow-hidden ring-2 ring-blue-400/20">
              <img 
                src="/public/rezuan.jpg" 
                alt="Rezuan Ahmmed" 
                class="w-full h-full object-cover rounded-full hover:scale-105 transition-transform duration-500"
                @error="handleImageError"
              />
            </div>
          </div>
        </div>
        
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-3 md:mb-4 text-white leading-tight">
          <span class="bg-gradient-to-r from-white via-blue-100 to-white bg-clip-text text-transparent animate-text-shimmer">
            Rezuan Ahmmed
          </span>
        </h1>
        
        <p class="text-lg sm:text-xl md:text-2xl text-gray-300 mb-6 md:mb-8 font-light">
          <span class="bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent">
            Full Stack Developer
          </span>
        </p>

        <!-- Navigation Items -->
        <div class="mb-6 md:mb-8">
          <div class="flex flex-wrap justify-center items-center gap-4 sm:gap-6 md:gap-8">
            <a href="#about" class="nav-link">About</a>
            <a href="#skills" class="nav-link">Skills</a>
            <a href="#experience" class="nav-link">Experience</a>
            <a href="#projects" class="nav-link">Projects</a>
            <a href="#contact" class="cta-button">
              Contact
            </a>
          </div>
        </div>

        <p class="text-sm sm:text-base md:text-lg text-gray-400 mb-6 md:mb-8 max-w-xs sm:max-w-md md:max-w-2xl mx-auto leading-relaxed px-4">
          Crafting digital experiences with modern web technologies and server management expertise
        </p>
      </div>
      
      <div class="flex flex-col sm:flex-row justify-center items-center gap-4 sm:gap-6 px-4">
        <a href="#projects" class="primary-button w-full sm:w-auto">
          <span>View Projects</span>
          <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
          </svg>
        </a>
        <a href="#contact" class="secondary-button w-full sm:w-auto">
          <span>Get In Touch</span>
        </a>
      </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-4 sm:bottom-6 md:bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
      <div class="w-5 h-8 sm:w-6 sm:h-10 border-2 border-gray-400/60 rounded-full flex justify-center backdrop-blur-sm">
        <div class="w-1 h-2 sm:h-3 bg-gradient-to-b from-blue-400 to-cyan-400 rounded-full mt-1 sm:mt-2 animate-pulse"></div>
      </div>
    </div>
  </section>
</template>

<script>
import * as THREE from 'three'

export default {
  name: 'HeroSection',
  data() {
    return {
      scene: null,
      camera: null,
      renderer: null,
      animationId: null,
      particles: null,
      geometryShapes: [],
      networkNodes: [],
      networkConnections: [],
      energyField: null,
      mouse: { x: 0, y: 0 },
      targetMouse: { x: 0, y: 0 },
      windowHalf: { x: 0, y: 0 },
      eventListeners: null,
      colors: {
        white: 0xffffff,
        orange: 0xfca311,
        gray: 0xe5e5e5,
        blue: 0x0066cc,
        cyan: 0x00ccff
      }
    }
  },
  mounted() {
    this.initThreeJS()
    this.setupSmoothScrolling()
  },
  beforeUnmount() {
    this.cleanup()
  },
  methods: {
    initThreeJS() {
      // Scene setup
      this.scene = new THREE.Scene()
      this.scene.fog = new THREE.Fog(0x000000, 15, 80)
      
      // Camera setup
      this.camera = new THREE.PerspectiveCamera(
        75, 
        window.innerWidth / window.innerHeight, 
        0.1, 
        1000
      )
      this.camera.position.set(0, 0, 12)
      
      // Renderer setup
      this.renderer = new THREE.WebGLRenderer({ 
        canvas: this.$refs.heroCanvas,
        alpha: true,
        antialias: true,
        powerPreference: "high-performance"
      })
      
      this.renderer.setSize(window.innerWidth, window.innerHeight)
      this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))
      this.renderer.setClearColor(0x000000, 0)
      
      // Initialize mouse tracking
      this.windowHalf.x = window.innerWidth / 2
      this.windowHalf.y = window.innerHeight / 2

      // Create all visual elements
      this.createAdvancedParticles()
      this.createFloatingShapes()
      this.createNeuralNetwork()
      this.createEnergyField()
      this.setupEventListeners()
      this.animate()
    },

    createAdvancedParticles() {
      const particlesCount = 1500
      const positions = new Float32Array(particlesCount * 3)
      const colors = new Float32Array(particlesCount * 3)
      const sizes = new Float32Array(particlesCount)
      const speeds = new Float32Array(particlesCount)
      
      const colorPalette = [
        new THREE.Color(this.colors.white),
        new THREE.Color(this.colors.orange),
        new THREE.Color(this.colors.gray),
        new THREE.Color(this.colors.blue),
        new THREE.Color(this.colors.cyan)
      ]

      for (let i = 0; i < particlesCount; i++) {
        const i3 = i * 3
        
        // Distribute particles in clusters with some randomness
        const radius = Math.random() * 30 + 10
        const theta = Math.random() * Math.PI * 2
        const phi = Math.random() * Math.PI
        
        positions[i3] = radius * Math.sin(phi) * Math.cos(theta) * (0.5 + Math.random() * 0.5)
        positions[i3 + 1] = radius * Math.sin(phi) * Math.sin(theta) * (0.5 + Math.random() * 0.5)
        positions[i3 + 2] = radius * Math.cos(phi) * (0.5 + Math.random() * 0.5)
        
        // Weighted color distribution: 30% orange, 30% white, 20% gray, 20% blue/cyan
        const colorIndex = Math.random() < 0.3 ? 1 : // 30% orange
                           Math.random() < 0.6 ? 0 : // 30% white
                           Math.random() < 0.8 ? 2 : // 20% gray
                           Math.random() < 0.9 ? 3 : 4 // 10% blue, 10% cyan
        
        const color = colorPalette[colorIndex]
        colors[i3] = color.r
        colors[i3 + 1] = color.g
        colors[i3 + 2] = color.b
        
        sizes[i] = Math.random() * 3 + 0.5
        speeds[i] = Math.random() * 0.02 + 0.005
      }

      const particlesGeometry = new THREE.BufferGeometry()
      particlesGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3))
      particlesGeometry.setAttribute('color', new THREE.BufferAttribute(colors, 3))
      particlesGeometry.setAttribute('size', new THREE.BufferAttribute(sizes, 1))
      particlesGeometry.setAttribute('speed', new THREE.BufferAttribute(speeds, 1))

      const particlesMaterial = new THREE.ShaderMaterial({
        uniforms: {
          time: { value: 0 },
          pixelRatio: { value: Math.min(window.devicePixelRatio, 2) },
          mousePosition: { value: new THREE.Vector2(0, 0) }
        },
        vertexShader: `
          uniform float time;
          uniform float pixelRatio;
          uniform vec2 mousePosition;
          attribute float size;
          attribute float speed;
          varying vec3 vColor;
          varying float vAlpha;
          
          void main() {
            vColor = color;
            
            vec4 modelPosition = modelMatrix * vec4(position, 1.0);
            
            // Complex floating motion
            modelPosition.y += sin(modelPosition.x * 0.1 + time * speed) * 1.5;
            modelPosition.x += cos(modelPosition.y * 0.1 + time * speed * 0.7) * 1.0;
            modelPosition.z += sin(modelPosition.x * 0.05 + modelPosition.y * 0.05 + time * speed * 0.5) * 0.8;
            
            // Mouse interaction - attraction/repulsion
            vec2 mouseInfluence = (mousePosition - modelPosition.xy) * 0.1;
            float mouseDist = length(mouseInfluence);
            if (mouseDist < 5.0) {
              modelPosition.xy += mouseInfluence * (1.0 - mouseDist / 5.0) * 2.0;
            }
            
            vec4 viewPosition = viewMatrix * modelPosition;
            vec4 projectedPosition = projectionMatrix * viewPosition;
            
            gl_Position = projectedPosition;
            
            // Pulsating effect
            float pulse = sin(time * 2.0 + position.x * 0.1) * 0.3 + 0.7;
            gl_PointSize = size * pixelRatio * pulse * (400.0 / -viewPosition.z);
            
            // Distance-based alpha for depth
            vAlpha = 1.0 - (length(viewPosition) / 50.0);
          }
        `,
        fragmentShader: `
          varying vec3 vColor;
          varying float vAlpha;
          
          void main() {
            vec2 center = gl_PointCoord - 0.5;
            float dist = length(center);
            
            // Soft circular particles with glow
            float alpha = 1.0 - smoothstep(0.0, 0.5, dist);
            alpha *= vAlpha;
            
            // Add outer glow
            float glow = exp(-dist * 8.0) * 0.5;
            alpha += glow;
            
            gl_FragColor = vec4(vColor, alpha * 0.9);
          }
        `,
        transparent: true,
        vertexColors: true,
        blending: THREE.AdditiveBlending,
        depthWrite: false
      })

      this.particles = new THREE.Points(particlesGeometry, particlesMaterial)
      this.scene.add(this.particles)
    },

    createFloatingShapes() {
      this.geometryShapes = []
      const geometries = [
        new THREE.OctahedronGeometry(1.2),
        new THREE.IcosahedronGeometry(0.8),
        new THREE.TetrahedronGeometry(1.0),
        new THREE.DodecahedronGeometry(0.6),
        new THREE.TorusGeometry(0.8, 0.3, 8, 16),
        new THREE.ConeGeometry(0.6, 1.5, 8)
      ]

      for (let i = 0; i < 12; i++) {
        const geometry = geometries[Math.floor(Math.random() * geometries.length)]
        
        // Create materials with your color scheme
        const colorValue = Math.random() < 0.4 ? this.colors.orange :
                           Math.random() < 0.7 ? this.colors.white :
                           Math.random() < 0.85 ? this.colors.gray :
                           Math.random() < 0.92 ? this.colors.blue : this.colors.cyan
        
        const material = new THREE.MeshBasicMaterial({
          color: colorValue,
          wireframe: true,
          transparent: true,
          opacity: 0.4
        })

        const mesh = new THREE.Mesh(geometry, material)
        
        mesh.position.set(
          (Math.random() - 0.5) * 40,
          (Math.random() - 0.5) * 25,
          (Math.random() - 0.5) * 20
        )
        
        mesh.userData = {
          rotationSpeed: {
            x: (Math.random() - 0.5) * 0.015,
            y: (Math.random() - 0.5) * 0.015,
            z: (Math.random() - 0.5) * 0.01
          },
          floatSpeed: Math.random() * 0.008 + 0.003,
          floatRange: Math.random() * 3 + 1,
          originalY: mesh.position.y,
          originalScale: 1 + Math.random() * 0.5
        }
        
        this.geometryShapes.push(mesh)
        this.scene.add(mesh)
      }
    },

    createNeuralNetwork() {
      this.networkNodes = []
      this.networkConnections = []
      
      // Create glowing nodes
      for (let i = 0; i < 20; i++) {
        const nodeGeometry = new THREE.SphereGeometry(0.15, 8, 8)
        const nodeColor = Math.random() < 0.5 ? this.colors.orange : this.colors.white
        const nodeMaterial = new THREE.MeshBasicMaterial({
          color: nodeColor,
          transparent: true,
          opacity: 0.8
        })
        
        const node = new THREE.Mesh(nodeGeometry, nodeMaterial)
        node.position.set(
          (Math.random() - 0.5) * 25,
          (Math.random() - 0.5) * 18,
          (Math.random() - 0.5) * 12
        )
        
        node.userData = {
          pulseSpeed: Math.random() * 0.02 + 0.01,
          pulseRange: Math.random() * 0.3 + 0.1,
          baseScale: 1
        }
        
        this.networkNodes.push(node)
        this.scene.add(node)
      }
      
      // Create connections between nearby nodes
      for (let i = 0; i < this.networkNodes.length; i++) {
        for (let j = i + 1; j < this.networkNodes.length; j++) {
          const distance = this.networkNodes[i].position.distanceTo(this.networkNodes[j].position)
          if (distance < 10 && Math.random() > 0.6) {
            const points = [
              this.networkNodes[i].position.clone(), 
              this.networkNodes[j].position.clone()
            ]
            const geometry = new THREE.BufferGeometry().setFromPoints(points)
            
            const connectionColor = Math.random() < 0.3 ? this.colors.orange : this.colors.gray
            const material = new THREE.LineBasicMaterial({
              color: connectionColor,
              transparent: true,
              opacity: 0.3
            })
            
            const line = new THREE.Line(geometry, material)
            line.userData = {
              pulseSpeed: Math.random() * 0.02 + 0.005,
              baseOpacity: 0.3
            }
            
            this.networkConnections.push(line)
            this.scene.add(line)
          }
        }
      }
    },

    createEnergyField() {
      const fieldGeometry = new THREE.PlaneGeometry(60, 60, 80, 80)
      const fieldMaterial = new THREE.ShaderMaterial({
        uniforms: {
          time: { value: 0 },
          mousePosition: { value: new THREE.Vector2(0, 0) }
        },
        vertexShader: `
          uniform float time;
          uniform vec2 mousePosition;
          varying vec2 vUv;
          varying float vElevation;
          varying float vDistanceToMouse;
          
          void main() {
            vUv = uv;
            
            vec4 modelPosition = modelMatrix * vec4(position, 1.0);
            
            // Create complex wave patterns
            float elevation = sin(modelPosition.x * 0.2 + time * 0.5) * 0.8 + 
                            sin(modelPosition.y * 0.15 + time * 0.7) * 0.6 +
                            sin(modelPosition.x * 0.1 + modelPosition.y * 0.1 + time) * 0.4;
            
            // Mouse interaction creates ripples
            vec2 mouseInfluence = mousePosition - modelPosition.xy;
            float mouseDist = length(mouseInfluence);
            vDistanceToMouse = mouseDist;
            
            if (mouseDist < 8.0) {
              elevation += (1.0 - mouseDist / 8.0) * 2.0;
            }
            
            modelPosition.z += elevation * 0.5;
            vElevation = elevation;
            
            vec4 viewPosition = viewMatrix * modelPosition;
            vec4 projectedPosition = projectionMatrix * viewPosition;
            
            gl_Position = projectedPosition;
          }
        `,
        fragmentShader: `
          uniform float time;
          varying vec2 vUv;
          varying float vElevation;
          varying float vDistanceToMouse;
          
          void main() {
            float intensity = abs(vElevation) * 0.5;
            
            // Your color scheme
            vec3 orangeColor = vec3(0.988, 0.639, 0.067); // #fca311
            vec3 whiteColor = vec3(1.0, 1.0, 1.0);        // #ffffff
            vec3 grayColor = vec3(0.898, 0.898, 0.898);   // #e5e5e5
            
            vec3 color = mix(grayColor, orangeColor, intensity);
            
            // Mouse creates white energy ripples
            if (vDistanceToMouse < 8.0) {
              float mouseInfluence = 1.0 - (vDistanceToMouse / 8.0);
              color = mix(color, whiteColor, mouseInfluence * 0.6);
            }
            
            float alpha = intensity * 0.15 + 0.05;
            gl_FragColor = vec4(color, alpha);
          }
        `,
        transparent: true,
        wireframe: true,
        side: THREE.DoubleSide
      })

      this.energyField = new THREE.Mesh(fieldGeometry, fieldMaterial)
      this.energyField.rotation.x = -Math.PI / 2
      this.energyField.position.y = -15
      this.scene.add(this.energyField)
    },

    setupEventListeners() {
      // Enhanced mouse movement tracking
      const handleMouseMove = (event) => {
        this.mouse.x = (event.clientX / window.innerWidth) * 2 - 1
        this.mouse.y = -(event.clientY / window.innerHeight) * 2 + 1
        this.mouse.x *= window.innerWidth * 0.5
        this.mouse.y *= window.innerHeight * 0.5
      }
      
      // Enhanced window resize
      const handleResize = () => {
        this.windowHalf.x = window.innerWidth / 2
        this.windowHalf.y = window.innerHeight / 2
        
        this.camera.aspect = window.innerWidth / window.innerHeight
        this.camera.updateProjectionMatrix()
        
        this.renderer.setSize(window.innerWidth, window.innerHeight)
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))
      }
      
      window.addEventListener('mousemove', handleMouseMove)
      window.addEventListener('resize', handleResize)
      
      // Store for cleanup
      this.eventListeners = { handleMouseMove, handleResize }
    },

    animate() {
      this.animationId = requestAnimationFrame(() => this.animate())
      
      const time = Date.now() * 0.001
      
      // Smooth mouse interpolation for subtle interactions
      this.targetMouse.x += (this.mouse.x - this.targetMouse.x) * 0.05
      this.targetMouse.y += (this.mouse.y - this.targetMouse.y) * 0.05
      
      // Update particles system
      if (this.particles) {
        this.particles.material.uniforms.time.value = time
        this.particles.material.uniforms.mousePosition.value.set(
          this.targetMouse.x * 0.01, 
          this.targetMouse.y * 0.01
        )
        this.particles.rotation.y += 0.0003
      }
      
      // Update floating geometric shapes
      this.geometryShapes.forEach((shape, index) => {
        // Rotation animations
        shape.rotation.x += shape.userData.rotationSpeed.x
        shape.rotation.y += shape.userData.rotationSpeed.y
        shape.rotation.z += shape.userData.rotationSpeed.z
        
        // Floating motion
        shape.position.y = shape.userData.originalY + 
          Math.sin(time * shape.userData.floatSpeed + index) * shape.userData.floatRange
        
        // Scale pulsation
        const scale = shape.userData.originalScale + Math.sin(time * 2 + index) * 0.1
        shape.scale.setScalar(scale)
        
        // Mouse repulsion effect
        const mouseDistance = Math.sqrt(
          Math.pow(this.targetMouse.x * 0.02 - shape.position.x, 2) + 
          Math.pow(this.targetMouse.y * 0.02 - shape.position.y, 2)
        )
        if (mouseDistance < 5) {
          const force = (5 - mouseDistance) * 0.02
          shape.position.x += (shape.position.x - this.targetMouse.x * 0.02) * force
          shape.position.y += (shape.position.y - this.targetMouse.y * 0.02) * force
        }
      })
      
      // Update neural network nodes
      this.networkNodes.forEach((node, index) => {
        const pulse = Math.sin(time * node.userData.pulseSpeed + index) * node.userData.pulseRange + node.userData.baseScale
        node.scale.setScalar(pulse)
        
        // Opacity pulsation
        node.material.opacity = 0.8 + Math.sin(time * 2 + index) * 0.2
      })
      
      // Update neural network connections
      this.networkConnections.forEach((connection, index) => {
        const pulse = Math.sin(time * connection.userData.pulseSpeed + index) * 0.2 + connection.userData.baseOpacity
        connection.material.opacity = pulse
      })
      
      // Update energy field
      if (this.energyField) {
        this.energyField.material.uniforms.time.value = time
        this.energyField.material.uniforms.mousePosition.value.set(
          this.targetMouse.x * 0.02, 
          this.targetMouse.y * 0.02
        )
      }
      
      // Subtle camera parallax effect
      this.camera.position.x += (this.targetMouse.x * 0.0008 - this.camera.position.x) * 0.05
      this.camera.position.y += (-this.targetMouse.y * 0.0005 - this.camera.position.y) * 0.05
      this.camera.lookAt(0, 0, 0)
      
      this.renderer.render(this.scene, this.camera)
    },

    setupSmoothScrolling() {
      // Smooth scrolling for navigation links
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

    cleanup() {
      if (this.animationId) {
        cancelAnimationFrame(this.animationId)
      }
      
      if (this.eventListeners) {
        window.removeEventListener('mousemove', this.eventListeners.handleMouseMove)
        window.removeEventListener('resize', this.eventListeners.handleResize)
      }
      
      // Dispose of Three.js resources properly
      if (this.scene) {
        this.scene.traverse((object) => {
          if (object.geometry) object.geometry.dispose()
          if (object.material) {
            if (Array.isArray(object.material)) {
              object.material.forEach(material => material.dispose())
            } else {
              object.material.dispose()
            }
          }
        })
      }
      
      if (this.renderer) {
        this.renderer.dispose()
      }
    }
  }
}
</script>