<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'BookStore') - Online Bookstore</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #6366f1; /* Indigo */
            --primary-dark: #4338ca;
            --accent: #f59e0b; /* Amber */
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --bg-body: #0f172a;
            --bg-card: rgba(30, 41, 59, 0.7);
            --glass-border: rgba(255, 255, 255, 0.1);
            --success: #22c55e;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            background-image:
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(245, 158, 11, 0.05) 0px, transparent 50%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        nav {
            padding: 1.2rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text-main);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            letter-spacing: -0.5px;
        }

        .logo i {
            color: var(--primary);
        }

        .logo span {
            color: var(--primary);
        }

        .nav-links {
            display: flex;
            gap: 1.8rem;
            align-items: center;
        }

        .nav-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
            font-size: 0.95rem;
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--text-main);
        }

        .btn {
            padding: 0.6rem 1.4rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
            cursor: pointer;
            border: none;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px var(--primary);
        }

        .btn-outline {
            border: 1px solid var(--glass-border);
            color: var(--text-main);
            background: rgba(255, 255, 255, 0.05);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Main Content */
        main {
            flex: 1;
            padding: 3rem 5%;
        }

        /* Footer */
        footer {
            padding: 3rem 5%;
            background: rgba(15, 23, 42, 0.9);
            border-top: 1px solid var(--glass-border);
            text-align: center;
            color: var(--text-muted);
        }

        footer .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 1.5rem;
        }

        footer .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            transition: 0.3s;
        }

        footer .footer-links a:hover {
            color: var(--text-main);
        }

        /* Glassmorphism Card */
        .glass-card {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.2);
            color: #86efac;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }

        /* Badges */
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 99px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-primary { background: rgba(99, 102, 241, 0.2); color: #a5b4fc; }
        .badge-success { background: rgba(34, 197, 94, 0.2); color: #86efac; }
        .badge-warning { background: rgba(245, 158, 11, 0.2); color: #fcd34d; }

        .auth-container {
            max-width: 500px;
            margin: 4rem auto;
            padding: 0 1.5rem;
        }

        .form-control {
            width: 100%;
            padding: 1.1rem 1.5rem;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 14px;
            color: white;
            font-size: 1rem;
            transition: 0.3s;
            outline: none;
        }

        select.form-control {
            cursor: pointer;
        }

        select.form-control option {
            background-color: #1e293b;
            color: white;
            padding: 1rem;
        }

        .form-control:focus {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                gap: 1.5rem;
                padding: 1.5rem;
            }

            .nav-links {
                gap: 1rem;
                font-size: 0.85rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            main {
                padding: 2rem 5%;
            }

            .auth-container {
                margin: 2rem auto;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav>
        <a href="/" class="logo"><i class="fas fa-book-open"></i> Book<span>Store</span></a>
        <div class="nav-links">
            <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="{{ Request::is('about') ? 'active' : '' }}">About Us</a>
            <a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a>

            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                @else
                    <a href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i> Cart</a>
                    <a href="{{ route('orders.history') }}">My Orders</a>
                @endif

                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="padding: 0.4rem 1rem;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            @endauth
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <ul style="margin-left: 1rem; list-style: none;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="footer-links">
            <a href="/">Home</a>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
        <p>&copy; {{ date('Y') }} BookStore. All rights reserved.</p>
    </footer>

    @yield('scripts')
</body>
</html>
