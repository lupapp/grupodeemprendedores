<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 12/04/2018
 * Time: 11:30
 */

class Pedido extends Mysqli
{
    private $id;
    private $cliente;
    private $metodoPago;
    private $estado;
    private $fecha;
    private $hora;
    private $subtotal;
    private $impuesto;
    private $descuento;
    private $total;
    private $pais;
    private $departamento;
    private $ciudad;
    private $cupon;

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
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * @return mixed
     */
    public function getMetodoPago()
    {
        return $this->metodoPago;
    }

    /**
     * @param mixed $metodoPago
     */
    public function setMetodoPago($metodoPago)
    {
        $this->metodoPago = $metodoPago;
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
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * @param mixed $hora
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    /**
     * @return mixed
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * @param mixed $subtotal
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    /**
     * @return mixed
     */
    public function getImpuesto()
    {
        return $this->impuesto;
    }

    /**
     * @param mixed $impuesto
     */
    public function setImpuesto($impuesto)
    {
        $this->impuesto = $impuesto;
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

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * @param mixed $pais
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    /**
     * @return mixed
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * @param mixed $departamento
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }

    /**
     * @return mixed
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * @param mixed $ciudad
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;
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

    public function save(){
        $query="INSERT INTO pedidos (id, cliente, metodoPago, estado, fecha, hora, subtotal, impuesto, descuento, total, pais, departamento, ciudad, cupon)"
            ."VALUES (NULL, '".$this->cliente."', '".$this->metodoPago."', '".$this->estado."'"
            .", '".$this->fecha."', '".$this->hora."', '".$this->subtotal."', '".$this->impuesto."', '".$this->descuento."', '".$this->total."'"
            .", '".$this->pais."', '".$this->departamento."', '".$this->ciudad."', '".$this->cupon."')";
        $save=$this->con->query($query);
        return $save;
    }
    public function getAll(){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM pedidos");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function getUltimoRegistro(){
        $query=$this->con->query("SELECT * FROM pedidos ORDER BY id DESC LIMIT 1");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }
    public function getExisteCupon($cupon){
        $existe=0;
        $query=$this->con->query("SELECT * FROM pedidos WHERE cupon='$cupon'");
        if($row=$query->fetch_object()){
            $existe++;
        }
        return $existe;
    }
    public function getById($id){
        $query=$this->con->query("SELECT * FROM pedidos WHERE id=$id");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }
    public function update($id){
        $query="UPDATE pedidos SET estado='".$this->estado."' WHERE id=$id";
        $update=$this->con->query($query);
        return $update;
    }

}