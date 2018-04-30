<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 04/04/2018
 * Time: 16:11
 */

class Producto extends Mysqli
{
    private $id;
    private $ref;
    private $categoria;
    private $clasificacion;
    private $name;
    private $valor;
    private $esp;
    private $descripcion;
    private $detalle;
    private $stock;
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
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function getClasificacion()
    {
        return $this->clasificacion;
    }

    /**
     * @param mixed $clasificacion
     */
    public function setClasificacion($clasificacion)
    {
        $this->clasificacion = $clasificacion;
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
    public function getEsp()
    {
        return $this->esp;
    }

    /**
     * @param mixed $esp
     */
    public function setEsp($esp)
    {
        $this->esp = $esp;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * @param mixed $detalle
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    }

    /**
     * @return mixed
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @param mixed $ref
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function save(){

        $query="INSERT INTO productos (id, ref, categoria, clasificacion, name, valor, esp, descripcion, detalle, stock)"
        ."VALUES (NULL, '".$this->ref."', '".$this->categoria."', '".$this->clasificacion."', '".$this->name."', '".$this->valor."',"
        ." '".$this->esp."','".$this->descripcion."', '".$this->detalle."', '".$this->stock."')";
        $save=$this->con->query($query);
        return $save;
    }
    public function getAll(){
        $query=$this->con->query("SELECT * FROM productos");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function getAllNot($id){
        $query=$this->con->query("SELECT * FROM productos WHERE NOT categoria=$id");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function getUltimoRegistro(){
        $query=$this->con->query("SELECT * FROM productos ORDER BY id DESC LIMIT 1");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }
    public function getById($id){
        $query=$this->con->query("SELECT * FROM productos WHERE id=$id");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }
    public function getByIdCat($id){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM productos WHERE categoria=$id");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function getSearch($criterio){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM productos WHERE name LIKE '%$criterio%' OR descripcion LIKE'%$criterio%' OR detalle LIKE '%$criterio%' OR valor LIKE '%$criterio%'");
        while($row=$query->fetch_object()) {
            $resultset[] = $row;
        }
        return $resultset;
    }
    public function update($id){
        $query="UPDATE productos SET name='".$this->name."',ref='".$this->ref."', categoria='".$this->categoria."',"
            ."clasificacion='".$this->clasificacion."',valor='".$this->valor."',esp='".$this->esp."',"
            ."descripcion='".$this->descripcion."', detalle='".$this->detalle."', stock='".$this->stock."' WHERE id=$id";
        $update=$this->con->query($query);
        return $update;
    }
    public function delete($id){
        $query=$this->con->query("DELETE FROM productos WHERE id=$id");
        return $query;
    }
}