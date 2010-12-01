<?php
class UsersController extends AppController {

	var $components = array('Captcha');
	var $paginate = array('order' => array('User.username'));


	function register() {
		$this->layout = 'talleres';
		if (empty($this->data)) {
			$this->set('step', 1);
		} else {

			if ($this->data['User']['step'] == 1) {

				$this->User->set($this->data);

				if ($this->User->validates()) {

					$exists = $this->User->find('first',
						array(
							'conditions' => array(
								'User.document'		=> $this->data['User']['document'],
							)
						)
					);
					if (empty($exists)) {

						$company = $this->__check_company(
							$this->data['User']['mobile_area'], $this->data['User']['mobile_phone']
						);
						
						if (!empty($company)) {
							if (strpos(strtolower($company['Company']['operator']), 'cti') !== false) {
								$code = 3; // Claro
							} else if (strpos(strtolower($company['Company']['operator']), 'personal') !== false) {
								$code = 4; // Personal
							} else {
								$code = 1; // Movistar
							}

							$this->data['User']['mobile_company'] = $code;
						}

						$r = $this->User->get_personal_data(
							$this->data['User']['document'],
							$this->data['User']['sex']
						);

						if (!empty($r)) {
							if (!empty($r['domicilios_v_1'])) {
								$valid['address'] = $data['address'][] = $r['domicilios_v_1'];
							} elseif (!empty($r['domicilios_v_2'])) {
								$valid['address'] = $data['address'][] = $r['domicilios_v_2'];
							} elseif (!empty($r['domicilios_v_3'])) {
								$valid['address'] = $data['address'][] = $r['domicilios_v_3'];
							} elseif (!empty($r['domicilios_v_4'])) {
								$valid['address'] = $data['address'][] = $r['domicilios_v_4'];
							}
							$data['address'][] = $r['domicilios_f_1'];
							$data['address'][] = $r['domicilios_f_2'];
							$data['address'][] = $r['domicilios_f_3'];
							shuffle($data['address']);


							if (!empty($r['laborales_v_1'])) {
								$valid['know'] = $data['know'][] = $r['laborales_v_1'];
							} elseif (!empty($r['laborales_v_2'])) {
								$valid['know'] = $data['address'][] = $r['laborales_v_2'];
							} elseif (!empty($r['laborales_v_3'])) {
								$valid['know'] = $data['address'][] = $r['laborales_v_3'];
							}
							$data['know'][] = $r['laborales_f_1'];
							$data['know'][] = $r['laborales_f_2'];
							$data['know'][] = $r['laborales_f_3'];
							shuffle($data['know']);



							if (!empty($r['telefonos_v_1'])) {
								$valid['phone'] = $data['phone'][] = $r['telefonos_v_1'];
							} else {
								$valid['phone'] = $data['phone'][] = $r['telefonos_v_2'];
							}
							$data['phone'][] = $r['telefonos_f_1'];
							$data['phone'][] = $r['telefonos_f_2'];
							$data['phone'][] = $r['telefonos_f_3'];
							shuffle($data['phone']);

							
							$this->data['User']['full_name'] = $r['apellido'] . ' ' . $r['nombre'];
							$this->Session->write('user_data', $this->data);
							$this->Session->write('valid_data', $valid);
							$this->set('validation_data', $data);
						} else {
							$this->Session->setFlash(
								__('Persona no encontrada. Verifique los datos ingresados.', true),
								'flash_error'
							);
							$this->redirect(array('controller' => 'users', 'action' => 'register'));
						}
					} else {
						$this->Session->setFlash(
							__('Usted ya esta registrado.', true),
							'flash_error'
						);
						$this->redirect(array('controller' => 'users', 'action' => 'login'));
					}
					$this->set('step', 2);
				} else {
					$this->set('step', 1);
				}
			} else if ($this->data['User']['step'] == 2) {

				if (!$this->Captcha->protect()) {
					$this->Session->setFlash(__('Los numeros de la imagen ingresados no coinciden', true), 'flash_error');
				} else {

					$this->set('step', 3);

					$validData = $this->Session->read('valid_data');
					if (
						$this->data['User']['address'] == $validData['address'] &&
						$this->data['User']['phone'] == $validData['phone'] &&
						$this->data['User']['know'] == $validData['know']
					) {
						$uuid = rand(1000, 9999);
						$user = $this->Session->read('user_data');
						unset($user['User']['step']);
						$user['User']['password'] = md5($uuid);
						$user['User']['username'] = $user['User']['document'];
						
						$this->User->create();
						if ($this->User->save($user)) {


							$params['to'] = $user['User']['mobile_area'] . $user['User']['mobile_phone'];
							$params['company'] = $user['User']['mobile_company'];
							$params['message'] = sprintf('
								DATOS DE ACCESO AL SISTEMA:
								Usuario/documento %s
								Contrasena %s',
								$user['User']['username'],
								$uuid
							);
							$this->User->send_sms($params);

							$this->Session->setFlash(__('Usuario creado con exito, su contrasena fue enviada a su celular', true), 'flash_success');
						} else {
							$this->Session->setFlash(__('Error guardando los datos', true), 'flash_error');
						}
					}
				}
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
		}
	}


	function captcha() {
		$this->Captcha->show();
	}


	function index() {
		//d($this->User->get_personal_data('27959940'));
		$this->set('data', $this->paginate());
	}


	function forgot_password() {
		$this->layout = 'talleres';
		if (!empty($this->data)) {

			$user = $this->User->find('first',
				array(
					'conditions' => array(
						'User.document'		=> $this->data['User']['document'],
						'User.mobile_phone'	=> $this->data['User']['mobile_phone'],
						'User.mobile_area'	=> $this->data['User']['mobile_area']
					)
				)
			);
			
			if (!empty($user)) {

				$new_pass = rand(1000, 9999);
				$updateUser['User'] = array(
					'id'		=> $user['User']['id'],
					'password'	=> md5($new_pass)
				);
				
				$this->User->save($updateUser);
				$params['to'] = $this->data['User']['mobile_area'] . $this->data['User']['mobile_phone'];
				$params['company'] = $user['User']['mobile_company'];
				$params['message'] = sprintf('
							DATOS DE ACCESO AL SISTEMA:
							Usuario/documento %s
							Contrasena %s',
							$user['User']['username'],
							$new_pass
				);
				$this->User->send_sms($params);
				return $this->Session->setFlash(
					__('Sus datos de acceso fueron enviados a su celular', true),
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

		$this->layout = 'talleres';

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
						__('Contrasena actual incorrecta.', true),
						'flash_error'
					);
					$prefix = ((User::get('/User/type') == 'admin') ? true : false);
					$this->redirect(
						array('admin' => $prefix, 'controller' => 'users', 'action' => 'change_password')
					);
				}
			}

			$new_password = $this->data['User']['new_password'];
			$retype_password = $this->data['User']['retype_password'];


			if(empty($new_password) || empty($retype_password)) {

				$this->Session->setFlash(
					__('Ingrese una contrasena.', true),
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
							__('La contrasena fue actualizada.', true),
							'flash_success'
						);
						
					} else {
						$this->Session->setFlash(
							__('Ocurrio un error al actualizar la contrasena.', true),
							'flash_error'
						);
						
					}
				} else {
					$this->Session->setFlash(
						__('La contrasena nueva no coincide.', true),
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
		$this->layout = 'talleres';
		$this->__change_password();
	}




	function admin_index() {
		$this->Filter->process();
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
				$this->Session->setFlash(__('Usuario guardado', true), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Error guardando usuario', true), 'flash_error');
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

	private function __check_company($code_area, $number, $chars = 2) {

		$Company = ClassRegistry::init('Company');
		$block = substr($number, 0, $chars);
		$data = $Company->find('first',
			array(
				'conditions' => array(
					'Company.code_area'	=> $code_area,
					'Company.block'		=> $block
				)
			)
		);
		if (!empty($data)) {
			return $data;
		} else {
			if ($chars <= 6) {
				return $this->__check_company($code_area, $number, $chars + 1);
			} else {
				return null;
			}
		}
	}

	function check_company($code_area, $number) {
		d($this->__check_company($code_area, $number));
	}


}