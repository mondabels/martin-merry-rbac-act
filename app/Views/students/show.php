<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Student Profile</h3>
        <a href="<?= base_url('students') ?>" class="btn btn-outline-custom"><i class="bi bi-arrow-left"></i> Back to
            List</a>
    </div>

    <div class="row">
        <div class="col-md-4 text-center border-end" style="border-color: var(--highlight-color) !important;">
            <?php $pImg = $student['profile_image'] ?? ''; ?>
            <img src="<?= $pImg ? base_url('uploads/profiles/' . $pImg) : 'https://ui-avatars.com/api/?name=' . urlencode($student['name']) . '&background=00FFDD&color=00072D' ?>"
                alt="Profile" class="img-fluid rounded-circle mb-3"
                style="width: 150px; height: 150px; object-fit: cover; border: 4px solid var(--accent-color);">

            <h4><?= esc($student['name']) ?></h4>
            <span class="badge"
                style="background-color: var(--hover-color); color: var(--accent-color); font-size: 0.9em; padding: 5px 10px;">
                STUDENT
            </span>
        </div>

        <div class="col-md-8 ps-4">
            <h5 class="mb-3 text-muted border-bottom pb-2" style="border-color: var(--highlight-color) !important;">
                Contact Information</h5>
            <dl class="row">
                <dt class="col-sm-3" style="color: var(--accent-color);">Email</dt>
                <dd class="col-sm-9"><?= esc($student['email']) ?></dd>

                <dt class="col-sm-3" style="color: var(--accent-color);">Phone</dt>
                <dd class="col-sm-9"><?= esc($student['phone']) ?: '<i class="text-muted">Not provided</i>' ?></dd>

                <dt class="col-sm-3" style="color: var(--accent-color);">Address</dt>
                <dd class="col-sm-9"><?= esc($student['address']) ?: '<i class="text-muted">Not provided</i>' ?></dd>
            </dl>

            <h5 class="mb-3 mt-4 text-muted border-bottom pb-2"
                style="border-color: var(--highlight-color) !important;">Academic Information</h5>
            <dl class="row">
                <dt class="col-sm-3" style="color: var(--accent-color);">Student ID</dt>
                <dd class="col-sm-9"><?= esc($student['student_id'] ?? 'N/A') ?></dd>

                <dt class="col-sm-3" style="color: var(--accent-color);">Course</dt>
                <dd class="col-sm-9"><?= esc($student['course'] ?? 'N/A') ?></dd>

                <dt class="col-sm-3" style="color: var(--accent-color);">Year & Section</dt>
                <dd class="col-sm-9">Year <?= esc($student['year_level'] ?? 'N/A') ?> - Section
                    <?= esc($student['section'] ?? 'N/A') ?>
                </dd>
            </dl>
        </div>
    </div>
</div>
<?= $this->endSection() ?>