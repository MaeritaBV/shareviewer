<table>
<tr class="headerRow">
  <!-- <td style="font-weight:bold">id&nbsp;</td> -->
  <td class="headerRow leftCell">&nbsp;<?php p($l->t('object')); ?>&nbsp;</td>
  <td class="headerRow middleCell">&nbsp;<?php p($l->t('object type')); ?>&nbsp;</td>
  <td class="headerRow middleCell">&nbsp;<?php p($l->t('owner')); ?>&nbsp;</td>
  <td class="headerRow middleCell">&nbsp;<?php p($l->t('shared by')); ?>&nbsp;</td>
  <td class="headerRow middleCell">&nbsp;<?php p($l->t('shared with')); ?>&nbsp;</td>
  <td class="headerRow middleCell">&nbsp;<?php p($l->t('share type')); ?>&nbsp;</td>
  <td class="headerRow rightCell">&nbsp;<?php p($l->t('expires on')); ?>&nbsp;</td>
</tr>
<?php
$trClass = 'odd';
foreach (unserialize($_['resultset']) as $shareListResultSet) {
  echo '<tr class="' . $trClass . '">' .
         //'<td>' . $shareListResultSet['id'] . '&nbsp;</td>' .
         '<td class="leftCell">&nbsp;' . $shareListResultSet['path'] . '&nbsp;</td>' .
         '<td class="icon-' . $shareListResultSet['item_type'] . ' middleCell">&nbsp;&nbsp;&nbsp;</td>' .
         '<td class="middleCell">&nbsp;' . $shareListResultSet['displayname_owner'] . '&nbsp;</td>' .
         '<td class="middleCell">&nbsp;' . $shareListResultSet['displayname_initiator'] . '&nbsp;</td>' .
         '<td class="middleCell">&nbsp;' . $shareListResultSet['displayname_share_with'] . '&nbsp;</td>' .
         '<td class="icon-' . (!empty($shareListResultSet['token'])?'mail':'share') . ' middleCell">&nbsp;&nbsp;&nbsp;</td>' .
         '<td class="rightCell">&nbsp;' . $shareListResultSet['expiration'] . '</td>' .
       '</tr>';
  $trClass = ($trClass==='odd'?'even':'odd');
} // foreach (unserialize($_['resultset']) as $shareListResultSet)
?>
</table>