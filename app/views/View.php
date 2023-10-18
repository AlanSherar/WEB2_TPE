<?php

abstract class View
{
    protected $recurso;

    public function __construct($recurso)
    {
        $this->recurso = $recurso;
    }

    public static function displayError($error = null)
    {
        require "./templates/error.phtml";
    }
    public function showList($data)
    {

        require './templates/' . $this->recurso . '.list.phtml';
    }

    public function showDetalle($data)
    {
        require "./templates/" . $this->recurso . ".detail.phtml";
    }
    public function showForm($id = null, $data = null)
    {
        require './templates/form.' . $this->recurso . '.phtml';
    }
}
