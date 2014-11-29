<?php if($this->failed) { ?>

<div id="system-message-container" class="articlepay-message">
	<dl id="system-message">
		<dt class="error"><?php echo JText::_('COM_ARTICLEPAY_ARTICLE_ERROR_TITLE');?></dt>
		<dd class="error message">
			<ul>
				<li><?php echo JText::_('COM_ARTICLEPAY_ARTICLE_ERROR_MSG');?></li>
			</ul>
		</dd>
	</dl>
</div>

<?php } else { ?>

<div class="articlepay-payment-article-details">
	<dl>
		<dt><?php echo JText::_('COM_ARTICLEPAY_ARTICLE_TITLE');?><?php echo $this->article->article_title;?></dt>
		<dd><?php echo JText::_('COM_ARTICLEPAY_ARTICLE_COST_TITLE');?><?php echo $this->article->amount;?></dd>
	</dl>
	<div class="articlepay-payment-link">
		<hr>
		<?php echo JHtml::link($this->paymentUrl,JText::_('COM_ARTICLEPAY_ARTICLE_PAYMENT_LINK_TITLE'));?>
	</div>
</div>

<?php } // end of if ?>