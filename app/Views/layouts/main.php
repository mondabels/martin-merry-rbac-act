<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        <?php
        $userRole = session('user')['role'] ?? 'guest';
        $themes = [
            'admin' => [
                'bg' => '#f8f9fa',
                'secondary' => '#ffffff',
                'hover' => '#fff0f0',
                'highlight' => '#ffc9c9',
                'accent' => '#A80925',
                'text' => '#212529',
                'muted' => '#868e96',
                'border' => '#e9ecef'
            ],
            'teacher' => [
                'bg' => '#f8f9fa',
                'secondary' => '#ffffff',
                'hover' => '#ebfbee',
                'highlight' => '#b2f2bb',
                'accent' => '#40c057',
                'text' => '#212529',
                'muted' => '#868e96',
                'border' => '#e9ecef'
            ],
            'student' => [
                'bg' => '#f8f9fa',
                'secondary' => '#ffffff',
                'hover' => '#e7f5ff',
                'highlight' => '#a5d8ff',
                'accent' => '#339af0',
                'text' => '#212529',
                'muted' => '#868e96',
                'border' => '#e9ecef'
            ]
        ];
        $currentTheme = $themes[$userRole] ?? $themes['student'];
        ?>
        :root {
            --bg-color:
                <?= $currentTheme['bg'] ?>
            ;
            --sidebar-bg: #303130;
            --secondary-color:
                <?= $currentTheme['secondary'] ?>
            ;
            --hover-color:
                <?= $currentTheme['hover'] ?>
            ;
            --highlight-color:
                <?= $currentTheme['highlight'] ?>
            ;
            --accent-color:
                <?= $currentTheme['accent'] ?>
            ;
            --text-color:
                <?= $currentTheme['text'] ?>
            ;
            --text-muted:
                <?= $currentTheme['muted'] ?>
            ;
            --border-color:
                <?= $currentTheme['border'] ?>
            ;
            --sidebar-text: #ffffff;
            --sidebar-muted: rgba(255, 255, 255, 0.7);
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a {
            color: var(--accent-color);
            text-decoration: none;
        }

        a:hover {
            opacity: 0.8;
        }

        /* Sidebar layout */
        .wrapper {
            display: flex;
            width: 100%;
            flex-grow: 1;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            transition: all 0.3s;
            min-height: 100vh;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: var(--sidebar-bg);
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        #sidebar .sidebar-header h4 {
            color: var(--sidebar-text);
        }

        #sidebar ul.components {
            padding: 20px 0;
        }

        #sidebar ul p {
            color: var(--sidebar-muted);
            padding: 10px;
        }

        #sidebar ul li {
            padding: 0 15px;
            margin-bottom: 5px;
        }

        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 1.05em;
            display: block;
            color: var(--sidebar-muted);
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        #sidebar ul li a:hover {
            color: #ffffff;
            background: color-mix(in srgb, var(--accent-color) 25%, transparent);
            transform: translateX(4px);
        }

        #sidebar ul li.active>a {
            color: #ffffff;
            background: var(--accent-color);
            font-weight: 600;
        }

        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            background-color: var(--bg-color);
        }

        /* Topbar */
        .topbar {
            background: #ffffff;
            color: var(--text-color);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid var(--border-color);
        }

        .topbar h5 {
            color: var(--text-color);
            margin: 0;
            font-weight: 700;
        }

        .user-menu span {
            color: var(--text-color);
            text-align: right;
            font-weight: 500;
        }

        .user-menu img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--accent-color);
        }

        /* Buttons & Cards */
        .btn-custom {
            background-color: var(--accent-color) !important;
            color: #ffffff !important;
            font-weight: 600;
            border: none;
        }

        .btn-custom:hover {
            background-color: var(--accent-color) !important;
            color: #ffffff !important;
            opacity: 0.85;
        }

        .btn-outline-custom {
            border: 1px solid var(--accent-color);
            color: var(--accent-color);
            font-weight: 500;
        }

        .btn-outline-custom:hover {
            background-color: var(--hover-color);
            color: var(--accent-color);
        }

        .card-custom {
            background-color: var(--secondary-color);
            border: 1px solid var(--border-color) !important;
            color: var(--text-color);
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03) !important;
        }

        .form-control-custom {
            background-color: var(--bg-color);
            border: 1px solid var(--border-color);
            color: var(--text-color);
        }

        .form-control-custom:focus {
            background-color: #ffffff;
            border-color: var(--accent-color);
            color: var(--text-color);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--accent-color) 25%, transparent);
        }

        .table-custom {
            color: var(--text-color);
        }

        .table-custom thead th {
            border-bottom: 2px solid var(--highlight-color);
            color: var(--text-muted);
            text-transform: uppercase;
            font-size: 0.85em;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .table-custom tbody tr {
            border-bottom: 1px solid var(--border-color);
        }

        .table-custom tbody tr:hover {
            background-color: var(--hover-color);
            color: var(--text-color);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--text-color);
            font-weight: 600;
            letter-spacing: -0.3px;
        }
    </style>
    <?= $this->renderSection('styles') ?>
