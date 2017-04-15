<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 4/15/17
 * Time: 11:50 AM
 */

namespace App\Controller;


class RestoreController extends AppController
{
    public function restart_session() {
        \App::getInstance()->getDB()->delete_db();
        session_destroy();
        session_start();
    }

    private function removedir($dir)
    {
        foreach (scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) continue;
            if (is_dir("$dir/$file")) {
                $this->removedir("$dir/$file");
            }
            else unlink("$dir/$file");
        }
        rmdir($dir);
    }

    public function remove_photos () {
        if (file_exists('Public/Photos')) {
            $this->removedir('Public/Photos');
        }
    }

    public function clean() {
        $this->remove_photos();
        $this->restart_session();
    }
}