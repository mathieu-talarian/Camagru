<?php

namespace Core\Auth;

use Core\Database\Database;
use Core\Debug\Debug;

class DBAuth {

    private $db;


    public function __construct(Database $db) {
        $this->db = $db;
    }


    /*
     *
     * @param userame
     * @param passwd
     * @return booleen
     *
     */
    public function login($username, $passwd) {
        $user = $this->db->prepare('SELECT * from admin Where name= ? ', $username, null, true);
        Debug::getInstance()->vd($user);
    }

    public function logged() {
        return isset($_SESSION['auth']);
    }
}