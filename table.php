<?php
if(!ini_set('default_socket_timeout', 15)) echo '<!-- Error: Could not change "default_socket_timeout" -->';

/**
* This function generates a list of category tags and their frequency.
*
* @param array $sheet_data
*
* @return array An array with all category tags and their frequency in the spreadsheet.
*/
function genTagListFrequency ($sheet_data) {
	$sheet_data = array_slice($sheet_data, 1);
	$tag_list = array();
	foreach ($sheet_data as $row) {
		$categories = explode(',', $row[2]);
		foreach ($categories as $category) {
			$tag_list[trim($category)]++;
		}
	}

	return $tag_list;
}

/**
* This function saves a spreadsheet in serialized form.
*
* @param array $sheet_data
*
* @return void
*/
function saveLocalData ($sheet_data) {
	$local_file = fopen('sheet.txt', 'w');
	fwrite($local_file, serialize($sheet_data));
	fclose($local_file);
}

/**
* This function prints the date the spreadsheet file was last updated.
*
* @param array $sheet_data
*
* @return void
*/
function printLastChangeDate () {
	$change_time = filemtime('sheet.txt');
	echo date("F d, Y.", $change_time);
}

/**
* This function loads a spreadsheet from a file if the file is not older than the $max_age.
*
* @param integer $max_age
*
* @return array An array containing the spreadsheet.
*/
function loadLocalData ($max_age) {
	if ( time() - filemtime('sheet.txt') < $max_age ) {
		$local_file = file_get_contents('sheet.txt');
		return unserialize($local_file);
	} else {
		return False;
	}
}

/**
* This function generates a clickable tag list.
*
* @param string $tag_list
*
* @return string html containing tag links
*/
function htmlTags ($tag_list) {
	$html = array();
	$categories = explode(',', $tag_list);

	foreach ($categories as $category) {
		$category = trim($category);
		$html[] = '<a href="/tag/'.$category.'">'.$category.'</a>';
	}

	return implode(', ', $html);

}

/**
* This function prints the spreadsheet as rows.
*
* @param array $sheet_data
*
* @return void
*/
function printTableRows ($sheet_data) {
	include('config.php');
	unset($sheet_data[0]); //Remove the Headings

	if (isset($_GET["tag"])) {
		$tag = $_GET["tag"];
		foreach ($sheet_data as $row) {
			$row_cat = array_map('trim', explode(',', $row[2]));
			if (in_array(trim($tag), $row_cat)) {
				$tags = htmlTags($row[2]);
				$edit_link = '<a class="editlink" target="_blank" href="'.$config_suggest_individual_form.'&'.$config_suggest_individual_form_toolfield.'='.$row[0].'">&#9998;</a>';

				echo '<tr>';
				if (strlen($row[6]) > 0) {
					echo '<td><a href="'.$row[6].'">'.$row[0].'</a> '.$edit_link.'</td>';
				} else {
					echo '<td>'.$row[0].' '.$edit_link.'</td>';
				}

				echo '<td>'.$row[1].'</td>';
				echo '<td>'.$tags.'</td>';
				echo '<td>'.$row[3].'</td>';
				echo '<td>'.$row[4].'</td>';
				echo '</tr>';
			}
		}
	} else {
		foreach ($sheet_data as $row) {
			$tags = htmlTags($row[2]);
			$edit_link = '<a class="editlink" target="_blank" href="'.$config_suggest_individual_form.'&'.$config_suggest_individual_form_toolfield.'='.$row[0].'">&#9998;</a>';

			echo '<tr>';
			if (strlen($row[6]) > 0) {
				echo '<td><a href="'.$row[6].'">'.$row[0].'</a> '.$edit_link.'</td>';
			} else {
				echo '<td>'.$row[0].' '.$edit_link.'</td>';
			}

			echo '<td>'.$row[1].'</td>';
			echo '<td>'.$tags.'</td>';
			echo '<td>'.$row[3].'</td>';
			echo '<td>'.$row[4].'</td>';
			echo '</tr>';
		}
	}
}

/**
* This function prints the table;
*
* @param void
*
* @return void
*/
function printTable ($sheet_data) {
	$table_top = <<<EOD
	<table id="list">
	</thead> 
	  <tr>
		<th>Tool</th>
		<th>Description</th>
		<th>Tags</th>
		<th>Platforms</th>
		<th>Pricing</th>
	  </tr>
	</thead>
	<tbody>
	EOD;

	echo $table_top;
	printTableRows($sheet_data);

	$table_bottom = <<<EOD
	</tbody>
	</table>
	EOD;

	echo $table_bottom;
}

/**
* This function prints the table in CSV format;
*
* @param void
*
* @return void
*/
function printTableJson ($sheet_data) {
	echo json_encode($sheet_data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}

/**
* This function prints the $top_n tags in terms of frequency.
*
* @param array $tag_list
*
* @return void
*/
function printTagList ($tag_list, $top_n=25) {
	arsort($tag_list);
	$tag_list = array_slice($tag_list, 0, $top_n);

	echo '<div class="tag tag-all"><a href="/">All Tags</a></div>';

	if (isset($_GET["tag"])) {
		$tag = $_GET["tag"];
	}

	foreach ($tag_list as $tag => $frequency) {
		if (strlen($tag) > 0) {

			if (strlen($tag) > 22) {
				$tag_name = substr($tag, 0, 18) . ' ...';
			} else {
				$tag_name = $tag;
			}

			if (isset($_GET["tag"]) && $tag == $_GET["tag"]) {
				echo '<div class="tag tag-active">'.$tag_name.' <span class="badge">'.$frequency.'</span></div>';
			} else {
				//echo '<div class="tag"><a href="index.php?tag='.$tag.'">'.$tag.'</a></div>';
				echo '<div class="tag"><a href="/tag/'.$tag.'#list">'.$tag_name.'</a> <span class="badge">'.$frequency.'</span></div>';
			}
		}
	}
}

/**
* This function prints all category tags.
*
* @param array $tag_list
*
* @return void
*/
function printCompleteTagList ($tag_list) {
	arsort($tag_list);

	echo '<ul>';
	foreach ($tag_list as $tag => $frequency) {
		if (strlen($tag) > 0) {
			echo '<li><a href="/tag/'.$tag.'">'.$tag.'</a> ('.$frequency.')</li>';
		}
	}
	echo '</ul>';
}

/**
* This function returns the number of tools available.
*
* @param array $sheet_data;
*
* @return int The number of tools available.
*/
function ToolNr ($sheet_data) {
	return (sizeof($sheet_data) - 1);
}

# Get the data from the spreadsheet
include('config.php');
if (loadLocalData($config_max_age)) {
	$sheet_data = loadLocalData($config_max_age);
} else {
	if (($handle = fopen($config_sheet_url, 'r')) !== False) {
	    while (($data = fgetcsv($handle, 1000, ',')) !== False) {
	        $sheet_data[] = $data;
	        saveLocalData($sheet_data);
	    }
	    fclose($handle);
	}
	else {
	    echo '<!-- Error: Could not read the csv from Google Sheets -->';
	    $sheet_data = loadLocalData(9999999);
	}
}

?>
