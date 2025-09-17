<?php
require_once "../../config/database.php";
require_once "../../lib/auth.php";
require_once "../../lib/projects.php";
require_once "../../lib/imagenes.php";

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if (!checkAuth()) {
    header("Location: ../login.php");
    exit;
}

$projects = getAllProjects($db, $_SESSION['id_rol']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Em3 - Proyectos</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="56x56" href="../assets/images/fav-icon/logo_em3.png">
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
                        <!-- <a href="./dashboard.php" class="text-text-secondary hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            Inicio
                        </a> -->
                        <a href="./project_gallery.php" class="bg-accent text-white px-3 py-2 rounded-md text-sm font-medium">
                            Proyectos
                        </a>
                        <?php if($_SESSION['id_rol'] == 1):?>
                            <a href="./user_list.php" class="text-text-secondary hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                Usuarios
                            </a>
                        <?php endif; ?>
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
                <!-- <a href="./dashboard.php" class="text-text-secondary hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Inicio</a> -->
                <a href="./project_gallery.php" class="bg-accent-50 text-accent block px-3 py-2 rounded-md text-base font-medium">Proyectos</a>
                <a href="./user_list.php" class="text-text-secondary hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Usuarios</a>
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
                        <form method="POST" action="./project_gallery/add_projec.php" enctype="multipart/form-data" class="space-y-4">
                            <div>
                                <label for="name" class="block text-text-secondary mb-1">Nombre proyecto</label>
                                <input type="text" id="name" name="nombre" placeholder="Ej. Ampliación terraza" class="input-field" required />
                            </div>

                            <div>
                                <label for="description" class="block text-text-secondary mb-1">Descripción</label>
                                <textarea id="description" name="descripcion" rows="3" placeholder="Descripción del proyecto..." class="input-field" required></textarea>
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
            <?php if (empty($projects)): ?>
                <div>
                    <h1 class="text-2xl font-inter font-semibold text-secondary">No hay proyectos disponibles</h1>
                </div>
            <?php else: ?>
                <?php foreach ($projects as $p): ?>
                    <?php
                    $images = getImagesByProject($db, $p['id_proyecto'], $_SESSION['id_rol']);
                    $thumbnail = !empty($images) ? "proyectos/" . $p['id_proyecto'] . "/" . $images[0]['nombre_archivo'] : "no-imagen.jpg";
                    $fechaObj = new DateTime($p['fecha_creacion']);
                    $fechaFormateada = $fechaObj->format('d/m/Y H:i');
                    ?>
                    <div class="project-card card group">
                        <div class="relative overflow-hidden rounded-lg mb-4">
                            <img src="./project_gallery/uploads/<?= htmlspecialchars($thumbnail); ?>" alt="<?= htmlspecialchars($p['nombre']); ?>" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300" onerror="this.src='./project_gallery/uploads/no-imagen.jpg'; this.onerror=null;" />
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <h3 class="text-lg font-inter font-semibold text-primary"><?= htmlspecialchars($p['nombre']); ?></h3>
                            </div>
                            <div class="flex items-center justify-between pt-2">
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs text-text-secondary"><?= htmlspecialchars($p['usuario_creador']); ?></span>
                                </div>
                                <span class="text-xs text-text-secondary"><?= htmlspecialchars($fechaFormateada); ?></span>
                            </div>
                        </div>
                        <div class="flex items-center justify-center gap-3 pt-2 card-buttons">
                            <button
                                class="btn-primary open-edit-project"
                                data-id="<?= $p['id_proyecto']; ?>"
                                data-nombre="<?= htmlspecialchars($p['nombre']); ?>"
                                data-descripcion="<?= htmlspecialchars($p['descripcion']); ?>"
                                data-images='<?= json_encode($images); ?>'>
                                Editar
                            </button>
                            <a href="./project_gallery/delete.php?id=<?= $p['id_proyecto']; ?>"
                                class="btn-secondary"
                                onclick="return confirm('¿Seguro que quieres eliminar este proyecto junto con sus imágenes?');">
                                Eliminar
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div id="modal-edit-project" class="fixed inset-0 z-50 hidden">
            <div class="fixed inset-0 bg-primary/80 backdrop-blur-sm" id="modalOverlayEdit"></div>
            <div class="fixed inset-0 flex items-center justify-center p-4">
                <div class="bg-surface rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto modal">
                    <div class="p-6">
                        <!-- Modal Header -->
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-inter font-bold text-primary">Editar proyecto</h2>
                            <button id="close-edit-project" class="p-2 hover:bg-neutral-100 rounded-lg transition-colors">
                                <svg class="w-6 h-6 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Content -->
                        <form id="editForm" method="POST" action="./project_gallery/edit_project.php" enctype="multipart/form-data" class="space-y-4">
                            <input type="hidden" name="id_proyecto" id="edit-id" class="input-field">
                            <div>
                                <label for="edit-nombre" class="block text-text-secondary mb-1">Nombre proyecto</label>
                                <input type="text" name="nombre" id="edit-nombre" placeholder="Ej. Ampliación terraza" class="input-field" required />
                            </div>

                            <div>
                                <label for="edit-descripcion" class="block text-text-secondary mb-1">Descripción</label>
                                <textarea name="descripcion" id="edit-descripcion" rows="3" placeholder="Descripción del proyecto..." class="input-field" required></textarea>
                            </div>

                            <div>
                                <label class="block text-text-secondary mb-1">Imágenes actuales</label>
                                <div id="edit-current-images" class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3"></div>
                            </div>

                            <!-- Image Upload -->
                            <div class="border-2 border-dashed border-neutral-300 rounded-lg p-4 text-center cursor-pointer hover:border-accent transition-all">
                                <input type="file" id="edit-images" name="imagenes[]" accept="image/*" multiple class="hidden" />
                                <label for="edit-images" class="cursor-pointer flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-accent mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 15a4 4 0 014-4h1a4 4 0 018 0h1a4 4 0 110 8H7a4 4 0 01-4-4z" />
                                    </svg>
                                    <span class="text-sm text-text-secondary">Click o arrastra imágenes para subir</span>
                                </label>
                            </div>

                            <!-- Preview container -->
                            <div id="edit-preview" class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3"></div>

                            <!-- Actions -->
                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="submit" class="btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if (isset($_GET['success'])): ?>
        <script>
            Swal.fire({
                title: "¡Éxito!",
                text: "<?= htmlspecialchars($_GET['success']); ?>",
                icon: "success",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "<?= htmlspecialchars($_GET['error']); ?>",
                icon: "error",
                showCloseButton: true
            });
        </script>
    <?php endif; ?>
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

        // Filter functionality
        const searchInput = document.getElementById('searchInput');
        const projectCards = document.querySelectorAll('.project-card');

        function filterProjects() {
            const searchTerm = searchInput.value.toLowerCase();

            projectCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();

                const matchesSearch = title.includes(searchTerm);

                if (matchesSearch) {
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

        const modalEditProject = document.getElementById('modal-edit-project');
        const modalOverlayEdit = document.getElementById('modalOverlayEdit');
        const btnCloseEdit = document.getElementById('close-edit-project');

        // Open modal to edit project
        document.querySelectorAll('.open-edit-project').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const nombre = btn.dataset.nombre;
                const descripcion = btn.dataset.descripcion;

                // rellenar el formulario
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-nombre').value = nombre;
                document.getElementById('edit-descripcion').value = descripcion;

                // cargar imágenes actuales
                const imagesContainer = document.getElementById('edit-current-images');
                imagesContainer.innerHTML = '';

                const images = JSON.parse(btn.dataset.images || '[]');

                if (images.length === 0) {
                    imagesContainer.innerHTML = '<p>No hay imágenes para este proyecto.</p>';
                } else {
                    images.forEach(img => {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'relative rounded-lg overflow-hidden border group w-full h-32';

                        // Imagen
                        const imageEl = document.createElement('img');
                        imageEl.src = `./project_gallery/uploads/proyectos/${img.id_proyecto_fk}/${img.nombre_archivo}`;
                        imageEl.className = 'w-full h-full object-cover';

                        // Checkbox en misma posición que la "x"
                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.name = 'eliminar_imagenes[]';
                        checkbox.value = img.id_imagen;
                        checkbox.className = 'form-check-input';
                        checkbox.style.position = "absolute";
                        checkbox.style.top = "8px";
                        checkbox.style.right = "8px";
                        checkbox.style.width = "20px";
                        checkbox.style.height = "20px";
                        checkbox.style.zIndex = "50"; // 🔑 asegura que quede arriba
                        checkbox.style.background = "white";

                        wrapper.appendChild(imageEl);
                        wrapper.appendChild(checkbox);
                        imagesContainer.appendChild(wrapper);
                    });
                }

                // mostrar modal
                modalEditProject.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
        });

        function closeEditModal() {
            modalEditProject.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        modalOverlayEdit.addEventListener('click', closeEditModal);
        btnCloseEdit.addEventListener('click', closeEditModal);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modalAddProject.classList.contains('hidden')) {
                closeModalHandlerAddProject();
            } else if (e.key === 'Escape' && !modalEditProject.classList.contains('hidden')) {
                closeEditModal();
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

        (function() {
            const form = document.getElementById('editForm');
            const input = document.getElementById('edit-images');
            const label = document.querySelector('label[for="edit-images"]');
            const preview = document.getElementById('edit-preview');

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
                const totalImagenesActuales = form.querySelectorAll('#edit-current-images input[type="checkbox"]:not(:checked)').length;
                const totalNuevas = selectedFiles.length;

                if ((totalImagenesActuales + totalNuevas) === 0) {
                    e.preventDefault();
                    Swal.fire({
                        title: "Estimado usuario.",
                        text: "El proyecto debe tener al menos una imagen.",
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