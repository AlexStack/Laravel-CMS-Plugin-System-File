/* eslint-disable no-undef */

/**
 * This js file will attach to the bottom of all admin pages
 * We should optimize it to speed up load the page
 * Suggest function name format: pluginNameFuncName() to avoid be override  by the same function name of other js file
 */

function systemFileAddLinkToSetting() {
  var category = $("#cms_setting_form .input-category").val();
  var param_name = $("#cms_setting_form .input-param_name").val();
  if (
    category == "template" &&
    (param_name == "frontend_dir" || param_name == "backend_dir")
  ) {
    $(".label-param_value").after(
      '<a href="../../plugins/system-file?path=resources/views/vendor/laravel-cms" class="text-info ml-2 small" target="_blank"><i class="fas fa-globe mr-1"></i>View/Edit template files</a>'
    );
  } else if (
    category == "template" &&
    (param_name == "frontend_language" || param_name == "frontend_language")
  ) {
    $(".label-param_value").after(
      '<a href="../../plugins/system-file?path=resources/lang/vendor/laravel-cms" class="text-info ml-2 small" target="_blank"><i class="fas fa-language mr-1"></i>View/Edit language files</a>'
    );
  } else if (category == "plugin") {
    $(".label-param_value").after(
      '<a href="../../plugins/system-file?path=resources/views/vendor/laravel-cms/plugins/' +
      param_name +
      '" class="text-info ml-2 small" target="_blank"><i class="fas fa-solar-panel mr-1"></i>View/Edit plugin template files</a>' +
      '<a href="../../plugins/system-file?path=app/LaravelCms/Plugins" class="text-primary ml-2" target="_blank"><i class="fab fa-php mr-1"></i><small>View/Edit plugin PHP files</small></a>'
    );
  }
}

function systemFileAddLinkToFileManager() {
  // todo
}

function systemFileShowTopLinks() {
  $(".breadcrumb").after(
    '<div class="col-md-12 mb-3 text-secondary top-links d-none">' +
    $(".shortcuts").html() +
    "</div>"
  );
  $(".top-links").hide()
    .removeClass("d-none")
    .fadeIn("slow");
}


function systemFileCountFiles() {
  $(".folder-action").prepend(
    '<span class=" text-right text-secondary count-files d-none mr-3"><i class="far fa-folder mr-2 ml-5"></i>Folders : ' +
    $("#file-list-table i.fa-folder").length + ' <i class="far fa-file mr-2 ml-3"></i>Files : ' + $("#file-list-table i.fa-file").length +
    "</span>"
  );
  $(".count-files").hide()
    .removeClass("d-none")
    .fadeIn("slow");
}

// Main controller function will invoke after the page dom loaded
$(function () {
  if (location.href.indexOf(admin_route + "/settings/") !== -1) {
    systemFileAddLinkToSetting();
  } else if (
    location.href.indexOf(admin_route + "/files") !== -1 &&
    location.href.indexOf("editor_id=") == -1
  ) {
    systemFileAddLinkToFileManager();
  } else if (
    location.href.indexOf(admin_route + "/plugins/system-file") !== -1 &&
    location.href.indexOf("path=") == -1
  ) {
    systemFileShowTopLinks();
  }

  if (
    location.href.indexOf(admin_route + "/plugins/system-file") !== -1 &&
    location.href.indexOf("file=") == -1
  ) {
    systemFileCountFiles();
  }
});
