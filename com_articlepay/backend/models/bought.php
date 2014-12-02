<?php
/**
* Articlepay Administrator Article Payed model
* 
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
*/
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
// Import the JModel class
jimport ( 'joomla.application.component.model' );
class ArticlepayModelBought extends JModel {
	/**
	 * Transactions data array of objects
	 *
	 * @access private
	 * @var array
	 */
	public $_articlesPayed;
	/**
	 * Method to get a list of article payed
	 *
	 * @access public
	 * @return array of objects
	 */
	private function getDbName() {
		return '#__articlepay_user_payed';
	}
	public function getArticlesPayed() {
		$db = & $this->getDBO ();
		$table = $db->nameQuote ($this->getDbName());
		$joinTable1=$db->nameQuote('#__articlepay_articles');
		$joinTable2=$db->nameQuote('#__users');
		$query = "SELECT 
					`apy`.`id`,`apy`.`user_id`,`apy`.`article_id`,
					`art`.`article_title`, 
					`usr`.`username`
				  FROM ".$table." AS `apy`
				  INNER JOIN $joinTable1 AS `art` ON `art`.`article_id`=`apy`.`article_id`
				  INNER JOIN $joinTable2 AS `usr` ON `usr`.`id`=`apy`.`user_id`;";
		$db->setQuery ( $query );
		$this->_articlesPayed = $db->loadObjectList ();
		// Return the list of revues
		return $this->_articlesPayed;
	}
	
}