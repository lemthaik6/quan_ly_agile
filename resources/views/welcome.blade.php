<!doctype html>
<html lang="vi" class="h-full">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LEMTHAI - Tái định nghĩa trải nghiệm số</title>
  <script src="https://cdn.tailwindcss.com/3.4.17"></script>
  <script src="/_sdk/element_sdk.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&amp;family=Inter:wght@300;400;500;600&amp;display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html, body { height: 100%; }
    
    :root {
      --bg-primary: #030014;
      --bg-secondary: #0a0a1f;
      --cyan-glow: #00f5ff;
      --blue-glow: #0066ff;
      --purple-glow: #8b5cf6;
      --magenta-glow: #ec4899;
    }
    
    .font-orbitron { font-family: 'Orbitron', sans-serif; }
    .font-inter { font-family: 'Inter', sans-serif; }
    
    .hero-container {
      background: radial-gradient(ellipse at 50% 0%, rgba(0, 102, 255, 0.15) 0%, transparent 50%),
                  radial-gradient(ellipse at 80% 50%, rgba(139, 92, 246, 0.1) 0%, transparent 40%),
                  radial-gradient(ellipse at 20% 80%, rgba(0, 245, 255, 0.08) 0%, transparent 40%),
                  linear-gradient(180deg, #030014 0%, #0a0a1f 50%, #030014 100%);
      position: relative;
      overflow: hidden;
    }
    
    .noise-overlay {
      position: absolute;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
      opacity: 0.02;
      pointer-events: none;
    }
    
    .glass-nav {
      background: rgba(255, 255, 255, 0.03);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .nav-link {
      position: relative;
      color: rgba(255, 255, 255, 0.7);
      transition: all 0.3s ease;
    }
    
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -4px;
      left: 50%;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--cyan-glow), transparent);
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }
    
    .nav-link:hover {
      color: var(--cyan-glow);
      text-shadow: 0 0 20px rgba(0, 245, 255, 0.5);
    }
    
    .nav-link:hover::after {
      width: 100%;
    }
    
    .cta-primary {
      background: linear-gradient(135deg, var(--cyan-glow), var(--blue-glow));
      position: relative;
      overflow: hidden;
      transition: all 0.4s ease;
    }
    
    .cta-primary::before {
      content: '';
      position: absolute;
      inset: -2px;
      background: linear-gradient(135deg, var(--cyan-glow), var(--purple-glow), var(--cyan-glow));
      border-radius: inherit;
      z-index: -1;
      opacity: 0;
      transition: opacity 0.4s ease;
      filter: blur(8px);
    }
    
    .cta-primary:hover::before {
      opacity: 1;
    }
    
    .cta-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 40px rgba(0, 245, 255, 0.4);
    }
    
    .cta-secondary {
      background: transparent;
      border: 1px solid rgba(0, 245, 255, 0.3);
      position: relative;
      overflow: hidden;
      transition: all 0.4s ease;
    }
    
    .cta-secondary::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(0, 245, 255, 0.1), rgba(139, 92, 246, 0.1));
      opacity: 0;
      transition: opacity 0.4s ease;
    }
    
    .cta-secondary:hover::before {
      opacity: 1;
    }
    
    .cta-secondary:hover {
      border-color: var(--cyan-glow);
      box-shadow: 0 0 30px rgba(0, 245, 255, 0.2), inset 0 0 30px rgba(0, 245, 255, 0.05);
      transform: translateY(-2px);
    }
    
    .canvas-container {
      position: relative;
      width: 100%;
      max-width: 700px;
      aspect-ratio: 1;
    }
    
    .glow-orb {
      position: absolute;
      border-radius: 50%;
      filter: blur(60px);
      animation: pulse-glow 4s ease-in-out infinite;
    }
    
    @keyframes pulse-glow {
      0%, 100% { opacity: 0.6; transform: scale(1); }
      50% { opacity: 0.9; transform: scale(1.1); }
    }
    
    .headline-text {
      background: linear-gradient(135deg, #ffffff 0%, var(--cyan-glow) 50%, var(--purple-glow) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      animation: gradient-shift 8s ease infinite;
      background-size: 200% 200%;
    }
    
    @keyframes gradient-shift {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }
    
    .particle {
      position: absolute;
      background: radial-gradient(circle, rgba(0, 245, 255, 0.8) 0%, transparent 70%);
      border-radius: 50%;
      pointer-events: none;
    }
    
    .star {
      position: absolute;
      width: 2px;
      height: 2px;
      background: white;
      border-radius: 50%;
      animation: twinkle 3s ease-in-out infinite;
    }
    
    @keyframes twinkle {
      0%, 100% { opacity: 0.2; transform: scale(1); }
      50% { opacity: 1; transform: scale(1.5); }
    }
    
    .logo-text {
      background: linear-gradient(90deg, var(--cyan-glow), #ffffff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
    }
    
    .floating { animation: float 6s ease-in-out infinite; }
  </style>
  <style>body { box-sizing: border-box; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
 </head>
 <body class="h-full overflow-auto">
  <div class="hero-container min-h-full w-full flex flex-col">
   <div class="noise-overlay"></div><!-- Particles Container -->
   <div id="particles-container" class="absolute inset-0 overflow-hidden pointer-events-none"></div><!-- Stars Container -->
   <div id="stars-container" class="absolute inset-0 overflow-hidden pointer-events-none"></div><!-- Navigation -->
   <nav class="glass-nav relative z-50 px-6 lg:px-12 py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between"><!-- Logo -->
     <div class="flex items-center gap-3">
      <div class="w-10 h-10 relative">
       <svg viewbox="0 0 40 40" class="w-full h-full"><defs>
         <lineargradient id="logoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stop-color="#00f5ff" />
          <stop offset="100%" stop-color="#8b5cf6" />
         </lineargradient>
        </defs> <polygon points="20,2 38,32 2,32" fill="none" stroke="url(#logoGrad)" stroke-width="2" /> <circle cx="20" cy="20" r="6" fill="url(#logoGrad)" opacity="0.8" />
       </svg>
      </div><span class="font-orbitron font-bold text-xl logo-text tracking-wider">LEMTHAI</span>
     </div><!-- Center Menu -->
     <div class="hidden lg:flex items-center gap-8"><a href="#about" class="nav-link font-inter text-sm tracking-wide">Về chúng tôi</a> <a href="#products" class="nav-link font-inter text-sm tracking-wide">Sản phẩm</a> <a href="#demo" class="nav-link font-inter text-sm tracking-wide">Demo</a> <a href="#library" class="nav-link font-inter text-sm tracking-wide">Thư viện</a> <a href="#contact" class="nav-link font-inter text-sm tracking-wide">Liên hệ</a>
     </div><!-- CTA Button --> <button id="nav-cta" class="cta-primary px-6 py-2.5 rounded-full font-inter font-medium text-sm text-white tracking-wide"> Bắt đầu </button>
    </div>
   </nav><!-- Main Hero Content -->
   <main class="flex-1 flex flex-col items-center justify-center px-6 py-12 relative z-10"><!-- Ambient Glow Effects -->
    <div class="glow-orb w-96 h-96 bg-cyan-500/20 absolute top-1/4 left-1/4 -translate-x-1/2" style="animation-delay: 0s;"></div>
    <div class="glow-orb w-80 h-80 bg-purple-500/15 absolute bottom-1/4 right-1/4 translate-x-1/2" style="animation-delay: 2s;"></div>
    <div class="glow-orb w-64 h-64 bg-blue-500/20 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" style="animation-delay: 1s;"></div><!-- 3D Canvas Container -->
    <div class="canvas-container floating mb-8">
     <canvas id="sculpture-canvas"></canvas>
    </div><!-- Headline -->
    <h1 id="headline" class="headline-text font-orbitron font-bold text-4xl md:text-5xl lg:text-6xl text-center mb-6 max-w-4xl leading-tight">Tái định nghĩa trải nghiệm số</h1><!-- Subtitle -->
    <p id="subtitle" class="font-inter text-lg md:text-xl text-center text-white/60 max-w-2xl mb-10 leading-relaxed">Chúng tôi xây dựng những nền tảng số hiện đại với công nghệ web thế hệ mới.</p><!-- CTA Buttons -->
    <div class="flex flex-col sm:flex-row items-center gap-4"><button id="primary-btn" class="cta-primary px-10 py-4 rounded-full font-inter font-semibold text-base text-white tracking-wide"> Bắt đầu </button> <button id="secondary-btn" class="cta-secondary px-10 py-4 rounded-full font-inter font-semibold text-base text-cyan-400 tracking-wide"> Xem Demo </button>
    </div>
   </main>
  </div>
  <script>
    // Configuration
    const defaultConfig = {
      main_headline: "Tái định nghĩa trải nghiệm số",
      subtitle_text: "Chúng tôi xây dựng những nền tảng số hiện đại với công nghệ web thế hệ mới.",
      primary_cta: "Bắt đầu",
      secondary_cta: "Xem Demo",
      background_color: "#030014",
      accent_color: "#00f5ff",
      text_color: "#ffffff",
      secondary_accent: "#8b5cf6",
      surface_color: "#0a0a1f",
      font_family: "Orbitron",
      font_size: 16
    };

    // 3D Sculpture Renderer
    class GenerativeSculpture {
      constructor(canvas) {
        this.canvas = canvas;
        this.ctx = canvas.getContext('2d');
        this.time = 0;
        this.nodes = [];
        this.connections = [];
        this.rings = [];
        this.particles = [];
        this.init();
      }

      init() {
        this.resize();
        window.addEventListener('resize', () => this.resize());
        
        // Create neural network nodes
        const nodeCount = 60;
        for (let i = 0; i < nodeCount; i++) {
          const theta = (i / nodeCount) * Math.PI * 2;
          const phi = Math.acos(2 * Math.random() - 1);
          const radius = 120 + Math.random() * 60;
          
          this.nodes.push({
            baseX: Math.sin(phi) * Math.cos(theta) * radius,
            baseY: Math.sin(phi) * Math.sin(theta) * radius,
            baseZ: Math.cos(phi) * radius,
            x: 0, y: 0, z: 0,
            connections: [],
            energy: Math.random(),
            phase: Math.random() * Math.PI * 2
          });
        }
        
        // Create connections
        this.nodes.forEach((node, i) => {
          const connectionCount = 2 + Math.floor(Math.random() * 3);
          for (let j = 0; j < connectionCount; j++) {
            const targetIndex = Math.floor(Math.random() * this.nodes.length);
            if (targetIndex !== i) {
              node.connections.push(targetIndex);
            }
          }
        });
        
        // Create energy rings
        for (let i = 0; i < 5; i++) {
          this.rings.push({
            radius: 80 + i * 35,
            rotation: { x: Math.random() * Math.PI, y: Math.random() * Math.PI, z: 0 },
            speed: 0.3 + Math.random() * 0.4,
            segments: 48 + i * 8,
            phase: Math.random() * Math.PI * 2,
            wobble: 0.1 + Math.random() * 0.15
          });
        }
        
        // Create floating particles
        for (let i = 0; i < 100; i++) {
          this.particles.push({
            x: (Math.random() - 0.5) * 400,
            y: (Math.random() - 0.5) * 400,
            z: (Math.random() - 0.5) * 400,
            vx: (Math.random() - 0.5) * 0.5,
            vy: (Math.random() - 0.5) * 0.5,
            vz: (Math.random() - 0.5) * 0.5,
            size: 1 + Math.random() * 2,
            alpha: 0.3 + Math.random() * 0.7
          });
        }
        
        this.animate();
      }

      resize() {
        const rect = this.canvas.parentElement.getBoundingClientRect();
        const dpr = window.devicePixelRatio || 1;
        this.canvas.width = rect.width * dpr;
        this.canvas.height = rect.height * dpr;
        this.canvas.style.width = rect.width + 'px';
        this.canvas.style.height = rect.height + 'px';
        this.ctx.scale(dpr, dpr);
        this.centerX = rect.width / 2;
        this.centerY = rect.height / 2;
      }

      rotatePoint(x, y, z, rx, ry, rz) {
        // Rotate around Y axis
        let cosY = Math.cos(ry), sinY = Math.sin(ry);
        let x1 = x * cosY - z * sinY;
        let z1 = x * sinY + z * cosY;
        
        // Rotate around X axis
        let cosX = Math.cos(rx), sinX = Math.sin(rx);
        let y1 = y * cosX - z1 * sinX;
        let z2 = y * sinX + z1 * cosX;
        
        // Rotate around Z axis
        let cosZ = Math.cos(rz), sinZ = Math.sin(rz);
        let x2 = x1 * cosZ - y1 * sinZ;
        let y2 = x1 * sinZ + y1 * cosZ;
        
        return { x: x2, y: y2, z: z2 };
      }

      project(x, y, z) {
        const fov = 400;
        const scale = fov / (fov + z);
        return {
          x: this.centerX + x * scale,
          y: this.centerY + y * scale,
          scale: scale
        };
      }

      animate() {
        this.time += 0.008;
        this.render();
        requestAnimationFrame(() => this.animate());
      }

      render() {
        const ctx = this.ctx;
        const width = this.canvas.width / (window.devicePixelRatio || 1);
        const height = this.canvas.height / (window.devicePixelRatio || 1);
        
        ctx.clearRect(0, 0, width, height);
        
        // Global rotation
        const globalRx = this.time * 0.2;
        const globalRy = this.time * 0.3;
        const globalRz = this.time * 0.1;
        
        // Update and draw particles
        this.particles.forEach(p => {
          p.x += p.vx;
          p.y += p.vy;
          p.z += p.vz;
          
          if (Math.abs(p.x) > 200) p.vx *= -1;
          if (Math.abs(p.y) > 200) p.vy *= -1;
          if (Math.abs(p.z) > 200) p.vz *= -1;
          
          const rotated = this.rotatePoint(p.x, p.y, p.z, globalRx, globalRy, globalRz);
          const projected = this.project(rotated.x, rotated.y, rotated.z);
          
          const gradient = ctx.createRadialGradient(
            projected.x, projected.y, 0,
            projected.x, projected.y, p.size * projected.scale * 2
          );
          gradient.addColorStop(0, `rgba(0, 245, 255, ${p.alpha * projected.scale})`);
          gradient.addColorStop(1, 'transparent');
          
          ctx.beginPath();
          ctx.fillStyle = gradient;
          ctx.arc(projected.x, projected.y, p.size * projected.scale * 2, 0, Math.PI * 2);
          ctx.fill();
        });
        
        // Draw energy rings
        this.rings.forEach((ring, ringIndex) => {
          const ringRotation = {
            x: ring.rotation.x + this.time * ring.speed,
            y: ring.rotation.y + this.time * ring.speed * 0.7,
            z: this.time * ring.speed * 0.3
          };
          
          const points = [];
          for (let i = 0; i <= ring.segments; i++) {
            const angle = (i / ring.segments) * Math.PI * 2;
            const wobbleOffset = Math.sin(angle * 3 + this.time * 2 + ring.phase) * ring.radius * ring.wobble;
            const r = ring.radius + wobbleOffset;
            
            const x = Math.cos(angle) * r;
            const y = Math.sin(angle) * r;
            const z = Math.sin(angle * 2 + this.time) * 20;
            
            const rotated = this.rotatePoint(x, y, z, ringRotation.x, ringRotation.y, ringRotation.z);
            const projected = this.project(rotated.x, rotated.y, rotated.z);
            points.push({ ...projected, z: rotated.z });
          }
          
          // Draw ring
          ctx.beginPath();
          ctx.strokeStyle = ringIndex % 2 === 0 
            ? `rgba(0, 245, 255, ${0.3 + Math.sin(this.time + ring.phase) * 0.2})`
            : `rgba(139, 92, 246, ${0.3 + Math.sin(this.time + ring.phase) * 0.2})`;
          ctx.lineWidth = 1.5;
          ctx.shadowColor = ringIndex % 2 === 0 ? '#00f5ff' : '#8b5cf6';
          ctx.shadowBlur = 15;
          
          points.forEach((p, i) => {
            if (i === 0) ctx.moveTo(p.x, p.y);
            else ctx.lineTo(p.x, p.y);
          });
          ctx.stroke();
          ctx.shadowBlur = 0;
        });
        
        // Update node positions
        this.nodes.forEach((node, i) => {
          const breathe = Math.sin(this.time * 2 + node.phase) * 10;
          const pulse = Math.sin(this.time * 3 + i * 0.1) * 5;
          
          node.x = node.baseX + breathe;
          node.y = node.baseY + pulse;
          node.z = node.baseZ + Math.cos(this.time + node.phase) * 15;
          
          node.energy = 0.5 + Math.sin(this.time * 2 + node.phase) * 0.5;
        });
        
        // Sort nodes by z for proper depth rendering
        const sortedNodes = [...this.nodes].map((node, index) => {
          const rotated = this.rotatePoint(node.x, node.y, node.z, globalRx, globalRy, globalRz);
          return { ...node, index, rotated };
        }).sort((a, b) => a.rotated.z - b.rotated.z);
        
        // Draw connections
        ctx.lineCap = 'round';
        sortedNodes.forEach(node => {
          const projected = this.project(node.rotated.x, node.rotated.y, node.rotated.z);
          
          node.connections.forEach(targetIndex => {
            const target = this.nodes[targetIndex];
            const targetRotated = this.rotatePoint(target.x, target.y, target.z, globalRx, globalRy, globalRz);
            const targetProjected = this.project(targetRotated.x, targetRotated.y, targetRotated.z);
            
            const avgZ = (node.rotated.z + targetRotated.z) / 2;
            const alpha = Math.max(0.05, Math.min(0.4, (200 + avgZ) / 400));
            
            const gradient = ctx.createLinearGradient(
              projected.x, projected.y,
              targetProjected.x, targetProjected.y
            );
            
            const energyPulse = Math.sin(this.time * 4 + node.index * 0.2) * 0.5 + 0.5;
            gradient.addColorStop(0, `rgba(0, 245, 255, ${alpha * node.energy})`);
            gradient.addColorStop(0.5, `rgba(139, 92, 246, ${alpha * energyPulse})`);
            gradient.addColorStop(1, `rgba(236, 72, 153, ${alpha * target.energy})`);
            
            ctx.beginPath();
            ctx.strokeStyle = gradient;
            ctx.lineWidth = 0.8 * projected.scale;
            ctx.moveTo(projected.x, projected.y);
            ctx.lineTo(targetProjected.x, targetProjected.y);
            ctx.stroke();
          });
        });
        
        // Draw nodes
        sortedNodes.forEach(node => {
          const projected = this.project(node.rotated.x, node.rotated.y, node.rotated.z);
          const size = (2 + node.energy * 3) * projected.scale;
          
          // Outer glow
          const glowGradient = ctx.createRadialGradient(
            projected.x, projected.y, 0,
            projected.x, projected.y, size * 4
          );
          glowGradient.addColorStop(0, `rgba(0, 245, 255, ${0.6 * node.energy * projected.scale})`);
          glowGradient.addColorStop(0.5, `rgba(139, 92, 246, ${0.3 * node.energy * projected.scale})`);
          glowGradient.addColorStop(1, 'transparent');
          
          ctx.beginPath();
          ctx.fillStyle = glowGradient;
          ctx.arc(projected.x, projected.y, size * 4, 0, Math.PI * 2);
          ctx.fill();
          
          // Core
          const coreGradient = ctx.createRadialGradient(
            projected.x, projected.y, 0,
            projected.x, projected.y, size
          );
          coreGradient.addColorStop(0, '#ffffff');
          coreGradient.addColorStop(0.5, '#00f5ff');
          coreGradient.addColorStop(1, 'rgba(0, 245, 255, 0)');
          
          ctx.beginPath();
          ctx.fillStyle = coreGradient;
          ctx.arc(projected.x, projected.y, size, 0, Math.PI * 2);
          ctx.fill();
        });
        
        // Draw central core
        const coreSize = 30 + Math.sin(this.time * 2) * 10;
        const coreGlow = ctx.createRadialGradient(
          this.centerX, this.centerY, 0,
          this.centerX, this.centerY, coreSize * 3
        );
        coreGlow.addColorStop(0, 'rgba(255, 255, 255, 0.8)');
        coreGlow.addColorStop(0.2, 'rgba(0, 245, 255, 0.5)');
        coreGlow.addColorStop(0.5, 'rgba(139, 92, 246, 0.3)');
        coreGlow.addColorStop(1, 'transparent');
        
        ctx.beginPath();
        ctx.fillStyle = coreGlow;
        ctx.arc(this.centerX, this.centerY, coreSize * 3, 0, Math.PI * 2);
        ctx.fill();
      }
    }

    // Create background particles
    function createParticles() {
      const container = document.getElementById('particles-container');
      for (let i = 0; i < 30; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = Math.random() * 100 + '%';
        particle.style.width = (2 + Math.random() * 4) + 'px';
        particle.style.height = particle.style.width;
        particle.style.animation = `float ${5 + Math.random() * 5}s ease-in-out infinite`;
        particle.style.animationDelay = Math.random() * 5 + 's';
        particle.style.opacity = 0.3 + Math.random() * 0.5;
        container.appendChild(particle);
      }
    }

    // Create background stars
    function createStars() {
      const container = document.getElementById('stars-container');
      for (let i = 0; i < 80; i++) {
        const star = document.createElement('div');
        star.className = 'star';
        star.style.left = Math.random() * 100 + '%';
        star.style.top = Math.random() * 100 + '%';
        star.style.animationDelay = Math.random() * 3 + 's';
        star.style.animationDuration = (2 + Math.random() * 3) + 's';
        container.appendChild(star);
      }
    }

    // Element SDK integration
    async function onConfigChange(config) {
      const headline = document.getElementById('headline');
      const subtitle = document.getElementById('subtitle');
      const primaryBtn = document.getElementById('primary-btn');
      const secondaryBtn = document.getElementById('secondary-btn');
      const navCta = document.getElementById('nav-cta');
      
      headline.textContent = config.main_headline || defaultConfig.main_headline;
      subtitle.textContent = config.subtitle_text || defaultConfig.subtitle_text;
      primaryBtn.textContent = config.primary_cta || defaultConfig.primary_cta;
      secondaryBtn.textContent = config.secondary_cta || defaultConfig.secondary_cta;
      navCta.textContent = config.primary_cta || defaultConfig.primary_cta;
      
      // Apply font
      const customFont = config.font_family || defaultConfig.font_family;
      headline.style.fontFamily = `${customFont}, Orbitron, sans-serif`;
      
      // Apply font size scaling
      const baseSize = config.font_size || defaultConfig.font_size;
      headline.style.fontSize = `${baseSize * 3}px`;
      subtitle.style.fontSize = `${baseSize * 1.25}px`;
      
      // Apply colors
      document.documentElement.style.setProperty('--bg-primary', config.background_color || defaultConfig.background_color);
      document.documentElement.style.setProperty('--cyan-glow', config.accent_color || defaultConfig.accent_color);
      document.documentElement.style.setProperty('--purple-glow', config.secondary_accent || defaultConfig.secondary_accent);
    }

    function mapToCapabilities(config) {
      return {
        recolorables: [
          {
            get: () => config.background_color || defaultConfig.background_color,
            set: (value) => { config.background_color = value; window.elementSdk.setConfig({ background_color: value }); }
          },
          {
            get: () => config.surface_color || defaultConfig.surface_color,
            set: (value) => { config.surface_color = value; window.elementSdk.setConfig({ surface_color: value }); }
          },
          {
            get: () => config.text_color || defaultConfig.text_color,
            set: (value) => { config.text_color = value; window.elementSdk.setConfig({ text_color: value }); }
          },
          {
            get: () => config.accent_color || defaultConfig.accent_color,
            set: (value) => { config.accent_color = value; window.elementSdk.setConfig({ accent_color: value }); }
          },
          {
            get: () => config.secondary_accent || defaultConfig.secondary_accent,
            set: (value) => { config.secondary_accent = value; window.elementSdk.setConfig({ secondary_accent: value }); }
          }
        ],
        borderables: [],
        fontEditable: {
          get: () => config.font_family || defaultConfig.font_family,
          set: (value) => { config.font_family = value; window.elementSdk.setConfig({ font_family: value }); }
        },
        fontSizeable: {
          get: () => config.font_size || defaultConfig.font_size,
          set: (value) => { config.font_size = value; window.elementSdk.setConfig({ font_size: value }); }
        }
      };
    }

    function mapToEditPanelValues(config) {
      return new Map([
        ["main_headline", config.main_headline || defaultConfig.main_headline],
        ["subtitle_text", config.subtitle_text || defaultConfig.subtitle_text],
        ["primary_cta", config.primary_cta || defaultConfig.primary_cta],
        ["secondary_cta", config.secondary_cta || defaultConfig.secondary_cta]
      ]);
    }

    // Initialize
    createParticles();
    createStars();
    
    const canvas = document.getElementById('sculpture-canvas');
    new GenerativeSculpture(canvas);
    
    if (window.elementSdk) {
      window.elementSdk.init({
        defaultConfig,
        onConfigChange,
        mapToCapabilities,
        mapToEditPanelValues
      });
    }
  </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9db39e1591fb8552',t:'MTc3MzMyNzA5Mi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>