<?php

namespace Routes;

use Controllers\UsuarioController;
use Controllers\DashBoardController;
use Controllers\PacienteController;
use Controllers\ErrorController;
use Lib\Router;

class Routes
{
    public static function index(){
        // INICIO
        Router::add('GET','/',function (){
            return (new DashBoardController())->index();
        });

        // USUARIOS
        Router::add('GET','/Usuario/indetifica',function (){
            return (new UsuarioController())->indetifica();
        });
        Router::add('POST','/Usuario/login',function (){
            return (new UsuarioController())->login();
        });
        Router::add('GET','/Usuario/logout',function (){
            return (new UsuarioController())->logout();
        });
        Router::add('GET','/Usuario/registro',function (){
            return (new UsuarioController())->registro();
        });
        Router::add('POST','/Usuario/registro',function (){
            return (new UsuarioController())->registro();
        });
        /*
        Router::add('GET','/Usuario/update/:id',function ($id){
            die("g");
            return (new UsuarioController())->update($id);
        });
        Router::add('POST','/Usuario/update',function (){
            return (new UsuarioController())->update();
        });
        */
        Router::add('GET','/Usuario/mostrarTodos',function (){
            return (new UsuarioController())->mostrarTodos();
        });

        // ERROR
        Router::add('GET','/Error/error/', function (){
            return (new ErrorController())->error404();
        });
        Router::dispatch();
    }
}