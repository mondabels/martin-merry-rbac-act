<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Create New Role</h3>
        <a href="<?= base_url('admin/roles') ?>" class="btn btn-outline-custom"><i class="bi bi-arrow-left"></i> Back to Roles</a>
    </div>

    <?php if(session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger bg-danger  border-0">
            <ul class="mb-0">
            <?php foreach(session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/roles/store') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="mb-3">
            <label for="name" class="form-label text-muted">Role Slug (e.g. coordinator) <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-custom" id="name" name="name" value="<?= old('name') ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="label" class="form-label text-muted">Role Label (e.g. Coordinator) <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-custom" id="label" name="label" value="<?= old('label') ?>" required>
        </div>

        <div class="mb-4">
            <label for="description" class="form-label text-muted">Description</label>
            <textarea class="form-control form-control-custom" id="description" name="description" rows="3"><?= old('description') ?></textarea>
        </div>
        
        <button type="submit" class="btn btn-custom px-4">Save Role</button>
    </form>
</div>
<?= $this->endSection() ?>
