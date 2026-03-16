<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LEMTHAI')</title>
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }
        
        body {
            background: linear-gradient(135deg, #030014 0%, #0a0a1f 50%, #030014 100%);
            color: #e5e7eb;
            font-family: 'Inter', sans-serif;
        }
        
        .font-orbitron { font-family: 'Orbitron', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        
        .btn-primary {
            background: linear-gradient(135deg, #0066ff, #8b5cf6);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary:hover {
            box-shadow: 0 0 30px rgba(0, 102, 255, 0.6);
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            border: 1px solid #00f5ff;
            color: #00f5ff;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: rgba(0, 245, 255, 0.1);
            box-shadow: 0 0 20px rgba(0, 245, 255, 0.4);
        }
        
        .card-gradient {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 245, 255, 0.2);
        }
        
        .card-gradient:hover {
            border-color: rgba(0, 245, 255, 0.5);
            box-shadow: 0 0 20px rgba(0, 102, 255, 0.3);
        }
        
        .glow-text {
            color: #00f5ff;
            text-shadow: 0 0 10px rgba(0, 245, 255, 0.6);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @stack('styles')
</head>
<body class="font-inter antialiased">
    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
