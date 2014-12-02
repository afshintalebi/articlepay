<?php
/**
*  Articlepay Component Administrator Articles View
* 
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
*/
// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
$result=JRequest::getVar( 'result', '0' );
$exist=JRequest::getVar( 'exist', '0' );
$addArticleLink = JRoute::_('index.php?option=com_articlepay&view=article&task=add',false);
$js = "
		Joomla.submitbutton = function(task) {
			if(task=='add') {
				window.location.href='$addArticleLink';
				return false;
			}
		}
";
$doc = JFactory::getDocument();
$doc->addScriptDeclaration($js);
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
</form>
<?php if($exist) { ?>
<div id="system-message-container">
	<dl id="system-message">
		<dt class="error"><?php echo JText::_('COM_ARTICLEPAY_RESULT_PAGE_TITLE');?></dt>
		<dd class="error message">
			<ul>
				<li><?php echo JText::_('COM_ARTICLEPAY_EXIST_MSG');?></li>
			</ul>
		</dd>
	</dl>
</div>

<?php } else { ?>

<?php if($result) {?>
<div id="system-message-container">
	<dl id="system-message">
		<dt class="message"><?php echo JText::_('COM_ARTICLEPAY_RESULT_PAGE_TITLE2');?></dt>
		<dd class="message message">
			<ul>
				<li><?php echo JText::_('COM_ARTICLEPAY_SAVE_SUCCESSFUL_MSG');?></li>
			</ul>
		</dd>
	</dl>
</div>
<?php } else { ?>
<div id="system-message-container">
	<dl id="system-message">
		<dt class="error"><?php echo JText::_('COM_ARTICLEPAY_RESULT_PAGE_TITLE');?></dt>
		<dd class="error message">
			<ul>
				<li><?php echo JText::_('COM_ARTICLEPAY_SAVE_FAILED_MSG');?></li>
			</ul>
		</dd>
	</dl>
</div>
<?php } // end of if ?>

<?php } // end of if ?>