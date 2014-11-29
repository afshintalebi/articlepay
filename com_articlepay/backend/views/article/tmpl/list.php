<?php
/**
*  Articlepay Component Administrator Articles View
* 
*  @package com_articlepay
*  @subpackage components
*  @link http://www.packtpub.com
*  @license GNU/GPL
*/
// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
$addArticleLink = JRoute::_('index.php?option=com_articlepay&view=article&task=add',false);
$js = "
		Joomla.submitbutton = function(task) {
			if(task=='add') {
				window.location.href='$addArticleLink';
				return false;
			}
			if(task=='delete') {
				Joomla.submitform(task, document.getElementById('adminForm'));
			}
		}
";
$doc = JFactory::getDocument();
$doc->addScriptDeclaration($js);
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<table class="adminlist">
		<thead>
			<tr>
				<th  style="width:3%;">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->articles ); ?>);" />
				</th>
				<th style="width:10%;"><?php echo JText::_('COM_ARTICLEPAY_ARTICLE_ID_LABEL');?></th>
				<th style="width:60%;"><?php echo JText::_('COM_ARTICLEPAY_ARTICLE_TITLE_LABEL');?></th>
				<th style="width:10%;"><?php echo JText::_('COM_ARTICLEPAY_ARTICLE_COST_LABEL');?></th>
				<th style="width:10%;"><?php echo JText::_('COM_ARTICLEPAY_ARTICLE_STATUS_LABEL');?></th>
		</thead>
		<tbody>
		<?php
		$k = 0;
		$i = 0;
		foreach ( $this->articles as $row ) {
			$checked = JHTML::_ ( 'grid.id', $i, $row->id );
			$link = '';//JRoute::_ ( 'index.php?option=' . JRequest::getVar ( 'option' ) . '&task=edit&cid[]=' . $row->id . '&hidemainmenu=1' );
		?>
		<tr class="<?php echo "row$k"; ?>">
				<td><?php echo $checked; ?></td>
				<td><?php echo $row->article_id; ?></td>
				<td><?php echo $row->article_title; ?></td>
				<td><?php echo $row->amount > 0 ? number_format($row->amount) : 0; ?></td>
				<td><?php echo JText::_($row->active ? 'COM_ARTICLEPAY_ARTICLE_ACTIVE_STATUS_LABEL' : 'COM_ARTICLEPAY_ARTICLE_INACTIVE_STATUS_LABEL'); ?></td>
			</tr>
		<?php
			$k = 1 - $k;
			$i ++;
		}
		?>
</tbody>
	</table>
	<input type="hidden" name="option" value="<?php echo JRequest::getVar( 'option' ); ?>" /> 
	<input type="hidden" name="view" value="<?php echo JRequest::getVar( 'view' ); ?>" /> 
	<input type="hidden" name="task" value="" /> 
	<input type="hidden" name="boxchecked" value="0" /> 
	<input type="hidden" name="hidemainmenu" value="1" />
</form>