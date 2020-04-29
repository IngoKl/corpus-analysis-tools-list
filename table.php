<?php
if(!ini_set('default_socket_timeout', 15)) echo '<!-- Error: Could not change "default_socket_timeout" -->';

include('config.php');

/**
* This function generates a list of category tags.
*
* @param array $sheet_data
*
* @return array An array with all category tags in the spreadsheet.
*/
function genTagList ($sheet_data) {
	$sheet_data = array_slice($sheet_data, 1);
	$tag_list = array();
	foreach ($sheet_data as $row) {
		$categories = explode(',', $row[2]);
		foreach ($categories as $category) {
			if (!in_array(trim($category), $tag_list)) {
				$tag_list[] = trim($category);
			}
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
	unset($sheet_data[0]); //Remove the Headings

	if (isset($_GET["tag"])) {
		$tag = $_GET["tag"];
		foreach ($sheet_data as $row) {
			$row_cat = array_map('trim', explode(',', $row[2]));
			if (in_array(trim($tag), $row_cat)) {
				echo '<tr>';
				if (strlen($row[6]) > 0) {
					echo '<td><a href="'.$row[6].'">'.$row[0].'</a></td>';
				} else {
					echo '<td>'.$row[0].'</td>';
				}

				$tags = htmlTags($row[2]);

				echo '<td>'.$row[1].'</td>';
				echo '<td>'.$tags.'</td>';
				echo '<td>'.$row[3].'</td>';
				echo '<td>'.$row[4].'</td>';
				echo '</tr>';
			}
		}
	} else {
		foreach ($sheet_data as $row) {
			echo '<tr>';
			if (strlen($row[6]) > 0) {
				echo '<td><a href="'.$row[6].'">'.$row[0].'</a></td>';
			} else {
				echo '<td>'.$row[0].'</td>';
			}

			$tags = htmlTags($row[2]);

			echo '<td>'.$row[1].'</td>';
			echo '<td>'.$tags.'</td>';
			echo '<td>'.$row[3].'</td>';
			echo '<td>'.$row[4].'</td>';
			echo '</tr>';
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
function printTagList ($tag_list) {
	echo '<div class="tag tag-all"><a href="/">Everything</a></div>';

	if (isset($_GET["tag"])) {
		$tag = $_GET["tag"];
	}

	foreach ($tag_list as $tag) {
		if (strlen($tag) > 0) {

			if (strlen($tag) > 22) {
				$tag_name = substr($tag, 0, 18) . ' ...';
			} else {
				$tag_name = $tag;
			}

			if (isset($_GET["tag"]) && $tag == $_GET["tag"]) {
				echo '<div class="tag tag-active">'.$tag_name.'</div>';
			} else {
				//echo '<div class="tag"><a href="index.php?tag='.$tag.'">'.$tag.'</a></div>';
				echo '<div class="tag"><a href="/tag/'.$tag.'#list">'.$tag_name.'</a></div>';
			}
		}
	}
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

