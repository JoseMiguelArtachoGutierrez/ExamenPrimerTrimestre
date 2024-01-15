<?php

namespace Controllers;

use Lib\Pages;
use Models\Pelicula;
use utils\utils;
class PeliculaController{
    private Pages $pages;
    public function __construct(){
        $this->pages=new Pages();
    }
    public function mostrarTodo(){
        $pelicula=Pelicula::fromArray([]);
        $todosLasPeliculas=$pelicula->getAll();
        $this->pages->render("pelicula/mostrarTodo",["peliculas"=>$todosLasPeliculas]);
    }
}