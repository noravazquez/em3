<?php
require_once "../../config/database.php";
require_once "../../lib/auth.php";

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if (!checkAuth()) {
    header("Location: ../login.php");
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Em3 - Proyectos administración</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56" href="assets/images/fav-icon/logo_em3.png">
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
</head>

<body>
    <!-- Header Navigation -->
    <header class="bg-surface architectural-shadow-strong sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo and Brand -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="inline-flex items-center justify-center w-10 h-10 bg-accent rounded-lg mr-3">
                            <img src="../assets/images/logo_menu.svg" alt="logo">
                        </div>
                        <div>
                            <h1 class="text-xl font-inter font-bold text-primary">Em3</h1>
                            <p class="text-xs text-text-secondary">CONSTRUCCIONES</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="hidden md:flex space-x-8">
                    <a href="./dashboard.php" class="text-accent font-medium px-3 py-2 rounded-md text-sm">
                        Inicio
                    </a>
                    <a href="./project_gallery.php" class="text-text-secondary hover:text-primary transition-colors px-3 py-2 rounded-md text-sm">
                        Proyectos
                    </a>
                </nav>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <!-- User Profile -->
                    <div class="relative">
                        <button id="userMenuButton" class="flex items-center space-x-3 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-accent-500">
                            <img class="h-8 w-8 rounded-full object-cover" src="../assets/images/dashboard/user.png" alt="User Avatar" />
                            <span class="hidden md:block font-medium text-text-primary" id="userName"><?php echo $_SESSION['usuario']; ?></span>
                            <svg class="w-4 h-4 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-surface rounded-lg architectural-shadow-strong py-1 z-50">
                            <a href="../logout.php" class="block px-4 py-2 text-sm text-error hover:bg-neutral-50">Cerrar sesión</a>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuButton" class="md:hidden p-2 text-text-secondary hover:text-primary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobileMenu" class="hidden md:hidden bg-surface border-t border-neutral-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="./dashboard.php" class="bg-accent-50 text-accent block px-3 py-2 rounded-md text-base font-medium">Inicio</a>
                <a href="./project_gallery.php" class="text-text-secondary hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Proyectos</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="mb-8">
            <div>
                <h1 class="text-3xl font-inter font-bold text-primary mb-2">BIENVENIDO/A</h1>
                <p class="text-text-secondary">Aquí podrás ver la administración de proyectos.</p>
            </div>
        </div>

        <!-- Main Dashboard Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Recent Projects & Activity -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Recent Projects -->
                <section>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-inter font-semibold text-primary">Proyectos recientes</h2>
                        <a href="./project_gallery.php" class="text-accent hover:text-accent-700 text-sm font-medium transition-colors">
                            Todos los proyectos →
                        </a>
                    </div>

                    <div class="space-y-4">
                        <!-- Project Card 1 -->
                        <div class="card hover:shadow-architectural-strong transition-all duration-300">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="h-16 w-16 rounded-lg object-cover" src="https://images.pexels.com/photos/1109541/pexels-photo-1109541.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Modern Office Complex" onerror="this.src='https://images.pixabay.com/photo/2016/11/29/03/53/architecture-1867187_1280.jpg'; this.onerror=null;" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-inter font-semibold text-primary">Proyecto 1</h3>
                                    <p class="text-sm text-text-secondary">Descripcion</p>
                                    <span class="text-sm text-text-secondary">Fecha: 12 de julio del 2025</span>
                                </div>
                            </div>
                        </div>

                        <!-- Project Card 2 -->
                        <div class="card hover:shadow-architectural-strong transition-all duration-300">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="h-16 w-16 rounded-lg object-cover" src="https://images.pixabay.com/photo/2017/07/09/03/19/home-2486092_1280.jpg" alt="Luxury Residential Villa" onerror="this.src='https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'; this.onerror=null;" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-inter font-semibold text-primary">Proyecto 2</h3>
                                    <p class="text-sm text-text-secondary">Descripcion</p>
                                    <span class="text-sm text-text-secondary">Fecha: 12 de julio del 2025</span>
                                </div>
                            </div>
                        </div>

                        <!-- Project Card 3 -->
                        <div class="card hover:shadow-architectural-strong transition-all duration-300">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="h-16 w-16 rounded-lg object-cover" src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Cultural Center Renovation" onerror="this.src='https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-inter font-semibold text-primary">Proyecto 3</h3>
                                    <p class="text-sm text-text-secondary">Descripcion</p>
                                    <span class="text-sm text-text-secondary">Fecha: 12 de julio del 2025</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Recent Activity -->
                <section>
                    <h2 class="text-xl font-inter font-semibold text-primary mb-6">Actividad reciente</h2>
                    <div class="card">
                        <div class="space-y-4">
                            <!-- Activity Item 1 -->
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-success-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-success" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-text-primary">
                                        <span class="font-medium">Sarah Johnson</span> approved the design revisions for
                                        <span class="font-medium">Modern Office Complex</span>
                                    </p>
                                    <p class="text-xs text-text-secondary">2 hours ago</p>
                                </div>
                            </div>

                            <!-- Activity Item 2 -->
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-accent-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-accent" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-text-primary">
                                        New milestone reached for <span class="font-medium">Luxury Residential Villa</span> -
                                        Foundation completed
                                    </p>
                                    <p class="text-xs text-text-secondary">5 hours ago</p>
                                </div>
                            </div>

                            <!-- Activity Item 3 -->
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-secondary-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-secondary" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-text-primary">
                                        <span class="font-medium">Mike Chen</span> uploaded new construction photos for
                                        <span class="font-medium">Cultural Center Renovation</span>
                                    </p>
                                    <p class="text-xs text-text-secondary">1 day ago</p>
                                </div>
                            </div>

                            <!-- Activity Item 4 -->
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-warning-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-warning" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-text-primary">
                                        Meeting scheduled with client for <span class="font-medium">Eco-Friendly Office Building</span>
                                        project review
                                    </p>
                                    <p class="text-xs text-text-secondary">2 days ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Right Column - Quick Actions & Notifications -->
            <div class="space-y-8">
                <!-- Quick Actions -->
                <section>
                    <h2 class="text-xl font-inter font-semibold text-primary mb-6">Metricas</h2>
                    <div class="card">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-accent-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-text-secondary">Proyectos totales</p>
                                <p class="text-2xl font-inter font-bold text-primary">12</p>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 10px;">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-secondary-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-text-secondary">Usuarios totales</p>
                                <p class="text-2xl font-inter font-bold text-primary">24</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <script>
        // User menu dropdown
        document.getElementById('userMenuButton').addEventListener('click', function() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        });

        // Mobile menu toggle
        document.getElementById('mobileMenuButton').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('userMenuButton');
            const userDropdown = document.getElementById('userDropdown');

            if (!userMenu.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }
        });
    </script>
</body>

</html>