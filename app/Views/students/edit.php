<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Edit Student</h3>
        <a href="<?= base_url('students') ?>" class="btn btn-outline-custom"><i class="bi bi-arrow-left"></i> Back to
            List</a>
    </div>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger bg-danger  border-0">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li>
                        <?= esc($error) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('students/update/' . $student['id']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="student_id" class="form-label text-muted">Student ID <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom" id="student_id" name="student_id"
                    value="<?= old('student_id', esc($student['student_id'])) ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="name" class="form-label text-muted">Full Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom" id="name" name="name"
                    value="<?= old('name', esc($student['name'])) ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label text-muted">Email Address <span
                        class="text-danger">*</span></label>
                <input type="email" class="form-control form-control-custom" id="email" name="email"
                    value="<?= old('email', esc($student['email'])) ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label text-muted">Phone Number</label>
                <input type="text" class="form-control form-control-custom" id="phone" name="phone"
                    value="<?= old('phone', esc($student['phone'])) ?>">
            </div>

            <div class="col-md-4 mb-3">
                <label for="course" class="form-label text-muted">Course <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom" id="course" name="course"
                    value="<?= old('course', esc($student['course'])) ?>" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="year_level" class="form-label text-muted">Year Level <span
                        class="text-danger">*</span></label>
                <input type="number" min="1" max="5" class="form-control form-control-custom" id="year_level"
                    name="year_level" value="<?= old('year_level', esc($student['year_level'])) ?>" required>
            </div>

            <div class="col-md-4 mb-3">
                <label for="section" class="form-label text-muted">Section <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-custom" id="section" name="section"
                    value="<?= old('section', esc($student['section'])) ?>" required>
            </div>

            <div class="col-12 mb-4">
                <label for="address" class="form-label text-muted">Address</label>
                <textarea class="form-control form-control-custom" id="address" name="address"
                    rows="2"><?= old('address', esc($student['address'])) ?></textarea>
            </div>

            <div class="col-12 text-end">
                <button type="submit" class="btn btn-custom px-4 py-2">Update Student</button>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>