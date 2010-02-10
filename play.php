<?php
$file = $_REQUEST['file'];
$file = str_replace(" ", "%20", $file);
$file = "http://" . $_SERVER['SERVER_NAME'] . "/phpTunes/" . $file;
echo $file;
?>
<html>
<head>
<script type="text/javascript" src="js/jquery.jplayer.js"></script>
<LINK href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.4.1.min.js"></script> 

<script> 
 
$(document).ready(function(){
 
	$("#jquery_jplayer").jPlayer({
		ready: function () {
			$(this).setFile("<?php echo $file; ?>").play();
			demoInstanceInfo($(this), $("#jplayer_info"));
		},
		cssPrefix: "different_prefix_example",
		volume: 50,
		oggSupport: false
	})
	.jPlayerId("play", "player_play")
	.jPlayerId("pause", "player_pause")
	.jPlayerId("stop", "player_stop")
	.jPlayerId("loadBar", "player_progress_load_bar")
	.jPlayerId("playBar", "player_progress_play_bar")
	.jPlayerId("volumeMin", "player_volume_min")
	.jPlayerId("volumeMax", "player_volume_max")
	.jPlayerId("volumeBar", "player_volume_bar")
	.jPlayerId("volumeBarValue", "player_volume_bar_value")
	.onProgressChange( function(loadPercent, playedPercentRelative, playedPercentAbsolute, playedTime, totalTime) {
		var myPlayedTime = new Date(playedTime);
		var ptMin = (myPlayedTime.getUTCMinutes() < 10) ? "0" + myPlayedTime.getUTCMinutes() : myPlayedTime.getUTCMinutes();
		var ptSec = (myPlayedTime.getUTCSeconds() < 10) ? "0" + myPlayedTime.getUTCSeconds() : myPlayedTime.getUTCSeconds();
		$("#play_time").text(ptMin+":"+ptSec);
 
		var myTotalTime = new Date(totalTime);
		var ttMin = (myTotalTime.getUTCMinutes() < 10) ? "0" + myTotalTime.getUTCMinutes() : myTotalTime.getUTCMinutes();
		var ttSec = (myTotalTime.getUTCSeconds() < 10) ? "0" + myTotalTime.getUTCSeconds() : myTotalTime.getUTCSeconds();
		$("#total_time").text(ttMin+":"+ttSec);
	})
	.onSoundComplete( function() {
		$(this).play();
	});
});
 
</script> 
</head>
<body>
<div id="jquery_jplayer"></div> 
 
			<div id="player_container"> 
				<ul id="player_controls"> 
					<li id="player_play">play</li> 
					<li id="player_pause">pause</li> 
					<li id="player_stop">stop</li> 
					<li id="player_volume_min">min volume</li> 
					<li id="player_volume_max">max volume</li> 
				</ul> 
 
				<div id="player_progress"> 
					<div id="player_progress_load_bar"> 
						<div id="player_progress_play_bar"></div> 
					</div> 
				</div> 
				<div id="player_volume_bar"> 
					<div id="player_volume_bar_value"></div> 
				</div> 
 
				<div id="player_playlist_message"> 
					<div id="song_title"><?php echo $_REQUEST['name']; ?></div> 
					<div id="play_time"></div> 
					<div id="total_time"></div> 
				</div> 
			</div> 
			<div id="jplayer_info"></div> 
</body>