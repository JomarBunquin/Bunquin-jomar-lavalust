<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: ProductModel
 *
 * Handles CRUD operations for the "products" table.
 */
class ProductModel extends Model {
    protected $table = 'products';
    protected $primary_key = 'id';

    // Everything except 'id' can be mass-assigned (id is guarded).
    protected $fillable = [];
    protected $guarded = ['id'];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all products, most recently created first.
     *
     * @return array
     */
    public function all()
    {
        return $this->db->table($this->table)
                         ->order_by('created_at', 'DESC')
                         ->get_all();
    }

    /**
     * Find a single product by id.
     *
     * @param int $id
     * @return array|null
     */
    public function find($id)
    {
        return $this->db->table($this->table)
                         ->where($this->primary_key, $id)
                         ->get();
    }

    /**
     * Create a new product.
     *
     * @param array $data
     * @return int|false Inserted id, or false on failure
     */
    public function create_product($data)
    {
        return $this->insert($data);
    }

    /**
     * Update an existing product.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update_product($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Delete a product.
     *
     * @param int $id
     * @return bool
     */
    public function delete_product($id)
    {
        return $this->delete($id);
    }
}
