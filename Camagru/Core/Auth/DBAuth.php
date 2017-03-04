<?php

namespace Core\Auth;

use Core\Database\Database;
use Core\Debug\Debug;

class DBAuth {

    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getUserId() {
        if ($this->logged()) {
            return $_SESSION['auth'];
        }
        return false;
    }


    /*
     *
     * @param userame
     * @param passwd
     * @return booleen
     *
     */
    public function login($username, $passwd) {
        $user = $this->db->prepare('SELECT * from user Where pseudo= ? ', [$username], null, true);
        if ($user) {
            if ($user->passwd = hash('whirlpool', $passwd)) {
                $_SESSION['auth'] = $user->id;
                return true;
            }
        }
        return false;
    }

    public function logged() {
        return isset($_SESSION['auth']);
    }

    public function logout() {
        if ($this->logged()) {
            unset($_SESSION['auth']);
        }
    }
}