<?php

namespace Models;

use PDO;
use PDOException;
use Lib\BaseDatos;

class Usuario{
    private string|null $id;
    private string $nombreUsuario;
    private string $password;
    private mixed $DNI;
    private string $nombreCompleto;
    private string $apellidoUNO;
    private string $apellidoDos;
    private string $email;
    private bool $habilitado;
    private string $rol;

    private BaseDatos $db;

    /*
    public function __construct(string|null $id,string $nombre,string $apellidos,string $email,string $password,string $rol){
        $this->db=new BaseDatos();
        $this->id=$id;
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
        $this->email=$email;
        $this->password=$password;
        $this->rol=$rol;
    }
*/
    /**
     * @param string|null $id
     * @param string $nombreUsuario
     * @param string $password
     * @param mixed $DNI
     * @param string $nombreCompleto
     * @param string $apellidoUNO
     * @param string $apellidoDos
     * @param string $email
     * @param bool $habilitado
     * @param string $rol
     */
    public function __construct(?string $id, string $nombreUsuario, string $password, mixed $DNI, string $nombreCompleto, string $apellidoUNO, string $apellidoDos, string $email, bool $habilitado, string $rol){
        $this->db=new BaseDatos();
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->DNI = $DNI;
        $this->nombreCompleto = $nombreCompleto;
        $this->apellidoUNO = $apellidoUNO;
        $this->apellidoDos = $apellidoDos;
        $this->email = $email;
        $this->habilitado = $habilitado;
        $this->rol = $rol;
    }



    public static function fromArray(array $data): Usuario {
        return new Usuario(
            $data['id']?? null,
            $data['nombreUsuario']?? '',
                $data['password']?? '',
                $data['DNI']?? '',
                $data['nombreCompleto']?? '',
            $data['apellidoUno']?? '',
                $data['apellidoDos']?? '',
            $data['email']?? '',
                $data['habilitado']?? true,
            $data['rol']?? '',
        );
    }

