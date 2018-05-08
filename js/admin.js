$(document).ready(function() {
  function saveSettings() {
    OC.msg.startSaving('#shareviewer_notifications_msg');
    var baseURL = OC.generateUrl('/apps/shareviewer/settings/admin');
    var post = $('#frmShareViewerAdmin').serialize();

    $.post(baseURL, post, function(response) {
      OC.msg.finishedSuccess('#shareviewer_notifications_msg', response.data.message);
    });
  }

  var $frmShareViewerAdmin = $('#frmShareViewerAdmin');
  $frmShareViewerAdmin.find('input[type=radio]').change(saveSettings);
});
