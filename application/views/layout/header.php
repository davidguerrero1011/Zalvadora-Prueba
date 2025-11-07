<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> - Zalvadora</title>

    <!-- Bootstrap Css Library -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>

    <navbar class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('admin'); ?>">
                <i class="fas fa-store"></i>Zalvadora
            </a>

            <?php if ($this->session->userdata('logged_in')):  ?>

                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="navbar-item">
                            <a class="nav-link" href="<?= base_url('admin'); ?>">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>

                        <?php if ($this->session->userdata('user_role') === 'admin'):  ?>
                            <li class="navbar-item">
                                <a class="nav-link" href="<?= base_url('admin/users'); ?>">
                                    <i class="fas fa-users"></i> Usuarios
                                </a>
                            </li>

                            <li class="navbar-item">
                                <a class="nav-link" href="<?= base_url('categories'); ?>">
                                    <i class="fas fa-tags"></i> Categorias
                                </a>
                            </li>
                        <?php endif; ?>

                        <li class="navbar-item">
                            <a class="nav-link" href="<?= base_url('products'); ?>">
                                <i class="fas fa-tags"></i> Productos
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="navbar-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> <?= $this->session->userdata('user_name'); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?= base_url('auth/logout'); ?>" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </navbar>

    <div class="container mt-4">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?>
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (validation_errors()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <?= validation_errors('error') ?>
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>