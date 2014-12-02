<?php
/**
*  Articlepay Component Payment View
* 
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
*/
// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
$loginLink = JRoute::_('index.php?option=com_users&view=login',false);
?>

<div id="system-message-container" class="articlepay-message">
	<dl id="system-message">
		<dt class="error"><?php echo JText::_('COM_ARTICLEPAY_PAYMENT_TITLE');?></dt>
		<dd class="<?php echo $this->result ? 'message' : 'error';?> message">
			<ul>
				<li><?php echo $this->message;?></li>
			</ul>
		</dd>
	</dl>
</div>