    public function desconecta(){
        $this->db->cierraConexion();
    }
    public function create(){
        $id=null;
        $nombreUsuario=$this->getNombreUsuario();
        $password=$this->getPassword();
        $DNI=$this->getDNI();
        $nombreCompleto=$this->getNombreCompleto();
        $apellidoUNO=$this->getApellidoUNO();
        $apellidoDOS=$this->getApellidoDos();
        $email=$this->getEmail();
        $habilitado=$this->isHabilitado();
        $rol='profesor';

        try {
            $stm=$this->db->preparada("insert into usuarios (id,nombreUsuario,password,dni,nombreCompleto,apellidoUNO,apellidoDOS,email,habilitado,rol)values(:id,:nombreUsuario,:password,:dni,:nombreCompleto,:apellidoUNO,:apellidoDOS,:email,:habilitado,:rol) ");
            $stm->bindValue(":id",$id);
            $stm->bindValue(":nombreUsuario",$nombreUsuario);
            $stm->bindValue(":password",$password);
            $stm->bindValue(":dni",$DNI);
            $stm->bindValue(":nombreCompleto",$nombreCompleto);
            $stm->bindValue(":apellidoUNO",$apellidoUNO);
            $stm->bindValue(":apellidoDOS",$apellidoDOS);
            $stm->bindValue(":email",$email);
            $stm->bindValue(":habilitado",$habilitado);
            $stm->bindValue(":rol",$rol);
            $stm->execute();
            $resultado=true;
        }catch (\PDOException $e){
            $resultado=false;
        }
        return $resultado;
    }
    public function update(){
        $id=$this->getId();
        $nombreUsuario=$this->getNombreUsuario();
        $password=$this->getPassword();
        $DNI=$this->getDNI();
        $nombreCompleto=$this->getNombreCompleto();
        $apellidoUNO=$this->getApellidoUNO();
        $apellidoDOS=$this->getApellidoDos();
        $email=$this->getEmail();
        $habilitado=$this->isHabilitado();
        $rol='profesor';

        try {
            $stm=$this->db->preparada("update usuarios set nombreUsuario=':nombreUsuario',
                    nombreCompleto=':nombreCompleto',dni=':dni',password=':password',apellidoUNO=':apellidoUNO',
                    apellidoDOS=':apellidoDOS',email':email',habilitado=':habilitado',rol=':rol' where id=':id'  ");
            $stm->bindValue(":id",$id);
            $stm->bindValue(":nombreUsuario",$nombreUsuario);
            $stm->bindValue(":password",$password);
            $stm->bindValue(":dni",$DNI);
            $stm->bindValue(":nombreCompleto",$nombreCompleto);
            $stm->bindValue(":apellidoUNO",$apellidoUNO);
            $stm->bindValue(":apellidoDOS",$apellidoDOS);
            $stm->bindValue(":email",$email);
            $stm->bindValue(":habilitado",$habilitado);
            $stm->bindValue(":rol",$rol);
            $stm->execute();
            $resultado=true;
        }catch (\PDOException $e){
            $resultado=false;
        }
        return $resultado;
    }
    public function login(){
        $nombreUsuario = $this->getNombreUsuario();
        $password=$this->getPassword();
        $usuario=$this->buscaUsuario($nombreUsuario);
        print_r($usuario);
        die();
        if ($usuario !==false){
            $verify=password_verify($password,$usuario->password);
            if ($verify){
                return $usuario;
            }
        }else{
            return false;
        }
    }
    public function desabilitado(){
        $nombreUsuario=$this->getNombreUsuario();
        $usuario=$this->buscaUsuario($nombreUsuario);
        $id=$usuario->id;
        try {
            $stm=$this->db->preparada("update usuarios set habilitado='false' where id=':id' ");
            $stm->bindValue(":id",$id);
            $stm->execute();
            $resultado=true;
        }catch (\PDOException $e){
            $resultado=false;
        }
        return $resultado;
    }
    public function buscaDNI(){
        $dni=$this->getDNI();
        $cons=$this->db->preparada("SELECT * FROM usuarios WHERE dni=:dni");
        $cons->bindValue(':dni',$dni,PDO::PARAM_STR);
        try{
            $cons->execute();
            if ($cons && $cons->rowCount()==1){
                $result=true;
            }
        }catch (PDOException $err){
            $result=false;
        }
        return $result;
    }
    public function buscaID(){
        $id=$this->getId();
        $cons=$this->db->preparada("SELECT * FROM usuarios WHERE id=:id");
        $cons->bindValue(':id',$id,PDO::PARAM_STR);
        try{
            $cons->execute();
            if ($cons && $cons->rowCount()==1){
                $result=$cons->fetch(PDO::FETCH_OBJ);
            }else{
                $result=false;
            }
        }catch (PDOException $err){
            $result=false;
        }
        return $result;
    }
    public function buscaUsuario($nombreUsuario){
        $cons=$this->db->preparada("SELECT * FROM usuarios WHERE nombreUsuario=:nombreUsuario");
        $cons->bindValue(':nombreUsuario',$nombreUsuario,PDO::PARAM_STR);
        try{
            $cons->execute();
            if ($cons && $cons->rowCount()==1){
                $result=$cons->fetch(PDO::FETCH_OBJ);
            }
        }catch (PDOException $err){
            $result=false;
        }
        return $result;
    }
    public function getAll(){
        $this->db->consulta("select * from usuarios order by id desc ;");
        $categorias=$this->db->extraer_todos();
        $this->db->cierraConexion();
        return $categorias;
    }

    /* GETTERS Y SETTERS */

    public function getId(): ?string{
        return $this->id;
    }
    public function setId(?string $id): void{
        $this->id = $id;
    }
    public function getNombreUsuario(): string{
        return $this->nombreUsuario;
    }
    public function setNombreUsuario(string $nombreUsuario): void{
        $this->nombreUsuario = $nombreUsuario;
    }
    public function getPassword(): string{
        return $this->password;
    }
    public function setPassword(string $password): void{
        $this->password = $password;
    }
    public function getDNI(): mixed{
        return $this->DNI;
    }
    public function setDNI(mixed $DNI): void{
        $this->DNI = $DNI;
    }
    public function getNombreCompleto(): string{
        return $this->nombreCompleto;
    }
    public function setNombreCompleto(string $nombreCompleto): void{
        $this->nombreCompleto = $nombreCompleto;
    }
    public function getApellidoUNO(): string{
        return $this->apellidoUNO;
    }
    public function setApellidoUNO(string $apellidoUNO): void{
        $this->apellidoUNO = $apellidoUNO;
    }
    public function getApellidoDos(): string{
        return $this->apellidoDos;
    }
    public function setApellidoDos(string $apellidoDos): void{
        $this->apellidoDos = $apellidoDos;
    }
    public function getEmail(): string{
        return $this->email;
    }
    public function setEmail(string $email): void{
        $this->email = $email;
    }
    public function isHabilitado(): bool{
        return $this->habilitado;
    }
    public function setHabilitado(bool $habilitado): void{
        $this->habilitado = $habilitado;
    }
    public function getRol(): string{
        return $this->rol;
    }
    public function setRol(string $rol): void{
        $this->rol = $rol;
    }

}