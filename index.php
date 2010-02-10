<?php
//vars
$DirectoryToScan = 'music';

if(!file_exists($DirectoryToScan)) 
{ 
mkdir($DirectoryToScan); 
} 

require_once('includes/getid3/getid3.php');

// Initialize getID3 engine
$getID3 = new getID3;

$dir = opendir($DirectoryToScan);
while (($file = readdir($dir)) !== false) {
	$FullFileName = realpath($DirectoryToScan.'/'.$file);
	if (is_file($FullFileName)) {
		set_time_limit(30);

		$ThisFileInfo = $getID3->analyze($FullFileName);

		getid3_lib::CopyTagsToComments($ThisFileInfo);

		// output desired information in whatever format you want
		$filename = str_replace(" ", "%20", $ThisFileInfo['filename']);
		$link = "play.php?name=" . (!empty($ThisFileInfo['comments_html']['title']) ? implode('<BR>', $ThisFileInfo['comments_html']['title']) : '&nbsp;') . "&file=" . $DirectoryToScan . "/" . $filename;
		$text = (!empty($ThisFileInfo['comments_html']['title']) ? implode('<BR>', $ThisFileInfo['comments_html']['title']) : '&nbsp;') . " - " . (!empty($ThisFileInfo['comments_html']['artist']) ? implode('<BR>', $ThisFileInfo['comments_html']['artist']) : '&nbsp;');
	echo $link;
	}
}

?>
<html>
<head>
<title>myTunes</title>
<LINK href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/jquery-1.4.1.min.js"></script> 

</head>
<body>
<div id="container">
<div class="top">
<h3>myTunes</h3>


</div>
<div class="sidebar">
side            
</div>
<div id="listing">

<a href="#" onclick="getdata('<?php echo $link; ?>','top');"><?php echo $text . "</a><br>"; ?>

</div>

</div>
</body>
</html>

