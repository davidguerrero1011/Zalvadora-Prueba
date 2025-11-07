<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-user-plus"></i>Editar Producto</h1>
    <a href="<?= base_url('products'); ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?= form_open('products/edit/' . $product->id); ?>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre *</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name', $product->name) ?>" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="sku" class="form-label">SKU *</label>
                    <input type="text" class="form-control" id="sku" name="sku" value="<?= set_value('sku', $product->sku) ?>" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="price" class="form-label">Precio *</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= set_value('price', $product->price) ?>" required>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="stock" class="form-label">Cantidad *</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="<?= set_value('stock', $product->stock) ?>" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoria *</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">Seleccione Categoria</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id ?>" <?= set_select('category_id', $category->id, $product->category_id == $category->id); ?>> <?= htmlspecialchars($category->name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                <i class="fas fa-save"></i>Actualizar Producto
            </button>
            <a href="<?= base_url('products'); ?>" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
        <?= form_close(); ?>
    </div>
</div>