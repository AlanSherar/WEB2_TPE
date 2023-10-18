<?php 
require_once "./app/helpers/db.helper.php";

class UserModel {
    private $db;
    private $table;

    function __construct() {
        $this->db = DbHelper::connect_db();
        $this->table = "usuarios";
    }

    public function getByEmail($email) {
        $query = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE email = ?');
        $query->execute([$email]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}
?>