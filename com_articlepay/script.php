<?php
// No direct access to this file
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 * Script file of com_articlepay component
 */
class com_articlepayInstallerScript {
	/**
	 * static method for loading component language
	 * @return void
	 */
	static function loadLanguage() {
		$lang =& JFactory::getLanguage();
		$lang->load('com_articlepay', JPATH_ADMINISTRATOR);
	}
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	public function install($parent) {
		// $parent is the class calling this method
		self::loadLanguage();
		echo JText::_ ( 'COM_ARTICLEPAY_INSTALL_DESCRIPTION' );
	}
	
	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	public function uninstall($parent) {
		// $parent is the class calling this method
		self::loadLanguage();
		echo JText::_ ( 'COM_ARTICLEPAY_UNINSTALL_DESCRIPTION' );
	}
	
	/**
	 * method to update the component
	 *
	 * @return void
	 **/
	public function update($parent) {
		self::loadLanguage();
		echo JText::_ ( 'COM_ARTICLEPAY_UPDATE_DESCRIPTION' );
	}
	
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 **/
	public function preflight($type, $parent) {
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
	}
	
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	public function postflight($type, $parent) {
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
	}
}