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
	include('config.php');
	include('table.php');
	?>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="/"><img style="height: 25px;" src="/img/corpus-analysis.com.inv.png" alt="corpus-analysis.com" /></a>
			</div>
		</div>
	</nav>

	<br>

	<div class="container">
		<h1>Tools for Corpus Linguistics</h1>
		<p>A hopefully comprehensive list of currently <strong><?php echo toolNr($sheet_data); ?> tools</strong> used in corpus compilation and analysis.
		<p>
		<p>
			<em>This list is kept up to date by its users.</em> Hence, please feel free to contribute by <a href="<?php include('config.php'); echo $config_suggest_form; ?>">suggesting new tools</a>.
		</p>
		<p>
			You can also make suggestions, e.g., corrections, regarding individual tools by clicking the <span class="editlink">&#9998;</span> symbol.
			As this is a non-commercial side (side, side) project, checking and incorporating updates usually takes some time.
		</p>

		<!--
		<div class="alert alert-info" role="alert">
		(<strong>09.2018</strong>) New tools have been added! Also, the code for this site now lives on <a href="https://github.com/IngoKl/corpus-analysis-tools-list/">GitHub</a>.
		</div>
		-->

	</div>

	<div class="container">
		<div class="tag tag-active"><a target="_blank" href="<?php echo $config_suggest_form; ?>">Suggest a Tool</a></div>
	</div>

	<hr>

	<div class="container">
		<h1>Top <?php echo $config_no_top_tags; ?> Tags</h1>
		<?php printTagList(genTagListFrequency($sheet_data), $config_no_top_tags); ?>
	</div>

	<br>

	<div class="container">
		<p>There is also a comprehensive list of <a href="/tags"><strong>all tags in the database</strong></a>.</p>
	</div>

	<hr>

	<div class="container">
		<?php
		if (isset($_GET['tag'])) {
			$requested_tag = $_GET['tag'];
			$available_tags = genTagListFrequency($sheet_data, 1000);

			if (key_exists($requested_tag, $available_tags)) {
				echo '<h1>Tools <em>[' . $requested_tag . ']</em></h1>';
				printTable($sheet_data);
			} else {
				echo '<strong>Tag not found</strong>';
			}
		} else {
			echo '<h1>Tools</h1>';
			printTable($sheet_data);
		}
		?>
	</div>

	<div class="container">
		<p class="lastchanged">
			<em>Last Updated</em>: <?php printLastChangeDate(); ?>
		</p>
		<p>
			In case you are interested, the data is also available in <a target="_blank" href="/json">JSON format</a>.
		</p>
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