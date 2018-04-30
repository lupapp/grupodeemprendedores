<?php
require 'config.php';
class Conexion extends Mysqli
{
    private $host;
    private $user;
    private $pass;
    private $db;

    public function __construct()
    {
        $this->host=DB_HOST;
        $this->user=DB_USER;
        $this->pass=DB_PASS;
        $this->db=DB_NAME;
        parent::__construct($this->host, $this->user, $this->pass, $this->db);
        $this->set_charset(SETCHAR);
    }

    public function setCharset()
    {
        $this->set_charset(SETCHAR);
    }
}
