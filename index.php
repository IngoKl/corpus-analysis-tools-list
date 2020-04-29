<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A comprehensive list of tools used in corpus analysis." />

    <title>Tools for Corpus Linguistics</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Style -->
    <link href="../css/corpus-tools.css" rel="stylesheet">

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
          <a class="navbar-brand" href="#"><img style="height: 25px;" src="/img/corpus-analysis.com.inv.png" alt="corpus-analysis.com"/></a>
        </div>
      </div>
    </nav>

    <br />

    <div class="container">
      <h1>Tools for Corpus Linguistics</h1>
      <h5>A comprehensive list of <i><?php echo toolNr($sheet_data); ?></i> tools used in corpus analysis.</h5>
      <p>
      	Please feel free to contribute by <a href="<?php include('config.php'); echo $config_suggest_form; ?>">suggesting new tools</a> or by pointing out mistakes in the data.
      </p>
	
	<!--
	<div class="alert alert-info" role="alert">
	  (<strong>09.2018</strong>) New tools have been added! Also, the code for this site now lives on <a href="https://github.com/IngoKl/corpus-analysis-tools-list/">GitHub</a>.
	</div>
	-->
	    
    </div>

    <div class="container">
    	<div class="tag tag-active"><a href="<?php echo $config_suggest_form; ?>" target="blank">Suggest a Tool</a></div>
    </div>

    <hr />

    <div class="container">
        <h1>Tags</h1>
        <?php printTagList(genTagList($sheet_data)); ?>
    </div>

    <hr />

    <div class="container">
      <h1>Tools</h1>
      <table id="list">
      </thead> 
        <tr>
          <th>Tool</th>
          <th>Description</th>
          <th>Categories</th>
          <th>Platform</th>
          <th>Pricing</th>
        </tr>
      </thead>

      <tbody> 
        <?php printTableRows($sheet_data); ?>
      </tbody>

      </table>
    </div>

    <hr />

    <footer class="footer">
      <div class="container">
        <p>Compiled with <i class="glyphicon glyphicon-heart heart"></i> by <a href="https://twitter.com/k_berb">Kristin Berberich</a>, <a href="https://kleiber.me">Ingo Kleiber</a>, and many amazing anonymous contributors.</p>
         <p>&copy; 2020 (<a href="/impressum-privacy-policy">Impressum / Privacy Policy</a>) (<a href="https://github.com/IngoKl/corpus-analysis-tools-list/"><i class="glyphicon glyphicon-wrench"></i> Code</a>)</p>
      </div>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Matomo -->
    <script type="text/javascript">
      var _paq = window._paq || [];
      /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//matomo.ingokleiber.de/";
        _paq.push(['setTrackerUrl', u+'matomo.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <!-- End Matomo Code -->

  </body>
</html>
