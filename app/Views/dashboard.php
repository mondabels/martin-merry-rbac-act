<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="py-2">

    <div class="mb-5">
        <h2 class=" fw-bold mb-1">Dashboard</h2>
        <p class="text-muted">Welcome back, <?= esc(session('user')['name'] ?? 'Guest') ?></p>
    </div>

    <?php $role = session('user')['role'] ?? 'guest'; ?>
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom border-0 shadow-lg transition-hover" style="border-radius: 12px;">
                <div style="height: 6px; background-color: var(--accent-color);"></div>
                <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center rounded-circle me-4"
                            style="width: 60px; height: 60px; background-color: color-mix(in srgb, var(--accent-color) 15%, transparent);">
                            <i class="bi bi-person-badge fs-3" style="color: var(--accent-color);"></i>
                        </div>
                        <div>
                            <h5 class=" fw-bold mb-1"><?= esc(session('user')['name'] ?? 'Guest') ?></h5>
                            <span class="badge"
                                style="background-color: var(--hover-color); color: var(--accent-color); font-size: 0.85em; padding: 5px 10px;">
                                <?= esc(strtoupper($role)) ?>
                            </span>
                        </div>
                    </div>
                    <div>
                        <a href="<?= base_url('profile') ?>" class="btn btn-outline-light"
                            style="border-color: var(--accent-color); color: var(--accent-color); border-radius: 8px; padding: 10px 20px;">
                            <i class="bi bi-pencil-square me-2"></i> Manage Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($role === 'student'): ?>
        <!-- STUDENT DASHBOARD -->
        <h4 class=" fw-bold mb-4 mt-5">My Class Schedule</h4>
        <div class="card card-custom border-0 shadow-lg overflow-hidden" style="border-radius: 12px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th class="border-0 px-4 py-3">Subject</th>
                                <th class="border-0 px-4 py-3">Time</th>
                                <th class="border-0 px-4 py-3">Room</th>
                                <th class="border-0 px-4 py-3">Instructor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-3 fw-bold ">CS101 - Intro to Programming</td>
                                <td class="px-4 py-3 text-muted">Mon/Wed 8:00 AM - 9:30 AM</td>
                                <td class="px-4 py-3 text-muted">Lab A</td>
                                <td class="px-4 py-3 text-muted">Dr. Quack Quack</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 fw-bold ">IT202 - Database Systems</td>
                                <td class="px-4 py-3 text-muted">Tue/Thu 10:00 AM - 11:30 AM</td>
                                <td class="px-4 py-3 text-muted">Room 304</td>
                                <td class="px-4 py-3 text-muted">Ms. Yizhou Ning
                            </tr>
                            <tr>
                                <td class="px-4 py-3 fw-bold ">ENG105 - Tech Writing</td>
                                <td class="px-4 py-3 text-muted">Friday 1:00 PM - 4:00 PM</td>
                                <td class="px-4 py-3 text-muted">Room 201</td>
                                <td class="px-4 py-3 text-muted">Prof. Jennie Kim</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer border-0 p-3 text-center" style="background-color: var(--hover-color);">
                <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Data shown is a placeholder
                    demonstration.</small>
            </div>
        </div>

    <?php elseif ($role === 'teacher'): ?>
        <!-- TEACHER DASHBOARD -->
        <h4 class=" fw-bold mb-4 mt-5">My Teaching Assignments</h4>
        <div class="card card-custom border-0 shadow-lg overflow-hidden" style="border-radius: 12px;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom mb-0">
                        <thead>
                            <tr>
                                <th class="border-0 px-4 py-3">Subject Code</th>
                                <th class="border-0 px-4 py-3">Description</th>
                                <th class="border-0 px-4 py-3">Section</th>
                                <th class="border-0 px-4 py-3 text-center">Enrolled Students</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-3 fw-bold ">CS101</td>
                                <td class="px-4 py-3 text-muted">Introduction to Programming</td>
                                <td class="px-4 py-3 text-muted">Block A</td>
                                <td class="px-4 py-3 text-center"><span class="badge"
                                        style="background-color: var(--accent-color); color: var(--bg-color);">35</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 fw-bold ">CS101</td>
                                <td class="px-4 py-3 text-muted">Introduction to Programming</td>
                                <td class="px-4 py-3 text-muted">Block B</td>
                                <td class="px-4 py-3 text-center"><span class="badge"
                                        style="background-color: var(--accent-color); color: var(--bg-color);">28</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 fw-bold ">IT301</td>
                                <td class="px-4 py-3 text-muted">Web Development</td>
                                <td class="px-4 py-3 text-muted">Block C</td>
                                <td class="px-4 py-3 text-center"><span class="badge"
                                        style="background-color: var(--accent-color); color: var(--bg-color);">42</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer border-0 p-3 text-center" style="background-color: var(--hover-color);">
                <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Data shown is a placeholder
                    demonstration.</small>
            </div>
        </div>

    <?php elseif ($role === 'admin'): ?>
        <!-- ADMIN DASHBOARD -->
        <h4 class=" fw-bold mb-4 mt-5">Administrative Actions</h4>
        <div class="row g-4">
            <div class="col-md-6">
                <a href="<?= base_url('students/create') ?>" class="text-decoration-none h-100 d-block">
                    <div class="card card-custom border-0 shadow-sm w-100 p-5 transition-hover text-center h-100 d-flex flex-column justify-content-center"
                        style="border-radius: 12px; background-color: var(--secondary-color);">
                        <div class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-4"
                            style="width: 80px; height: 80px; background-color: color-mix(in srgb, var(--accent-color) 15%, transparent);">
                            <i class="bi bi-person-plus-fill" style="color: var(--accent-color); font-size: 2.5rem;"></i>
                        </div>
                        <h4 class=" fw-bold mb-2">Add New Student</h4>
                        <p class="text-muted mb-0">Register a new student into the management system database</p>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="<?= base_url('students') ?>" class="text-decoration-none h-100 d-block">
                    <div class="card card-custom border-0 shadow-sm w-100 p-5 transition-hover text-center h-100 d-flex flex-column justify-content-center"
                        style="border-radius: 12px; background-color: var(--secondary-color);">
                        <div class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-4"
                            style="width: 80px; height: 80px; background-color: color-mix(in srgb, var(--accent-color) 15%, transparent);">
                            <i class="bi bi-people-fill" style="color: var(--accent-color); font-size: 2.5rem;"></i>
                        </div>
                        <h4 class=" fw-bold mb-2">View All Students</h4>
                        <p class="text-muted mb-0">Browse, edit, and manage the existing student records</p>
                    </div>
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php $this->section('styles') ?>
<style>
    .transition-hover {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .transition-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2) !important;
    }

    .table-custom td {
        border-bottom: 1px solid var(--highlight-color);
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }
</style>
<?php $this->endSection() ?>
<?= $this->endSection() ?>