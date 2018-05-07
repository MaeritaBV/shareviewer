<?php
// script('shareviewer', 'admin');
// style('shareviewer', 'admin');
?>
<form id="frmShareViewerAdmin" action="#" method="post">
  <div class="section" id="share_viewer">
    <h2><?php p($l->t('Share Viewer')) ?></h2>
    <p><?php p($l->t('Visibility of the shares, users can:')) ?></p>
    <p>
      <input type="radio" name="share_viewer_visibility" value="none" id="share_viewer_visibility_none" 
           <?php print_unescaped($_['visibility']=='none' ? 'checked="checked"' : '') ?> 
           />
      <label for="share_viewer_visibility_none"><?php p($l->t('not see any shared objects')) ?></label><br>
    </p>
    <p>
      <input type="radio" name="share_viewer_visibility" value="owned" id="share_viewer_visibility_owned"
           <?php print_unescaped($_['visibility']=='owned' ? 'checked="checked"' : '') ?> 
           />
      <label for="share_viewer_visibility_owned"><?php p($l->t('see shares on owned objects')) ?></label><br>
    </p>
    <p>
      <input type="radio" name="share_viewer_visibility" value="ownedandshared" id="share_viewer_visibility_ownedandshared"
           <?php print_unescaped($_['visibility']=='ownedandshared' ? 'checked="checked"' : '') ?> 
           />
      <label for="share_viewer_visibility_ownedandshared"><?php p($l->t('see shares on owned objects and those shared with the user')) ?></label><br>
    </p>
    <p>
      <input type="radio" name="share_viewer_visibility" value="all" id="share_viewer_visibility_all"
           <?php print_unescaped($_['visibility']=='all' ? 'checked="checked"' : '') ?> 
           />
      <label for="share_viewer_visibility_all"><?php p($l->t('see all shared objects')) ?></label><br>
    </p>
    <br />
    <input type="hidden" value="<?php p($_['requesttoken']); ?>" name="requesttoken" />
    <input type="submit" id="share_viewer_settings_apply" value="<?php p($l->t('Apply')) ?>">
    <span id="share_viewer-admin-msg" class="msg"></span>
  </div>
</form>
