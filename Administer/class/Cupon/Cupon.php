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
    private $estado;
    private $pedido;
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
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @param mixed $descuento
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    /**
     * @return mixed
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * @param mixed $pedido
     */
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;
    }

    public function save(){
        $query="INSERT INTO cupones (id, cupon, fecha, vencimiento, descuento, estado, pedido)"
            ."VALUES (NULL, '".$this->cupon."', '".$this->fecha."',"
            ."'".$this->vencimiento."', '".$this->descuento."', '".$this->estado."', '".$this->pedido."')";
        $save=$this->con->query($query);
        return $save;
    }
    public function getAll(){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM cupones");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function getExiste($cupon){
        $existe=0;
        $query=$this->con->query("SELECT * FROM cupones WHERE cupon='$cupon' AND estado=0");
        if($row=$query->fetch_object()){
            $existe++;
        }
        return $existe;
    }
    public function getByCupon($cupon){
        $query=$this->con->query("SELECT * FROM cupones WHERE cupon='$cupon'");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }else{
            $resultset='';
        }
        return $resultset;
    }
    public function getById($id){
        $query=$this->con->query("SELECT * FROM cupones WHERE id=$id");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }
    public function delete($id){
        $query=$this->con->query("DELETE FROM cupones WHERE id=$id");
        return $query;
    }
    public function update($cupon){
        $query="UPDATE cupones SET estado='".$this->estado."', pedido='".$this->pedido."' WHERE cupon='$cupon'";
        $update=$this->con->query($query);
        return $update;
    }
}