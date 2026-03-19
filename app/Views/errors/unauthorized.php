<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card card-custom p-5 text-center mt-5">
    <h1 class="text-danger mb-4"><i class="bi bi-exclamation-triangle"></i> 403 Unauthorized</h1>
    <p class="lead text-muted">Sorry, you do not have permission to access the requested page.</p>
    
    <?php $role = session('user')['role'] ?? 'guest'; ?>
    <p class="mt-3">Your current role is: <strong class="text-info" style="color: var(--accent-color) !important;"><?= strtoupper(esc($role)) ?></strong></p>
    
    <div class="mt-4">
        <?php if ($role === 'admin' || $role === 'teacher'): ?>
            <a href="<?= base_url('dashboard') ?>" class="btn btn-custom">Return to Dashboard</a>
        <?php elseif ($role === 'student'): ?>
            <a href="<?= base_url('student/dashboard') ?>" class="btn btn-custom">Return to Dashboard</a>
        <?php else: ?>
            <a href="<?= base_url('login') ?>" class="btn btn-custom">Return to Login</a>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
