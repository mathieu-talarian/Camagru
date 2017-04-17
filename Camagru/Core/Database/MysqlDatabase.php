<?php

/**
 * fonction exec obsolete a enlever
 */

namespace Core\Database;

use Core\Debug\Debug;
use \PDO;

class MysqlDatabase extends Database {
    /**
     * @var
     */
    private $db_name;

    /**
     * @var string
     */
    private $db_user;

    /**
     * @var string
     */
    private $db_pass;

    /**
     * @var string
     */
    private $db_host;

    /**
     * @var
     */
    private $pdo;

    /**
     * MysqlDatabase constructor.
     * @param $db_name
     * @param string $db_user
     * @param string $db_pass
     * @param string $db_host
     */
    public function __construct($db_name, $db_user = 'root', $db_pass = 'root', $db_host = 'localhost')
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    /**
     * @return PDO
     */
    public function InstallDB () {
        $e = null;
        if ($this->pdo === null) {
            try {
                $pdo = new PDO('mysql:dbname=' . $this->db_name . ';host=' . $this->db_host . '', $this->db_user, $this->db_pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;
            }
            catch (\Exception $e) {
                $pdo = new PDO('mysql:host=' . $this->db_host . '', $this->db_user, $this->db_pass);
                $pdo->exec('CREATE DATABASE IF NOT EXISTS ' . $this->db_name . ';');
                $pdo = new PDO('mysql:dbname=' . $this->db_name . ';host=' . $this->db_host . '', $this->db_user, $this->db_pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;
            }
        }
        return $this->pdo;
    }

    private function getPDO() {
        if ($this->pdo === null) {
            $pdo = new PDO('mysql:dbname=' . $this->db_name . ';host=' . $this->db_host . '', $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     * @param $statement
     * @param null $class_name
     * @param bool $one
     * @return array|mixed
     */
    public function query($statement, $class_name = null, $one = false) {
        $req = $this->getPDO()->query($statement);
        if (
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $req;
        }
        if ($class_name === null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        }
        else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    public function json_query($statement, $one = false, $to_encode) {
        $req = $this->getPDO()->query($statement);
        $req->setFetchMode(PDO::FETCH_ASSOC);
        if ($one) {
            $datas = $req->fetch();
        }
        else {
            $datas = $req->fetchAll();
        }
        if (!$to_encode) {
            return ($datas);
        }
        else {
            return (json_encode($datas));
        }
    }

    /**
     * @param $statement
     * @param $attributes
     * @param null $class_name
     * @param bool $one
     * @return array|mixed
     */
    public function prepare($statement, $attributes, $class_name = null , $one = false) {
        $req = $this->getPDO()->prepare($statement);
        $res = $req->execute($attributes);
        if (
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $res;
        }
        if ($class_name === null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        }
        else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    public function json_prepare($statement, $attributes, $one, $to_encode) {
        $req = $this->getPDO()->prepare($statement);
        $req->execute($attributes);
        $req->setFetchMode(PDO::FETCH_ASSOC);
        if ($one) {
            $datas = $req->fetch();
        }
        else {
            $datas = $req->fetchAll();
        }
        if (!$to_encode) {
            return ($datas);
        }
        else {
            return (json_encode($datas));
        }
    }

    /**
     * @param $statement
     */
    public function exec($statement) {
        $this->getPDO()->exec($statement);
    }

    /**
     * @return string
     * return l'id du dernier element affecté par PDO
     */
    public function lastInsertId() {
        return $this->getPDO()->lastInsertId();
    }

    /**
     * fonction pour supprimer la database en cours,
     * en cas de necessite de redemmarage de session
     * A EFFACER
     * @return array|mixed
     */
    public function delete_db() {
        return $this->exec("
        DROP database {$this->db_name};
        ");
    }
}