<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card card-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Edit Profile</h3>
        <a href="<?= base_url('profile') ?>" class="btn btn-outline-custom"><i class="bi bi-arrow-left"></i> Back</a>
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

    <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        
        <div class="row">
            <div class="col-md-4 text-center mb-4 border-end" style="border-color: var(--highlight-color) !important;">
                <?php $pImg = $user['profile_image'] ?? ''; ?>
                <img src="<?= $pImg ? base_url('uploads/profiles/' . $pImg) : 'https://ui-avatars.com/api/?name=' . urlencode($user['name']) . '&background=00FFDD&color=00072D' ?>" 
                     alt="Profile" 
                     class="img-fluid rounded-circle mb-3" 
                     id="preview"
                     style="width: 150px; height: 150px; object-fit: cover; border: 4px solid var(--accent-color);">
                
                <div class="mb-3">
                    <label for="profile_image" class="form-label text-muted">Update Avatar</label>
                    <input class="form-control form-control-custom form-control-sm" type="file" id="profile_image" name="profile_image" accept="image/*" onchange="previewImage(event)">
                </div>
            </div>
            
            <div class="col-md-8 ps-4">
                <h5 class="mb-3 text-muted border-bottom pb-2" style="border-color: var(--highlight-color) !important;">Basic Details</h5>
                <div class="mb-3">
                    <label for="name" class="form-label text-muted">Full Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-custom" id="name" name="name" value="<?= old('name', esc($user['name'])) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label text-muted">Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control form-control-custom" id="email" name="email" value="<?= old('email', esc($user['email'])) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-muted">New Password (Leave blank to keep current)</label>
                    <input type="password" class="form-control form-control-custom" id="password" name="password">
                </div>

                <h5 class="mb-3 mt-4 text-muted border-bottom pb-2" style="border-color: var(--highlight-color) !important;">Contact Details</h5>
                <div class="mb-3">
                    <label for="phone" class="form-label text-muted">Phone Number</label>
                    <input type="text" class="form-control form-control-custom" id="phone" name="phone" value="<?= old('phone', esc($user['phone'])) ?>">
                </div>

                <div class="mb-4">
                    <label for="address" class="form-label text-muted">Address</label>
                    <textarea class="form-control form-control-custom" id="address" name="address" rows="3"><?= old('address', esc($user['address'])) ?></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-custom px-4 py-2">Save Changes</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
        };
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>
