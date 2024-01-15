<?php

namespace Models;

class Pelicula
{
    private string|null $id;
    private string $titulo;
    private string $director;
    private string $genero;
    private string $fecha;

    private BaseDatos $db;

    /**
     * @param string|null $id
     * @param string $titulo
     * @param string $director
     * @param string $genero
     * @param string $año
     */
    public function __construct(?string $id, string $titulo, string $director, string $genero, string $fecha)
    {
        $this->db=new BaseDatos();
        $this->id = $id;
        $this->titulo = $titulo;
        $this->director = $director;
        $this->genero = $genero;
        $this->fecha = $fecha;
    }

    public static function fromArray(array $data): Pelicula {
        return new Pelicula(
            $data['id']?? null,
            $data['titulo']?? '',
            $data['director']?? '',
            $data['genero']?? '',
            $data['fecha']?? '',
        );
    }
    public function desconecta(){
        $this->db->cierraConexion();
    }
    public function buscaPeliculaPorID($id){
        $cons=$this->db->preparada("SELECT * FROM pelicula WHERE id=:id");
        $cons->bindValue(':id',$id,PDO::PARAM_STR);
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
        $this->db->consulta("select * from pelicula order by id desc ;");
        $categorias=$this->db->extraer_todos();
        $this->db->cierraConexion();
        return $categorias;
    }

    /* GETTERS Y SETTERS */
    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function getDirector(): string
    {
        return $this->director;
    }

    public function setDirector(string $director): void
    {
        $this->director = $director;
    }

    public function getGenero(): string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): void
    {
        $this->genero = $genero;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }




}