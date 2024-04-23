require(["jquery"], function ($) {
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

  	$(document).ready(function () {

		if( !$('.leeloolxpcontentapi_frame').length ){
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
			let lang = $("#leeloolxpcontentapi-js-vars").data("lang");

			var mootoolsresponseDe = JSON.parse(atob(mootoolsresponse));
			if( lang != '' ){
				mootoolsresponseDe.lang = lang;
			}

			mootoolsresponseDe.cmid = cmid;
			mootoolsresponseDe.sectionid = sectionid;
			mootoolsresponseDe.courseid = courseid;
			mootoolsresponseDe.baseurl = mootoolsleeloourldecoded + '/';

			var mootoolsresponseUp = btoa(JSON.stringify(mootoolsresponseDe));

			leeloolxpssourl =
				"https://spock.leeloolxp.com?mootoolsleeloourl=" +
				mootoolsleeloourl +
				"&mootoolstoken=" +
				mootoolstoken +
				"&mootoolsresponse=" +
				mootoolsresponseUp;

			document.getElementById("local_leeloolxpcontentapi_frame").innerHTML =
				'<iframe allow="camera; microphone" src="' +
				leeloolxpssourl +
				'" class="leeloolxpcontentapi_frame"></iframe>';
		}

    	$("#local_leeloolxpcontentapi_button").click(function () {

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
    	});
  	});
});
