<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A four-page Laravel point-of-sale foundation project.">
    <title><?php echo $__env->yieldContent('title', 'POS Foundations'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="<?php echo e(route('home')); ?>" aria-label="POS Foundations home">
                <span class="brand-mark">PF</span>
                <span>POS Foundations</span>
            </a>
            <nav aria-label="Primary navigation">
                <a class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">Home</a>
                <a class="<?php echo e(request()->routeIs('about') ? 'active' : ''); ?>" href="<?php echo e(route('about')); ?>">About</a>
                <a class="<?php echo e(request()->routeIs('customers.*') ? 'active' : ''); ?>" href="<?php echo e(route('customers.index')); ?>">Customers</a>
                <a class="<?php echo e(request()->routeIs('users.*') ? 'active' : ''); ?>" href="<?php echo e(route('users.index')); ?>">Users</a>
            </nav>
        </div>
    </header>

    <?php if(session('success')): ?>
        <div class="container flash-success" role="status"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer>
        <div class="container footer-wrap">
            <span>POS Foundations</span>
            <span>Built with Laravel and Blade</span>
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\Users\jhnjm\Downloads\tfa7-laravel-pos\resources\views/layouts/app.blade.php ENDPATH**/ ?>