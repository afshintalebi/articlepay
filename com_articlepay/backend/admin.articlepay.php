<?php 
/**
 * ArticlePay Administrator entry point
 *
 * @package ArticlePay
 * @subpackage components
 * @link https://github.com/afshintalebi/articlepay
 * @license GNU/GPL version 3
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