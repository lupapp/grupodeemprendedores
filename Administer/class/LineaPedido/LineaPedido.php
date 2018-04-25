<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 12/04/2018
 * Time: 13:53
 */

class LineaPedido extends Mysqli
{
    private $id;
    private $pedido;
    private $img;
    private $nomPro;
    private $idPro;
    private $valorPro;
    private $cantidad;
    private $totalLinea;
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

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getNomPro()
    {
        return $this->nomPro;
    }

    /**
     * @param mixed $nomPro
     */
    public function setNomPro($nomPro)
    {
        $this->nomPro = $nomPro;
    }

    /**
     * @return mixed
     */
    public function getIdPro()
    {
        return $this->idPro;
    }

    /**
     * @param mixed $idPro
     */
    public function setIdPro($idPro)
    {
        $this->idPro = $idPro;
    }

    /**
     * @return mixed
     */
    public function getValorPro()
    {
        return $this->valorPro;
    }

    /**
     * @param mixed $valorPro
     */
    public function setValorPro($valorPro)
    {
        $this->valorPro = $valorPro;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    /**
     * @return mixed
     */
    public function getTotalLinea()
    {
        return $this->totalLinea;
    }

    /**
     * @param mixed $totalLinea
     */
    public function setTotalLinea($totalLinea)
    {
        $this->totalLinea = $totalLinea;
    }

    public function save(){

        $query="INSERT INTO lineaspedido (id, pedido, img, nomPro, idPro, valorPro, cantidad, totalLinea)"
            ."VALUES (NULL, '".$this->pedido."', '".$this->img."', '".$this->nomPro."',"
            ."'".$this->idPro."','".$this->valorPro."','".$this->cantidad."','".$this->totalLinea."')";
        $save=$this->con->query($query);
        return $save;
    }
    public function getAll(){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM lineaspedido");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function getUltimoRegistro(){
        $query=$this->con->query("SELECT * FROM lineaspedido ORDER BY id DESC LIMIT 1");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }
    public function getById($id){
        $query=$this->con->query("SELECT * FROM lineaspedido WHERE id=$id");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }
    public function getByIdPedido($id){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM lineaspedido WHERE pedido=$id");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function update($id){
        $query="UPDATE categorias SET nombre='".$this->nombre."',posicion='".$this->posicion."',img='".$this->img."' WHERE id=$id";
        $update=$this->con->query($query);
        return $update;
    }
}