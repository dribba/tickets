<?php
class UsersController extends AppController {

	var $paginate = array('order' => array('User.username'));

	function index() {
		//d($this->User->get_personal_data('27959940'));
		$this->set('data', $this->paginate());
	}
	function forgot_password() {
		if (!empty($this->data)) {

			$mobilePhone = $this->data['User']['phone_area'] . $this->data['User']['phone_number'];
			$user = $this->User->find('first',
				array(
					'conditions' => array(
						'User.document'		=> $this->data['User']['document'],
						'User.mobile_phone'	=> $mobilePhone
					)
				)
			);

			if (!empty($user)) {
				
				$message = sprintf(
					"Nombre de usuario: %s Contraseña: %s",
					$user['User']['document'],
					$user['User']['mobile_phone']
				);
				$this->User->send_sms($user['User']['mobile_phone'], $message);
				return $this->Session->setFlash(
					__('Su usuario y contrasena fueron enviados a su celular', true),
					'flash_success'
				);

			} else {
				return $this->Session->setFlash(
					__('Los datos ingresados son incorrectos', true),
					'flash_error'
				);
			}
			
		}
	}

    function login() {

		if (!empty($this->data)) {

			if ($user = $this->User->validate($this->data)) {

				if ($user['User']['type'] == 'admin') {
					$redirect = array(
						'admin'			=> true,
						'controller'	=> 'events',
					);
				} else {
					$redirect = array(
						'controller'	=> 'sells',
					);
				}
				$userSession = $user;
				$userSession['User']['last_login'] = $this->User->updateLastLogin($user['User']['id']);
				$this->Session->write('User', $userSession);
				$this->redirect($redirect);
			} else {
				$this->Session->setFlash(
					__('Los datos ingresados son incorrectos', true),
					'flash_error'
				);
				$this->redirect(array(
					'controller'	=> 'users',
					'action'		=> 'login',
				));
			}
		}
	}


    function logout() {
		$this->Session->delete('User');
		$this->redirect('login');
	}




/**
	TODO: Validar longitud del password y caracteres obligatorios.
*/
	private function __change_password($id = null) {

		if (!empty($this->data)) {

			if (!empty($this->data['User']['id'])) {

				$user = $this->User->findById($this->data['User']['id']);
			} else {
				$user = $this->Session->read('User');
				$current_password = $this->data['User']['current'];

				if (md5($current_password) != $user['User']['password']) {

					$this->Session->setFlash(
						__('Current password error.', true),
						'flash_error'
					);
				}
			}

			$new_password = $this->data['User']['new_password'];
			$retype_password = $this->data['User']['retype_password'];


			if(empty($new_password) || empty($retype_password)) {

				$this->Session->setFlash(
					__('Please type new password.', true),
					'flash_error'
				);
				
			} else {
				if ($new_password == $retype_password) {
					$updatedPassword =  $this->User->updatePassword(
						$user['User']['id'],
						$new_password
					);

					if (!empty($updatedPassword)) {
						$this->Session->setFlash(
							__('The password was changed succesfully.', true),
							'flash_success'
						);
						
					} else {
						$this->Session->setFlash(
							__('There was a problem updating the password.', true),
							'flash_error'
						);
						
					}
				} else {
					$this->Session->setFlash(
						__('The new password and the retype fields must be equals.', true),
						'flash_error'
					);
					
				}
			}


		} else {
			$this->set('id', $id);
		}
		$this->render('__change_password');
	}

	function admin_change_password($id = null) {
		$this->__change_password($id);
	}

	function change_password() {
		$this->__change_password(User::get('/User/id'));
	}




	function admin_index() {

		$this->set('data', $this->paginate());

	}


/**
 *******************************************************************************
 * CRUDs
 *******************************************************************************
 */


/**
 * Create
 */ /*
	function admin_add($id = null) {
		$this->set('types', array('admin' => 'admin', 'agency' => 'agency'));
		if (!empty($this->data)) {
			
			$this->User->create();
			if (empty($this->data['User']['id'])) {
				$this->data['User']['password'] = md5($this->data['User']['password']);
			}
			if ($this->User->save($this->data)) {
				return $this->Session->setFlash(__('The user has been saved.', true), 'flash_success');
			} else {
				return $this->Session->setFlash(
					__('The user could not be saved. Please, check errors and try again.', true),
					'flash_error'
				);
			}
		} else {
			if (!empty($id)) {
				$this->set('id', $id);
				//$this->set('attributes', getConf('/App/Cards/Card[name=users]/Attributes/Attribute/.'));
				$user = $this->User->read(null, $id);
				$this->data = $user;
			}
		}
	}*/

	function admin_add($id = null) {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		} else {
			if (!empty($id)) {
				$this->data = $this->User->read(null, $id);
				$this->set('id', $this->data['User']['id']);
			}
		}
	}


/**
 * Read
 */
	function admin_view($id) {
		
		$this->set('id', $id);
		//$this->set('attributes', getConf('/App/Cards/Card[name=users]/Attributes/Attribute/.'));
		$this->set('data', $this->User->read(null, $id));
		
	}


/**
 * Update
 */
	function admin_edit($id) {

		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				return $this->setSuccessAjaxFlash(__('The user has been saved.', true));
			} else {
				return $this->setErrorAjaxFlash(
					__('The user could not be saved. Please, check errors and try again.', true)
				);
			}
		} else {
			$this->data = $this->User->read(null, $id);
			$this->get_lists();
			$this->render('admin_add');
		}

	}


/**
 * Delete
 */
	function admin_delete($id) {

		if ($this->User->delete($id)) {
			$this->Session->setFlash(
				__('Socio eliminado', true),
				'flash_success'
			);
		} else {
			$this->Session->setFlash(
				__('Error al eliminar socio', true),
				'flash_error'
			);
		}

		$this->redirect(array('action' => 'index'));
	}

	/*
	 * Block user
	 */
	function admin_block($state, $id) {
		
		$update = array(
			'User' => array(
				'id'				=> $id,
				'state'				=> $state,
			)
		);
		if ($this->User->save($update)) {
			$this->Session->setFlash(
				__('User' . ' ' .$state, true),
				'flash_success'
			);
		} else {
			$this->Session->setFlash(
				__('User was not' . ' ' . $state, true),
				'flash_error'
			);
		}

		$this->redirect(array('action' => 'index'));
	}

}