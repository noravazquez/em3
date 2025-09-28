<?php
require_once "../../config/database.php";
require_once "../../lib/auth.php";
require_once "../../lib/roles.php";
require_once "../../lib/users.php";

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if (!checkAuth()) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['id_rol'] != 1) {
    header("Location: ../logout.php");
    exit;
}

$users = getAllUsers($db, $_SESSION['id_rol']);
$roles = getAllRoles($db);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Em3 - Usuarios</title>
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
                        <a href="./project_gallery.php" class="text-text-secondary hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            Proyectos
                        </a>
                        <a href="./user_list.php" class="bg-accent text-white px-3 py-2 rounded-md text-sm font-medium">
                            Usuarios
                        </a>
                    </div>
                </nav>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <!-- User Profile -->
                    <div class="relative">
                        <button id="userMenuButton" class="flex items-center space-x-3 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-accent-500">
                            <img class="h-8 w-8 rounded-full object-cover" src="../assets/images/user.png" alt="User Avatar" />
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
                <a href="./project_gallery.php" class="text-text-secondary hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Proyectos</a>
                <a href="./user_list.php" class="bg-accent-50 text-accent block px-3 py-2 rounded-md text-base font-medium">Usuarios</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-inter font-bold text-primary mb-2">Lista de usuarios</h1>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <button class="btn-primary" id="open-add-user">
                        <div style="display: flex; align-items: center;">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Nuevo Usuario
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <div id="modal-add-user" class="fixed inset-0 z-50 hidden">
            <div class="fixed inset-0 bg-primary/80 backdrop-blur-sm" id="modalOverlay"></div>
            <div class="fixed inset-0 flex items-center justify-center p-4">
                <div class="bg-surface rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto modal">
                    <div class="p-6">
                        <!-- Modal Header -->
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-inter font-bold text-primary">Nuevo usuario</h2>
                            <button id="close-add-user" class="p-2 hover:bg-neutral-100 rounded-lg transition-colors">
                                <svg class="w-6 h-6 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Content -->
                        <form method="POST" action="./users/add_user.php" enctype="multipart/form-data" class="space-y-4">
                            <div>
                                <label for="usuario" class="block text-text-secondary mb-1">Usuario</label>
                                <input type="text" id="usuario" name="usuario" placeholder="Ingresa un usuario" class="input-field" required />
                            </div>

                            <div>
                                <label for="contrasena" class="block text-text-secondary mb-1">Contraseña</label>
                                <div class="relative">
                                    <input type="password" id="contrasena" name="contrasena" class="input-field" placeholder="Ingresa una contraseña" required />
                                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg class="h-5 w-5 text-neutral-400 hover:text-neutral-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label for="rol" class="block text-text-secondary mb-1">Rol</label>
                                <select id="rol" name="id_rol" class="input-field" required>
                                    <?php foreach ($roles as $rol): ?>
                                        <option value="<?= $rol['id_rol'] ?>">
                                            <?= $rol['rol'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

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

                    <div class="w-full">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Buscar usuarios..." class="input-field pl-10" />
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

        <div class="card mx-auto w-full">
            <!-- contenedor scroll solo para la tabla -->
            <div class="overflow-x-auto">
                <table class="w-full border border-neutral-200 rounded-lg">
                    <thead class="bg-neutral-200">
                        <tr>
                            <th class="py-2 px-4 text-center text-sm font-semibold text-text-secondary">Usuario</th>
                            <th class="py-2 px-4 text-center text-sm font-semibold text-text-secondary">Contraseña</th>
                            <th class="py-2 px-4 text-center text-sm font-semibold text-text-secondary">Rol</th>
                            <th class="py-2 px-4 text-center text-sm font-semibold text-text-secondary">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr class="hover:bg-neutral-100 transition-colors user-row">
                                <td class="usuario-table py-2 px-4 text-sm"><?= htmlspecialchars($user['usuario']); ?></td>
                                <td class="py-2 px-4 text-sm text-neutral-400">
                                    <?= str_repeat("•", 10); ?>
                                </td>
                                <td class="py-2 px-4 text-sm"><?= htmlspecialchars($user['rol']); ?></td>
                                <td class="py-2 px-4 text-sm">
                                    <div class="flex flex-wrap gap-2 justify-center">
                                        <button
                                            class="btn-primary open-edit-user px-3 py-1 text-xs"
                                            data-id="<?= $user['id_usuario']; ?>"
                                            data-usuario="<?= htmlspecialchars($user['usuario']); ?>"
                                            data-contrasena="<?= htmlspecialchars($user['contrasena']); ?>"
                                            data-rol="<?= $user['id_rol_fk']; ?>">
                                            Editar
                                        </button>
                                        <a href="./users/delete.php?id=<?= $user['id_usuario']; ?>"
                                            class="btn-secondary px-3 py-1 text-xs"
                                            onclick="return confirm('¿Seguro que quieres eliminar este usuario?');">
                                            Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="modal-edit-user" class="fixed inset-0 z-50 hidden">
            <div class="fixed inset-0 bg-primary/80 backdrop-blur-sm" id="modalOverlayEdit"></div>
            <div class="fixed inset-0 flex items-center justify-center p-4">
                <div class="bg-surface rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto modal">
                    <div class="p-6">
                        <!-- Modal Header -->
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-inter font-bold text-primary">Editar usuario</h2>
                            <button id="close-edit-user" class="p-2 hover:bg-neutral-100 rounded-lg transition-colors">
                                <svg class="w-6 h-6 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Content -->
                        <form id="editForm" method="POST" action="./users/edit_user.php" enctype="multipart/form-data" class="space-y-4">
                            <input type="hidden" name="id_usuario" id="edit-id" class="input-field">
                            <div>
                                <label for="edit-usuario" class="block text-text-secondary mb-1">Usuario</label>
                                <input type="text" name="usuario" id="edit-usuario" placeholder="Ingresa un usuario" class="input-field" required />
                            </div>

                            <div>
                                <label for="edit-contrasena" class="block text-text-secondary mb-1">Nueva contraseña</label>
                                <div class="relative">
                                    <input type="password" name="nueva-contrasena" id="edit-contrasena" placeholder="Ingresa nueva contrase contraseña" class="input-field" />
                                    <button type="button" id="togglePasswordEdit" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg class="h-5 w-5 text-neutral-400 hover:text-neutral-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                <small class="text-muted">Déjalo vacío si no deseas cambiar la contraseña.</small>
                            </div>

                            <div>
                                <label for="edit-rol" class="block text-text-secondary mb-1">Rol</label>
                                <select name="id_rol" id="edit-rol" class="input-field" required>
                                    <?php foreach ($roles as $rol): ?>
                                        <option value="<?= $rol['id_rol'] ?>">
                                            <?= $rol['rol'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

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
        const userRows = document.querySelectorAll('.user-row');

        function filterUsers() {
            const searchTerm = searchInput.value.toLowerCase();

            userRows.forEach(row => {
                const usuarioCell = row.querySelector('.usuario-table');
                const usuario = usuarioCell ? usuarioCell.textContent.toLowerCase() : "";

                const matchesSearch = usuario.includes(searchTerm);

                row.style.display = matchesSearch ? '' : 'none'; // ocultar/mostrar fila
            });
        }

        searchInput.addEventListener('input', filterUsers);

        // Open modal to add 
        const btnOpenAddUser = document.querySelector("#open-add-user");
        const btnCloseAddUser = document.querySelector("#close-add-user");
        const modalAddUser = document.querySelector("#modal-add-user");
        const modalOverlay = document.getElementById('modalOverlay');

        btnOpenAddUser.addEventListener("click", () => {
            modalAddUser.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });

        function closeModalHandlerAddUser() {
            modalAddUser.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        btnCloseAddUser.addEventListener('click', closeModalHandlerAddUser);
        modalOverlay.addEventListener('click', closeModalHandlerAddUser);

        const modalEditUser = document.getElementById('modal-edit-user');
        const modalOverlayEdit = document.getElementById('modalOverlayEdit');
        const btnCloseEdit = document.getElementById('close-edit-user');

        // Open modal to edit project
        document.querySelectorAll('.open-edit-user').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const usuario = btn.dataset.usuario;
                const rol = btn.dataset.rol;

                // rellenar el formulario
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-usuario').value = usuario;
                document.getElementById('edit-rol').value = rol;

                // mostrar modal
                modalEditUser.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
        });

        function closeEditModal() {
            modalEditUser.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        modalOverlayEdit.addEventListener('click', closeEditModal);
        btnCloseEdit.addEventListener('click', closeEditModal);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !btnCloseAddUser.classList.contains('hidden')) {
                closeModalHandlerAddUser();
            } else if (e.key === 'Escape' && !modalEditUser.classList.contains('hidden')) {
                closeEditModal();
            }
        });

        // Password toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('contrasena');
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

        document.getElementById('togglePasswordEdit').addEventListener('click', function() {
            const passwordField = document.getElementById('edit-contrasena');
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