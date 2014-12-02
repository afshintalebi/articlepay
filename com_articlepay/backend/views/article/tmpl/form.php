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
$articlesLink = 'index.php?option=com_content&amp;view=articles&amp;layout=modal&amp;tmpl=component&amp;'.JSession::getFormToken().'=1';
$articlesListLink = JRoute::_('index.php?option=com_articlepay&amp;view=article',false);
$js = "
		Joomla.submitbutton = function(task) {
			if(task=='cancel') {
				window.location='$articlesListLink';
				return false;
			}
			artSelBtnObj=document.getElementById('selectArticleBtn');
			artTitleObj=document.getElementById('article_title');
			artIdObj=document.getElementById('article_id');
			artCatIdObj=document.getElementById('article_cat_id');
			amountObj=document.getElementById('amount');
			activeObj=document.getElementById('activeEnable');
			inActiveObj=document.getElementById('activeDisable');
			if(!artTitleObj.value || !artIdObj.value || !artCatIdObj.value)
			{
				alert('".JText::_('COM_ARTICLEPAY_VALIDATION_MSG1')."');
				artSelBtnObj.focus();
				return false;
			}
			if(!amountObj.value || !parseInt(amountObj.value))
			{
				alert('".JText::_('COM_ARTICLEPAY_VALIDATION_MSG2')."');
				amountObj.focus();
				return false;
			}
			if(!(activeObj.checked || inActiveObj.checked))
			{
				alert('".JText::_('COM_ARTICLEPAY_VALIDATION_MSG3')."');
				activeObj.focus();
				return false;
			}
			Joomla.submitform(task, document.getElementById('adminForm'));
		}
		function jSelectArticle(id, title, catid, object, link, lang) {
			var hreflang = '';
			if (lang !== '') {
				var hreflang = ' hreflang = \"' + lang + '\"';
			}
			document.getElementById('article_id').value=id;
			document.getElementById('article_title').value=title;
			document.getElementById('article_cat_id').value=catid;
			document.getElementById('article_object').value=object;
			document.getElementById('article_link').value=link;
			document.getElementById('article_lang').value=lang;
			var tag = '<a' + hreflang + ' href=\"' + link + '\">' + title + '</a>';
			SqueezeBox.close();
		}";

$doc = JFactory::getDocument();
$doc->addScriptDeclaration($js);

JHtml::_('behavior.modal');
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
	<div class="col100">
		<div class="button2-left">
			<div class="blank">
				<a id="selectArticleBtn" style="width: 80px;text-align:center;" href="<?php echo $articlesLink;?>" class="modal" rel="{handler: 'iframe', size: {x: 800, y: 450}}">
					<?php echo JText::_('COM_ARTICLEPAY_SELECT_ARTICLE_BTN_LABEL');?>
				</a>
			</div>
		</div>
		<div class="clr" style="padding-top: 10px;"></div>
		<table class="admintable" cellpadding="5">
			<tr>
				<td width="100" align="right" class="key">
					<label for="article_title">
						<?php echo JText::_('COM_ARTICLEPAY_ARTICLE_TITLE_LABEL');?>  
						<span class="star"> *</span>
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="article_title" id="article_title" readonly="readonly"/>
					<input type="hidden" name="article_id" id="article_id" />
					<input type="hidden" name="article_cat_id" id="article_cat_id" />
					<input type="hidden" name="article_object" id="article_object" />
					<input type="hidden" name="article_link" id="article_link" />
					<input type="hidden" name="article_lang" id="article_lang" />
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key">
					<label for="title">
						<?php echo JText::_('COM_ARTICLEPAY_ARTICLE_COST_LABEL');?> 
						<span class="star"> *</span>
					</label>
				</td>
				<td>
					<input class="inputbox" type="text" name="amount" id="amount" />
				</td>
			</tr>
			<tr>
				<td width="100" align="right" class="key">
					<label for="active">
						<?php echo JText::_('COM_ARTICLEPAY_ARTICLE_STATUS_LABEL');?>
						<span class="star"> *</span> 
					</label>
				</td>
				<td>
					<input type="radio" name="active" id="activeEnable" value="1" checked="checked">
					<label for="activeEnable"><?php echo JText::_('COM_ARTICLEPAY_ARTICLE_ACTIVE_STATUS_LABEL');?></label>
					<input type="radio" name="active" id="activeDisable" value="0">
					<label for="activeDisable"><?php echo JText::_('COM_ARTICLEPAY_ARTICLE_INACTIVE_STATUS_LABEL');?></label>
				</td>
			</tr>
		</table>
	</div>
	<div class="clr"></div>
	<input type="hidden" name="option" value="<?php echo JRequest::getVar( 'option' ); ?>" /> 
	<input type="hidden" name="id" value="" /> 
	<input type="hidden" name="view" value="<?php echo JRequest::getVar('view',''); ?>" />
	<input type="hidden" name="tmpl" value="<?php echo JRequest::getVar('tmpl',''); ?>" />
	<input type="hidden" name="task" value="<?php echo JRequest::getVar('task',''); ?>" />
</form>

