    <div class="container">
      <?php

        //   echo '$_SESSION</br>';
        //   var_dump($_SESSION);
        // echo '</br>';
        //
        //   echo '$_POST</br>';
        //   var_dump($_POST);
        //   echo '</br>';

      if (!isset($_SESSION['name'])) {
        echo '<a href="index.php?p=login">Log in</a></br>';
        echo '<a href="index.php?p=signin">Sign in</a></br>';
      }
      else {
        echo 'Bonjour' . $_SESSION['name'] . '</br>';
      }
      ?>
        <h1>CAMAGRU</h1>
    </div>
