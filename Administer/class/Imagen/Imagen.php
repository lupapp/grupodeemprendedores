<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 05/04/2018
 * Time: 7:52
 */

class Imagen extends Mysqli
{
    private $id;
    private $imagen;
    private $producto;
    private $pocision;
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
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * @return mixed
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * @param mixed $producto
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;
    }

    /**
     * @return mixed
     */
    public function getPocision()
    {
        return $this->pocision;
    }

    /**
     * @param mixed $posicision
     */
    public function setPocision($pocision)
    {
        $this->pocision = $pocision;
    }
    public function save(){
        $save=$this->con->query("INSERT INTO imagenes (id, imagen, producto, posicion) VALUES"
        ." (NULL, '".$this->imagen."','".$this->producto."','".$this->posicion."')");
        return $save;
    }
    public function getById($id){
        $query=$this->con->query("SELECT * FROM imagenes WHERE id=$id");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }

    public function getFirst($id){
        $query=$this->con->query("SELECT * FROM imagenes WHERE producto=$id LIMIT 1");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }else{

            $resultset='';
        }
        return $resultset;
    }
    public function getByProd($id){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM imagenes WHERE producto=$id");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function delete($id){
        $query=$this->con->query("DELETE FROM imagenes WHERE id=$id");
        return $query;
    }
}