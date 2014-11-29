<?php
/**
* Articlepay frontend controller 
* 
* @package com_articlepay
* @subpackage components
* @link http://www.packtpub.com
* @license GNU/GPL
*/
// No direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );
// Load the base JController class
jimport ( 'joomla.application.component.controller' );
/**
 * Articlepay Frontend Controller
 */

class ArticlepayController extends JController {
	/**
	 * Method to display the view
	 *
	 * @access public
	 *        
	 */
	public function display() {
		echo JText::_('COM_ARTICLEPAY_TITLE');
	}
	/**
	 * Method for prepare payment for article
	 * 
	 * @access public
	 * @return void
	 */
	public function pay() {
		$app = JFactory::getApplication();
		$user = JFactory::getUser();
		$articleId=(int)JRequest::getVar ( 'item', 0 );
		if($user->guest) {
			$view = &$this->getView ( 'user', 'html' );
			$layout = JRequest::getVar( 'tmpl', 'default' );
			$view->setLayout($layout);
			// Use the View display method
			$view->loginRequired();
		} elseif($articleId){
			$userId=$user->id;
			$view = &$this->getView ( 'article', 'html' );
			$layout = JRequest::getVar( 'tmpl', 'details' );
			$model1 = &$this->getModel ( 'article' );
			$model2 = &$this->getModel ( 'bought' );
 			$view->setModel ( $model1, true );
			$view->setLayout( $layout );
			$userPayed=$model2->isUserPayed($userId,$articleId);
			if($userPayed) {
				$app->redirect(JURI::base());
			} else {
				// Use the View display method
				$view->articleDetails($articleId);
			}
		} else {
			$app->redirect(JURI::base());
		}
	}
	/**
	 * save payment data and go to the payment gate
	 * 
	 * @access public
	 * @return void
	 */
	public function pay_redirect() {
		$app = JFactory::getApplication();
		$user = JFactory::getUser();
		$articleId=(int)JRequest::getVar ( 'item', 0 );
		if($user->guest) {
			$app->redirect(JURI::base());
		} elseif($articleId) {
			$model1 = &$this->getModel ( 'article' );
			$model2 = &$this->getModel ( 'bought' );
			$model3 = &$this->getModel ( 'transaction' );
			$data=$model1->getArticleDetails($articleId);
			if($data) {
				require JPATH_COMPONENT_SITE.'/classes/zarinpal.php';
				$qstr=array(
					'ptyp'=>1,
					'item'=>$data->id,
				);
// 				Load the parameters.
				$params = $app->getParams('com_articlepay');
				$zarinpalCode=$params->get('zarinpalCode','');
				
				if($zarinpalCode) {
					$payment=new ZarinPalPayment();
					$payment->merchantCode=$zarinpalCode;
					$payment->amount=$data->amount;
					$payment->description=JText::_('COM_ARTICLEPAY_ARTICLE_TITLE').$data->article_title;
					$payment->email='';
					$payment->mobile='';
					$payment->callBackURL=JRoute::_('index.php?option=com_articlepay&task=pay_verify',false,-1);
					$result=$payment->PaymentRequest();
					if($result['status']==100) {
						$model3->paymentType=1;
						$model3->articleId=$articleId;
						$model3->userId=$user->id;
						$model3->amount=$data->amount;
						$model3->refCode=$result['authority'];
						$model3->createdDate=date('Y-m-d H:i:s',time());
						$model3->paymentData='';
						$model3->hasError=0;
						$model3->done=0;
						$saved=$model3->store();
						$payment->redirectToWebGate($result['authority'],$qstr);
					} else {
						die($payment->status[$result['status']]);
					}
				} else {
					die(JText::_('COM_ARTICLEPAY_MERCHANT_CODE_ERROR'));
				}
			} else {
				$app->redirect(JURI::base());
			}
		} else {
			$app->redirect(JURI::base());
		}
	}
	/**
	 * save payment data after verify payment
	 *
	 * @access private
	 * @return void
	 */
	private function savePaymentData($transId,$verifyData,$result) {
		$done=$result ? 1 : 0;
		$hasError=!$result ? 1 : 0;
		$model = &$this->getModel ( 'transaction' );
		$model->id=$transId;
		$model->paymentData=serialize($verifyData);
		$model->hasError=$hasError;
		$model->done=$done;
		return $model->updatePaymentData();
	}
	/**
	 * verify payment proccess
	 * 
	 * @access public
	 * @return void
	 */
	public function pay_verify() {
		$app = JFactory::getApplication();
		$authorityCode=JRequest::getVar ( 'Authority', '' );
		$status=JRequest::getVar ( 'Status', '' );
		$paymentType=JRequest::getVar ( 'ptyp', '' );
		$result=false;
		$verifyData=array();
		$message='';
		if($status=='OK') {
			require JPATH_COMPONENT_SITE.'/classes/zarinpal.php';
			$view = JRequest::getVar ( 'view', 'payment' );
			$layout = JRequest::getVar ( 'layout', 'payment_result' );
			$view = & $this->getView ( $view, 'html' );
			$view->setLayout ( $layout );
			$model = &$this->getModel ( 'transaction' );
			$model2 = &$this->getModel ( 'bought' );
			$data=$model->transactionDetails($authorityCode,$paymentType);
			$userPayed=$model2->isUserPayed($data->user_id,$data->article_id);
// 			checking for exist data
			if($data && !$userPayed) {
// 				Load the parameters.
				$params = $app->getParams('com_articlepay');
				$zarinpalCode=$params->get('zarinpalCode','');

				$payment=new ZarinPalPayment();
				$payment->merchantCode=$zarinpalCode;
				$payment->authority=$authorityCode;
				$payment->amount=$data->amount;
				$verify=$payment->PaymentVerification();
// 				checking for payment verified
				if($verify['status']==100 || $verify['status']==101) {
					$result=true;
					$transCode=$verify['refId'];
					$verifyData=array(
						'transCode'=>$transCode,
						'message'=>$payment->status[$verify['status']],
					);
					$savedVerifyData=$this->savePaymentData($data->id,$verifyData,1);
					if($savedVerifyData) {
// 						save article for user
						$model2->articleId=$data->article_id;
						$model2->userId=$data->user_id;
						$articleSaved=$model2->saveUserPay();
					}
					$message=JText::_($savedVerifyData ? 'COM_ARTICLEPAY_PAYMENT_SUCCESSFUL_MSG' : 'COM_ARTICLEPAY_PAYMENT_UNSUCCESSFUL_MSG').JText::_('COM_ARTICLEPAY_PAYMENT_TRANSACTION_CODE_TITLE').$transCode;
				} else {
					$message=$payment->status[$verify['status']];
				}
			} else {
				$message=JText::_($userPayed ? 'COM_ARTICLEPAY_PAYMENT_INVALID_MSG' : 'COM_ARTICLEPAY_PAYMENT_CANCELED_MSG');
			}
		} else {
			$message=JText::_('COM_ARTICLEPAY_PAYMENT_CANCELED_MSG');
		}
		$view->display($result,$message);
	}
}
?>