<?php
// core/Model.php
namespace core;

class Model {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }
}
