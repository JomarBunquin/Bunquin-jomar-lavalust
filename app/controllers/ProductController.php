<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->call->model('ProductModel');
    }

    /**
     * Read - list all products.
     */
    public function index()
    {
        $data['products'] = $this->ProductModel->all();
        $this->call->view('product_list', $data);
    }

    /**
     * Create - show form (GET) / save product (POST).
     */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->validate($_POST);

            if (!empty($errors)) {
                $data['errors'] = $errors;
                $data['old']    = $_POST;
                $this->call->view('product_form', $data);
                return;
            }

            $this->ProductModel->create_product([
                'product_name' => trim($_POST['product_name']),
                'description'  => trim($_POST['description'] ?? ''),
                'price'        => (float) $_POST['price'],
                'quantity'     => (int) $_POST['quantity'],
            ]);

            redirect('products');
            return;
        }

        $data['errors'] = [];
        $data['old']    = [];
        $this->call->view('product_form', $data);
    }

    /**
     * Update - show form pre-filled (GET) / save changes (POST).
     */
    public function edit($id)
    {
        $product = $this->ProductModel->find($id);

        if (empty($product)) {
            redirect('products');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->validate($_POST);

            if (!empty($errors)) {
                $data['errors']  = $errors;
                $data['old']     = $_POST;
                $data['product'] = $product;
                $data['edit']    = true;
                $this->call->view('product_form', $data);
                return;
            }

            $this->ProductModel->update_product($id, [
                'product_name' => trim($_POST['product_name']),
                'description'  => trim($_POST['description'] ?? ''),
                'price'        => (float) $_POST['price'],
                'quantity'     => (int) $_POST['quantity'],
            ]);

            redirect('products');
            return;
        }

        $data['errors']  = [];
        $data['old']     = $product;
        $data['product'] = $product;
        $data['edit']    = true;
        $this->call->view('product_form', $data);
    }

    /**
     * Delete - remove a product.
     */
    public function delete($id)
    {
        $this->ProductModel->delete_product($id);
        redirect('products');
    }

    /**
     * Basic server-side validation for create/edit.
     *
     * @param array $input
     * @return array List of error messages
     */
    private function validate($input)
    {
        $errors = [];

        if (trim($input['product_name'] ?? '') === '') {
            $errors[] = 'Product name is required.';
        } elseif (strlen($input['product_name']) > 100) {
            $errors[] = 'Product name must be 100 characters or fewer.';
        }

        if (!isset($input['price']) || !is_numeric($input['price']) || (float) $input['price'] < 0) {
            $errors[] = 'Price must be a valid non-negative number.';
        }

        if (!isset($input['quantity']) || !ctype_digit((string) $input['quantity'])) {
            $errors[] = 'Quantity must be a valid non-negative whole number.';
        }

        return $errors;
    }
}
