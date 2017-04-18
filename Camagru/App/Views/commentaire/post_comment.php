<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 4/18/17
 * Time: 6:09 PM
 */

if (isset($errors) && $errors) {
    foreach ($errors as $error) {
        echo $error;
    }
}