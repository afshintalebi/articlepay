<?php
/**
*  Articlepay Component Administrator Bought View
* 
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
*/
// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<table class="adminlist">
		<thead>
			<tr>
				<th style="width:45%;"><?php echo JText::_('COM_ARTICLEPAY_BOUGHT_USER_LABEL');?></th>
				<th style="width:45%;"><?php echo JText::_('COM_ARTICLEPAY_BOUGHT_ARTICLE_LABEL');?></th>
		</thead>
		<tbody>
		<?php
		$k = 0;
		$i = 0;
		foreach ( $this->articlesPayed as $row ) {
		?>
		<tr class="<?php echo "row$k"; ?>">
				<td><?php echo $row->username; ?></td>
				<td><?php echo $row->article_title; ?></td>
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