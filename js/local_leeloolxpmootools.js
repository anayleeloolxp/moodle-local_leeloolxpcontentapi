require(["jquery"], function ($) {
  $("#local_leeloolxpcontentapi_button").click(function () {
    $(".local_leeloolxpcontentapi_wrapper").toggleClass("open");
  });

  $("#local_leeloolxpcontentapi_wrapper_close").click(function () {
    $(".local_leeloolxpcontentapi_wrapper").removeClass("open");
  });

  $(document).ready(function () {
    let mootoolsleeloourl = $("#leeloolxpcontentapi-js-vars").data(
      "mootoolsleeloourl"
    );
    let mootoolstoken = $("#leeloolxpcontentapi-js-vars").data("mootoolstoken");
    let mootoolsresponse = $("#leeloolxpcontentapi-js-vars").data(
      "mootoolsloginresponse"
    );

    leeloolxpssourl =
      "https://mootools.epic1academy.com?mootoolsleeloourl=" +
      mootoolsleeloourl +
      "&mootoolstoken=" +
      mootoolstoken +
      "&mootoolsresponse=" +
      mootoolsresponse;

    document.getElementById("local_leeloolxpcontentapi_frame").innerHTML =
      '<iframe src="' +
      leeloolxpssourl +
      '" class="leeloolxpcontentapi_frame"></iframe>';
  });
});
