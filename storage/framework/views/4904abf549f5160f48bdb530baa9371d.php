<?php $__env->startSection('title', 'Semua Menu - Restorun'); ?>

<?php $__env->startSection('content'); ?>
<section class="container py-5" style="margin-top: 80px;">
    <div class="menu-header text-center mb-5">
        <h2>Semua Menu Kami</h2>
        <p>Temukan hidangan favorit Anda dari daftar lengkap kami.</p>
    </div>

    
    
    
    <div class="row justify-content-center mb-5">
        <div class="col-auto">
            <div class="btn-group" role="group" aria-label="Filter Menu">
                
                <a href="<?php echo e(route('menu.page')); ?>" class="btn <?php echo e(!request('kategori') ? 'btn-primary' : 'btn-outline-primary'); ?>">Semua</a>

                
                <a href="<?php echo e(route('menu.page', ['kategori' => 'makanan'])); ?>" class="btn <?php echo e(request('kategori') == 'makanan' ? 'btn-primary' : 'btn-outline-primary'); ?>">Makanan</a>

                
                <a href="<?php echo e(route('menu.page', ['kategori' => 'minuman'])); ?>" class="btn <?php echo e(request('kategori') == 'minuman' ? 'btn-primary' : 'btn-outline-primary'); ?>">Minuman</a>
            </div>
        </div>
    </div>
    
    
    

    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-4 col-md-6 my-4 text-center">
                <div class="card p-4 border-0 h-100" data-aos="fade-up">
                    <img src="<?php echo e(asset('storage/' . $item->image)); ?>" class="card-img-top" style="aspect-ratio: 1/1; object-fit: cover;" alt="<?php echo e($item->name); ?>">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title"><?php echo e($item->name); ?></h3>
                        <p class="card-text flex-grow-1"><?php echo e($item->description); ?></p>
                        <h3 class="mt-auto"><span>Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?></span></h3>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">Maaf, tidak ada menu yang cocok dengan filter ini.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <?php echo e($menuItems->links()); ?>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\MPTI-Tugas Akhir1\resources\views/menu.blade.php ENDPATH**/ ?>