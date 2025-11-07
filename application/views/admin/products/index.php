<div class="d-flex justify-content-between align-items center mb-4">
    <h1><i class="fas fa-users"></i>Gestion de Productos</h1>
    <a href="<?= base_url('products/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i>Nuevo Producto
    </a>
</div>


<div class="card mb">
    <div class="card-body">
        <?= form_open('products', array('method' => 'GET', 'class' => 'row g-3')); ?>
        <div class="col-md-4">
            <input type="text" class="form-control" name="q" placeholder="busca por nombre o por sku" value="<?= htmlspecialchars($search); ?>">
        </div>

        <div class="col-md-3">
            <select name="order_by" id="order_by" class="form-select">
                <option value="name" <?= $order_by === 'name' ? 'selected' : ''; ?>>Ordenar por nombre</option>
                <option value="sku" <?= $order_by === 'sku' ? 'selected' : ''; ?>>Ordenar por Sku</option>
                <option value="price" <?= $order_by === 'price' ? 'selected' : ''; ?>>Ordenar por precio</option>
                <option value="stock" <?= $order_by === 'stock' ? 'selected' : ''; ?>>Ordenar por cantidad</option>
            </select>
        </div>

        <div class="col-md-2">
            <select name="order_dir" id="order_dir" class="form-select">
                <option value="ASC" <?= $order_dir === 'ASC' ? 'selected' : ''; ?>>Ascendente</option>
                <option value="DESC" <?= $order_dir === 'DESC' ? 'selected' : ''; ?>>Descendente</option>
            </select>
        </div>

        <div class="col-md-1">
            <button type="submit" class="btn btn-outline-primary w-100">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <?php form_close(); ?>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <?php if (empty($products)): ?>
            <div class="text-center py-4">
                <i class="fas fa-users fa-3x text-muted mb-"></i>
                <p class="text-muted">No hay productos registrados</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>SKU</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Categoria</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product->id ?></td>
                                <td><?= htmlspecialchars($product->name); ?></td>
                                <td><?= htmlspecialchars($product->sku); ?></td>
                                <td>$<?= number_format($product->price, 2); ?></td>
                                <td>
                                    <span class="badge bg-<?= $product->stock > 0 ? 'success' : 'danger'; ?>">
                                        <?= $product->stock; ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($product->category_name); ?></td>
                                <td>
                                    <a href="<?= base_url('products/edit/' . $product->id); ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-outline-danger" onclick="confirmDelete('<?= base_url('products/delete/' . $product->id); ?>', '¿Está seguro que desea eliminar el producto <?= htmlspecialchars($product->name); ?>?')">
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