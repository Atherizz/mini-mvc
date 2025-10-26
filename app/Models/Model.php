<?php
require BASE_PATH . '/app/Core/Database.php';

class Model {
    public $db;
    public $error;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
}
