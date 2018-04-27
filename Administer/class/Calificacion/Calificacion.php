<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 25/04/2018
 * Time: 16:49
 */

class Calificacion extends Mysqli
{
    private $id;
    private $producto;
    private $user;
    private $calificacion;
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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * @param mixed $calificacion
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    }
    public function save(){
        $query="INSERT INTO calificaciones (id,producto, user, calificacion)"
            ."VALUES (NULL, '".$this->producto."', '".$this->user."', '".$this->calificacion."')";
        $save=$this->con->query($query);
        return $save;
    }
    public function getPromedio($id){
        $query=$this->con->query("SELECT SUM(calificacion)/COUNT(id) AS promedio FROM calificaciones WHERE producto=$id");
        $row=$query->fetch_object();
        $promedio=$row->promedio;
        $prom=round($promedio,0);
        return $prom;
    }
    public function verificar($idpro,$iduser){
        $resulset='';
        $query=$this->con->query("SELECT * FROM calificaciones WHERE producto=$idpro AND user=$iduser");
        if($row=$query->fetch_object()){
            $resulset=$row;
        }

        return $resulset;
    }
    public function getAll(){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM calificaciones");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function getUltimoRegistroByProducto($id){
        $query=$this->con->query("SELECT * FROM calificaciones WHERE producto=$id ORDER BY id DESC LIMIT 1");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }else{
            $resultset='';
        }
        return $resultset;
    }
    public function getByIdProducto($id){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM calificaciones WHERE producto=$id");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function getById($id){
        $query=$this->con->query("SELECT * FROM calificaciones WHERE id=$id");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }
    public function delete($id){
        $query=$this->con->query("DELETE FROM calificaciones WHERE id=$id");
        return $query;
    }
    public function update($id){
        $query="UPDATE calificaciones SET calificacion='".$this->calificacion."' WHERE id=$id";
        $update=$this->con->query($query);
        return $update;
    }
}