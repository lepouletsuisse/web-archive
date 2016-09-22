<?php
header('Content-type: text/html; charset=UTF-8');

class Utilisateur
{
    public $id;
    public $nom = array();
    public $prenom = array();
    public $naissance;
    public $ville;
    public $npa;
    public $rue;
    public $numero;

    public function __construct($id, $nom, $prenom, $naissance, $ville, $npa, $rue, $numero)
    {
        $this->id = $id;
        $this->nom = array($nom);
        $this->prenom = array($prenom);
        $this->naissance = $naissance;
        $this->ville = $ville;
        $this->npa = $npa;
        $this->rue = $rue;
        $this->numero = $numero;
    }

    public function __toString()
    {

        $str = "<li><h3>" . implode(" ", $this->prenom) . " " . implode(" ", $this->nom) .
            "</h3><ul>" .
            "<li>Né(e) le: " . $this->naissance . "</li>" .
            "<li>" . $this->rue . ", " . $this->numero .
            "<br/>" . $this->npa . ", " . $this->ville . "</li>"
            . "</ul></li>";

        return $str;
    }

}
