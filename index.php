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
		<style type="text/css">
			#logo h1 {
				display: inline-block;
				    margin: 10px 3px;
				cursor: help;
			}
			
			html,body { 
				margin:0;
				min-height:100%;
			}
			body {
				background: rgba(241,248,253,1);
				background: -moz-linear-gradient(top, rgba(241,248,253,1) 0%, rgba(173,207,245,1) 100%);
				background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(241,248,253,1)), color-stop(100%, rgba(173,207,245,1)));
				background: -webkit-linear-gradient(top, rgba(241,248,253,1) 0%, rgba(173,207,245,1) 100%);
				background: -o-linear-gradient(top, rgba(241,248,253,1) 0%, rgba(173,207,245,1) 100%);
				background: -ms-linear-gradient(top, rgba(241,248,253,1) 0%, rgba(173,207,245,1) 100%);
				background: linear-gradient(to bottom, rgba(241,248,253,1) 0%, rgba(173,207,245,1) 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f1f8fd', endColorstr='#adcff5', GradientType=0 );
				transition: margin-right .5s;
				padding: 8px;
				height: 100vh;
    			box-sizing: border-box;
			}
			#content { 
				display: grid;
    			grid-template-columns: 1fr 1fr;
    			grid-auto-rows: 1fr;
			}
			#header {
				height:auto;
				display: table;
			}
			#footer {
				text-align: right;
				height: 30px;
				position: absolute;
				bottom: 60px;
				left: 0;
				right: 0;
				color: #818181;
				padding: 10px;
			}
			.CodeMirror-scroll {
				overflow-x : auto;
				overflow-y : hidden;
			}
			.CodeMirror {
				border:1px solid #eee;
				height: calc(100vh - 70px);
				height: -moz-calc(100vh-70px);
				height: -webkit-calc(100vh-70px);
				height: -o-calc(100vh-70px);
				/*padding-top:10px;*/
				border-top-left-radius: 5px ;
				border-bottom-left-radius: 5px ;7		}
			
			
			.action-row {
    			display: table-cell;    
    			text-align: right;
				width:100%;
				vertical-align: middle;
			}
			.action-row input[type=button] {
				cursor: pointer;
				color:white;
				border-radius:4px;
				padding: 5px 20px;
				font-size:16px;
				border:1px solid transparent;
				
			}
			.action-row input[name=save] {background: rgb(28,184,65);}
			.action-row input[name=run] { background : rgb(66,184,221);}
			.action-row input[name=clear] {background :rgb(223,117,20);}
			.action-row button.btn-info {
				padding: 5px 10px;
				border: 1px solid #d7d4f0;
				background-color: #fff;
				border-radius: 3px;
			}
			#site-name {
				font-family: sans-serif;
			    font-size: 28px;
			    text-transform: uppercase;
			    font-weight: 300;
			    color: #444;
			}
			#resultpart iframe {
			    height: calc(100vh - 70px);
			    border: none;
			    background: #fff;
			    border-top-right-radius: 5px;
			    border-bottom-right-radius: 5px;
			}
			/** Side Nav */
			.sidenav {
				height: 100%;
				width: 0;
				position: fixed;
				z-index: 9999;
				top: 0;
				right: 0;
				background-color: #111;
				overflow-x: hidden;
				transition: 0.5s;
				padding-top: 60px;
			}
			.sidenav.active {
				width: 250px;
			}

			.sidenav a {
				padding: 8px 8px 8px 32px;
				text-decoration: none;
				font-size: 25px;
				color: #818181;
				display: block;
				transition: 0.3s;
			}

			.sidenav a:hover {
				color: #f1f1f1;
			}
			.sidenav p {
				padding: 10px;
				color:#818181;
			}

			.sidenav .closebtn {
				position: absolute;
				top: 0;
				right: 10px;
				font-size: 36px;
				margin-left: 50px;
			}

			@media screen and (max-height: 450px) {
				.sidenav {padding-top: 15px;}
				.sidenav a {font-size: 18px;}
			}
		</style>


	</head>
	<body>
    	<div id="header">
    		<div id="logo">
				<h1 id="site-name" title="For shortcut,Press ALT + s to save and ALT + r to run,f11 for fullscreen mode">Playground </h1>
			</div>
			<div class="action-row">
				<!-- <input type="button" value="Save" name='save' accesskey="s" /> -->
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
     	</div>
		

		<!-- All scripts at the bottom --> 
		<script src="codemirror/lib/codemirror.js"></script>
		<script src="jquery.min.js"></script>
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
		<script type="text/javascript">
			function debounce(func, wait, immediate) {
				var timeout;
				return function() {
					var context = this, args = arguments;
					var later = function() {
						timeout = null;
						if (!immediate) func.apply(context, args);
					};
					var callNow = immediate && !timeout;
					clearTimeout(timeout);
					timeout = setTimeout(later, wait);
					if (callNow) func.apply(context, args);
				};
			};
			jQuery('document').ready(function($) {

				//On change Update the outupt 
				editor.on('change', debounce(function() {
					console.log('Saving now');
					$('.action-row input[name=run]').trigger('click');
				}, 1000));

				$('.action-row').on('click', 'input', function(ev){
					var action = $(this).attr('name');
					if(action === 'save') {

						$.post('inc/save.php', { content: editor.getValue() }, function(res) {
							console.log(res);
						});

						//$('#textpart').attr('action','<?php echo $_SERVER["PHP_SELF"]; ?>');
						//$('#textpart').attr('target','_parent');
						//$('#textpart').submit();
					} else if ( action === 'run') {

						// Save text
						$.post('inc/save.php', { content: editor.getValue() }, function(res) {
							// Run code
							$('#resultpart iframe').attr( 'src', function ( i, val ) { return val; });
						});


						//$('#textpart').attr('action','test.php');
						//$('#textpart').attr('target','_blank');
						//$('#textpart').submit();
					} else if( action === 'clear') {
						$('textarea[name=code]').html('');
						if(editor) {
							editor.setValue('');
							//editor.clearHistory();
						}
						//window.location.reload();
					}
				});
			});
		 
		</script>
		<script>
			var editor = CodeMirror.fromTextArea(document.getElementById('code'),{
				viewportMargin:Infinity, 
				lineNumbers: true, 
				foldGutter:true, 
				gutters:["CodeMirror-lineNumbers","CodeMirror-foldgutter"],
				matchBrackets: true,
				autoCloseBrackets: true,
				matchTags: {
					bothTags: true
				},
				theme : "blackboard",
				mode: "application/x-httpd-php",
				autofocus: true,
				fullScreen: false,
				extraKeys:{
					"F11": function(cm) {
						cm.setOption("fullScreen", !cm.getOption("fullScreen"));
					},
					"Esc": function(cm) {
						if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
					}
				},
				indentUnit: 4,
				indentWithTabs: true
			});
		</script>
		<script>
			function toggleNav() {
				let target = document.getElementById('mySidenav');
				if(target.classList.contains('active')) {
					target.classList.toggle('active');
					document.body.style.marginRight = 'initial';
					document.body.style.backgroundColor = "white";
				} else {
					target.classList.toggle('active');
					document.body.style.marginRight = '250px';
					document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
				}
				
				
			}
		</script>
	</body>
</html>
