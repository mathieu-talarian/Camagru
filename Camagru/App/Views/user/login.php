<?php if ($errors): ?>

    <div style="color: red;">Identifiants incorrects</div>
<?php endif ?>
<h1>Login</h1>

<div class="container">
    <form method="post" action="index.php?p=user.login.index">
        <h2 >Please log in</h2>
        <input name="pseudo" type="text" placeholder="Pseudo">
        <input name="passwd" type="password" placeholder="Password">
<!--        <label class="checkbox">-->
<!--            <input type="checkbox" value="remember-me"> Remember me-->
<!--        </label>-->
        <button name="action" type="submit" value="ok">Sign in</button>
    </form>
</div>
