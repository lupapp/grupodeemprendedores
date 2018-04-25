<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 12/04/2018
 * Time: 11:30
 */

class Comentario extends Mysqli
{
    private $id;
    private $cliente;
    private $producto;
    private $comentario;
    private $estado;
    private $fecha;
    private $hora;


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
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * @param mixed $comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
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