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
        <input type="hidden" value="">
        <button type="submit">Home <?= $pseudo ?></button>
    </form>
<!--    bouton home-->

    <?php if(!isset($_SESSION['auth'])): ?>
        <form action="index.php" method="get">
            <input type="hidden" name="p" value="register.login">
            <button type="submit">Login</button>
        </form>

        <form action="index.php" method="get">
            <input type="hidden" name="p" value="register.inscription">
            <button type="submit">Inscription</button>
        </form>
    <?php else: ?>
            <form action="index.php" method="get">
                <input type="hidden" name="p" value="register.logout">
                <button type="submit">Logout</button>
            </form>
    <?php endif; ?>
</header>
