<?php 
	$fn = 'test.php';
	$content = '';
	$testfile = fopen($fn,'r') or die('unable to open file....');
	if(filesize($fn) !== 0){
		$content = fread($testfile,filesize($fn));
	}
	fclose($testfile);
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Testing Playground </title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="codemirror/lib/codemirror.css">
		<link rel="stylesheet" href="codemirror/addon/display/fullscreen.css">
		<!-- <link rel="stylesheet" href="codemirror/theme/xq-dark.css" /> -->
		<link rel="stylesheet" href="codemirror/theme/blackboard.css" />
		<!-- <link rel="stylesheet" type="text/css" href="codemirror/theme/paraiso-dark.css" /> -->
		<!-- <link rel="stylesheet" type="text/css" href="codemirron/theme/monokai.css" /> -->
		<!-- <link rel="stylesheet" type="text/css" href="codemirror/theme/seti.css" /> -->
		<link rel="stylesheet" href="codemirror/addon/fold/foldgutter.css" />

		<style type="text/css">.CodeMirror { border-top: 1px solid black; border-bottom: 1px solid black; font-size :16px; }</style>
		<style type="text/css"> #code.textarea { font-size : 16px; } </style>
		
		<noscript>You need Javascript enabled for this to work</noscript>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	<body>
    	<div id="header">
    		<div id="logo">
				<h1 id="site-name" title="For shortcut,Press ALT + s to save and ALT + r to run,f11 for fullscreen mode">Playground </h1>
			</div>
			<div class="action-row">
				<input type="button" value="Autoplay" name="autoplay" accesskey="a" />
				<input type="button" value="Save" name='save' accesskey="s" />
				<input type="button" value="Run" name='run' accesskey="r" />
				<input type="button" value="Clear" name='clear' accesskey="c" />
				<button class="btn-info" onclick="toggleNav()" >&#9776;</button>
			</div>
 		</div>
		 <div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" onclick="toggleNav()">&times;</a>
			<p> Thank you for using playground. </p>
			<div id="footer">
				<b><?php if(PHP_VERSION) {echo "PHP Version : ".PHP_VERSION;} 
						else {echo "PHP Not Installed."; }
				?><br /> Code Mirror Version : 5.48 </b>
			</div>
		</div>
 		<div id="content">
 			<div id="textpart" class="one-half">
				<textarea rows="50" cols="120" name="code" id="code"><?php echo $content;  ?></textarea>
			</div>
			<div id="resultpart" class="one-half">
				<iframe src="./test.php" width="100%" height="100%"></iframe>
			</div>
			<div id="snackbar"></div>
     	</div>
		

		<!-- All scripts at the bottom --> 
		<script src="codemirror/lib/codemirror.js"></script>
		<!-- <script src="jquery.min.js"></script> -->
		<script src="codemirror/mode/xml/xml.js"></script>
		<script src="codemirror/mode/javascript/javascript.js"></script>
		<script src="codemirror/mode/css/css.js"></script>
		<script src="codemirror/mode/clike/clike.js"></script>
		<script src="codemirror/mode/php/php.js"></script>
		<script src="codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="codemirror/addon/display/fullscreen.js"></script>
		<script src="codemirror/addon/edit/matchbrackets.js"></script>
		<script src="codemirror/addon/edit/closebrackets.js"></script>
		<script src="codemirror/addon/fold/foldcode.js"></script>
		<script src="codemirror/addon/fold/foldgutter.js"></script>
		<script src="codemirror/addon/fold/brace-fold.js"></script>
		<script src="codemirror/addon/fold/xml-fold.js"></script>
		<script src="codemirror/addon/edit/matchtags.js"></script>
		<script src="js/split.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/main.js"></script>
	</body>
</html>
