<?php
/**
 * Created by PhpStorm.
 * User: mmoullec
 * Date: 3/8/17
 * Time: 4:34 PM
 */
$pseudo = null;
$controller = new \App\Controller\UserController();
if (isset($_SESSION['auth'])) {
    $pseudo = $controller->user->FindPseudoWithId($_SESSION['auth'])->pseudo;
}
?>

<header class="header">
<!--bouton Home-->
    <form action="index.php" method="get">
        <input type="hidden" name="p" value="user.index">
        <button type="submit">Home <?= $pseudo ?></button>
    </form>
<!--    bouton home-->

    <form action="" method="get">
    <input type="hidden" name="p" value="user.gallery">
    <button type="submit">Gallery</button>
    </form>

    <form action="index.php" method="get">
        <input type="hidden" name="p" value="register.logout">
        <button type="submit">Logout</button>
    </form>

    <form action="index.php" method="get">
        <input type="hidden" name="p" value="user.compte">
        <button type="submit">Compte</button>
    </form>

<!--    <form action="index.php" method="get">-->
<!--        <input type="hidden" name="p" value="restore.clean">-->
<!--        <button type="submit">Restore</button>-->
<!--    </form>-->
</header>
