<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 25/04/2018
 * Time: 16:50
 */

class Cupon extends Mysqli
{
    private $id;
    private $cupon;
    private $fecha;
    private $vencimiento;
    private $descuento;

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
    public function getCupon()
    {
        return $this->cupon;
    }

    /**
     * @param mixed $cupon
     */
    public function setCupon($cupon)
    {
        $this->cupon = $cupon;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getVencimiento()
    {
        return $this->vencimiento;
    }

    /**
     * @param mixed $vencimiento
     */
    public function setVencimiento($vencimiento)
    {
        $this->vencimiento = $vencimiento;
    }

    /**
     * @return mixed
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * @param mixed $descuento
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }
    public function save(){
        $query="INSERT INTO comentarios (id, cliente, producto, fecha, hora, comentario, estado)"
            ."VALUES (NULL, '".$this->cliente."', '".$this->producto."',"
            ."'".$this->fecha."', '".$this->hora."','".$this->comentario."', '".$this->estado."')";
        $save=$this->con->query($query);
        return $save;
    }
    public function getAll(){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM comentarios");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function getUltimoRegistroByProducto($id){
        $query=$this->con->query("SELECT * FROM comentarios WHERE producto=$id ORDER BY id DESC LIMIT 1");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }else{
            $resultset='';
        }
        return $resultset;
    }
    public function getByIdProducto($id){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM comentarios WHERE producto=$id");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function getById($id){
        $query=$this->con->query("SELECT * FROM comentarios WHERE id=$id");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }
    public function delete($id){
        $query=$this->con->query("DELETE FROM comentarios WHERE id=$id");
        return $query;
    }
    public function update($id){
        $query="UPDATE comentarios SET estado='".$this->estado."' WHERE id=$id";
        $update=$this->con->query($query);
        return $update;
    }
}