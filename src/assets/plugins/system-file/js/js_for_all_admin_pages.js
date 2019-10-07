/* eslint-disable no-undef */
function systemFileAddLinkToSetting() {
  var category = $('#cms_setting_form .input-category').val();
  alert(category);
}
$(function () {
  if (location.href.indexOf(admin_route + "/settings/") !== -1) {
    systemFileAddLinkToSetting();
  }

});
