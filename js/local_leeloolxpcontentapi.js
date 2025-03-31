function setLeeloolxpUrl(Y, leeloolxpUrl) {
	window.leeloolxpUrl = leeloolxpUrl;
}

require(["jquery"], function ($) {

	function utf8_to_b64(str) {
		return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
			function toSolidBytes(match, p1) {
				return String.fromCharCode('0x' + p1);
		}));
	}

	// And for decoding, use this function
	function b64_to_utf8(str) {
		return decodeURIComponent(atob(str).split('').map(function(c) {
			return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
		}).join(''));
	}

  	$("#local_leeloolxpcontentapi_wrapper_close").click(function () {
		$(".local_leeloolxpcontentapi_wrapper").removeClass("open");

		var message = 'drawer_closed';
		var iframe = $(".leeloolxpcontentapi_frame")[0];

		// Check if the iframe is loaded
		if (iframe.contentWindow) {
			iframe.contentWindow.postMessage(message, "*");
		} else {
			// If iframe is not loaded, wait for it to load
			$(iframe).on('load', function() {
				iframe.contentWindow.postMessage(message, "*");
			});
		}
  	});

	window.addEventListener('message', function(event) {
		console.log(event.data);
		if(event.data == 'scene_ready'){
			setTimeout(function() {
				$('#local_leeloolxpcontentapi_button').addClass('active');
			}, 2000);
		}
	});

  	$(document).ready(function () {

		if( !$('.leeloolxpcontentapi_frame').length){
			let mootoolsleeloourl = $("#leeloolxpcontentapi-js-vars").data(
				"mootoolsleeloourl"
			);
			let mootoolsleeloourldecoded = atob(
				$("#leeloolxpcontentapi-js-vars").data("mootoolsleeloourl")
			);
			let mootoolstoken = $("#leeloolxpcontentapi-js-vars").data("mootoolstoken");
			let mootoolsresponse = $("#leeloolxpcontentapi-js-vars").data("mootoolsloginresponse");

			let cmid = $("#leeloolxpcontentapi-js-vars").data("cmid");
			let sectionid = $("#leeloolxpcontentapi-js-vars").data("sectionid");
			let courseid = $("#leeloolxpcontentapi-js-vars").data("courseid");
			let openpage = $("#leeloolxpcontentapi-js-vars").data("openpage");
			let lang = $("#leeloolxpcontentapi-js-vars").data("lang");



			var mootoolsresponseDe = JSON.parse(atob(mootoolsresponse));
			if( lang != '' ){
				mootoolsresponseDe.lang = lang;
			}

			mootoolsresponseDe.cmid = cmid;
			mootoolsresponseDe.sectionid = sectionid;
			mootoolsresponseDe.courseid = courseid;
			mootoolsresponseDe.openpage = openpage;
			mootoolsresponseDe.baseurl = mootoolsleeloourldecoded + '/';

			var mootoolsresponseUp = utf8_to_b64(JSON.stringify(mootoolsresponseDe));

			leeloolxpssourl =
				window.leeloolxpUrl + "?mootoolsleeloourl=" +
				mootoolsleeloourl +
				"&mootoolstoken=" +
				mootoolstoken +
				"&mootoolsresponse=" +
				mootoolsresponseUp;

			document.getElementById("local_leeloolxpcontentapi_frame").innerHTML =
				'<iframe allow="camera; microphone" allowfullscreen="true" src="' +
				leeloolxpssourl +
				'" class="leeloolxpcontentapi_frame"></iframe>';
		}

    	$("#local_leeloolxpcontentapi_button").click(function () {

			if( $(this).hasClass("active") ){
				var $wrapper = $(".local_leeloolxpcontentapi_wrapper");

				// Toggle the "open" class on the wrapper
				$wrapper.toggleClass("open");

				// Check if the wrapper has the "open" class
				if ($wrapper.hasClass("open")) {

					var message = 'drawer_open';
					var iframe = $(".leeloolxpcontentapi_frame")[0];

					// Check if the iframe is loaded
					if (iframe.contentWindow) {
						iframe.contentWindow.postMessage(message, "*");
					} else {
						// If iframe is not loaded, wait for it to load
						$(iframe).on('load', function() {
							iframe.contentWindow.postMessage(message, "*");
						});
					}
				}
			}

    	});
  	});
});
