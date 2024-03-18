require(["jquery"], function ($) {
  $("#local_leeloolxpcontentapi_wrapper_close").click(function () {
    $(".local_leeloolxpcontentapi_wrapper").removeClass("open");
  });

  $(document).ready(function () {
    $("#local_leeloolxpcontentapi_button").click(function () {
      $(".local_leeloolxpcontentapi_wrapper").toggleClass("open");
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

        var mootoolsresponseDe = JSON.parse(atob(mootoolsresponse));
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

    });
  });
});
