<?php
// script('shareviewer', 'admin');
style('shareviewer', 'admin');
?>
<form class="section" id="frmShareViewerAdmin">

  <h2><?php p($l->t('Share Viewer')) ?></h2>

  <p class="settings-hint">
    <?php p($l->t('Visibility of the shares, users can:')); ?>
  </p>


	<?php
	foreach ($_['categories'] as $category => $data) {
		?>
		<p>
			<input id="survey_client_<?php p($category); ?>" name="survey_client_<?php p($category); ?>"
				   type="checkbox" class="checkbox survey_client_category" value="1" <?php if ($data['enabled']): ?> checked="checked"<?php endif; ?> />
			<label for="survey_client_<?php p($category); ?>"><?php print_unescaped($data['displayName']); ?></label>
		</p>
		<?php
	}
	?>



  <table class="grid shareviewersettings">
    <thead>
      <tr>
        <th class="small">&nbsp;</th>
        <th><span id="activity_notifications_msg" class="msg"></span></th>
      </tr>
    </thead>
    <tbody>
		<?php foreach ($_['visibility'] as $data): ?>

      <tr>
        <td class="small">
          <input type="radio" name="share_viewer_visibility" value="none" id="share_viewer_visibility_<?php p($data); ?>" 
            <?php if ($_['visibility']===$data): ?>  checked="checked"<?php endif; ?> />
        </td>
        <td>
          <?php p($l->t('not see any shared objects')) ?>
        </td>
      </tr>
		<?php endforeach; ?>
      <tr>
        <td class="small">
          <input type="radio" name="share_viewer_visibility" value="owned" id="share_viewer_visibility_owned" 
            <?php if ($_['visibility']==='owned'): ?>  checked="checked"<?php endif; ?> />
        </td>
        <td>
          <?php p($l->t('see shares on owned objects')); p($data); ?>
        </td>
      </tr>
      <tr>
        <td class="small">
          <input type="radio" name="share_viewer_visibility" value="ownedandshared" id="share_viewer_visibility_ownedandshared" 
            <?php if ($_['visibility']==='ownedandshared'): ?>  checked="checked"<?php endif; ?> />
        </td>
        <td>
          <?php p($l->t('see shares on owned objects and those shared with the user')) ?>
        </td>
      </tr>
      <tr>
        <td class="small">
          <input type="radio" name="share_viewer_visibility" value="all" id="share_viewer_visibility_all" 
            <?php if ($_['visibility']==='all'): ?>  checked="checked"<?php endif; ?> />
        </td>
        <td>
          <?php p($l->t('see all shared objects')) ?>
        </td>
      </tr>
    </tbody>

</form>