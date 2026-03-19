<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<style>
    body {
        background-color: #f4c20d;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card card-custom p-4 shadow-sm border-0">
    <div class="card-body">

        <div class="text-center mb-4">
            <h3 class="card-title font-weight-bold">Login</h3>
            <p class="text-muted">Sign in to access the Student Management System</p>
        </div>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger bg-danger text-white border-0">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger bg-danger text-white border-0">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success bg-success text-white border-0">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="email" class="form-label font-weight-bold">Email address</label>
                <input type="email" class="form-control form-control-custom" id="email" name="email"
                    value="<?= old('email') ?>" required>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label font-weight-bold">Password</label>
                <input type="password" class="form-control form-control-custom" id="password" name="password" required>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-custom btn-lg">Login</button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <p class="mb-0 text-muted">
                Don't have an account?
                <a href="<?= base_url('register') ?>" class="text-decoration-none fw-bold">Register here</a>
            </p>
        </div>

    </div>
</div>
<?= $this->endSection() ?>