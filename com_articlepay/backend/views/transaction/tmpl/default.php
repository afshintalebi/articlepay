<?php
/**
*  Articlepay Component Administrator Transactions View
* 
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
*/
// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
$js = "
		Joomla.submitbutton = function(task) {
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
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->transactions ); ?>);" />
				</th>
				<th style="width:10%;"><?php echo JText::_('COM_ARTICLEPAY_TRAN_DATE_LABEL');?></th>
				<th style="width:20%;"><?php echo JText::_('COM_ARTICLEPAY_TRAN_REF_CODE_LABEL');?></th>
				<th style="width:10%;"><?php echo JText::_('COM_ARTICLEPAY_TRAN_USERNAME_LABEL');?></th>
				<th style="width:10%;"><?php echo JText::_('COM_ARTICLEPAY_TRAN_AMOUNT_LABEL');?></th>
				<th style="width:15%;"><?php echo JText::_('COM_ARTICLEPAY_TRAN_PAYMENT_TYPE_LABEL');?></th>
				<th style="width:15%;"><?php echo JText::_('COM_ARTICLEPAY_TRAN_STATUS_LABEL');?></th>
		</thead>
		<tbody>
		<?php
		$k = 0;
		$i = 0;
		foreach ( $this->transactions as $row ) {
			$checked = JHTML::_ ( 'grid.id', $i, $row->id );
			$link = '';//JRoute::_ ( 'index.php?option=' . JRequest::getVar ( 'option' ) . '&task=edit&cid[]=' . $row->id . '&hidemainmenu=1' );
		?>
		<tr class="<?php echo "row$k"; ?>">
				<td><?php echo $checked; ?></td>
				<td><?php echo JHtml::_('date', $row->created_date, JText::_('DATE_FORMAT_LC4')); ?></td>
				<td><?php echo $row->ref_code; ?></td>
				<td><?php echo $row->username; ?></td>
				<td><?php echo $row->amount > 0 ? number_format($row->amount) : 0; ?></td>
				<td><?php echo $row->payment_type; ?></td>
				<td><?php echo JText::_($row->done ? 'COM_ARTICLEPAY_TRAN_SUCCESS_LABEL' : 'COM_ARTICLEPAY_TRAN_FAILED_LABEL'); ?></td>
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
	<input type="hidden" name="hidemainmenu" value="0" />
</form>