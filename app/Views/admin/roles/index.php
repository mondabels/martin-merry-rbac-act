<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Role Management</h3>
        <a href="<?= base_url('admin/roles/create') ?>" class="btn btn-custom"><i class="bi bi-plus-circle"></i> Add New Role</a>
    </div>

    <div class="table-responsive">
        <table class="table table-custom align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Slug (Name)</th>
                    <th>Label</th>
                    <th>Description</th>
                    <th>Users Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($roles as $role): ?>
                <tr>
                    <td><?= $role->id ?></td>
                    <td><span class="badge bg-secondary"><?= esc($role->name) ?></span></td>
                    <td><?= esc($role->label) ?></td>
                    <td><?= esc($role->description) ?></td>
                    <td><?= $role->user_count ?></td>
                    <td>
                        <a href="<?= base_url('admin/roles/edit/'.$role->id) ?>" class="btn btn-sm btn-outline-custom"><i class="bi bi-pencil"></i> Edit</a>
                        <?php if($role->name !== 'admin'): ?>
                        <a href="<?= base_url('admin/roles/delete/'.$role->id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this role?')"><i class="bi bi-trash"></i> Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
