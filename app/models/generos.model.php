    <?php
    require_once "./app/helpers/db.helper.php";
    require_once "./app/models/Model.php";

    class GenerosModel extends Model
    {

        function __construct()
        {
            parent::__construct("generos");
        }

        public function insert($data)
        {
            $query = $this->db->prepare('INSERT INTO ' . $this->table . ' (nombre) values (?)');
            return $query->execute([$data["nombre"]]);
        }
        function putById($id, $data)
        {
            $query = $this->db->prepare('UPDATE ' . $this->table . ' SET nombre = ? WHERE id = ?');
            return $query->execute([$data["nombre"], $id]);
        }
    }
    ?>
