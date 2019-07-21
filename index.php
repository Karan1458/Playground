<?php 
	$fn = "test.php";
	$testfile = fopen($fn,'r') or die('unable to open file....'); 
	$content = fread($testfile,filesize($fn));
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
			
			html,body { min-height:100%;}
			body {
				background: rgba(241,248,253,1);
				background: -moz-linear-gradient(top, rgba(241,248,253,1) 0%, rgba(173,207,245,1) 100%);
				background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(241,248,253,1)), color-stop(100%, rgba(173,207,245,1)));
				background: -webkit-linear-gradient(top, rgba(241,248,253,1) 0%, rgba(173,207,245,1) 100%);
				background: -o-linear-gradient(top, rgba(241,248,253,1) 0%, rgba(173,207,245,1) 100%);
				background: -ms-linear-gradient(top, rgba(241,248,253,1) 0%, rgba(173,207,245,1) 100%);
				background: linear-gradient(to bottom, rgba(241,248,253,1) 0%, rgba(173,207,245,1) 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f1f8fd', endColorstr='#adcff5', GradientType=0 );
			}
			#content { 
				display: grid;
    			grid-template-columns: 1fr 1fr;
    			grid-auto-rows: 1fr;
				min-height: 100%;
			}
			#header {height:auto;}
			#footer {
			         text-align:right;
			       	height: 30px; 
					 }
			.CodeMirror-scroll {
				overflow-x : auto;
				overflow-y : hidden;
			}
			.CodeMirror {
				border:1px solid #eee;
				height: calc(100vh - 160px);
				height: -moz-calc(100vh-160px);
				height: -webkit-calc(100vh-160px);
				height: -o-calc(100vh-160px);
				/*padding-top:10px;*/
				border-top-left-radius: 5px ;
				border-bottom-left-radius: 5px ;
			}
			
			#textpart input[type=button] {
				cursor: pointer;
				color:white;
				border-radius:4px;
				padding: 5px 20px;
				font-size:16px;
				border:1px solid transparent;
				
			}
			#textpart input[name=save] {background: rgb(28,184,65);}
			#textpart input[name=run] { background : rgb(66,184,221);}
			#textpart input[name=clear] {background :rgb(223,117,20);}
			#site-name {
				font-family: sans-serif;
			    font-size: 28px;
			    text-transform: uppercase;
			    font-weight: 300;
			    color: #444;
			}
			#resultpart iframe {
			    height: calc(100vh - 160px);
			    border: none;
			    background: #fff;
			    border-top-right-radius: 5px;
			    border-bottom-right-radius: 5px;
			}
		</style>


	</head>
	<body>
    	<div id="header">
    		<div id="logo"><h1 id="site-name" title="For shortcut,Press ALT + s to save and ALT + r to run,f11 for fullscreen mode">Playground </h1></div>
 		</div>
 		<div id="content">
 			<div id="textpart" class="one-half">
				<textarea rows="50" cols="120" name="code" id="code"><?php echo $content;  ?></textarea>
	    		<div class="action-row">
	    			<!-- <input type="button" value="Save" name='save' accesskey="s" /> -->
					<input type="button" value="Run" name='run' accesskey="r" />
					<input type="button" value="Clear" name='clear' accesskey="c" />
				</div>
			</div>
			<div id="resultpart" class="one-half">
				<iframe src="./test.php" width="100%" height="100%"></iframe>
			</div>
     	</div>
		<div id="footer">
	  		<b><?php if(PHP_VERSION) {echo "PHP Version : ".PHP_VERSION;} 
	  				else {echo "PHP Not Installed."; }
			?><br /> Code Mirror Version : 5.48 </b>
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
			jQuery('document').ready(function($) {

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

	</body>
</html>
