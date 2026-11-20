<?php $__env->startSection('title', 'Home | POS Foundations'); ?>

<?php $__env->startSection('content'); ?>
<section class="hero">
    <div class="container hero-grid">
        <div>
            <p class="eyebrow">Laravel POS Application</p>
            <h1>A clean foundation for everyday point-of-sale work.</h1>
            <p class="lead">Create and edit customer and user records with server-side validation, helpful error messages, and display-ready profile pictures.</p>
            <div class="button-row">
                <a class="button primary" href="<?php echo e(route('customers.index')); ?>">View customers</a>
                <a class="button secondary" href="<?php echo e(route('about')); ?>">About the project</a>
            </div>
        </div>
        <div class="dashboard-preview" aria-label="Point-of-sale summary">
            <div class="preview-top">
                <span>Store overview</span>
                <span class="live-dot">Live</span>
            </div>
            <div class="metric-grid">
                <article><span>Customers</span><strong>5</strong><small>Seeded records</small></article>
                <article><span>Team users</span><strong>5</strong><small>Unique usernames</small></article>
                <article><span>Avatar size</span><strong>240</strong><small>Square pixels</small></article>
                <article><span>Upload limit</span><strong>2 MB</strong><small>Validated images</small></article>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <p class="eyebrow">Database editing workflow</p>
            <h2>Safe, helpful forms for everyday POS data</h2>
        </div>
        <div class="card-grid">
            <article class="feature-card"><span>01</span><h3>Create records</h3><p>Add customers and users through dedicated Blade forms.</p></article>
            <article class="feature-card"><span>02</span><h3>Edit records</h3><p>Open a prefilled form and update an existing database record.</p></article>
            <article class="feature-card"><span>03</span><h3>Validate input</h3><p>See field-specific errors while valid old input remains in place.</p></article>
            <article class="feature-card"><span>04</span><h3>Upload avatars</h3><p>Prepare images at 240 by 240 pixels and display a fallback when absent.</p></article>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jhnjm\Downloads\tfa7-laravel-pos\resources\views/home.blade.php ENDPATH**/ ?>