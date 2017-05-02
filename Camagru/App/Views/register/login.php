<?php if ($errors): ?>

    <?php foreach ($errors as $error): ?>
    <div style="color: red;"><?= $error; ?></div>
        <?php endforeach ?>
<?php endif ?>
<h1>Login</h1>

<div class="container">
    <form method="post" action="index.php?p=register.login">
        <h2 >Please log in</h2>
        <input name="pseudo" type="text" placeholder="Pseudo">
        <input name="passwd" type="password" placeholder="Password">
<!--        <label class="checkbox">-->
<!--            <input type="checkbox" value="remember-me"> Remember me-->
<!--        </label>-->
        <button name="action" type="submit" value="ok">Sign in</button>
    </form>
    <form action="index.php" method="get">
        <button type="submit" name="p" value="register.newmdp">Forgot password?</button>
    </form>
</div>
