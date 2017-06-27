<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>GMan</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Fira+Mono|Montserrat:400,500" rel="stylesheet">
    <?php
      require 'Parsedown.php';

      $readmes = array('README.md', 'README.txt', 'README');

      function URLExists($url) {
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $source = curl_exec($c);
        $status = curl_getinfo($c, CURLINFO_HTTP_CODE);
        curl_close($c);

        if ($status != 404) {
          return true;
        } else {
          return false;
        }
      }

      function getReadmeName($username, $repo) {
        global $readmes;
        $done = false;
        foreach ($readmes as $key => $file) {
          if (URLExists("https://raw.githubusercontent.com/".$username."/".$repo."/master/".$file)) {
            $done = true;
            return "https://raw.githubusercontent.com/".$username."/".$repo."/master/".$file;
          }
        }
        if ($done == false) {
          return 0;
        }
      }

      function getSource($url) {
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $source = curl_exec($c);
        curl_close($c);

        return $source;
      }
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
        <input name="username" spellcheck=false type="text" placeholder="username" <?php echo (isset($_GET["username"]) ? 'value='.$_GET["username"] : '') ?>>
        <input name="repo" spellcheck=false type="text" placeholder="repo" <?php echo (isset($_GET["repo"]) ? 'value='.$_GET["repo"] : '') ?>>
        <input type="submit" value="Go!">
      </form>
    </div>
    <div class="result">
      <div class="inner">
        <div class="file">
          <pre>
<?php
  if (!isset($_GET["username"]) || !isset($_GET["repo"])) {
    echo "You haven't specified a repo yet.";
  } else {
    $readmeURL = getReadmeName($_GET["username"], $_GET["repo"]);
    $Parsedown = new Parsedown();
    echo $Parsedown->text(getSource($readmeURL));
    if ($readmeURL == 0) {
      echo "README not found.";
    }
  }
?>
          </pre>
        </div>
      </div>
    </div>
  </body>
</html>
