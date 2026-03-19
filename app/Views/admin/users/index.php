<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card card-custom p-4">
    <div class="mb-4">
        <h3 class="mb-0">User Management</h3>
        <p class="text-muted">Assign roles to users.</p>
    </div>

    <div class="table-responsive">
        <table class="table table-custom align-middle">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Role</th>
                    <th>Assign New Role</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= esc($user->name) ?></td>
                    <td><?= esc($user->email) ?></td>
                    <td><span class="badge bg-primary"><?= esc($user->role_label ?? $user->role_name) ?></span></td>
                    <td>
                        <?php if(session('user')['id'] != $user->id): ?>
                        <form action="<?= base_url('admin/users/assign-role/'.$user->id) ?>" method="post" class="d-flex">
                            <?= csrf_field() ?>
                            <select name="role_id" class="form-select form-control-custom form-select-sm me-2" style="width: 150px;">
                                <?php foreach($roles as $r): ?>
                                    <option value="<?= $r->id ?>" <?= $r->id == $user->role_id ? 'selected' : '' ?>><?= esc($r->label) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="btn btn-sm btn-custom">Update</button>
                        </form>
                        <?php else: ?>
                        <span class="text-muted">Cannot change own role</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
