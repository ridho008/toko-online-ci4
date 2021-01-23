<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="container">
	<h1>Hello World</h1>
   <?php d(session()->get()); ?>
</div>
<?= $this->endSection(); ?>