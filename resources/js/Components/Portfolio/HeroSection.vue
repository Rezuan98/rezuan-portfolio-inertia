<template>
  <section id="hero" class="hero-section">
    <!-- Three.js Canvas -->
    <canvas ref="heroCanvas" class="hero-canvas"></canvas>
    
    <!-- Hero Content -->
    <div class="hero-content">
      <div class="hero-inner">
        <!-- Profile Image -->
        <div class="profile-container">
          <div class="profile-wrapper">
            <div class="profile-inner">
              <img 
  :src="getProfileImage()" 
  :alt="getProfileName()" 
  class="w-full h-full object-cover rounded-full hover:scale-105 transition-transform duration-500"
  @error="handleImageError"
/>
            </div>
          </div>
        </div>
        
        <h1 class="hero-title">
          <span class="bg-gradient-to-r from-white via-blue-100 to-white bg-clip-text text-transparent animate-text-shimmer">
  {{ getProfileName() }}
</span>
        </h1>
        
        <p class="hero-subtitle">
          <span class="hero-role">
            Full Stack Developer
          </span>
        </p>

        <!-- Navigation Items -->
        <div class="hero-nav">
          <div class="nav-container">
            <a href="#about" class="nav-link">About</a>
            <a href="#skills" class="nav-link">Skills</a>
            <a href="#experience" class="nav-link">Experience</a>
            <a href="#projects" class="nav-link">Projects</a>
            <a href="#contact" class="cta-button">
              Contact
            </a>
          </div>
        </div>

       
      </div>
      
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
    
    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
      <div class="scroll-indicator-inner">
        <div class="scroll-indicator-dot"></div>
      </div>
    </div>
  </section>
</template>

<script>
import * as THREE from 'three'
import { markRaw } from 'vue'

