<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$products = $products ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products · Product Manager</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: #0f172a;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            color: #f1f5f9;
            padding: 2rem;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: .75rem;
        }
        h1 { margin: 0; font-size: 1.5rem; }
        .actions a, .actions button {
            display: inline-block;
            padding: .55rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: .85rem;
            border: none;
            cursor: pointer;
        }
        .btn-primary { background: #3b82f6; color: #fff; }
        .btn-primary:hover { background: #2563eb; }
        .btn-secondary { background: #334155; color: #f1f5f9; }
        .btn-secondary:hover { background: #475569; }
        .btn-danger { background: #dc2626; color: #fff; }
        .btn-danger:hover { background: #b91c1c; }
        .row-actions a, .row-actions button {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .4rem .75rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: .8rem;
            font-weight: 500;
            border: 1px solid transparent;
            cursor: pointer;
            transition: background .15s ease, border-color .15s ease;
        }
        .row-actions a.edit {
            background: #1e2b45;
            color: #93c5fd;
            border-color: #2d3f63;
        }
        .row-actions a.edit:hover { background: #24365a; border-color: #3b5e91; }
        .row-actions button.delete {
            background: #2a1a1e;
            color: #fca5a5;
            border-color: #4a2328;
        }
        .row-actions button.delete:hover { background: #3a2024; border-color: #6b2b31; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #1e293b;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: .8rem 1rem;
            text-align: left;
            border-bottom: 1px solid #334155;
            font-size: .9rem;
        }
        th { background: #172033; color: #94a3b8; font-weight: 600; }
        tr:last-child td { border-bottom: none; }
        .empty {
            padding: 2rem;
            text-align: center;
            color: #64748b;
        }
        .row-actions { display: flex; gap: .5rem; }
        .row-actions form { margin: 0; }
    </style>
</head>
<body>

    <div class="topbar">
        <h1>Products</h1>
        <div class="actions">
            <a href="<?= site_url('products/create'); ?>" class="btn-primary">+ Add Product</a>
            <a href="<?= site_url('logout'); ?>" class="btn-secondary">Logout</a>
        </div>
    </div>

    <?php if (!empty($products)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td>#<?= (int) $product['id']; ?></td>
                    <td><?= htmlspecialchars($product['product_name']); ?></td>
                    <td><?= htmlspecialchars($product['description'] ?? ''); ?></td>
                    <td>&#8369;<?= number_format((float) $product['price'], 2); ?></td>
                    <td><?= (int) $product['quantity']; ?></td>
                    <td><?= htmlspecialchars($product['created_at'] ?? ''); ?></td>
                    <td class="row-actions">
                        <a href="<?= site_url('products/edit/' . $product['id']); ?>" class="edit">✎ Edit</a>
                        <form action="<?= site_url('products/delete/' . $product['id']); ?>" method="post"
                              onsubmit="return confirm('Delete this product?');">
                            <?= csrf_field(); ?>
                            <button type="submit" class="delete">🗑 Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="empty">No products yet. Click "Add Product" to create one.</div>
    <?php endif; ?>

</body>
</html>