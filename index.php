<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>GMan</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Fira+Mono|Montserrat:400,500" rel="stylesheet">
    <?php
      $arrayName = array('README.md', 'README.txt', 'README');
    ?>
  </head>
  <body>
    <div class="top">
      <h1 class="title">gMan</h1>
      <h4 class="subtitle">The most aesthetic GitHub README viewer.</h4>
    </div>
    <div class="input">
      <form action="" method="get">
        <label>github.com/</label>
        <input name="username" spellcheck=false type="text" placeholder="username">
        <input name="repo" spellcheck=false type="text" placeholder="repo">
        <input type="submit" value="Go!">
      </form>
    </div>
    <div class="result">
      <div class="inner">
        <h1 class="filename">
          <?php
            if (!isset($_GET["username"]) || !isset($_GET["repo"])) {
              echo "You haven't specified a repo yet.";
            } else {

            }
          ?>
        </h1>
        <div class="file">
        </div>
      </div>
    </div>
  </body>
</html>