export default {
  name: 'HeroSection',
  props: {
  profile: {
    type: Object,
    default: null
  }
},
  data() {
    return {
      // Mark all Three.js objects as non-reactive to prevent Vue proxy issues
      scene: null,
      camera: null,
      renderer: null,
      animationId: null,
      
      // Enhanced animation objects - these will be marked as non-reactive
      particles: null,
      geometryShapes: [],
      neuralNetwork: null,
      energyField: null,
      dataStreams: [],
      glowingSpheres: [],
      
      // Mouse and interaction - keep these reactive for UI updates
      mouse: { x: 0, y: 0 },
      targetMouse: { x: 0, y: 0 },
      mouseVelocity: { x: 0, y: 0 },
      
      // Performance and state
      isInitialized: false,
      frameCount: 0,
      lastTime: 0,
      eventListeners: null,
      
      // Enhanced color palette
      colors: {
        primary: 0x3b82f6,    // Blue
        secondary: 0x06b6d4,  // Cyan
        accent: 0x8b5cf6,     // Purple
        highlight: 0x10b981,  // Emerald
        white: 0xffffff,
        dark: 0x0f172a
      }
    }
  },
  
  mounted() {
    this.$nextTick(() => {
      this.initThreeJS()
      this.setupSmoothScrolling()
    })
  },
  
  beforeUnmount() {
    this.cleanup()
  },
  
  methods: {
    initThreeJS() {
      try {
        if (!this.$refs.heroCanvas) {
          console.error('Canvas ref not found')
          return
        }

        // Enhanced scene setup - mark as non-reactive
        this.scene = markRaw(new THREE.Scene())
        this.scene.fog = new THREE.FogExp2(0x0f172a, 0.002)
        
        // Enhanced camera setup - mark as non-reactive
        this.camera = markRaw(new THREE.PerspectiveCamera(
          60, 
          window.innerWidth / window.innerHeight, 
          0.1, 
          2000
        ))
        this.camera.position.set(0, 0, 50)
        
        // Enhanced renderer setup - mark as non-reactive
        this.renderer = markRaw(new THREE.WebGLRenderer({ 
          canvas: this.$refs.heroCanvas,
          alpha: true,
          antialias: true,
          powerPreference: "high-performance"
        }))
        
        this.renderer.setSize(window.innerWidth, window.innerHeight)
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))
        this.renderer.setClearColor(0x0f172a, 0.1)

        // Create enhanced visual elements
        this.createEnhancedParticleSystem()
        this.createFloatingGeometry()
        this.createNeuralNetworkSystem()
        this.createDataStreams()
        this.createGlowingSpheres()
        this.createEnergyField()
        this.setupEnhancedEventListeners()
        
        this.isInitialized = true
        this.animate()
        
        console.log('Enhanced Three.js initialized successfully')
      } catch (error) {
        console.error('Error initializing Three.js:', error)
      }
    },

    createEnhancedParticleSystem() {
      const particleCount = 1500
      const positions = new Float32Array(particleCount * 3)
      const colors = new Float32Array(particleCount * 3)
      const sizes = new Float32Array(particleCount)
      const speeds = new Float32Array(particleCount)
      const phases = new Float32Array(particleCount)
      
      const colorPalette = [
        new THREE.Color(this.colors.primary),
        new THREE.Color(this.colors.secondary),
        new THREE.Color(this.colors.accent),
        new THREE.Color(this.colors.highlight),
        new THREE.Color(this.colors.white)
      ]

      for (let i = 0; i < particleCount; i++) {
        const i3 = i * 3
        
        // Create clustered distribution with some scattered elements
        const cluster = Math.random() < 0.7
        let radius, spread
        
        if (cluster) {
          radius = Math.random() * 40 + 20
          spread = 0.3 + Math.random() * 0.4
        } else {
          radius = Math.random() * 120 + 60
          spread = 0.1 + Math.random() * 0.2
        }
        
        const theta = Math.random() * Math.PI * 2
        const phi = Math.random() * Math.PI
        
        positions[i3] = radius * Math.sin(phi) * Math.cos(theta) * spread
        positions[i3 + 1] = radius * Math.sin(phi) * Math.sin(theta) * spread
        positions[i3 + 2] = radius * Math.cos(phi) * spread
        
        // Enhanced color distribution
        const colorIndex = Math.random() < 0.3 ? 0 : 
                           Math.random() < 0.5 ? 1 : 
                           Math.random() < 0.7 ? 2 : 
                           Math.random() < 0.85 ? 3 : 4
        
        const color = colorPalette[colorIndex]
        colors[i3] = color.r
        colors[i3 + 1] = color.g
        colors[i3 + 2] = color.b
        
        sizes[i] = Math.random() * 4 + 1
        speeds[i] = Math.random() * 0.03 + 0.01
        phases[i] = Math.random() * Math.PI * 2
      }

      const particlesGeometry = markRaw(new THREE.BufferGeometry())
      particlesGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3))
      particlesGeometry.setAttribute('color', new THREE.BufferAttribute(colors, 3))
      particlesGeometry.setAttribute('size', new THREE.BufferAttribute(sizes, 1))
      particlesGeometry.setAttribute('speed', new THREE.BufferAttribute(speeds, 1))
      particlesGeometry.setAttribute('phase', new THREE.BufferAttribute(phases, 1))

      const particlesMaterial = markRaw(new THREE.ShaderMaterial({
        uniforms: {
          time: { value: 0 },
          pixelRatio: { value: Math.min(window.devicePixelRatio, 2) },
          mousePosition: { value: new THREE.Vector2(0, 0) },
          mouseVelocity: { value: new THREE.Vector2(0, 0) }
        },
        vertexShader: `
          uniform float time;
          uniform float pixelRatio;
          uniform vec2 mousePosition;
          uniform vec2 mouseVelocity;
          
          attribute float size;
          attribute float speed;
          attribute float phase;
          
          varying vec3 vColor;
          varying float vAlpha;
          varying float vGlow;
          
          void main() {
            vColor = color;
            
            vec4 modelPosition = modelMatrix * vec4(position, 1.0);
            
            // Enhanced floating motion with multiple wave patterns
            float wave1 = sin(modelPosition.x * 0.02 + time * speed + phase) * 3.0;
            float wave2 = cos(modelPosition.y * 0.015 + time * speed * 0.8 + phase * 1.3) * 2.0;
            float wave3 = sin(modelPosition.z * 0.01 + time * speed * 0.6 + phase * 0.7) * 1.5;
            
            modelPosition.x += wave1 + wave3 * 0.5;
            modelPosition.y += wave2 + wave1 * 0.3;
            modelPosition.z += wave3 + wave2 * 0.4;
            
            // Enhanced mouse interaction with velocity influence
            vec2 mouseInfluence = (mousePosition - modelPosition.xy) * 0.008;
            float mouseDist = length(mouseInfluence);
            float velocityMagnitude = length(mouseVelocity);
            
            if (mouseDist < 10.0) {
              float influence = (1.0 - mouseDist / 10.0);
              modelPosition.xy += mouseInfluence * influence * 3.0;
              modelPosition.z += sin(time * 2.0 + phase) * influence * 2.0;
              vGlow = influence * (1.0 + velocityMagnitude * 0.5);
            } else {
              vGlow = 0.3 + sin(time * 2.0 + phase) * 0.2;
            }
            
            vec4 viewPosition = viewMatrix * modelPosition;
            vec4 projectedPosition = projectionMatrix * viewPosition;
            
            gl_Position = projectedPosition;
            
            // Dynamic sizing with pulsation
            float pulse = sin(time * 3.0 + phase + length(modelPosition.xy) * 0.1) * 0.4 + 0.8;
            float depthFactor = 1.0 - (length(viewPosition) / 100.0);
            gl_PointSize = size * pixelRatio * pulse * depthFactor * (300.0 / -viewPosition.z);
            
            // Enhanced alpha calculation
            vAlpha = depthFactor * (0.6 + pulse * 0.4);
          }
        `,
        fragmentShader: `
          varying vec3 vColor;
          varying float vAlpha;
          varying float vGlow;
          
          void main() {
            vec2 center = gl_PointCoord - 0.5;
            float dist = length(center);
            
            // Create soft circular particles with enhanced glow
            float alpha = 1.0 - smoothstep(0.0, 0.5, dist);
            alpha *= vAlpha;
            
            // Multi-layer glow effect
            float innerGlow = exp(-dist * 12.0) * vGlow;
            float outerGlow = exp(-dist * 4.0) * vGlow * 0.3;
            alpha += innerGlow + outerGlow;
            
            // Color enhancement based on glow
            vec3 finalColor = vColor + vec3(vGlow * 0.2);
            
            gl_FragColor = vec4(finalColor, alpha * 0.85);
          }
        `,
        transparent: true,
        vertexColors: true,
        blending: THREE.AdditiveBlending,
        depthWrite: false
      }))

      this.particles = markRaw(new THREE.Points(particlesGeometry, particlesMaterial))
      this.scene.add(this.particles)
    },

    createFloatingGeometry() {
      this.geometryShapes = []
      
      const geometries = [
        new THREE.OctahedronGeometry(2),
        new THREE.IcosahedronGeometry(1.5),
        new THREE.TetrahedronGeometry(1.8),
        new THREE.DodecahedronGeometry(1.2),
        new THREE.TorusGeometry(1.5, 0.6, 8, 24),
        new THREE.ConeGeometry(1, 3, 8)
      ]

      for (let i = 0; i < 12; i++) {
        const geometry = markRaw(geometries[Math.floor(Math.random() * geometries.length)])
        
        const colorValues = [
          this.colors.primary,
          this.colors.secondary,
          this.colors.accent,
          this.colors.highlight
        ]
        const colorValue = colorValues[Math.floor(Math.random() * colorValues.length)]
        
        const material = markRaw(new THREE.MeshBasicMaterial({
          color: colorValue,
          wireframe: true,
          transparent: true,
          opacity: 0.4
        }))

        const mesh = markRaw(new THREE.Mesh(geometry, material))
        
        mesh.position.set(
          (Math.random() - 0.5) * 80,
          (Math.random() - 0.5) * 50,
          (Math.random() - 0.5) * 40
        )
        
        mesh.userData = {
          rotationSpeed: {
            x: (Math.random() - 0.5) * 0.02,
            y: (Math.random() - 0.5) * 0.02,
            z: (Math.random() - 0.5) * 0.015
          },
          floatSpeed: Math.random() * 0.01 + 0.005,
          floatRange: Math.random() * 5 + 2,
          originalPosition: mesh.position.clone(),
          phase: Math.random() * Math.PI * 2,
          scale: 0.5 + Math.random() * 0.5
        }
        
        this.geometryShapes.push(mesh)
        this.scene.add(mesh)
      }
    },

    createNeuralNetworkSystem() {
      const nodeCount = 20
      const nodes = []
      
      // Create enhanced glowing nodes
      for (let i = 0; i < nodeCount; i++) {
        const nodeGeometry = markRaw(new THREE.SphereGeometry(0.3, 16, 16))
        const nodeColor = Math.random() < 0.5 ? this.colors.primary : this.colors.secondary
        const nodeMaterial = markRaw(new THREE.MeshBasicMaterial({
          color: nodeColor,
          transparent: true,
          opacity: 0.8
        }))
        
        const node = markRaw(new THREE.Mesh(nodeGeometry, nodeMaterial))
        node.position.set(
          (Math.random() - 0.5) * 60,
          (Math.random() - 0.5) * 40,
          (Math.random() - 0.5) * 30
        )
        
        node.userData = {
          pulseSpeed: Math.random() * 0.03 + 0.02,
          phase: Math.random() * Math.PI * 2,
          baseScale: 1
        }
        
        nodes.push(node)
        this.scene.add(node)
      }
      
      // Create enhanced connections
      const connections = []
      for (let i = 0; i < nodes.length; i++) {
        for (let j = i + 1; j < nodes.length; j++) {
          const distance = nodes[i].position.distanceTo(nodes[j].position)
          if (distance < 20 && Math.random() > 0.7) {
            const points = [nodes[i].position.clone(), nodes[j].position.clone()]
            const geometry = markRaw(new THREE.BufferGeometry().setFromPoints(points))
            
            const material = markRaw(new THREE.LineBasicMaterial({
              color: this.colors.accent,
              transparent: true,
              opacity: 0.4
            }))
            
            const line = markRaw(new THREE.Line(geometry, material))
            line.userData = {
              pulseSpeed: Math.random() * 0.02 + 0.005,
              baseOpacity: 0.4
            }
            
            connections.push(line)
            this.scene.add(line)
          }
        }
      }
      
      this.neuralNetwork = { nodes, connections }
    },

    createDataStreams() {
      this.dataStreams = []
      
      for (let i = 0; i < 6; i++) {
        const streamGeometry = markRaw(new THREE.BufferGeometry())
        const streamPoints = []
        const streamCount = 50
        
        for (let j = 0; j < streamCount; j++) {
          const t = j / (streamCount - 1)
          const radius = 20 + Math.sin(t * Math.PI * 4) * 5
          const angle = t * Math.PI * 8 + i * Math.PI * 0.25
          
          streamPoints.push(new THREE.Vector3(
            Math.cos(angle) * radius,
            (t - 0.5) * 60,
            Math.sin(angle) * radius
          ))
        }
        
        streamGeometry.setFromPoints(streamPoints)
        
        const streamMaterial = markRaw(new THREE.LineBasicMaterial({
          color: this.colors.highlight,
          transparent: true,
          opacity: 0.6
        }))
        
        const stream = markRaw(new THREE.Line(streamGeometry, streamMaterial))
        stream.userData = { speed: Math.random() * 0.02 + 0.01 }
        
        this.dataStreams.push(stream)
        this.scene.add(stream)
      }
    },

    createGlowingSpheres() {
      this.glowingSpheres = []
      
      for (let i = 0; i < 4; i++) {
        const sphereGeometry = markRaw(new THREE.SphereGeometry(3, 32, 32))
        
        const sphereMaterial = markRaw(new THREE.MeshBasicMaterial({
          color: this.colors.accent,
          transparent: true,
          opacity: 0.2,
          wireframe: true
        }))
        
        const sphere = markRaw(new THREE.Mesh(sphereGeometry, sphereMaterial))
        sphere.position.set(
          (Math.random() - 0.5) * 100,
          (Math.random() - 0.5) * 60,
          (Math.random() - 0.5) * 50
        )
        
        sphere.userData = {
          speed: Math.random() * 0.01 + 0.005,
          phase: Math.random() * Math.PI * 2
        }
        
        this.glowingSpheres.push(sphere)
        this.scene.add(sphere)
      }
    },

    createEnergyField() {
      const fieldGeometry = markRaw(new THREE.PlaneGeometry(200, 200, 100, 100))
      const fieldMaterial = markRaw(new THREE.ShaderMaterial({
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
            
            // Complex wave patterns
            float elevation = 
              sin(modelPosition.x * 0.1 + time * 0.8) * 2.0 + 
              sin(modelPosition.y * 0.08 + time * 1.2) * 1.5 +
              sin(modelPosition.x * 0.05 + modelPosition.y * 0.05 + time * 0.6) * 1.0 +
              cos(length(modelPosition.xy) * 0.02 + time) * 0.8;
            
            // Enhanced mouse interaction
            vec2 mouseInfluence = mousePosition - modelPosition.xy;
            float mouseDist = length(mouseInfluence);
            vDistanceToMouse = mouseDist;
            
            if (mouseDist < 15.0) {
              float influence = 1.0 - (mouseDist / 15.0);
              elevation += influence * 4.0 * sin(time * 3.0);
            }
            
            modelPosition.z += elevation;
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
            float intensity = abs(vElevation) * 0.3;
            
            // Enhanced color palette
            vec3 primaryColor = vec3(0.231, 0.510, 0.965);  // Blue
            vec3 secondaryColor = vec3(0.024, 0.714, 0.831); // Cyan
            vec3 accentColor = vec3(0.545, 0.361, 0.965);    // Purple
            
            vec3 color = mix(primaryColor, secondaryColor, intensity);
            color = mix(color, accentColor, sin(time + vElevation) * 0.5 + 0.5);
            
            // Enhanced mouse interaction glow
            if (vDistanceToMouse < 15.0) {
              float mouseInfluence = 1.0 - (vDistanceToMouse / 15.0);
              color += vec3(mouseInfluence * 0.5);
            }
            
            float alpha = intensity * 0.4 + 0.1;
            gl_FragColor = vec4(color, alpha);
          }
        `,
        transparent: true,
        wireframe: true,
        side: THREE.DoubleSide
      }))

      this.energyField = markRaw(new THREE.Mesh(fieldGeometry, fieldMaterial))
      this.energyField.rotation.x = -Math.PI / 2
      this.energyField.position.y = -30
      this.scene.add(this.energyField)
    },

    setupEnhancedEventListeners() {
      let lastMouseX = 0
      let lastMouseY = 0
      
      const handleMouseMove = (event) => {
        const newMouseX = (event.clientX / window.innerWidth) * 2 - 1
        const newMouseY = -(event.clientY / window.innerHeight) * 2 + 1
        
        // Calculate velocity
        this.mouseVelocity.x = (newMouseX - lastMouseX) * 10
        this.mouseVelocity.y = (newMouseY - lastMouseY) * 10
        
        this.mouse.x = newMouseX * window.innerWidth * 0.01
        this.mouse.y = newMouseY * window.innerHeight * 0.01
        
        lastMouseX = newMouseX
        lastMouseY = newMouseY
      }
      
      const handleResize = () => {
        if (!this.isInitialized) return
        
        this.camera.aspect = window.innerWidth / window.innerHeight
        this.camera.updateProjectionMatrix()
        
        this.renderer.setSize(window.innerWidth, window.innerHeight)
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))
      }
      
      window.addEventListener('mousemove', handleMouseMove, { passive: true })
      window.addEventListener('resize', handleResize, { passive: true })
      
      this.eventListeners = { handleMouseMove, handleResize }
    },

    animate() {
      if (!this.isInitialized) return
      
      this.animationId = requestAnimationFrame(() => this.animate())
      
      const currentTime = Date.now() * 0.001
      const deltaTime = currentTime - this.lastTime
      this.lastTime = currentTime
      this.frameCount++
      
      // Smooth mouse interpolation with enhanced easing
      this.targetMouse.x += (this.mouse.x - this.targetMouse.x) * 0.08
      this.targetMouse.y += (this.mouse.y - this.targetMouse.y) * 0.08
      
      // Decay mouse velocity
      this.mouseVelocity.x *= 0.95
      this.mouseVelocity.y *= 0.95
      
      // Update enhanced particle system
      if (this.particles && this.particles.material.uniforms) {
        this.particles.material.uniforms.time.value = currentTime
        this.particles.material.uniforms.mousePosition.value.set(
          this.targetMouse.x, 
          this.targetMouse.y
        )
        this.particles.material.uniforms.mouseVelocity.value.set(
          this.mouseVelocity.x,
          this.mouseVelocity.y
        )
        
        // Subtle particle system rotation
        this.particles.rotation.y += 0.0002
        this.particles.rotation.x = Math.sin(currentTime * 0.1) * 0.02
      }
      
      // Update floating geometry with enhanced motion
      this.geometryShapes.forEach((shape, index) => {
        const userData = shape.userData
        
        // Enhanced rotation with time-based variation
        shape.rotation.x += userData.rotationSpeed.x * (1 + Math.sin(currentTime * 0.5) * 0.2)
        shape.rotation.y += userData.rotationSpeed.y * (1 + Math.cos(currentTime * 0.3) * 0.2)
        shape.rotation.z += userData.rotationSpeed.z * (1 + Math.sin(currentTime * 0.7) * 0.2)
        
        // Enhanced floating motion with multiple wave patterns
        const floatY = Math.sin(currentTime * userData.floatSpeed + userData.phase) * userData.floatRange
        const floatX = Math.cos(currentTime * userData.floatSpeed * 0.7 + userData.phase) * userData.floatRange * 0.3
        const floatZ = Math.sin(currentTime * userData.floatSpeed * 0.5 + userData.phase) * userData.floatRange * 0.2
        
        shape.position.x = userData.originalPosition.x + floatX
        shape.position.y = userData.originalPosition.y + floatY
        shape.position.z = userData.originalPosition.z + floatZ
        
        // Dynamic scaling with pulsation
        const scale = userData.scale * (1 + Math.sin(currentTime * 2 + userData.phase + index) * 0.15)
        shape.scale.setScalar(scale)
        
        // Enhanced mouse interaction with repulsion/attraction
        const mouseDistance = Math.sqrt(
          Math.pow(this.targetMouse.x * 0.5 - shape.position.x, 2) + 
          Math.pow(this.targetMouse.y * 0.5 - shape.position.y, 2)
        )
        
        if (mouseDistance < 15) {
          const force = (15 - mouseDistance) * 0.003
          const direction = Math.random() > 0.5 ? 1 : -1 // Some attract, some repel
          shape.position.x += (shape.position.x - this.targetMouse.x * 0.5) * force * direction
          shape.position.y += (shape.position.y - this.targetMouse.y * 0.5) * force * direction
        }
      })
      
      // Update neural network system
      if (this.neuralNetwork) {
        this.neuralNetwork.nodes.forEach((node, index) => {
          const userData = node.userData
          
          // Enhanced pulsation
          const pulse = Math.sin(currentTime * userData.pulseSpeed + userData.phase) * 0.4 + 1.0
          node.scale.setScalar(pulse)
          
          // Enhanced opacity
          node.material.opacity = 0.8 + Math.sin(currentTime * 2 + userData.phase) * 0.2
          
          // Subtle floating motion
          node.position.y += Math.sin(currentTime * 0.5 + userData.phase) * 0.01
        })
        
        this.neuralNetwork.connections.forEach((connection, index) => {
          const userData = connection.userData
          const pulse = Math.sin(currentTime * userData.pulseSpeed + index) * 0.2 + userData.baseOpacity
          connection.material.opacity = pulse
        })
      }
      
      // Update data streams
      this.dataStreams.forEach((stream, index) => {
        const userData = stream.userData
        
        // Animate stream flow
        stream.rotation.y += userData.speed
        
        // Dynamic positioning
        stream.position.x = Math.sin(currentTime * 0.2 + index) * 5
        stream.position.z = Math.cos(currentTime * 0.15 + index) * 5
        
        // Dynamic opacity
        stream.material.opacity = 0.6 + Math.sin(currentTime * 2 + index) * 0.2
      })
      
      // Update glowing spheres
      this.glowingSpheres.forEach((sphere, index) => {
        const userData = sphere.userData
        
        // Orbital motion
        const radius = 30 + Math.sin(currentTime * 0.3 + userData.phase) * 10
        const angle = currentTime * userData.speed + userData.phase
        
        sphere.position.x = Math.cos(angle) * radius
        sphere.position.z = Math.sin(angle) * radius
        sphere.position.y = Math.sin(currentTime * 0.2 + userData.phase) * 15
        
        // Dynamic opacity
        sphere.material.opacity = 0.2 + Math.sin(currentTime * 1.5 + userData.phase) * 0.1
      })
      
      // Update energy field
      if (this.energyField && this.energyField.material.uniforms) {
        this.energyField.material.uniforms.time.value = currentTime
        this.energyField.material.uniforms.mousePosition.value.set(
          this.targetMouse.x * 0.3, 
          this.targetMouse.y * 0.3
        )
      }
      
      // Enhanced camera movement with smooth parallax
      const targetCameraX = this.targetMouse.x * 0.001
      const targetCameraY = -this.targetMouse.y * 0.0008
      
      this.camera.position.x += (targetCameraX - this.camera.position.x) * 0.02
      this.camera.position.y += (targetCameraY - this.camera.position.y) * 0.02
      
      // Subtle camera breathing effect
      this.camera.position.z = 50 + Math.sin(currentTime * 0.5) * 2
      
      // Dynamic camera rotation based on mouse position
      this.camera.rotation.x = this.targetMouse.y * 0.00005
      this.camera.rotation.y = this.targetMouse.x * 0.00005
      
      this.camera.lookAt(0, 0, 0)
      
      // Render with performance monitoring
      this.renderer.render(this.scene, this.camera)
      
      // Performance optimization: reduce particle count on lower-end devices
      if (this.frameCount % 120 === 0) { // Check every 2 seconds at 60fps
        const fps = 1 / deltaTime
        if (fps < 30 && this.particles) {
          // Reduce particle density for better performance
          console.log('Optimizing for performance...', Math.round(fps), 'fps')
        }
      }
    },

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

    cleanup() {
      this.isInitialized = false
      
      if (this.animationId) {
        cancelAnimationFrame(this.animationId)
      }
      
      if (this.eventListeners) {
        window.removeEventListener('mousemove', this.eventListeners.handleMouseMove)
        window.removeEventListener('resize', this.eventListeners.handleResize)
      }
      
      // Enhanced cleanup for all objects
      const objectsToCleanup = [
        ...this.geometryShapes,
        ...this.dataStreams,
        ...this.glowingSpheres,
        this.particles,
        this.energyField
      ]
      
      if (this.neuralNetwork) {
        objectsToCleanup.push(...this.neuralNetwork.nodes, ...this.neuralNetwork.connections)
      }
      
      objectsToCleanup.forEach(object => {
        if (object && object.geometry) {
          object.geometry.dispose()
        }
        if (object && object.material) {
          if (Array.isArray(object.material)) {
            object.material.forEach(material => {
              if (material.dispose) material.dispose()
            })
          } else if (object.material.dispose) {
            object.material.dispose()
          }
        }
      })
      
      if (this.renderer) {
        this.renderer.dispose()
      }
      
      // Clear arrays
      this.geometryShapes = []
      this.dataStreams = []
      this.glowingSpheres = []
      this.neuralNetwork = null
    },
    getProfileName() {
  return this.profile?.name || 'Rezuan Ahmmed'
},
getProfileImage() {
  if (this.profile?.image) {
    return `/storage/${this.profile.image}`
  }
  return '/public/rezuan.jpg' // fallback to original image
},

  }
}


</script>

<style scoped>
/* Enhanced Hero Section Styles */
.hero-section {
  position: relative;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  background: linear-gradient(135deg, #0a101f 0%, #1e293b 50%, #0f172a 100%);
}

.hero-canvas {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 0;
  display: block;
}

.hero-content {
  position: relative;
  z-index: 10;
  text-align: center;
  padding: 0 1rem;
  width: 100%;
  max-width: 112rem;
  margin: 0 auto;
  backdrop-filter: blur(2px);
}

.hero-inner {
  margin-bottom: 2rem;
  animation: enhancedFadeInUp 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

/* Enhanced Profile Image */
.profile-container {
  margin-bottom: 1.5rem;
  padding-top: 2rem;
}

@media (min-width: 640px) {
  .profile-container {
    margin-bottom: 2rem;
    padding-top: 3rem;
  }
}

@media (min-width: 768px) {
  .profile-container {
    padding-top: 4rem;
  }
}

.profile-wrapper {
  width: 6rem;
  height: 6rem;
  margin: 0 auto;
  border-radius: 50%;
  background: linear-gradient(135deg, #ffc300, #ffc300, #ffd60a);
  padding: 0.25rem;
  box-shadow: 
    0 25px 50px -12px #ffc300,
    0 0 0 1px #ffc300,
    inset 0 1px 0 #ffc300;
  animation: profileGlow 3s ease-in-out infinite alternate;
}

@keyframes profileGlow {
  0% {
    box-shadow: 
      0 25px 50px -12px rgba(59, 130, 246, 0.4),
      0 0 0 1px rgba(255, 255, 255, 0.1),
      inset 0 1px 0 rgba(255, 255, 255, 0.2);
  }
  100% {
    box-shadow: 
      0 25px 50px -12px rgba(139, 92, 246, 0.6),
      0 0 0 1px rgba(255, 255, 255, 0.2),
      inset 0 1px 0 rgba(255, 255, 255, 0.3);
  }
}

@media (min-width: 640px) {
  .profile-wrapper {
    width: 7rem;
    height: 7rem;
  }
}

@media (min-width: 768px) {
  .profile-wrapper {
    width: 8rem;
    height: 8rem;
  }
}

@media (min-width: 1024px) {
  .profile-wrapper {
    width: 10rem;
    height: 10rem;
  }
}

.profile-inner {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  overflow: hidden;
  border: 2px solid #ffc300;
  backdrop-filter: blur(8px);
}

.profile-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
  transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.profile-image:hover {
  transform: scale(1.08);
}

/* Enhanced Typography */
.hero-title {
  font-size: 1.875rem;
  font-weight: 800;
  margin-bottom: 0.75rem;
  color: white;
  line-height: 1.1;
  text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
}

@media (min-width: 640px) {
  .hero-title {
    font-size: 2.25rem;
  }
}

@media (min-width: 768px) {
  .hero-title {
    font-size: 3rem;
    margin-bottom: 1rem;
  }
}

@media (min-width: 1024px) {
  .hero-title {
    font-size: 3.75rem;
  }
}

@media (min-width: 1280px) {
  .hero-title {
    font-size: 4.5rem;
  }
}

.hero-name {
  background: linear-gradient(135deg, #ffffff 0%, #40916c 25%, #40916c 50%, #40916c 75%, #fefae0 100%);
  background-clip: text;
  -webkit-background-clip: text;
  color: transparent;
  background-size: 300% auto;
  animation: enhancedTextShimmer 4s linear infinite;
}

@keyframes enhancedTextShimmer {
  0% {
    background-position: 0% center;
  }
  100% {
    background-position: 300% center;
  }
}

.hero-subtitle {
  font-size: 1.125rem;
  color: #fefae0;
  margin-bottom: 1.5rem;
  font-weight: 600;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

@media (min-width: 640px) {
  .hero-subtitle {
    font-size: 1.25rem;
  }
}

@media (min-width: 768px) {
  .hero-subtitle {
    font-size: 1.5rem;
    margin-bottom: 2rem;
  }
}

.hero-role {
  background: linear-gradient(135deg, #fefae0, #ffc300, #fefae0);
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

/* Enhanced Navigation */
.hero-nav {
  margin-bottom: 1.5rem;
}

@media (min-width: 768px) {
  .hero-nav {
    margin-bottom: 2rem;
  }
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

@media (min-width: 640px) {
  .nav-container {
    gap: 1.5rem;
  }
}

@media (min-width: 768px) {
  .nav-container {
    gap: 2rem;
  }
}

.nav-link {
  color: #cbd5e1;
  transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  font-size: 0.875rem;
  font-weight: 500;
  text-decoration: none;
  position: relative;
  padding: 0.5rem 1rem;
  border-radius: 25px;
}

.nav-link:hover {
  color: white;
  background: #ffc300;
  transform: translateY(-2px);
}

@media (min-width: 640px) {
  .nav-link {
    font-size: 1rem;
  }
}

.nav-link:hover::after {
  content: '';
  position: absolute;
  bottom: -4px;
  left: 50%;
  transform: translateX(-50%);
  width: 80%;
  height: 2px;
  background: linear-gradient(90deg, #fefae0, #fefae0);
  border-radius: 1px;
  animation: navUnderline 0.3s ease-out forwards;
}

@keyframes navUnderline {
  0% {
    width: 0%;
  }
  100% {
    width: 80%;
  }
}

.cta-button {
  background: linear-gradient(135deg, #ffc300, #ffc300);
  color: white;
  padding: 0.75rem 1.5rem;
  border-radius: 25px;
  font-size: 0.875rem;
  font-weight: 600;
  transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  text-decoration: none;
  position: relative;
  overflow: hidden;
}

.cta-button::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.6s;
}

.cta-button:hover::before {
  left: 100%;
}

.cta-button:hover {
  box-shadow: 
    0 15px 35px rgba(59, 130, 246, 0.4),
    0 5px 15px rgba(6, 182, 212, 0.3);
  transform: translateY(-3px) scale(1.05);
}

@media (min-width: 640px) {
  .cta-button {
    font-size: 1rem;
  }
}







/* Enhanced Buttons */
.hero-buttons {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 1rem;
  padding: 0 1rem;
}

@media (min-width: 640px) {
  .hero-buttons {
    flex-direction: row;
    gap: 1.5rem;
  }
}

.primary-button {
  background: linear-gradient(135deg, #3b82f6, #06b6d4, #8b5cf6);
  color: white;
  padding: 1rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  width: 100%;
  position: relative;
  overflow: hidden;
  background-size: 200% auto;
}

.primary-button::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, #8b5cf6, #06b6d4, #3b82f6);
  border-radius: 50px;
  opacity: 0;
  transition: opacity 0.4s;
}

.primary-button:hover::before {
  opacity: 1;
}

.primary-button > * {
  position: relative;
  z-index: 1;
}

@media (min-width: 640px) {
  .primary-button {
    width: auto;
  }
}

.primary-button:hover {
  box-shadow: 
    0 20px 40px rgba(59, 130, 246, 0.4),
    0 10px 20px rgba(139, 92, 246, 0.3);
  transform: translateY(-4px) scale(1.05);
}

.secondary-button {
  border: 2px solid rgba(59, 130, 246, 0.5);
  color: #cbd5e1;
  padding: 1rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  width: 100%;
  position: relative;
  overflow: hidden;
}

@media (min-width: 640px) {
  .secondary-button {
    width: auto;
  }
}

.secondary-button:hover {
  color: white;
  border-color: #06b6d4;
  background: rgba(6, 182, 212, 0.1);
  transform: translateY(-3px) scale(1.05);
  box-shadow: 0 15px 30px rgba(6, 182, 212, 0.2);
}

.button-icon {
  width: 1.25rem;
  height: 1.25rem;
  margin-left: 0.75rem;
  transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.primary-button:hover .button-icon {
  transform: translateX(0.5rem);
}

/* Enhanced Scroll Indicator */
.scroll-indicator {
  position: absolute;
  bottom: 1rem;
  left: 50%;
  transform: translateX(-50%);
  animation: enhancedBounce 2s ease-in-out infinite;
}

@media (min-width: 640px) {
  .scroll-indicator {
    bottom: 1.5rem;
  }
}

@media (min-width: 768px) {
  .scroll-indicator {
    bottom: 2rem;
  }
}

.scroll-indicator-inner {
  width: 1.5rem;
  height: 2.5rem;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 25px;
  display: flex;
  justify-content: center;
  backdrop-filter: blur(10px);
  background: rgba(255, 255, 255, 0.05);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

@media (min-width: 640px) {
  .scroll-indicator-inner {
    width: 1.75rem;
    height: 3rem;
  }
}

.scroll-indicator-dot {
  width: 0.375rem;
  height: 0.75rem;
  background: linear-gradient(to bottom, #60a5fa, #06b6d4);
  border-radius: 25px;
  margin-top: 0.5rem;
  animation: scrollDotPulse 2s ease-in-out infinite;
  box-shadow: 0 0 10px rgba(96, 165, 250, 0.5);
}

@media (min-width: 640px) {
  .scroll-indicator-dot {
    height: 1rem;
    margin-top: 0.75rem;
  }
}

/* Enhanced Animations */
@keyframes enhancedFadeInUp {
  0% {
    opacity: 0;
    transform: translateY(60px) scale(0.95);
    filter: blur(4px);
  }
  100% {
    opacity: 1;
    transform: translateY(0) scale(1);
    filter: blur(0);
  }
}

@keyframes enhancedBounce {
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

/* Performance optimizations */
.hero-section * {
  will-change: transform;
}

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