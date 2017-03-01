<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 28/02/2017
 * Time: 14:55
 */

namespace Core\Table;

use Core\Database\Database;

class Table
{

    protected $table;

    /*
     * Variable $db ou je récupere l'instance de la class Database
     */
    protected $db;

    /*
     * Le constructeur prend en parametres une instance de la class DB car la class Table et tout son heritage
     * auront besoin de se connecter a la DB
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
        if (is_null($this->table)) {
        $parts = explode('\\', get_class($this));
        $class_name = end($parts);
        $class_name = str_replace('Table', '', $class_name);
        $this->table = strtolower($class_name);
        }
    }

    /*
     * connection a la DB et SELECT * FROM *;
     * l'instance de la DB est un parametre protegé de la classe;
     */
    public function all() {
        return ($this->query('SELECT * from ' . $this->table));
    }

    public function find($id) {
        return $this->query("
        SELECT * from " . $this->table . " 
        WHERE id = ?
        ", [$id], true);
    }

    public function query ($statement, $attributes = null, $one = false) {
        if ($attributes) {
            return
                $this->db->prepare(
                $statement,
                $attributes,
                str_replace('Table', 'Entity', get_class($this)),
                $one
            );
        }
        else {
            return
                $this->db->query(
                $statement,
                str_replace('Table', 'Entity', get_class($this)),
                $one
            );

        }

    }
}
