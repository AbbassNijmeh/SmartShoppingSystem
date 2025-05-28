<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $setting->name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <!-- Add these in your <head> section -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Optional Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('admin_assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('admin_assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/magnific-popup.css') }}">
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('admin_assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.dataTables.min.css" rel="stylesheet">
    <style>
        /* Redesigned Color Scheme */
        body {
            font-family: 'Spectral', serif;
            background-color: white !important;
            color: #343a40;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar .nav-link {
            color: #ffffff;
            transition: color 0.3s ease;
        }

        .navbar .nav-link:hover {
            color: #ffc107;
        }

        .navbar-brand {
            color: #ffffff;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar-brand:hover {
            color: #ffc107;
        }

        /* Error/Success Message Container */
        .message-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
            width: 90%;
        }

        /* Base Message Card */
        .message-card {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            animation: slideIn 0.3s ease-out forwards;
            position: relative;
            overflow: hidden;
        }

        /* Error Message Styling */
        .error-card {
            background: #f8d7da;
            border-left: 6px solid #dc3545;
        }

        .error-icon {
            color: #dc3545;
        }

        .error-message {
            color: #721c24;
        }

        /* Success Message Styling */
        .success-card {
            background: #d4edda;
            border-left: 6px solid #28a745;
        }

        .success-icon {
            color: #28a745;
        }

        .success-message {
            color: #155724;
        }

        /* Warning Message Styling */
        .warning-card {
            background: #fff3cd;
            border-left: 6px solid #ffc107;
        }

        .warning-icon {
            color: #ffc107;
        }

        .warning-message {
            color: #856404;
        }

        /* Common Icon Styling */
        .message-icon {
            font-size: 1.8rem;
            margin-right: 1rem;
            min-width: 30px;
        }

        /* Message Content */
        .message-content {
            flex-grow: 1;
            font-size: 1rem;
            padding-right: 1.5rem;
        }

        /* Dismiss Button */
        .message-dismiss {
            position: absolute;
            top: 8px;
            right: 8px;
            background: none;
            border: none;
            color: inherit;
            opacity: 0.7;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .message-dismiss:hover {
            opacity: 1;
        }

        /* Animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                height: 0;
                padding: 0;
                margin: 0;
                transform: translateX(100%);
            }
        }

        /* Stacking effect for multiple messages */
        .message-stack div:nth-child(1) {
            z-index: 3;
        }

        .message-stack div:nth-child(2) {
            transform: translateY(20px) scale(0.95);
            z-index: 2;
        }

        .message-stack div:nth-child(3) {
            transform: translateY(40px) scale(0.9);
            z-index: 1;
        }

        .message-stack div:nth-child(n+4) {
            display: none;
        }

        /* Footer Styling (existing) */
        .ftco-footer {
            border-top: 3px solid #007bff;
        }

        .ftco-footer a:hover {
            color: #007bff !important;
            transform: translateX(5px);
            transition: all 0.3s ease;
        }

        .social-icons a {
            color: #ffffff;
            margin-right: 10px;
            transition: transform 0.3s ease;
        }

        .social-icons a:hover {
            transform: scale(1.2);
        }
    </style>

<body style="background-color: white !important;">
    <!-- Error Messages -->
    @if ($errors->any())
        <div class="message-container">
            <div class="message-stack">
                @foreach ($errors->all() as $error)
                    <div class="message-card error-card">
                        <div class="message-icon error-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="message-content error-message">
                            {{ $error }}
                        </div>
                        <button class="message-dismiss"
                            onclick="this.parentElement.style.animation='fadeOut 0.3s forwards'">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Success Messages -->
    @if (session('success'))
        <div class="message-container">
            <div class="message-stack">
                <div class="message-card success-card">
                    <div class="message-icon success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="message-content success-message">
                        {{ session('success') }}
                    </div>
                    <button class="message-dismiss"
                        onclick="this.parentElement.style.animation='fadeOut 0.3s forwards'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Warning/Error Messages -->
    @if (session('error'))
        <div class="message-container">
            <div class="message-stack">
                <div class="message-card warning-card">
                    <div class="message-icon warning-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="message-content warning-message">
                        {{ session('error') }}
                    </div>
                    <button class="message-dismiss"
                        onclick="this.parentElement.style.animation='fadeOut 0.3s forwards'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif



    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-store-alt me-2"></i>{{ $setting->name }}
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <!-- Home -->
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link px-3">
                            <i class="fas fa-home fa-2x"></i>
                            <span class="d-inline d-lg-none px-2">Home </span>
                        </a>
                    </li>

                    <!-- Cart -->
                    <li class="nav-item dropdown">
                        <a class="nav-link px-3 position-relative" href="#" id="cartDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-shopping-cart fa-2x"></i>
                            <span class="d-inline d-lg-none px-2">Cart </span> <!-- Show on mobile, hide on lg+ -->

                            @auth
                                @php $cartCount = Auth::user()->cart->count(); @endphp
                                @if ($cartCount > 0)
                                    <span
                                        class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle shadow-sm"
                                        style="font-size: 0.75rem; padding: 0.4em 0.6em;" id="cart-count">
                                        {{ $cartCount }}
                                    </span>
                                @else
                                    <span
                                        class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle shadow-sm"
                                        style="font-size: 0.75rem; padding: 0.4em 0.6em;" id="cart-count">
                                        0
                                    </span>
                                @endif
                            @else
                                <span
                                    class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle shadow-sm"
                                    style="font-size: 0.75rem; padding: 0.4em 0.6em;" id="cart-count">
                                    0
                                </span>
                            @endauth
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="cartDropdown"
                            style="min-width: 320px;" id="cart-preview-list">
                            @auth
                                @if (Auth::user()->cart->isEmpty())
                                    <li class="text-center text-muted py-2">Your cart is empty.</li>
                                @else
                                    @foreach (Auth::user()->cart->take(4) as $cartItem)
                                        <li class="d-flex align-items-center mb-2">
                                            <img src="{{ asset($cartItem->product->image) }}"
                                                alt="{{ $cartItem->product->name }}" class="rounded"
                                                style="width: 48px; height: 48px; object-fit: cover;">
                                            <div class="ms-2 flex-grow-1">
                                                <div class="fw-bold">{{ $cartItem->product->name }}</div>
                                                <div class="small text-muted">
                                                    ${{ number_format($cartItem->product->price, 2) }} &times;
                                                    {{ $cartItem->quantity }}</div>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-center btn btn-primary"
                                            href="{{ route('cart.show') }}">View All Cart</a>
                                    </li>
                                @endif
                            @else
                                <li class="text-center text-muted py-2">Please <a href="{{ route('login') }}">login</a>
                                    to view your cart.</li>
                            @endauth
                        </ul>
                    </li>

                    <!-- Wishlist -->
                    <li class="nav-item dropdown">
                        <a class="nav-link px-3 position-relative" href="#" id="wishlistDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-heart fa-2x"></i>
                            <span class="d-inline d-lg-none px-2">Wishlist </span> <!-- Show on mobile, hide on lg+ -->

                            @auth
                                @php $wishlistCount = Auth::user()->wishlist->count(); @endphp
                                @if ($wishlistCount > 0)
                                    <span
                                        class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle shadow-sm"
                                        style="font-size: 0.75rem; padding: 0.4em 0.6em;" id="wishlist-count">
                                        {{ $wishlistCount }}
                                    </span>
                                @else
                                    <span
                                        class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle shadow-sm"
                                        style="font-size: 0.75rem; padding: 0.4em 0.6em;" id="wishlist-count">
                                        0
                                    </span>
                                @endif
                            @else
                                <span
                                    class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle shadow-sm"
                                    style="font-size: 0.75rem; padding: 0.4em 0.6em;" id="wishlist-count">
                                    0
                                </span>
                            @endauth
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="wishlistDropdown"
                            id="wishlist-preview-list" style="min-width: 320px;">
                            @auth
                                @if (Auth::user()->wishlist->isEmpty())
                                    <li class="text-center text-muted py-2">Your wishlist is empty.</li>
                                @else
                                    @foreach (Auth::user()->wishlist->take(4) as $wishlistItem)
                                        <li class="d-flex align-items-center mb-2">
                                            <img src="{{ asset($wishlistItem->product->image) }}"
                                                alt="{{ $wishlistItem->product->name }}" class="rounded"
                                                style="width: 48px; height: 48px; object-fit: cover;">
                                            <div class="ms-2 flex-grow-1">
                                                <div class="fw-bold">{{ $wishlistItem->product->name }}</div>
                                                <div class="small text-muted">
                                                    ${{ number_format($wishlistItem->product->price, 2) }}</div>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-center btn btn-primary"
                                            href="{{ route('wishlist.index') }}">View All Wishlist</a>
                                    </li>
                                @endif
                            @else
                                <li class="text-center text-muted py-2">Please <a href="{{ route('login') }}">login</a>
                                    to view your wishlist.</li>
                            @endauth
                        </ul>
                    </li>

                    <!-- User/Account -->
                    <li class="nav-item dropdown">
                        <a class="nav-link px-3" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user fa-2x"></i>
                            <span class="d-inline d-lg-none px-2 ">My Account </span>
                            <!-- Show on mobile, hide on lg+ -->

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @guest
                                <li>
                                    <a class="dropdown-item" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-2"></i>Login
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-2"></i>Register
                                    </a>
                                </li>
                            @else
                                <li>
                                    <span class="dropdown-item text-center fw-bold">{{ Auth::user()->name }}</span>
                                </li>
                                @if (Auth::user()->isAdmin())
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard.index') }}">
                                            <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                                        </a>
                                    </li>
                                @elseif (Auth::user()->isDelivery())
                                    <li>
                                        <a class="dropdown-item" href="{{ route('delivery.index') }}">
                                            <i class="fas fa-tachometer-alt me-2"></i>Delivery Page
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="fas fa-user-circle me-2"></i>Manage Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.allergies') }}">
                                        <i class="fas fa-allergies me-2"></i>Manage Allergies
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('user.orderHistory') }}">
                                        <i class="fas fa-history me-2"></i>Order History
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item text-danger" data-bs-toggle="modal"
                                        data-bs-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </a>
                                </li>
                            @endguest
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    @yield('body')

    <hr>
    <footer class="ftco-footer bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-md-6 col-lg-3">
                    <div class="mb-4">
                        <h2 class="h4 mb-3">
                            <a href="#" class="text-white text-decoration-none">{{ $setting->name }}</a>
                        </h2>
                        <p>Far far away, behind the word mountains, far from the countries.</p>
                        <div class="social-icons mt-4">
                            <a href="{{ $setting->facebook }}" class="text-white me-3" target="_blank">
                                <i class="fab fa-facebook-f fa-lg"></i>
                            </a>

                            <a href="{{ $setting->instagram }}" class="text-white me-3" target="_blank">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                            <a href="{{ $setting->tiktok }}" class="text-white" target="_blank">
                                <i class="fab fa-tiktok fa-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-md-6 col-lg-3">
                    <div class="mb-4 ">
                        <h3 class="h5 mb-3 text-white">My Account</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('profile.show') }}" class="text-white text-decoration-none">
                                    <i class="fas fa-user-circle me-2"></i>My Profile
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('user.orderHistory') }}" class="text-white text-decoration-none">
                                    <i class="fas fa-history me-2"></i>Order History
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('login') }}" class="text-white text-decoration-none">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="text-white text-decoration-none">
                                    <i class="fas fa-user-plus me-2"></i>Register
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-md-6 col-lg-3">
                    <div class="mb-4">
                        <h3 class="h5 mb-3  text-white">Contact Us</h3>
                        <ul class="list-unstyled text-muted">
                            <li class="mb-3">
                                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                {{ $setting->address }}
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-phone-volume me-2 text-primary"></i>
                                <a href="tel:{{ $setting->phone }}" class="text-white text-decoration-none">
                                    {{ $setting->phone }}
                                </a>
                            </li>
                            <li>
                                <i class="fas fa-envelope me-2 text-primary"></i>
                                <a href="mailto:{{ $setting->email }}" class="text-white text-decoration-none">
                                    {{ $setting->email }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="col-md-6 col-lg-3">
                    <div class="mb-4">
                        <h3 class="h5 mb-3  text-white">Newsletter</h3>
                        <form class="subscribe-form">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Enter your email">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                        <small class="text-muted">Subscribe to get latest updates</small>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 text-center">
                    <p class="mb-0 text-muted">
                        © {{ date('Y') }} {{ $setting->name }}. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="button"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>

    <script>
        function showMessage(message, backgroundColor) {
            const messageHtml = `
        <div id="success-message" style="position: fixed; top: 20px; left: 20px; padding: 10px 20px;
            background-color: ${backgroundColor}; color: white; border-radius: 5px; z-index: 1000; font-size: 16px;">
            ${message}
        </div>`;
            $('body').append(messageHtml);

            setTimeout(function() {
                $('#success-message').fadeOut('slow', function() {
                    $(this).remove(); // Ensure the element is removed after fading out
                });
            }, 4000);
        }
    </script>
    <script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/scrollax.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/google-map.js') }}"></script>
    <script src="{{ asset('admin_assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    @stack('script')
    <script>
        function updateCartPreview(response) {
            let cartItemsHtml = '';

            if (response.items.length > 0) {
                response.items.slice(0, 4).forEach(item => {
                    cartItemsHtml += `
                <li class="d-flex align-items-center mb-2">
                    <img src="${item.image}" alt="${item.name}" class="rounded" style="width: 48px; height: 48px; object-fit: cover;">
                    <div class="ms-2 flex-grow-1">
                        <div class="fw-bold">${item.name}</div>
                        <div class="small text-muted">$${parseFloat(item.price).toFixed(2)} &times; ${item.quantity}</div>
                    </div>
                </li>`;
                });

                cartItemsHtml += '<li><hr class="dropdown-divider"></li>';
                cartItemsHtml +=
                    '<li><a class="dropdown-item text-center btn btn-primary" href="/cart">View All Cart</a></li>';
            } else {
                cartItemsHtml = '<li class="text-center text-muted py-2">Your cart is empty.</li>';
            }
            document.getElementById('cart-count').innerHTML = response.totalItems; // Update the cart count

            document.getElementById('cart-preview-list').innerHTML = cartItemsHtml;
        }
    </script>
    <script>
        function updateWishListPreview(response) {
            let cartItemsHtml = '';

            if (response.items.length > 0) {
                response.items.slice(0, 4).forEach(item => {
                    cartItemsHtml += `
                <li class="d-flex align-items-center mb-2">
                    <img src="${item.image}" alt="${item.name}" class="rounded" style="width: 48px; height: 48px; object-fit: cover;">
                    <div class="ms-2 flex-grow-1">
                        <div class="fw-bold">${item.name}</div>
                        <div class="small text-muted">$${parseFloat(item.price).toFixed(2)} </div>
                    </div>
                </li>`;
                });

                cartItemsHtml += '<li><hr class="dropdown-divider"></li>';
                cartItemsHtml +=
                    '<li><a class="dropdown-item text-center btn btn-primary" href="/cart">View All Cart</a></li>';
            } else {
                cartItemsHtml = '<li class="text-center text-muted py-2">Your cart is empty.</li>';
            }
            document.getElementById('wishlist-count').innerHTML = response.totalItems; // Update the cart count
            document.getElementById('wishlist-preview-list').innerHTML = cartItemsHtml;
        }
    </script>
</body>

</html>
