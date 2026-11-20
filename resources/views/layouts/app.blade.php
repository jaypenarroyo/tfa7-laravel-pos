<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A four-page Laravel point-of-sale foundation project.">
    <title>@yield('title', 'POS Foundations')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="{{ route('home') }}" aria-label="POS Foundations home">
                <span class="brand-mark">PF</span>
                <span>POS Foundations</span>
            </a>
            <nav aria-label="Primary navigation">
                <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                <a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                <a class="{{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">Customers</a>
                <a class="{{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a>
            </nav>
        </div>
    </header>

    @if (session('success'))
        <div class="container flash-success" role="status">{{ session('success') }}</div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container footer-wrap">
            <span>POS Foundations</span>
            <span>Built with Laravel and Blade</span>
        </div>
    </footer>
</body>
</html>
