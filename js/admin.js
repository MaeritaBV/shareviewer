$(document).ready(function() {
  function saveSettings() {
    //OC.msg.startSaving('#shareviewer_notifications_msg');
    var post = $('#frmShareViewerAdmin').serialize();

    //$.post(OC.generateUrl('/apps/shareviewer/settings/adminsettings'), post, function(response) {
    //  OC.msg.finishedSuccess('#shareviewer_notifications_msg', response.data.message);
    //});
    alert('test');
  }

  var $frmShareViewerAdmin = $('#frmShareViewerAdmin');
  $frmShareViewerAdmin.find('input[type=radio]').change(saveSettings);
});
