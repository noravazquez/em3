<?php
// session_start();

// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Pragma: no-cache");
// header("Expires: 0");

// if (!isset($_SESSION['id_usuario'])) {
//     header("Location: ../login.php");
//     exit;
// }

// require_once '../modelo/categoria.php';

// $categorias = obtenerCategorias();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Em3 - Proyectos</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56" href="assets/images/fav-icon/logo_em3.png">
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
</head>

<body class="min-h-screen bg-background font-source-sans">
    <!-- Header Navigation -->
    <header class="bg-surface architectural-shadow-strong sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="inline-flex items-center">
                            <div class="w-10 h-10 bg-accent rounded-lg flex items-center justify-center mr-3">
                                <img src="../assets/images/logo_menu.svg" alt="logo">
                            </div>
                            <span class="text-xl font-inter font-bold text-primary">Em3</span>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="./dashboard.php" class="text-text-secondary hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            Inicio
                        </a>
                        <a href="./project_gallery.php" class="bg-accent text-white px-3 py-2 rounded-md text-sm font-medium">
                            Proyectos
                        </a>
                    </div>
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
                            <a href="../modelo/logout.php" class="block px-4 py-2 text-sm text-error hover:bg-neutral-50">Cerrar sesión</a>
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
                <a href="./dashboard.php" class="text-text-secondary hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Inicio</a>
                <a href="./project_gallery.php" class="bg-accent-50 text-accent block px-3 py-2 rounded-md text-base font-medium">Proyectos</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-inter font-bold text-primary mb-2">Galería de proyectos</h1>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <button class="btn-primary" id="open-add-project">
                        <div style="display: flex; align-items: center;">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Nuevo Proyecto
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <div id="modal-add-project" class="fixed inset-0 z-50 hidden">
            <div class="fixed inset-0 bg-primary/80 backdrop-blur-sm" id="modalOverlay"></div>
            <div class="fixed inset-0 flex items-center justify-center p-4">
                <div class="bg-surface rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto modal">
                    <div class="p-6">
                        <!-- Modal Header -->
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-inter font-bold text-primary">Nuevo proyecto</h2>
                            <button id="close-add-project" class="p-2 hover:bg-neutral-100 rounded-lg transition-colors">
                                <svg class="w-6 h-6 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Content -->
                        <form method="POST" action="../modelo/proyecto.php" enctype="multipart/form-data" class="space-y-4">
                            <div>
                                <label for="name" class="block text-text-secondary mb-1">Nombre proyecto</label>
                                <input type="text" id="name" name="nombre" placeholder="Ej. Ampliación terraza" class="input-field" required />
                            </div>

                            <div>
                                <label for="description" class="block text-text-secondary mb-1">Descripción</label>
                                <textarea id="description" name="descripcion" rows="3" placeholder="Descripción del proyecto..." class="input-field" required></textarea>
                            </div>

                            <div>
                                <label for="category" class="block text-text-secondary mb-1">Categoría</label>
                                <select id="category" name="id_categoria" class="input-field" required>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?= $categoria['id_categoria'] ?>">
                                            <?= $categoria['categoria'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Image Upload -->
                            <div class="border-2 border-dashed border-neutral-300 rounded-lg p-4 text-center cursor-pointer hover:border-accent transition-all">
                                <input type="file" id="images" name="imagenes[]" accept="image/*" multiple class="hidden" />
                                <label for="images" class="cursor-pointer flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-accent mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 15a4 4 0 014-4h1a4 4 0 018 0h1a4 4 0 110 8H7a4 4 0 01-4-4z" />
                                    </svg>
                                    <span class="text-sm text-text-secondary">Click o arrastra imágenes para subir</span>
                                </label>
                            </div>

                            <!-- Preview container -->
                            <div id="preview" class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3"></div>

                            <!-- Actions -->
                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="submit" class="btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="mb-8">
            <div class="card">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Search -->
                    <div class="w-full">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Buscar proyectos..." class="input-field pl-10" />
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Gallery Grid -->
        <div id="projectGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Project Card 1 -->
            <div class="project-card card group cursor-pointer" data-category="commercial" data-status="completed" data-project="skyline-tower">
                <div class="relative overflow-hidden rounded-lg mb-4">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Skyline Tower" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300" onerror="this.src='https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-inter font-semibold text-primary">Proyecto 1</h3>
                        <span class="text-sm text-text-secondary">Categoria</span>
                    </div>
                    <p class="text-sm text-text-secondary">Descripcion.</p>
                    <div class="flex items-center justify-between pt-2">
                        <div class="flex items-center space-x-2">
                            <span class="text-xs text-text-secondary">Usuario agrego</span>
                        </div>
                        <span class="text-xs text-text-secondary">Jan 2024</span>
                    </div>
                </div>
            </div>

            <!-- Project Card 2 -->
            <div class="project-card card group cursor-pointer" data-category="residential" data-status="completed" data-project="harmony-residence">
                <div class="relative overflow-hidden rounded-lg mb-4">
                    <img src="https://images.pexels.com/photos/1109541/pexels-photo-1109541.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Harmony Residence" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300" onerror="this.src='https://images.pixabay.com/photo/2016/11/29/03/53/architecture-1867187_1280.jpg'; this.onerror=null;" />
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-4 right-4">
                        <span class="px-2 py-1 bg-success text-white text-xs font-medium rounded-full">Completed</span>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <h3 class="text-lg font-inter font-semibold mb-1">Harmony Residence</h3>
                        <p class="text-sm opacity-90">8,500 sq ft • 2024</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-inter font-semibold text-primary">Harmony Residence</h3>
                        <span class="text-sm text-text-secondary">Residential</span>
                    </div>
                    <p class="text-sm text-text-secondary">Luxury family home featuring open-concept living and seamless indoor-outdoor integration.</p>
                    <div class="flex items-center justify-between pt-2">
                        <div class="flex items-center space-x-2">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Team Member" class="w-6 h-6 rounded-full object-cover" onerror="this.src='https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                            <span class="text-xs text-text-secondary">Michael Torres</span>
                        </div>
                        <span class="text-xs text-text-secondary">Mar 2024</span>
                    </div>
                </div>
            </div>

            <!-- Project Card 3 -->
            <div class="project-card card group cursor-pointer" data-category="institutional" data-status="in-progress" data-project="innovation-center">
                <div class="relative overflow-hidden rounded-lg mb-4">
                    <img src="https://images.pixabay.com/photo/2017/07/09/03/19/home-2486092_1280.jpg" alt="Innovation Center" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300" onerror="this.src='https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'; this.onerror=null;" />
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-4 right-4">
                        <span class="px-2 py-1 bg-warning text-white text-xs font-medium rounded-full">In Progress</span>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <h3 class="text-lg font-inter font-semibold mb-1">Innovation Center</h3>
                        <p class="text-sm opacity-90">32,000 sq ft • 2025</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-inter font-semibold text-primary">Innovation Center</h3>
                        <span class="text-sm text-text-secondary">Institutional</span>
                    </div>
                    <p class="text-sm text-text-secondary">State-of-the-art research facility promoting collaboration and technological advancement.</p>
                    <div class="flex items-center justify-between pt-2">
                        <div class="flex items-center space-x-2">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b5bc?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Team Member" class="w-6 h-6 rounded-full object-cover" onerror="this.src='https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                            <span class="text-xs text-text-secondary">Elena Rodriguez</span>
                        </div>
                        <span class="text-xs text-text-secondary">Dec 2024</span>
                    </div>
                </div>
            </div>

            <!-- Project Card 4 -->
            <div class="project-card card group cursor-pointer" data-category="commercial" data-status="completed" data-project="urban-plaza">
                <div class="relative overflow-hidden rounded-lg mb-4">
                    <img src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Urban Plaza" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300" onerror="this.src='https://images.pexels.com/photos/1109541/pexels-photo-1109541.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-4 right-4">
                        <span class="px-2 py-1 bg-success text-white text-xs font-medium rounded-full">Completed</span>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <h3 class="text-lg font-inter font-semibold mb-1">Urban Plaza</h3>
                        <p class="text-sm opacity-90">28,000 sq ft • 2023</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-inter font-semibold text-primary">Urban Plaza</h3>
                        <span class="text-sm text-text-secondary">Commercial</span>
                    </div>
                    <p class="text-sm text-text-secondary">Mixed-use development creating vibrant community spaces with retail and office components.</p>
                    <div class="flex items-center justify-between pt-2">
                        <div class="flex items-center space-x-2">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Team Member" class="w-6 h-6 rounded-full object-cover" onerror="this.src='https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                            <span class="text-xs text-text-secondary">David Kim</span>
                        </div>
                        <span class="text-xs text-text-secondary">Sep 2023</span>
                    </div>
                </div>
            </div>

            <!-- Project Card 5 -->
            <div class="project-card card group cursor-pointer" data-category="residential" data-status="planning" data-project="eco-village">
                <div class="relative overflow-hidden rounded-lg mb-4">
                    <img src="https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Eco Village" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300" onerror="this.src='https://images.pixabay.com/photo/2016/11/29/03/53/architecture-1867187_1280.jpg'; this.onerror=null;" />
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-4 right-4">
                        <span class="px-2 py-1 bg-accent text-white text-xs font-medium rounded-full">Planning</span>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <h3 class="text-lg font-inter font-semibold mb-1">Eco Village</h3>
                        <p class="text-sm opacity-90">125,000 sq ft • 2025</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-inter font-semibold text-primary">Eco Village</h3>
                        <span class="text-sm text-text-secondary">Residential</span>
                    </div>
                    <p class="text-sm text-text-secondary">Sustainable community development featuring net-zero energy homes and shared green spaces.</p>
                    <div class="flex items-center justify-between pt-2">
                        <div class="flex items-center space-x-2">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b5bc?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Team Member" class="w-6 h-6 rounded-full object-cover" onerror="this.src='https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                            <span class="text-xs text-text-secondary">Lisa Wang</span>
                        </div>
                        <span class="text-xs text-text-secondary">Q2 2025</span>
                    </div>
                </div>
            </div>

            <!-- Project Card 6 -->
            <div class="project-card card group cursor-pointer" data-category="institutional" data-status="in-progress" data-project="cultural-center">
                <div class="relative overflow-hidden rounded-lg mb-4">
                    <img src="https://images.pixabay.com/photo/2016/11/29/03/53/architecture-1867187_1280.jpg" alt="Cultural Center" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300" onerror="this.src='https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'; this.onerror=null;" />
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-4 right-4">
                        <span class="px-2 py-1 bg-warning text-white text-xs font-medium rounded-full">In Progress</span>
                    </div>
                    <div class="absolute bottom-4 left-4 right-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <h3 class="text-lg font-inter font-semibold mb-1">Cultural Center</h3>
                        <p class="text-sm opacity-90">18,500 sq ft • 2024</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-inter font-semibold text-primary">Cultural Center</h3>
                        <span class="text-sm text-text-secondary">Institutional</span>
                    </div>
                    <p class="text-sm text-text-secondary">Community arts facility with performance spaces, galleries, and educational workshops.</p>
                    <div class="flex items-center justify-between pt-2">
                        <div class="flex items-center space-x-2">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Team Member" class="w-6 h-6 rounded-full object-cover" onerror="this.src='https://images.pexels.com/photos/614810/pexels-photo-614810.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'; this.onerror=null;" />
                            <span class="text-xs text-text-secondary">James Park</span>
                        </div>
                        <span class="text-xs text-text-secondary">Nov 2024</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Project data
        const projectData = {
            'skyline-tower': {
                title: 'Skyline Tower',
                category: 'Commercial',
                status: 'Completed',
                size: '45,000 sq ft',
                completion: 'January 2024',
                teamName: 'Sarah Chen',
                teamImage: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                mainImage: 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                description: 'A modern office complex featuring sustainable design principles, innovative workspace solutions, and cutting-edge technology integration. The building incorporates energy-efficient systems, natural lighting optimization, and flexible floor plans to accommodate evolving business needs.'
            },
            'harmony-residence': {
                title: 'Harmony Residence',
                category: 'Residential',
                status: 'Completed',
                size: '8,500 sq ft',
                completion: 'March 2024',
                teamName: 'Michael Torres',
                teamImage: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                mainImage: 'https://images.pexels.com/photos/1109541/pexels-photo-1109541.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                description: 'A luxury family home designed with open-concept living spaces and seamless indoor-outdoor integration. Features include a gourmet kitchen, spa-like master suite, and entertainment areas that flow naturally into landscaped outdoor spaces.'
            },
            'innovation-center': {
                title: 'Innovation Center',
                category: 'Institutional',
                status: 'In Progress',
                size: '32,000 sq ft',
                completion: 'December 2024',
                teamName: 'Elena Rodriguez',
                teamImage: 'https://images.unsplash.com/photo-1494790108755-2616b612b5bc?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                mainImage: 'https://images.pixabay.com/photo/2017/07/09/03/19/home-2486092_1280.jpg',
                description: 'A state-of-the-art research facility designed to promote collaboration and technological advancement. The building features flexible laboratory spaces, collaborative work areas, and advanced infrastructure to support cutting-edge research initiatives.'
            }
        };

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

        // Filter functionality
        const searchInput = document.getElementById('searchInput');
        const projectCards = document.querySelectorAll('.project-card');

        function filterProjects() {
            const searchTerm = searchInput.value.toLowerCase();

            projectCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const description = card.querySelector('p').textContent.toLowerCase();
                const category = card.dataset.category;
                const status = card.dataset.status;

                const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
                const matchesCategory = !categoryValue || category === categoryValue;
                const matchesStatus = !statusValue || status === statusValue;

                if (matchesSearch && matchesCategory && matchesStatus) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterProjects);

        // Open modal to add 
        const btnOpenAddProject = document.querySelector("#open-add-project");
        const btnCloseAddProject = document.querySelector("#close-add-project");
        const modalAddProject = document.querySelector("#modal-add-project");
        const modalOverlay = document.getElementById('modalOverlay');

        btnOpenAddProject.addEventListener("click", () => {
            modalAddProject.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });

        function closeModalHandlerAddProject() {
            modalAddProject.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        btnCloseAddProject.addEventListener('click', closeModalHandlerAddProject);
        modalOverlay.addEventListener('click', closeModalHandlerAddProject);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modalAddProject.classList.contains('hidden')) {
                closeModalHandlerAddProject();
            }
        });

        //Images preview
        (function() {
            const form = document.querySelector('form');
            const input = document.getElementById('images');
            const label = document.querySelector('label[for="images"]');
            const preview = document.getElementById('preview');

            let selectedFiles = []; // array que guarda todos los archivos seleccionados

            // Limpia input antes de abrir el selector para que el "change" siempre dispare aunque se seleccione el mismo archivo
            label.addEventListener('click', () => {
                input.value = '';
            });

            input.addEventListener('change', (event) => {
                const files = Array.from(event.target.files);

                files.forEach(file => {
                    if (!file.type.startsWith('image/')) return;

                    // Evitar duplicados por name+size+lastModified
                    const exists = selectedFiles.some(f =>
                        f.name === file.name && f.size === file.size && f.lastModified === file.lastModified
                    );
                    if (!exists) selectedFiles.push(file);
                });

                updatePreview();
                updateInputFiles(); // sincroniza input.files con selectedFiles
            });

            function updatePreview() {
                preview.innerHTML = '';

                selectedFiles.forEach((file, index) => {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'preview-wrapper';

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = file.name;
                        img.className = 'preview-img';

                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.innerHTML = '&times;';
                        btn.className = 'remove-btn';
                        btn.addEventListener('click', () => removeFile(index));

                        wrapper.appendChild(img);
                        wrapper.appendChild(btn);
                        preview.appendChild(wrapper);
                    };
                    reader.readAsDataURL(file);
                });
            }

            function updateInputFiles() {
                // Reconstruye un FileList a partir de selectedFiles usando DataTransfer
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(f => dataTransfer.items.add(f));
                input.files = dataTransfer.files;
            }

            function removeFile(index) {
                selectedFiles.splice(index, 1);
                updatePreview();
                updateInputFiles();
            }

            form.addEventListener('submit', function(e) {
                if (selectedFiles.length === 0) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Estimado usuario.",
                        text: "Por favor, seleccione por lo menos una imagen antes de guardar.",
                        icon: "warning",
                        showCloseButton: true,
                        showConfirmButton: false
                    });
                }
            });
        })();
    </script>
</body>

</html>