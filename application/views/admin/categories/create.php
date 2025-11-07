<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-user-plus"></i>Crear Categoria</h1>
    <a href="<?= base_url('categories'); ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?= form_open('categories/create'); ?>
        <div class="mb-3">
            <label for="name" class="form-label">Nombre *</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name') ?>" required>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                <i class="fas fa-save"></i>Crear Categoria
            </button>
            <a href="<?= base_url('admin/users'); ?>" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
        <?= form_close(); ?>
    </div>
</div>