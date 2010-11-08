<?php

class AppController extends Controller {

	var $helpers = array('MyHtml', 'MyPaginator', 'MyForm', 'Session');
	//var $components = array('RequestHandler', 'Session', 'Cookie', 'Filter', 'Uploader');
	//var $components = array('RequestHandler', 'Session');
	var $components = array('Filter', 'Session');


/**
 * Check is an uploaded file was correctly uploaded
 *
 * @param <string> $msg
 * @return bool
 */
	function isUploadedFile($params){
		$val = array_shift($params);
		if ((isset($val['error']) && $val['error'] == 0) ||
		(!empty( $val['tmp_name']) && $val['tmp_name'] != 'none')) {
			return is_uploaded_file($val['tmp_name']);
		}
		return false;
	}


/**
 * Simplify application messages
 *
 * @param <string> $msg
 * @param <string> $type
 *		error
 *		success
 * @return void
 */
	function setFlash($msg, $type = 'error') {
		$this->Session->setFlash(
			$msg, 'default', array('class' => $type, 'id' => 'message')
		);
	}

	function delete($id) {

		if ($this->{$this->modelClass}->delete($id)) {
 			$this->Session->setFlash(__('Record deleted', true), 'flash_success');
		} else {
			$this->Session->setFlash(__('Record was not deleted', true), 'flash_error');
		}

		$this->redirect(array('action' => 'index'));
	}

	function index() {
		$data = $this->paginate();
		$this->set('data', $data);
	}

	private function __setAjaxFlash($options) {

		$errors = array();
		if ($options['state'] == 'error') {
			if (empty($options['errors'])) {
				foreach ($this->{$this->modelClass}->validationErrors as $field => $message) {
					$errors[$this->{$this->modelClass}->name . Inflector::camelize($field)] = $message;
				}
			}
		}

		if (!empty($options['fields'])) {
			$errors = array_merge($errors, $options['fields']);
		}

		$_defaults = array(
			'title'		=> $options['state'],
			'fields'	=> $errors);
		$options = array_merge($_defaults, $options);


		$this->set('data', json_encode($options));
		$this->render('/elements/only_text', 'ajax');
	}


	function setSuccessAjaxFlash($message = '', $options = array()) {
		if (empty($message)) {
			$message = __('Success', true);
		}

		$_defaults = array(
			'state'		=> 'success',
			'message'	=> $message);
		$options = array_merge($_defaults, $options);
		$this->__setAjaxFlash($options);
	}


	function setErrorAjaxFlash($message = '', $options = array()) {
		if (empty($message)) {
			$message = __('Error', true);
		}

		$_defaults = array(
			'state'		=> 'error',
			'message'	=> $message);
		$options = array_merge($_defaults, $options);
		$this->__setAjaxFlash($options);
	}

	function beforeFilter() {


		/** Check for a logged in user */
		if ($this->Session->check('User')) {

			/** Saves current logged in user */
			$user = $this->Session->read('User');
			App::import('Model', 'User');
			User::store($user);

		} else if (
			!in_array(
				$this->params['action'],
				array('login', 'login', 'logout', 'forgot_password', 'register')))
		{
			$this->redirect(
				array(
					'admin'			=> false,
					'controller' 	=> 'users',
					'action' 		=> 'login'
				)
			);
		}

	}

}