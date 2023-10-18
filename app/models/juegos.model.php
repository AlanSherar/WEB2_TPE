<?php
require_once "./app/helpers/db.helper.php";
require_once "./app/models/Model.php";

class JuegosModel extends Model
{

    public function __construct()
    {
        parent::__construct("juegos");
    }

    function getAllByGenero($id)
    {
        $query = $this->db->prepare('SELECT * FROM ' . $this->table . ' WHERE genero = ?');
        $query->execute([$id]);
        $data = $query->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }

    public function deleteAllByGeneroId($id)
    {
        $query = $this->db->prepare('DELETE FROM ' . $this->table . ' WHERE genero = ?');
        return $query->execute([$id]);
    }

    public function insert($data)
    {
        $query = $this->db->prepare('INSERT INTO ' . $this->table . ' (nombre, precio, genero, desarrolladora, micro_transacciones, lanzamiento) values (?,?,?,?,?,?)');
        return $query->execute([$data["nombre"], $data["precio"], $data["genero"], $data["desarrolladora"], $data["micro_transacciones"], $data["lanzamiento"]]);
    }

    public function putById($id, $data)
    {
        $query = $this->db->prepare('UPDATE ' . $this->table . ' SET nombre = ?, precio = ?, genero = ?, desarrolladora = ?, micro_transacciones = ?, lanzamiento = ? WHERE id = ?');
        return $query->execute([$data["nombre"], $data["precio"], $data["genero"], $data["desarrolladora"], $data["micro_transacciones"], $data["lanzamiento"], $id]);
    }
}
?>
