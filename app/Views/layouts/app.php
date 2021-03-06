<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>

<!-- Navbar -->
<?= $this->include('layouts/nav'); ?>

<!-- Content -->
<?= $this->renderSection('content'); ?>

<script src="/js/jquery-3.5.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<?= $this->renderSection('script'); ?>
</body>
</html>