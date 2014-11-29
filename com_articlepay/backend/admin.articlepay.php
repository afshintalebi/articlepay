<?php 
/**
 * Boxoffice Administrator entry point
 *
 * @package com_boxoffice
 * @subpackage components
 * @license GNU/GPL
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// fetch the view
$view = JRequest::getVar( 'view' , 'article' );

// Require the base controller
// require_once( JPATH_COMPONENT.DS.'controller.php' );
require_once( JPATH_COMPONENT.'/controllers/'.$view.'.php' );

// Create the controller
$controllerClass = 'ArticlepayController'.ucfirst($view);
$controller = new $controllerClass;
//Perform the requested task
$controller->execute(JRequest::getVar('task', 'display'));

//Redirect if set by the controller
$controller->redirect();
?>