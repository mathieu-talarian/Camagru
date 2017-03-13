<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?= \App::getInstance()->_titre; ?></title>
      <link href="Public/css/style.css" rel="stylesheet" type="text/css">

    </head>
<body>
    <?= $header; ?>
<div class="heart">
    <?= $content; ?>
</div>
<div class="footer">
    <?= $footer ?>
</div>
</body>
</html>
