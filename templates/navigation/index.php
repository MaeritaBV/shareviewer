<ul class="with-icon">
	<li data-id="all" class="nav-all<?php p(($_['viewtype'] == 'all'?' active':'')); ?>"><a class="icon-share" href="?viewtype=all#"><?php p($l->t('All Objects')); ?></a></li>
	<li data-id="files" class="nav-files<?php p(($_['viewtype'] == 'files'?' active':'')); ?>"><a class="icon-file" href="?viewtype=files#"><?php p($l->t('Files')); ?></a></li>
	<li data-id="folders" class="nav-folders<?php p(($_['viewtype'] == 'folders'?' active':'')); ?>"><a class="icon-folder" href="?viewtype=folders#"><?php p($l->t('Folders')); ?></a></li>
</ul>