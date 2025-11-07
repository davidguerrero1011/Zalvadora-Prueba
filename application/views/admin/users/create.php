<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-user-plus"></i>Crear Usuario</h1>
    <a href="<?= base_url('admin/users'); ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?= form_open('admin/user_create'); ?>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre *</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name') ?>" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo *</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña *</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="role" class="form-label">Rol *</label>
                    <select name="role" id="role" class="form-select">
                        <option value="">Seleccionar Rol</option>
                        <option value="admin" <?= set_select('role', 'admin'); ?>>Administrador</option>
                        <option value="user" <?= set_select('role', 'user'); ?>>Usuario</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                <i class="fas fa-save"></i>Crear Usuario
            </button>
            <a href="<?= base_url('admin/users'); ?>" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
        <?= form_close(); ?>
    </div>
</div>