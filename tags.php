<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A comprehensive list of tools used in corpus compilation and analysis." />

    <title>Tools for Corpus Linguistics</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Style -->
    <link href="../css/corpus-tools.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/cookieconsent.css" media="print" onload="this.media='all'; this.onload=null;">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <?php
    include('table.php');
  ?>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/"><img style="height: 25px;" src="/img/corpus-analysis.com.inv.png" alt="corpus-analysis.com"/></a>
        </div>
      </div>
    </nav>

    <br>

    <div class="container">
      <h1>Tools for Corpus Linguistics</h1>
      <p>These are <strong>all the tags</strong> currently in the database <strong>sorted by frequency</strong>:</p>

      <?php printCompleteTagList(genTagListFrequency($sheet_data)); ?>
    </div>

    <hr>

    <footer class="footer">
      <div class="container">
        <p>Compiled with <i class="glyphicon glyphicon-heart heart"></i> by <a href="https://twitter.com/k_berb">Kristin Berberich</a>, <a href="https://kleiber.me">Ingo Kleiber</a>, and many amazing anonymous contributors.</p>
         <p>&copy; 2023 (<a href="/impressum-privacy-policy">Impressum / Privacy Policy</a>) (<a href="https://github.com/IngoKl/corpus-analysis-tools-list/"><i class="glyphicon glyphicon-wrench"></i> Code</a>)</p>
      </div>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Consent Management -->
    <script src="../js/cookieconsent.js"></script>
    <script src="../js/consent.js"></script>

  </body>
</html>
