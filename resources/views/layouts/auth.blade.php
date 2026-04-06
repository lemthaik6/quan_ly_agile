<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'OutfitChill Shop')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --obsidian: #080808;
            --midnight: #0f1118;
            --carbon: #1a1f2e;
            --slate: #2d3142;
            --glass-light: rgba(255,255,255,0.08);
            --glass-lighter: rgba(255,255,255,0.12);
            --laser-blue: #00d4ff;
            --electric-violet: #8b5cf6;
            --hot-pink: #ff006e;
            --text-primary: #f0f0f0;
            --text-secondary: #b0b0c0;
            --text-muted: #808090;
            --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            --radius-lg: 14px;
            --radius-md: 10px;
            --border-thin: 1px solid rgba(255,255,255,0.08);
            --border-light: 1px solid rgba(255,255,255,0.12);
            --shadow-sm: 0 4px 12px rgba(0,0,0,0.3);
            --backdrop: blur(20px);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }
        
        body {
            background: linear-gradient(135deg, var(--obsidian) 0%, #1a1f3a 50%, #2d1f4a 100%);
            color: var(--text-primary);
            font-family: var(--font-sans);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(ellipse 800px 600px at 20% 50%, rgba(0, 212, 255, 0.08) 0%, transparent 60%),
                radial-gradient(ellipse 600px 800px at 80% 80%, rgba(139, 92, 246, 0.06) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
            filter: blur(40px);
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .auth-card {
            width: 100%;
            max-width: 480px;
            background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
            border: var(--border-light);
            border-radius: var(--radius-lg);
            backdrop-filter: var(--backdrop);
            padding: 48px 32px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .auth-logo {
            font-size: 42px;
            margin-bottom: 16px;
            display: inline-block;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .auth-title {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--text-primary) 0%, var(--laser-blue) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .auth-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--laser-blue);
            letter-spacing: 0.3px;
        }

        .form-input {
            padding: 12px 14px;
            background: rgba(255,255,255,0.03);
            border: var(--border-thin);
            border-radius: var(--radius-md);
            color: var(--text-primary);
            font-family: inherit;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-input::placeholder {
            color: var(--text-muted);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--laser-blue);
            box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.1), inset 0 0 0 1px rgba(0, 212, 255, 0.2);
            background: rgba(255,255,255,0.05);
        }

        .form-error {
            color: #fca5a5;
            font-size: 12px;
            margin-top: 4px;
        }

        .auth-button {
            padding: 12px 24px;
            background: linear-gradient(135deg, var(--laser-blue), var(--electric-violet));
            border: none;
            border-radius: var(--radius-md);
            color: var(--obsidian);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .auth-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .auth-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 212, 255, 0.4);
        }

        .auth-button:hover::before {
            left: 100%;
        }

        .auth-divider {
            position: relative;
            margin: 24px 0;
        }

        .auth-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0,212,255,0.2), transparent);
        }

        .auth-divider-text {
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--obsidian) 0%, #1a1f3a 50%, #2d1f4a 100%);
            padding: 0 12px;
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .auth-link {
            text-align: center;
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 24px;
            padding-top: 24px;
            border-top: var(--border-thin);
        }

        .auth-link a {
            color: var(--laser-blue);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .auth-link a:hover {
            color: var(--electric-violet);
        }

        .alert {
            padding: 12px 14px;
            border-radius: var(--radius-md);
            border-left: 3px solid;
            margin-bottom: 16px;
            font-size: 13px;
        }

        .alert-error {
            background: linear-gradient(135deg, rgba(239,68,68,0.1), rgba(239,68,68,0.05));
            border-left-color: #ef4444;
            color: #fca5a5;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(16,185,129,0.1), rgba(16,185,129,0.05));
            border-left-color: #10b981;
            color: #86efac;
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 13px;
            color: var(--text-secondary);
        }

        .checkbox-input {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            accent-color: var(--laser-blue);
            cursor: pointer;
        }

        .checkbox-group a {
            color: var(--laser-blue);
            text-decoration: none;
            transition: color 0.3s;
        }

        .checkbox-group a:hover {
            color: var(--electric-violet);
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 32px 20px;
            }

            .auth-title {
                font-size: 24px;
            }

            .auth-form {
                gap: 16px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="auth-container">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
