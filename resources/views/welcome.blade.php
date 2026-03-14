<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEMTHAI Store - 3D Experience</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Orbitron', sans-serif;
            background: linear-gradient(135deg, #030014 0%, #0a0033 50%, #1a004d 100%);
            color: #fff;
            overflow: hidden;
            height: 100vh;
        }

        canvas {
            display: block;
            width: 100%;
            height: 100%;
        }

        /* Navigation */
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background: rgba(3, 0, 20, 0.6);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 245, 255, 0.2);
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            background: linear-gradient(135deg, #00f5ff, #0066ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-family: 'Orbitron', sans-serif;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-link {
            color: #ccc;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
            position: relative;
        }

        .nav-link:hover {
            color: #00f5ff;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #00f5ff, #0066ff);
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn-nav {
            background: linear-gradient(135deg, #0066ff, #8b5cf6);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 102, 255, 0.4);
        }

        /* Content Overlay */
        .content {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            z-index: 100;
            pointer-events: none;
        }

        .content > * {
            pointer-events: auto;
        }

        .hero-title {
            font-size: 80px;
            font-weight: 900;
            margin-bottom: 20px;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 3px;
            animation: glow 3s ease-in-out infinite;
        }

        .hero-title span {
            background: linear-gradient(135deg, #00f5ff, #0066ff, #8b5cf6, #ff006e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 300% 300%;
            animation: gradientShift 8s ease infinite;
        }

        @keyframes glow {
            0%, 100% { text-shadow: 0 0 20px rgba(0, 245, 255, 0.5); }
            50% { text-shadow: 0 0 40px rgba(0, 102, 255, 0.8); }
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .hero-subtitle {
            font-size: 24px;
            color: #ccc;
            margin-bottom: 40px;
            font-weight: 300;
            letter-spacing: 2px;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 100px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #00f5ff, #0066ff);
            border: 2px solid transparent;
            color: #030014;
            padding: 15px 40px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-primary:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 245, 255, 0.4);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid #00f5ff;
            color: #00f5ff;
            padding: 15px 40px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: rgba(0, 245, 255, 0.1);
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 245, 255, 0.2);
        }

        .stats {
            position: fixed;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 60px;
            z-index: 100;
        }

        .stat {
            text-align: center;
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
            background: linear-gradient(135deg, #00f5ff, #0066ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
            letter-spacing: 1px;
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: fixed;
            bottom: 20px;
            right: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            z-index: 100;
        }

        .scroll-text {
            font-size: 12px;
            color: #00f5ff;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .scroll-arrow {
            width: 24px;
            height: 24px;
            border-right: 2px solid #00f5ff;
            border-bottom: 2px solid #00f5ff;
            animation: scroll-bounce 2s infinite;
        }

        @keyframes scroll-bounce {
            0% { transform: translateY(0) rotate(45deg); opacity: 1; }
            100% { transform: translateY(10px) rotate(45deg); opacity: 0.3; }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 40px;
            }

            .hero-subtitle {
                font-size: 16px;
            }

            .nav {
                padding: 15px 20px;
            }

            .nav-links {
                gap: 15px;
            }

            .nav-link {
                font-size: 12px;
            }

            .cta-buttons {
                flex-direction: column;
                gap: 15px;
            }

            .stats {
                gap: 30px;
            }

            .stat-value {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Canvas for Three.js -->
    <canvas id="canvas"></canvas>

    <!-- Navigation -->
    <nav class="nav">
        <div class="logo">LEMTHAI</div>
        <div class="nav-links">
            <a href="#" class="nav-link">Shop</a>
            <a href="#" class="nav-link">About</a>
            <a href="#" class="nav-link">Contact</a>
            <button class="btn-nav">Sign In</button>
        </div>
    </nav>

    <!-- Content -->
    <div class="content">
        <h1 class="hero-title"><span>LEMTHAI</span> STORE</h1>
        <p class="hero-subtitle">Trải Nghiệm Mua Sắm Tương Lai</p>
        
        <div class="cta-buttons">
            <a href="#" class="btn-primary">Khám Phá Ngay</a>
            <a href="#" class="btn-secondary">Chi Tiết</a>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats">
        <div class="stat">
            <div class="stat-value">10K+</div>
            <div class="stat-label">Sản Phẩm</div>
        </div>
        <div class="stat">
            <div class="stat-value">50K+</div>
            <div class="stat-label">Khách Hàng</div>
        </div>
        <div class="stat">
            <div class="stat-value">24/7</div>
            <div class="stat-label">Hỗ Trợ</div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <span class="scroll-text">Scroll</span>
        <div class="scroll-arrow"></div>
    </div>

    <!-- Three.js Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        // Scene Setup
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ canvas: document.getElementById('canvas'), antialias: true, alpha: true });
        
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.setClearColor(0x000000, 0);
        camera.position.z = 50;

        // Mouse tracking
        const mouse = { x: 0, y: 0 };
        document.addEventListener('mousemove', (event) => {
            mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
            mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
        });

        // Create Particles
        const particles = [];
        const particleGeometry = new THREE.BufferGeometry();
        const positions = [];

        for (let i = 0; i < 1000; i++) {
            const x = (Math.random() - 0.5) * 200;
            const y = (Math.random() - 0.5) * 200;
            const z = (Math.random() - 0.5) * 200;
            positions.push(x, y, z);
        }

        particleGeometry.setAttribute('position', new THREE.BufferAttribute(new Float32Array(positions), 3));

        const particleMaterial = new THREE.PointsMaterial({
            size: 0.5,
            color: 0x00f5ff,
            sizeAttenuation: true,
            transparent: true,
            opacity: 0.6
        });

        const particleSystem = new THREE.Points(particleGeometry, particleMaterial);
        scene.add(particleSystem);

        // Create animated geometric shapes
        const geometries = [];

        // Rotating Cube
        const cubeGeometry = new THREE.BoxGeometry(8, 8, 8);
        const cubeMaterial = new THREE.MeshPhongMaterial({
            color: 0x0066ff,
            emissive: 0x0066ff,
            emissiveIntensity: 0.3,
            wireframe: false
        });
        const cube = new THREE.Mesh(cubeGeometry, cubeMaterial);
        cube.position.set(-20, 15, 0);
        scene.add(cube);
        geometries.push({ mesh: cube, speed: 0.005 });

        // Rotating Pyramid (Tetrahedron)
        const pyramidGeometry = new THREE.TetrahedronGeometry(6, 0);
        const pyramidMaterial = new THREE.MeshPhongMaterial({
            color: 0x8b5cf6,
            emissive: 0x8b5cf6,
            emissiveIntensity: 0.3,
            wireframe: false
        });
        const pyramid = new THREE.Mesh(pyramidGeometry, pyramidMaterial);
        pyramid.position.set(20, 15, 0);
        scene.add(pyramid);
        geometries.push({ mesh: pyramid, speed: 0.007 });

        // Rotating Icosahedron
        const icoGeometry = new THREE.IcosahedronGeometry(6, 0);
        const icoMaterial = new THREE.MeshPhongMaterial({
            color: 0xff006e,
            emissive: 0xff006e,
            emissiveIntensity: 0.3,
            wireframe: false
        });
        const ico = new THREE.Mesh(icoGeometry, icoMaterial);
        ico.position.set(0, -20, 0);
        scene.add(ico);
        geometries.push({ mesh: ico, speed: 0.006 });

        // Lighting
        const ambientLight = new THREE.AmbientLight(0x00f5ff, 0.4);
        scene.add(ambientLight);

        const pointLight1 = new THREE.PointLight(0x0066ff, 1, 500);
        pointLight1.position.set(100, 100, 100);
        scene.add(pointLight1);

        const pointLight2 = new THREE.PointLight(0xff006e, 0.8, 500);
        pointLight2.position.set(-100, -100, 100);
        scene.add(pointLight2);

        // Animation Loop
        function animate() {
            requestAnimationFrame(animate);

            // Rotate particles
            particleSystem.rotation.x += 0.0002;
            particleSystem.rotation.y += 0.0003;

            // Rotate geometries
            geometries.forEach((geo) => {
                geo.mesh.rotation.x += geo.speed;
                geo.mesh.rotation.y += geo.speed * 1.5;
                geo.mesh.rotation.z += geo.speed * 0.7;

                // Mouse tracking effect
                geo.mesh.position.x += (mouse.x * 50 - geo.mesh.position.x) * 0.02;
                geo.mesh.position.y += (mouse.y * 50 - geo.mesh.position.y) * 0.02;
            });

            // Camera movement with mouse
            camera.position.x += (mouse.x * 20 - camera.position.x) * 0.01;
            camera.position.y += (mouse.y * 20 - camera.position.y) * 0.01;
            camera.lookAt(scene.position);

            renderer.render(scene, camera);
        }

        animate();

        // Handle window resize
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
    </script>
</body>
</html>
