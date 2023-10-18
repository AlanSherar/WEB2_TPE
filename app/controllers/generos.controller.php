<?php

require_once './app/models/juegos.model.php';
require_once './app/views/generos.view.php';
require_once "./app/models/generos.model.php";

class GenerosController
{
    private $juegos_model;
    private $model;
    private $view;

    public function __construct()
    {
        $this->juegos_model = new JuegosModel();
        $this->model = new GenerosModel();
        $this->view = new GenerosView();
    }

    public function show($params = null)
    {
        if (isset($params)) {
            $genero = $this->model->getById($params[0]);
            if ($genero) {
                $this->view->showDetalle($genero);
            } else {
                $this->view->displayError("Hubo un error: el genero no se encuentra en la base");
            }
        } else {
            $generos = $this->model->getAll();
            $this->view->showList($generos);
        }
    }

    public function insert()
    {
        if (!empty($_POST["nombre"])) {
            $this->model->insert($_POST);
            header("Location: " . BASE_URL);
        } else {
            // hubo un error
        }
    }

    public function update($id = null)
    {
        if (isset($id) && !empty($_POST["nombre"])) {
            $this->model->putById($id, $_POST);
        }

        header("Location: " . BASE_URL);
    }

    public function delete($id = null)
    {
        if (isset($id)) {
            $this->juegos_model->deleteAllByGeneroId($id);
            $this->model->deleteById($id);
        }

        header("Location: " . BASE_URL);
    }

    public function showForm($params)
    {
        if (isset($params[0])) {
            $this->view->showForm($params[0]);
        } else {
            $this->view->showForm();
        }
    }
}
?>