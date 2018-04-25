<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 16/04/2018
 * Time: 8:15
 */

class User extends Mysqli
{
    private $id;
    private $user;
    private $nombre;
    private $mail;
    private $pass;
    private $telefono;
    private $celular;
    private $direccion;
    private $ciudad;
    private $pais;
    private $tipo;
    public function __construct(Conexion $con)
    {
        $this->con = $con;
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
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
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
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
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function save(){

        $query="INSERT INTO usuarios (id, usuario, clave, nombre, mail, telefono, movil, direccion, ciudad, pais, tipo)"
            ."VALUES (NULL, '".$this->user."', '".$this->pass."', '".$this->nombre."', '".$this->mail."', '".$this->telefono."'"
            .", '".$this->celular."', '".$this->direccion."', '".$this->ciudad."', '".$this->pais."', '".$this->tipo."')";
        $save=$this->con->query($query);
        return $save;
    }
    public function getAll(){
        $resultset=[];
        $query=$this->con->query("SELECT * FROM usuarios ORDER BY id");
        while($row=$query->fetch_object()){
            $resultset[]=$row;
        }
        return $resultset;
    }
    public function getUltimoRegistro(){
        $query=$this->con->query("SELECT * FROM usuarios ORDER BY id DESC LIMIT 1");
        if($row=$query->fetch_array(MYSQLI_ASSOC)){
            $resultset=$row;
        }
        return $resultset;
    }
    public function getById($id){
        $query=$this->con->query("SELECT * FROM usuarios WHERE id=$id");
        if($row=$query->fetch_object()){
            $resultset=$row;
        }
        return $resultset;
    }
    public function delete($id){
        $query=$this->con->query("DELETE FROM usuarios WHERE id=$id");
        return $query;
    }
    public function update($id){
        $query="UPDATE usuarios SET nombre='".$this->nombre."',mail='".$this->mail."',clave='".$this->pass."'"
            .",telefono='".$this->telefono."',movil='".$this->celular."',direccion='".$this->direccion."'"
            .",ciudad='".$this->ciudad."',pais='".$this->pais."',tipo='".$this->tipo."' WHERE id=$id";
        $update=$this->con->query($query);
        return $update;
    }
    public function gPass(){
        $opc_letras = TRUE; //  FALSE para quitar las letras
        $opc_numeros = TRUE; // FALSE para quitar los números
        $opc_letrasMayus = TRUE; // FALSE para quitar las letras mayúsculas
        $opc_especiales = FALSE; // FALSE para quitar los caracteres especiales
        $longitud = 12;
        $password = [];
        $letras ="abcdefghijklmnopqrstuvwxyz";
        $numeros = "1234567890";
        $letrasMayus = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $especiales ="|@#~$%()=^*+[]{}-_";
        $listado = "";
        $pass="";

        if ($opc_letras == TRUE) {
            $listado .= $letras; }
        if ($opc_numeros == TRUE) {
            $listado .= $numeros; }
        if($opc_letrasMayus == TRUE) {
            $listado .= $letrasMayus; }
        if($opc_especiales == TRUE) {
            $listado .= $especiales; }

        str_shuffle($listado);
        for( $i=1; $i<=$longitud; $i++) {
            $password[$i] = $listado[rand(0,strlen($listado)-1)];
            str_shuffle($listado);
        }

        foreach ($password as $dato_password) {
            $pass=$pass."".$dato_password;
            //return $dato_password;
        }
        $passmd5=array("passmd5"=>md5($pass),"pass"=>$pass);
        return $passmd5;

    }
    public function reset($id){
        $query="UPDATE usuarios SET clave='".$this->pass."' WHERE id=$id";
        $update=$this->con->query($query);
        return $update;
    }
}