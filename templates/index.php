<?php
// script('shareviewer', 'scripts');
style('shareviewer', 'styles');
?>
<div id="app">
  <div id="app-navigation">
    <?php print_unescaped($this->inc('navigation/index')); ?>
    <?php //print_unescaped($this->inc('settings/index')); ?>
  </div>

  <div id="app-content">
    <div id="app-content-header">
      <h2><?php p($l->t('Shared Objects') . ' : ' . $l->t($_['viewtype'])); ?></h2>
    </div>
    <div id="app-content-wrapper">
      <?php print_unescaped($this->inc('content/index')); ?>
    </div>
  </div>
</div>