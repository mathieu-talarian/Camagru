<?php
/**
 * Created by PhpStorm.
 * User: mathieumoullec
 * Date: 04/03/2017
 * Time: 16:07
 */

?>

<?php if (isset($pseudo)): ?>
<form action="index.php" method="get">
    <input type="hidden" name="p" value="user.index">
    <button type="submit"><?=$pseudo?></button>
</form>
    <form action="index.php" method="get">
    <input type="hidden" name="p" value="user.logout">
    <button type="submit">Logout</button>
</form>

<?php endif ?>

    <?php if (!isset($pseudo)): ?>
<form action="index.php" method="get">
    <input type="hidden" name="p" value="user.login.index">
<button type="submit">Login</button>
</form>
    <?php endif ?>
<form action="index.php" method="get">
    <input type="hidden" name="p" value="user.inscription.index">
    <button type="submit">Inscription</button>
</form>