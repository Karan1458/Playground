function toggleNav() {
	let target = document.getElementById('mySidenav'),
		bodyTag = document.body;
	if(target.classList.contains('active')) {
		target.classList.toggle('active');
		bodyTag.style.marginRight = 'initial';
		bodyTag.body.style.backgroundColor = "white";
	} else {
		target.classList.toggle('active');
		bodyTag.style.marginRight = '250px';
		bodyTag.style.backgroundColor = "rgba(0,0,0,0.4)";
	}
}
function snackbar(message) {
		var x = document.getElementById("snackbar");
		x.innerText = message
		x.className = "show";
		setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

function post(url, data, callback, fallback = false) {
	if(fallback) {
		// XHR 
		var xhr = new XMLHttpRequest();
		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
		xhr.setRequestHeader("cache-control", "no-cache");
		const urlParams = new URLSearchParams(Object.entries(data));
		xhr.send(urlParams.toString());
		xhr.onload = callback;
	} else {
		//Fetch API
		fetch(url, { 
			method: "POST", 
			headers: {'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8"},
			mode: 'cors',
			cache: 'default',
			body: serialize(data)
		}).then( response => response.json()).then(callback);	
	}
	
	
}
function serialize(obj, prefix) {
  var str = [], p;
  for (p in obj) {
    if (obj.hasOwnProperty(p)) {
      var k = prefix ? prefix + "[" + p + "]" : p,
        v = obj[p];
      str.push((v !== null && typeof v === "object") ?
        serialize(v, k) :
        encodeURIComponent(k) + "=" + encodeURIComponent(v));
    }
  }
  return str.join("&");
}
function jsonToURI(json){ return encodeURIComponent(JSON.stringify(json)); }
function uriToJSON(urijson){ return JSON.parse(decodeURIComponent(urijson)); }

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

document.addEventListener("DOMContentLoaded", function() {
	var autoPlayBtn = document.querySelector('.action-row input[name=autoplay]'),
		saveBtn = document.querySelector('.action-row input[name=run]'),
		runBtn = document.querySelector('.action-row input[name=run]'),
		clearBtn = document.querySelector('.action-row input[name=clear]');

	// Initialize 
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

  	//On change Update the output 
	editor.on('change', debounce(function() {
		var isAutoplay = autoPlayBtn.classList.contains('active');
		if(isAutoplay) { runBtn.click(); }
	}, 1000));

	//Save Button Clicked
	saveBtn.addEventListener('click', function() {
		post('inc/save.php', { content: editor.getValue() }, function(res) {
			snackbar('Code has been saved.');
		});
	});

	//Run Code button
	runBtn.addEventListener('click', function() {
		post('inc/run.php', { content: editor.getValue() }, function(res) {
			console.log(res);
			if(res.status === 'success') {
				var outputFrame = document.querySelector('#resultpart iframe');
				outputFrame.contentWindow.location.reload();
				snackbar('Code has been updated.');	
			} else {
				snackbar('Something went wrong while update.');
			}
		});
	});

	// Clear Text Button
	clearBtn.addEventListener('click', function() {
		document.querySelector('textarea[name=code]').innerHTML = '';

		if(editor) {
			editor.setValue('');
			//editor.clearHistory();
		}
		snackbar('Code has been cleared.');
		//window.location.reload();
	});

	//Autopay toggle Button
	autoPlayBtn.addEventListener('click', function() {
		this.classList.toggle('active');
		if(this.classList.contains('active'))
			snackbar('Autoplay has been enabled.');
		else 
			snackbar('Autoplay has been disabled.');
	})


	Split(['#textpart', '#resultpart'], {
	    minSize: 0,
	    gutter: function (index, direction) {
	        var gutter = document.createElement('div')
	        gutter.className = 'gutter gutter-' + direction + ' logo-gutter'
	        var mask = document.createElement('span');
	        mask.className = 'mask';
	        gutter.appendChild(mask);
	        //gutter.style.height = '144px'
	        return gutter
	    },
	    gutterSize: 0,
	    gutterAlign: 'center'
	})
});