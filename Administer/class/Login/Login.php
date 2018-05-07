<?php

class Login
{
    private $con;
    private $user;
    private $pass;
    private $mail;
    private $telefono;
    private $movil;
    private $direccion;
    private $ciudad;
    private $pais;
    private $tipo;
    public function __construct(Conexion $con)
    {
        $this->con=$con;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
        return $this;
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
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * @param mixed $movil
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;
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

    public function signIn() {
        $query="SELECT * FROM usuarios WHERE usuario='$this->user' AND clave='$this->pass'";
        $resp=$this->con->query($query);
        if($this->con->affected_rows > 0) {
            if ($row=$resp->fetch_array(MYSQLI_ASSOC)) {
                $res=array(
                    'user'=>$row,
                    'existe'=>true,
                    'ms'=>'Usuario existe'
                );

            }
        }else{
            $res=array(
                'user'=>'',
                'existe'=>false,
                'ms'=>'Usuario o contraseña incorrectos'
            );
        }
        return $res;
    }
    public function logout() {
        session_start();
        unset($_SESSION['user']);
        header('Location: login.php');
    }
    public function recordarPass(){
        $query="SELECT * FROM usuarios WHERE mail='$this->mail'";
        $resp=$this->con->query($query);
        if($this->con->affected_rows > 0) {
            if ($row=$resp->fetch_array(MYSQLI_ASSOC)) {
                $mensaje= '.<h2>Recuperar contraseña </h2>
                <ul>
                <li><strong>Su contraseña es:</strong> '.$row['clave'].'</li>
                <li>Ingrese <a href="http://www.grupodeemprededores.com/index/GE-login.php" target="_blank">Aqui</a></li>
                </ul>';
                $to = $row['mail'];
                $from = 'MIME-Version: 1.0' . "\r\n";
                $from .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $from .= 'To:' . $row['mail'] . '' . "\r\n";
                $from .= 'From: Do_Not_reply@grupodeemprendedores.com' . "\r\n";
                date_default_timezone_set('America/Bogota');
                $tema = "Recuperar Contraseña";

                @mail($to, $tema, utf8_decode($mensaje), $from);
                $res = array(
                    'user' => $row,
                    'existe' => true,
                    'ms' => 'Contraseña recuperada'
                );
            }
        }else{
            $res=array(
                'user'=>'',
                'existe'=>false,
                'ms'=>'Correo incorrecto'
            );
        }
        return $res;
    }

}