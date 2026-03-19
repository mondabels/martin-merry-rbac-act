<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Students List</h3>
        <a href="<?= base_url('students/create') ?>" class="btn btn-custom"><i class="bi bi-person-plus-fill"></i> Add Student</a>
    </div>

    <div class="table-responsive">
        <table class="table table-custom align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Year/Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($students)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No students found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($students as $student): ?>
                    <tr>
                        <td class="text-muted"><?= esc($student['student_id'] ?? $student['id']) ?></td>
                        <td class="fw-bold" style="color: var(--accent-color);"><?= esc($student['name']) ?></td>
                        <td><?= esc($student['email']) ?></td>
                        <td><?= esc($student['course']) ?></td>
                        <td><?= esc($student['year_level']) ?> - <?= esc($student['section']) ?></td>
                        <td>
                            <a href="<?= base_url('students/edit/' . $student['id']) ?>" class="btn btn-sm btn-outline-custom me-1" title="Edit"><i class="bi bi-pencil"></i></a>
                            <a href="<?= base_url('students/delete/' . $student['id']) ?>" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this student?');" style="border-color: #dc3545; color: #dc3545;"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
