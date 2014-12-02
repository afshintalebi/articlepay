<?php
/**
* Articlepay frontend entry point 
* 
* @package com_articlepay
* @subpackage components
* @link https://github.com/afshintalebi/articlepay
* @license GNU/GPL version 3
*/
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
// Require the base controller
require_once (JPATH_COMPONENT . DS . 'controller.php');
// Create the controller
$controller = new ArticlepayController ();
// Perform the requested task
$controller->execute ( JRequest::getVar ( 'task', 'display' ) );
// Redirect if set by the controller
$controller->redirect ();
?>