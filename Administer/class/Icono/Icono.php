<?php
/**
 * Created by PhpStorm.
 * User: Julian
 * Date: 11/04/2018
 * Time: 4:18
 */

class Icono extends Mysqli
{
    private $id;
    private $icono;
    private $clase;
    private $zise;

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
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * @param mixed $icono
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;
    }

    /**
     * @return mixed
     */
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * @param mixed $clase
     */
    public function setClase($clase)
    {
        $this->clase = $clase;
    }

    /**
     * @return mixed
     */
    public function getZise()
    {
        return $this->zise;
    }

    /**
     * @param mixed $zise
     */
    public function setZise($zise)
    {
        $this->zise = $zise;
    }

    public function save(){
        $save=$this->con->query("INSERT INTO iconos (id, icon, clase, zise) VALUES"
            ."(NULL,'fas fa-users', '','')");
        return $save;
    }
    public function getAll()
    {
        $resultset = [];
        $query = $this->con->query("SELECT * FROM iconos");
        while ($row = $query->fetch_object()) {
            $resultset[] = $row;
        }
        return $resultset;

        $iconos = [
            'fas fa-users', 'fas fa-user', 'fas fa-user-md', 'fas fa-user-secret', 'fas fa-user-circle', 'fas fa-male', 'fas fa-female', 'fas fa-microphone',
            'fab fa-accessible-icon', 'fas fa-building', 'fas fa-adjust', 'fab fa-adn', 'fab fa-algolia', 'fas fa-allergies',
            'fas fa-american-sign-language-interpreting', 'fas fa-ambulance', 'fas fa-anchor', 'fab fa-angellist', 'fab fa-apple',
            'fas fa-archive', 'fas fa-address-book', 'fas fa-address-card', 'fas fa-balance-scale', 'fas fa-band-aid', 'fab fa-avianex',
            'fas fa-assistive-listening-systems', 'fas fa-at', 'fas fa-baseball-ball', 'fas fa-bell', 'fas fa-bicycle', 'fas fa-binoculars',
            'fab fa-black-tie', 'fas fa-blind', 'fas fa-bomb', 'fab fa-bitcoin', 'fas fa-box', 'fas fa-box-open', 'fas fa-briefcase',
            'fas fa-calendar-alt', 'fas fa-car', 'fas fa-comments', 'fas fa-flask', 'fas fa-gift', 'fas fa-image', 'fas fa-book',
            'fas fa-graduation-cap', 'fas fa-puzzle-piece', 'fas fa-couch', 'fas fa-cubes', 'fas fa-cut'
        ];
    }
}