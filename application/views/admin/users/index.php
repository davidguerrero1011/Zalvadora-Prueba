<div class="d-flex justify-content-between align-items center mb-4">
    <h1><i class="fas fa-users"></i>Gestion de Usuarios</h1>
    <a href="<?= base_url('admin/user_create') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i>Nuevo Usuario
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (empty($users)): ?>
            <div class="text-center py-4">
                <i class="fas fa-users fa-3x text-muted mb-"></i>
                <p class="text-muted">No hay usuarios registrados</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Fecha Creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user->id ?></td>
                                <td><?= htmlspecialchars($user->name); ?></td>
                                <td><?= htmlspecialchars($user->email); ?></td>
                                <td>
                                    <span class="badge bg-<?= $user->role === 'admin' ? 'danger' : 'secondary'; ?>">
                                        <?= ucfirst($user->role); ?>
                                    </span>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($user->created_at)); ?></td>
                                <td>
                                    <a href="<?= base_url('admin/user_edit/' . $user->id); ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-outline-danger" onclick="confirmDelete('<?= base_url('admin/user_delete/' . $user->id); ?>', '¿Está seguro que desea eliminar al usuario <?= htmlspecialchars($user->name); ?>?')">
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