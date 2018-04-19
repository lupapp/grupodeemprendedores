<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 19/04/2018
 * Time: 5:07
 */

class Options extends Mysqli
{
    private $id;
    private $name;
    private $valor;
    private $estado;
    private $borrar;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
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
    public function getBorrar()
    {
        return $this->borrar;
    }

    /**
     * @param mixed $borrar
     */
    public function setBorrar($borrar)
    {
        $this->borrar = $borrar;
    }
     public function save(){
         $query="INSERT INTO options (id, name, valor, estado, borrar)"
         ."VALUES (NULL, '".$this->name."', '".$this->valor."', '".$this->estado."', '".$this->borrar."')";
         $save=$this->con->query($query);
         return $save;
     }

     public function getAll(){
         $query=$this->con->query("SELECT * FROM options");
         while($row=$query->fetch_object()){
             $resultset[]=$row;
         }
         return $resultset;
     }

     public function getById($id){
         $query=$this->con->query("SELECT * FROM options WHERE id=$id");
         if($row=$query->fetch_object()){
             $resultset=$row;
         }
         return $resultset;
     }

    public function getByName($name){
        $query=$this->con->query("SELECT * FROM options WHERE name='$name'");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }

     public function update($id){
         $query="UPDATE options SET valor='".$this->valor."', estado='".$this->estado."',"
             ."name='".$this->name."',borrar='".$this->borrar."' WHERE id=$id";
         $update=$this->con->query($query);
         return $update;
     }

     public function delete($id){
         $query=$this->con->query("DELETE FROM options WHERE id=$id");
         return $query;
     }

}