</head>

<body>

    <?php if (session()->has('user')): ?>
        <div class="wrapper">

            <nav id="sidebar">
                <div class="sidebar-header">
                    <h4><i class="bi bi-mortarboard-fill"></i> StudyHub</h4>
                </div>

                <ul class="list-unstyled components">
                    <?php $role = session('user')['role'] ?? 'guest'; ?>

                    <?php if ($role === 'admin'): ?>
                        <li class="<?= (url_is('dashboard*')) ? 'active' : '' ?>">
                            <a href="<?= base_url('dashboard') ?>"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                        </li>
                        <li class="<?= (url_is('students*')) ? 'active' : '' ?>">
                            <a href="<?= base_url('students') ?>"><i class="bi bi-people-fill me-2"></i> Students</a>
                        </li>
                        <li class="<?= (url_is('admin/roles*')) ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/roles') ?>"><i class="bi bi-shield-lock-fill me-2"></i> Roles</a>
                        </li>
                        <li class="<?= (url_is('admin/users*')) ? 'active' : '' ?>">
                            <a href="<?= base_url('admin/users') ?>"><i class="bi bi-person-lines-fill me-2"></i> Users</a>
                        </li>
                    <?php elseif ($role === 'teacher'): ?>
                        <li class="<?= (url_is('dashboard*')) ? 'active' : '' ?>">
                            <a href="<?= base_url('dashboard') ?>"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                        </li>
                        <li class="<?= (url_is('students*')) ? 'active' : '' ?>">
                            <a href="<?= base_url('students') ?>"><i class="bi bi-people-fill me-2"></i> Students</a>
                        </li>
                    <?php else: ?>
                        <li class="<?= (url_is('student/dashboard*')) ? 'active' : '' ?>">
                            <a href="<?= base_url('student/dashboard') ?>"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                        </li>
                    <?php endif; ?>

                    <li class="<?= (url_is('profile*')) ? 'active' : '' ?>">
                        <a href="<?= base_url('profile') ?>"><i class="bi bi-person-fill me-2"></i> Profile</a>
                    </li>

                    <li>
                        <a href="<?= base_url('logout') ?>" class="mt-4" style="color: #ffffff;"><i
                                class="bi bi-box-arrow-right me-2"></i> Logout</a>
                    </li>
                </ul>
            </nav>


            <div id="content" class="p-0">
                <div class="topbar">
                    <div>
                        <h5 class="mb-0">CI4 Student Management System</h5>
                    </div>
                    <div class="user-menu d-flex align-items-center">
                        <?php $userSess = session('user') ?? []; ?>
                        <span class="me-3"><?= esc($userSess['name'] ?? 'Guest') ?> <br><small
                                style="color: var(--accent-color) !important; font-size: 0.85em; font-weight: 600;"><?= esc(strtoupper($userSess['role'] ?? '')) ?></small></span>
                        <?php $pImg = $userSess['profile_image'] ?? null; ?>
                        <img src="<?= $pImg ? base_url('uploads/profiles/' . $pImg) : 'https://ui-avatars.com/api/?name=' . urlencode($userSess['name'] ?? 'Guest') . '&background=' . ltrim($currentTheme['hover'], '#') . '&color=' . ltrim($currentTheme['accent'], '#') ?>"
                            alt="Profile" style="border-color: var(--accent-color);">
                    </div>
                </div>

                <div class="p-4">

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible bg-success  border-0 fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible bg-danger  border-0 fade show" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
    <?php else: ?>

        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="w-100" style="max-width: 500px;">

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success bg-success  border-0">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger bg-danger  border-0">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>