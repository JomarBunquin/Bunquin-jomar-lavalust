<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$edit    = $edit ?? false;
$errors  = $errors ?? [];
$old     = $old ?? [];
$product = $product ?? null;

$action = $edit
    ? site_url('products/edit/' . $product['id'])
    : site_url('products/create');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $edit ? 'Edit Product' : 'Add Product'; ?> · Product Manager</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
            padding: 2rem;
        }
        .card {
            background: #1e293b;
            padding: 2.5rem;
            border-radius: 12px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 30px rgba(0,0,0,.3);
        }
        h1 {
            color: #f8fafc;
            font-size: 1.4rem;
            margin: 0 0 1.5rem;
        }
        label {
            display: block;
            color: #cbd5e1;
            font-size: .85rem;
            margin-bottom: .3rem;
        }
        input, textarea {
            width: 100%;
            padding: .65rem .75rem;
            margin-bottom: 1rem;
            border-radius: 6px;
            border: 1px solid #334155;
            background: #0f172a;
            color: #f1f5f9;
            font-size: .95rem;
            font-family: inherit;
        }
        textarea { resize: vertical; min-height: 80px; }
        .row { display: flex; gap: 1rem; }
        .row > div { flex: 1; }
        .btns { display: flex; gap: .75rem; margin-top: .5rem; }
        button, .btn-link {
            padding: .7rem 1rem;
            border: none;
            border-radius: 6px;
            font-size: .95rem;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }
        button { background: #3b82f6; color: #fff; flex: 1; }
        button:hover { background: #2563eb; }
        .btn-link { background: #334155; color: #f1f5f9; flex: 1; }
        .btn-link:hover { background: #475569; }
        .errors {
            background: #7f1d1d;
            color: #fecaca;
            padding: .7rem .9rem;
            border-radius: 6px;
            font-size: .85rem;
            margin-bottom: 1rem;
        }
        .errors ul { margin: 0; padding-left: 1.1rem; }
    </style>
</head>
<body>
    <div class="card">
        <h1><?= $edit ? 'Edit Product' : 'Add Product'; ?></h1>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= $action; ?>" method="post">
            <?= csrf_field(); ?>

            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" maxlength="100" required
                   value="<?= htmlspecialchars($old['product_name'] ?? ''); ?>">

            <label for="description">Description</label>
            <textarea id="description" name="description"><?= htmlspecialchars($old['description'] ?? ''); ?></textarea>

            <div class="row">
                <div>
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" required
                           value="<?= htmlspecialchars($old['price'] ?? ''); ?>">
                </div>
                <div>
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" step="1" min="0" required
                           value="<?= htmlspecialchars($old['quantity'] ?? ''); ?>">
                </div>
            </div>

            <div class="btns">
                <a href="<?= site_url('products'); ?>" class="btn-link">Cancel</a>
                <button type="submit"><?= $edit ? 'Save Changes' : 'Add Product'; ?></button>
            </div>
        </form>
    </div>
</body>
</html>
