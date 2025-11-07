<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="fas fa-tags"></i>Gestión de Categorias
        <a href="<?= base_url('categories/create') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i>Nueva Categoria
        </a>
    </h1>
</div>

<div class="card">
    <div class="card-body">
        <?php if (empty($categories)): ?>
            <div class="text-center py-4">
                <i class="fas fa-users fa-3x text-muted mb-"></i>
                <p class="text-muted">No hay categorias registradas</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha Creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?= $category->id ?></td>
                                <td><?= htmlspecialchars($category->name); ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($category->created_at)); ?></td>
                                <td>
                                    <a href="<?= base_url('categories/edit/' . $category->id); ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-outline-danger" onclick="confirmDelete('<?= base_url('categories/delete/' . $category->id); ?>', '¿Está seguro que desea eliminar la categoría <?= htmlspecialchars($category->name); ?>?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if ($pagination): ?>
                <div class="d-flex justify-content-center">
                    <?= $pagination; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>