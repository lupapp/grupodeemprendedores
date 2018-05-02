<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 30/04/2018
 * Time: 14:59
 */
class Membresia extends Mysqli
{
    private $id;
    private $id_pro;
    private $img_pro;
    private $producto;
    private $valor;
    private $user;
    private $id_user;
    private $nombre_user;
    private $mail;
    private $celular;
    private $fecha;
    private $vencimiento;
    private $estado;

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
    public function getId_pro()
    {
        return $this->id_pro;
    }

    /**
     * @param mixed $id_pro
     */
    public function setId_pro($id_pro)
    {
        $this->id_pro = $id_pro;
    }

    /**
     * @return mixed
     */
    public function getImg_pro()
    {
        return $this->img_pro;
    }

    /**
     * @param mixed $img_pro
     */
    public function setImg_pro($img_pro)
    {
        $this->img_pro = $img_pro;
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
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getNombre_user()
    {
        return $this->nombre_user;
    }

    /**
     * @param mixed $nombre_user
     */
    public function setNombre_user($nombre_user)
    {
        $this->nombre_user = $nombre_user;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @param mixed $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
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
    public function save(){
        $query="INSERT INTO membresias (id, id_pro, img_pro, producto, valor, user, id_user, nombre_user, mail, celular, fecha, vencimiento, estado)"
            ."VALUES (NULL, '".$this->id_pro."','".$this->img_pro."','".$this->producto."', '".$this->valor."','".$this->user."',"
            ."'".$this->id_user."','".$this->nombre_user."','".$this->mail."','".$this->celular."',"
            ."'".$this->fecha."','".$this->vencimiento."', '".$this->estado."')";
        $save=$this->con->query($query);
        return $save;
    }
    public function getAll(){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM membresias");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }

    public function getById($id){
        $query=$this->con->query("SELECT * FROM membresias WHERE id=$id");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }
    public function delete($id){
        $query=$this->con->query("DELETE FROM membresias WHERE id=$id");
        return $query;
    }
    public function update($id){
        $query="UPDATE membresias SET estado='".$this->estado."', vencimiento='".$this->vencimiento."' WHERE id=$id";
        $update=$this->con->query($query);
        return $update;
    }
    public function fechaVencimiento($fecha,$meses){
        date_default_timezone_set('America/Guayaquil');
        $diasmes=array(31,28,31,30,31,30,31,31,30,31,30,31);
        $biciesto=date('Y')%4;
        if($biciesto==0){
            $diasmes[1]=29;
        }
        $dias=0;
        $mes=date('n');
        $index=$mes-1;
        for($i=($mes-1);$i<(($mes-1)+$meses);$i++){
            if($i>11){

                $index=0;
            }
            $dias=$dias+$diasmes[$index];

            $index++;
        }
        $nuevafecha = strtotime ( '+'.$dias.'day' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
        return $nuevafecha;
    }
    public function verificarVencimiento($fecha){
        $diasmes=array(31,28,31,30,31,30,31,31,30,31,30,31);
        $biciesto=date('Y')%4;
        if($biciesto==0){
            $diasmes[1]=29;
        }
        $segundos = strtotime($fecha) - strtotime('now');
        $diferencia_dias = intval($segundos / 60 / 60 / 24);
        return $diferencia_dias;
    }
}