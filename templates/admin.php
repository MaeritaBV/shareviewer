<?php
script('shareviewer', 'admin');
style('shareviewer', 'admin');
?>
<form class="section" id="frmShareViewerAdmin">

  <h2><?php p($l->t('Share Viewer')) ?></h2>

  <p class="settings-hint">
    <?php p($l->t('Visibility of the shares, users can:')); ?>
  </p>

  <table class="shareviewersettings">
    <thead>
      <tr>
        <th class="small">&nbsp;</th>
        <th><span id="shareviewer_notifications_msg" class="msg"></span></th>
      </tr>
    </thead>
    <tbody>
		<?php foreach ($_['visibilitytypes'] as $visibilityType => $description): ?>
      <tr>
        <td class="small">
          <input type="radio" name="shareviewer_visibility" value="<?php p($visibilityType); ?>" id="shareviewer_visibility_<?php p($visibilityType); ?>" 
            <?php if ($_['visibility']===$visibilityType): ?>  checked="checked"<?php endif; ?> />
        </td>
        <td>
          <?php p($description); ?>|||<?php echo OC.generateUrl('/apps/shareviewer/settingscontroller'); ?>
        </td>
      </tr>
		<?php endforeach; ?>
    </tbody>
  </table>

</form>