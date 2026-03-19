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
            <h3 class="card-title font-weight-bold">Create an Account</h3>
            <p class="text-muted">Register to access the Student Management System</p>
        </div>

        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger bg-danger text-white border-0">
                <ul class="mb-0">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= base_url('register') ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label font-weight-bold">Full Name</label>
                <input type="text" class="form-control form-control-custom" id="name" name="name" required
                    value="<?= old('name') ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label font-weight-bold">Email address</label>
                <input type="email" class="form-control form-control-custom" id="email" name="email" required
                    value="<?= old('email') ?>">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label font-weight-bold">Password</label>
                <input type="password" class="form-control form-control-custom" id="password" name="password" required>
            </div>

            <div class="mb-4">
                <label for="pass_confirm" class="form-label font-weight-bold">Confirm Password</label>
                <input type="password" class="form-control form-control-custom" id="pass_confirm" name="pass_confirm"
                    required>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-custom btn-lg">Register</button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <p class="mb-0 text-muted">Already have an account? <a href="<?= base_url('login') ?>"
                    class="text-decoration-none fw-bold">Login here</a></p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>