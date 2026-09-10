<?php

class Seed_admin_user {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        $existing = $this->_lava->db->table('users')
            ->where('username', 'admin')
            ->get();

        if (!empty($existing)) {
            return;
        }

        $this->_lava->db->table('users')->insert([
            'username'  => 'admin',
            'email'     => 'admin@example.com',
            'password'  => password_hash('Admin@123', PASSWORD_DEFAULT),
            'role'      => 'admin',
            'is_active' => 1,
        ]);
    }

    public function down()
    {
        $this->_lava->db->table('users')->where('username', 'admin')->delete();
    }
}
