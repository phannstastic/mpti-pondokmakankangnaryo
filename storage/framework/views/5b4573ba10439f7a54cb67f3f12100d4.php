<?php $__env->startSection('title', 'Galeri - Restorun'); ?>

<?php $__env->startSection('content'); ?>
<section class="container py-5" style="margin-top: 80px;">
    <div class="menu-header text-center mb-5">
        <h2>Galeri Restoran Kami</h2>
        <p>Lihat momen-momen spesial yang tertangkap kamera di restoran kami.</p>
    </div>

    <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $galleryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-4 col-md-6">
                <div class="card overflow-hidden" data-aos="zoom-in">
                    <img src="<?php echo e(Storage::url($photo->image)); ?>" class="img-fluid" style="aspect-ratio: 4/3; object-fit: cover;" alt="<?php echo e($photo->title ?? 'Foto Galeri'); ?>">
                    <?php if($photo->caption): ?>
                    <div class="card-body text-center py-2">
                        <p class="card-text small text-muted"><?php echo e($photo->caption); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">Maaf, belum ada foto di galeri saat ini.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <?php echo e($galleryItems->links()); ?>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MPTI-Tugas Akhir1\resources\views/galeri.blade.php ENDPATH**/ ?>