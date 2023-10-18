<?php

require_once './app/models/juegos.model.php';
require_once './app/views/juegos.view.php';
require_once "./app/models/generos.model.php";

class JuegosController{
    private $generos_model;
    private $model;
    private $view;

    public function __construct() {
        $this->generos_model = new GenerosModel();
        $this->model = new JuegosModel();
        $this->view = new JuegosView();
    }

    public function show($params = null, $filtro = false) {
        if(isset($params)){
            $juego = $this->model->getById($params[0]);
            if($juego){
                $genero = $this->generos_model->getById($juego->genero);
                $juego->genero = $genero->nombre;
                $this->view->showDetalle($juego);
            } else {
                $this->view->displayError("Hubo un error: el juego no se encuentra en la base");
            }
        } else {
            if($filtro){
                $juegos = $this->model->getAllByGenero($filtro);
            } else {
                $juegos = $this->model->getAll();
            }
            foreach($juegos as $juego){
                $genero = $this->generos_model->getById($juego->genero);
                $juego->genero = $genero->nombre;
            }

            $generos = $this->generos_model->getAll();
            $this->view->showList([ "juegos" => $juegos, "generos" => $generos]);
        }

    }

    public function insert(){
        if(!empty($_POST["nombre"]) && !empty($_POST["precio"]) && !empty($_POST["genero"]) && !empty($_POST["desarrolladora"]) && !empty($_POST["micro_transacciones"]) && !empty($_POST["lanzamiento"]) ){
            $this->model->insert($_POST);
        }
        else {
            // hubo un error
        }
        header("Location: ".BASE_URL);
    }

    public function update($id = null){
        if(isset($id) && !empty($_POST["nombre"]) && !empty($_POST["precio"]) && !empty($_POST["genero"]) && !empty($_POST["desarrolladora"]) && !empty($_POST["micro_transacciones"]) && !empty($_POST["lanzamiento"]) ){
            $this->model->putById($id, $_POST);
        }
        else {
            // hubo un error
        }
        header("Location: ".BASE_URL);
    }

    public function delete($id=null){
        if(isset($id)){
            $this->model->deleteById($id);
        }

        header("Location: ".BASE_URL);
    }

    public function showForm($params){
        $generos = $this->generos_model->getAll();

        if(isset($params[0])){
            $this->view->showForm($params[0],$generos);
        } else {
            $this->view->showForm(null, $generos);
        }
    }
}
?>