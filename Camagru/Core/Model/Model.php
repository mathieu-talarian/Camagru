<?php

/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 28/02/2017
 * Time: 14:55
 */

namespace Core\Model;

use Core\Debug\Debug;
use Core\Database\Database;

class Model
{
    /**
     * @var string
     * nom de la table en cours, peut etre modifiee manuellement
     * dans la classe qui herite si le nom differe du nom dans la DB
     */
    protected $table;

    /**
     * @var Database
     * Variable $db ou je récupere l'instance de la class Database
     *
     */
    protected $db;

    /**
     * Table constructor.
     * @param Database $db
     * Le constructeur prend en parametres une instance de la class DB car la class Table et tout son heritage
     * auront besoin de se connecter a la DB
     */
    public function __construct(Database $db) {
        $this->db = $db;
        if (is_null($this->table)) {
        $parts = explode('\\', get_class($this));
        $class_name = end($parts);
        $class_name = str_replace('Model', '', $class_name);
        $this->table = strtolower($class_name);
        }
    }

    /**
     * @return mixed
     * connection a la DB et SELECT * FROM * (renvoie toute la table)
     * l'instance de la DB est un parametre protegé de la classe;
     */
    public function all() {
        return ($this->query("SELECT * from {$this->table}"));
    }

    /**
     * @param $id
     * @return mixed
     * recherche dans la table en fonction de l'id passee en parametre
     */
    public function findwithid($id) {
        return $this->query("
        SELECT * from " . $this->table . " 
        WHERE id = ?
        ", [$id], true);
    }

    public function lastInsertId() {
        return $this->db->lastInsertId();
    }

    public function update($id, $fields) {
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $k => $v) {
            $sql_parts [] = "$k = ?";
            $attributes [] = $v;
        }
        $attributes [] = $id;
        $sql_part = implode(', ', $sql_parts);
       return $this->query(
           "UPDATE {$this->table} SET $sql_part WHERE id= ?",
           $attributes,
           true);
    }

    public function create($fields) {
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $k => $v) {
            $sql_parts [] = "$k = ?";
            $attributes [] = $v;
        }
        $sql_part = implode(', ', $sql_parts);
        return $this->query(
            "INSERT INTO {$this->table} SET $sql_part",
            $attributes,
            true);
    }

    public function delete($id) {

        return $this->query(
            "DELETE FROM {$this->table} WHERE id= ?",
            [$id],
            true);
    }

    public function extract_list($key, $value) {
        $records = $this->all();
        $return = [];
        foreach ($records as $k => $v) {
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }

    /**
     * @param $statement
     * @param null $attributes
     * @param bool $one
     * @return mixed
     * fonction qui appelle une connection prepare a la DB
     * On change le nom de la classe passee en parametres:
     * -PostTable devient EntityTable
     * -la fonction PDO:prepare et PDO:execute peuvent modifier la facon de rendu
     * Ici dans MysqlDatabase, on a choisi d'utiliser PDO::FETCH_CLASS qui renvoie
     * Un objet de classe & un tableau
     * ce qui nous permet d'utiliser la class Entity pour recuperer les donnees
     * dans cet objet renvoye
     */
    public function query ($statement, $attributes = null, $one = false) {

        if ($attributes) {
            return
                $this->db->prepare(
                $statement,
                $attributes,
                str_replace('Model', 'Entity', get_class($this)),
                $one
            );
        }

        else
           {
            return
                $this->db->query(
                $statement,
                str_replace('Model', 'Entity', get_class($this)),
                $one
            );
        }
    }

    public function json_query ($statement, $attributes = null, $one = false) {
        if ($attributes) {
            return ($this->db->json_prepare($statement, $attributes, $one));
        }
        else {
            return ($this->db->json_query($statement, $one));
        }
    }
}
