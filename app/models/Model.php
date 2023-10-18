<?php 
    require_once "./app/helpers/db.helper.php";

    abstract class Model {

    protected $db;
    protected $table;

    public function __construct($tabla) {
        $this->db = DbHelper::connect_db();
        $this->table = $tabla;
    }

    public function getById($id) {
        $query = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE id = ?');
        $query->execute([$id]);
        $data = $query->fetch(PDO::FETCH_OBJ);

        return $data;
    }
    public function getAll() {
        $query = $this->db->prepare('SELECT * FROM '.$this->table);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }
    public function deleteById($id){
        $query = $this->db->prepare('DELETE FROM '.$this->table.' WHERE id = ?');
        return $query->execute([$id]);
    }

    abstract public function insert($data);
    abstract public function putById($id, $data);
    
    }
?>