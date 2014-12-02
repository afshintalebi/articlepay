<?php
/**
*  Articlepay Component Administrator User View
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
		<dt class="error"><?php echo JText::_('COM_ARTICLEPAY_PAYMENT_LOGIN_REQUIRED_TITLE');?></dt>
		<dd class="error message">
			<ul>
				<li><?php echo JText::_('COM_ARTICLEPAY_USER_SHOULD_BE_LOGIN_MSG');?></li>
				<li>
					<a href="<?php echo $loginLink;?>">
						<?php echo JText::_('COM_ARTICLEPAY_USER_LOGIN_LINK_TITLE');?>
					</a>
				</li>
			</ul>
		</dd>
	</dl>
</div>
