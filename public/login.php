<?php
require_once "../config/database.php";
require_once "../lib/auth.php";

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if (checkAuth()) {
    header("Location: admin/dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if (login($usuario, $password, $db)) {
        header("Location: admin/dashboard.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}

?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Em3 - Login</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56" href="assets/images/fav-icon/logo_em3.png">
</head>

<body class="min-h-screen bg-background font-source-sans">
    <!-- Background Carousel -->
    <div class="fixed inset-0 z-0">
        <div class="relative w-full h-full overflow-hidden">
            <div id="carousel-container" class="w-full h-full">
                <!-- Slide 1 -->
                <div class="carousel-slide absolute inset-0 opacity-100 transition-opacity duration-1000">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Modern Architecture" class="w-full h-full object-cover" onerror="this.src='https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                    <div class="absolute inset-0 bg-primary opacity-60"></div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                    <img src="https://images.pexels.com/photos/1109541/pexels-photo-1109541.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Architectural Design" class="w-full h-full object-cover" onerror="this.src='https://images.pixabay.com/photo/2016/11/29/03/53/architecture-1867187_1280.jpg'; this.onerror=null;" />
                    <div class="absolute inset-0 bg-primary opacity-60"></div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                    <img src="https://images.pixabay.com/photo/2017/07/09/03/19/home-2486092_1280.jpg" alt="Contemporary Building" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'; this.onerror=null;" />
                    <div class="absolute inset-0 bg-primary opacity-60"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Logo and Brand -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-accent rounded-xl mb-4 architectural-shadow">
                    <img src="assets/images/logo_menu.svg" alt="logo">
                </div>
                <h1 class="text-3xl font-inter font-bold text-white mb-2">Em3</h1>
                <p class="text-neutral-200 text-lg">CONSTRUCCIONES S.A. DE C.V.</p>
            </div>

            <!-- Login Card -->
            <div class="card bg-surface/95 backdrop-blur-sm architectural-shadow-strong">
                <div class="mb-6">
                    <h2 class="text-2xl font-inter font-semibold text-primary mb-2">BIENVENIDO/A</h2>
                </div>

                <!-- Login Form -->
                <form id="loginForm" class="space-y-6" method="POST">
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-text-primary mb-2">CORREO ELECTRONICO</label>
                        <div class="relative">
                            <input type="email" id="email" name="usuario" class="input-field pl-12" placeholder="Ingresa tu correo" required />
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-text-primary mb-2">CONTRASEÑA</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="input-field pl-12 pr-12" placeholder="Ingresa tu contraseña" required />
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="h-5 w-5 text-neutral-400 hover:text-neutral-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" id="loginButton" class="btn-primary w-full">
                        <span id="loginText">Iniciar sesión</span>
                        <div id="loginSpinner" class="hidden inline-flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                            </svg>
                            Autenticando...
                        </div>
                    </button>

                    <?php if (!empty($error)) echo "<p>$error</p>" ?>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Carousel functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const totalSlides = slides.length;

        function nextSlide() {
            slides[currentSlide].classList.remove('opacity-100');
            slides[currentSlide].classList.add('opacity-0');

            currentSlide = (currentSlide + 1) % totalSlides;

            slides[currentSlide].classList.remove('opacity-0');
            slides[currentSlide].classList.add('opacity-100');
        }

        // Auto-advance carousel every 5 seconds
        setInterval(nextSlide, 5000);

        // Password toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle icon
            const icon = this.querySelector('svg');
            if (type === 'text') {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>';
            } else {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            }
        });
    </script>
</body>

</html>