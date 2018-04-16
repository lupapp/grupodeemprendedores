<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 04/04/2018
 * Time: 16:11
 */

class Clasificacion extends Mysqli
{
    private $id;
    private $nombre;
    private $porcentaje;
    private $icono;
    private $min;
    private $max;

    public function __construct(Conexion $con)
    {
        $this->con=$con;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getPorcentaje()
    {
        return $this->porcentaje;
    }

    /**
     * @param mixed $porcentaje
     */
    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;
    }

    /**
     * @return mixed
     */
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * @param mixed $icono
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;
    }

    /**
     * @return mixed
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param mixed $min
     */
    public function setMin($min)
    {
        $this->min = $min;
    }

    /**
     * @return mixed
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param mixed $max
     */
    public function setMax($max)
    {
        $this->max = $max;
    }


    public function save(){
        $query="INSERT INTO clasificaciones (id, nombre, porcentaje, icono, min, max)"
        ."VALUES (NULL, '".$this->nombre."', '".$this->porcentaje."', '".$this->icono."', '".$this->min."', '".$this->max."')";
        $save=$this->con->query($query);
        return $save;
    }
    public function getAll(){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM clasificaciones");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function getUltimoRegistro(){
        $query=$this->con->query("SELECT * FROM clasificaciones ORDER BY id DESC LIMIT 1");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }
    public function getById($id){
        $query=$this->con->query("SELECT * FROM clasificaciones WHERE id=$id");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }
    public function update($id){
        $query="UPDATE clasificaciones SET nombre='".$this->nombre."',porcentaje='".$this->porcentaje."',"
            ."icono='".$this->icono."',min='".$this->min."',max='".$this->max."' WHERE id=$id";
        $update=$this->con->query($query);
        return $update;
    }
}