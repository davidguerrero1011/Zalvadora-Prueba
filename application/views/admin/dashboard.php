<div class="row">
    <div class="col-12">
        <h1><i class="fas fa-tachometer-alt"></i>Dashboard</h1>
        <p class="lead">Bienvenido al panel de administración de Zalvadora</p>
    </div>
</div>

<div class="row">
    <?php if ($this->session->userdata('user_role') === 'admin'): ?>
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">
                    <i class="fas fa-users">Usuarios</i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Gestionar Usuarios</h5>
                    <p class="card-text">Administrar cuentas de usuario del sistema</p>
                    <a href="<?= base_url('admin/users'); ?>" class="btn btn-light">Ver Usuarios</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">
                    <i class="fas fa-tags">Categorias</i>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Gestionar Categorias</h5>
                    <p class="card-text">Administrar categorias de productos.</p>
                    <a href="<?= base_url('categories'); ?>" class="btn btn-light">Ver Categorias</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3">
            <div class="card-header">
                <i class="fas fa-box">Productos</i>
            </div>
            <div class="card-body">
                <h5 class="card-title">Gestionar Productos</h5>
                <p class="card-text">Administrar inventario de productos.</p>
                <a href="<?= base_url('products'); ?>" class="btn btn-light">Ver Productos</a>
            </div>
        </div>
    </div>
</div>