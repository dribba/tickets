<?php
class WizardsController extends AppController {

	//var $uses = array();
	var $steps = array();
	var $wizardName = '';
	var $wizardData = array();
	var $wizardReports = array();
	
	private function __getSteps() {
	
		if (empty($this->steps)) {
			$this->steps = array(
				1 => array(
					'id' 			=> 1,
					'type'			=> 'form',
					'card'			=> 'users',
					'form_name'		=> 'insert_document',
					'form_label'	=> 'Insert document',
					'next'			=> 2
				),
				2 => array(
					'id' 			=> 2,
					'type'			=> 'form',
					'card'			=> 'users',
					'form_name'		=> 'personal_data',
					'form_label'	=> 'Personal data',
					'next'			=> 3
				),
				3 => array(
					'id' 			=> 3,
					'type'			=> 'form',
					'card'			=> 'users',
					'form_name'		=> 'insert_street',
					'form_label'	=> 'Street',
					'next'			=> ''
				)
			);
		}
	}

	private function __getStep($step) {
		$this->__getSteps();
		if (isset($this->steps[$step])) {
			return $this->steps[$step];
		} else {
			return false;
		}
	}

	private function __getNextStep($step) {
		
		
		$currentStep = $this->__getStep($step);
		$step = $this->__getStep($currentStep['next']);
		
		return $step;

	}

	private function __getPrevStep($step) {
		$step = $this->__getStep($step);
		if (empty($step)) {
			$step = $currentStep;
		}
		return $step;
	}



	function wizard($wizardName = null) {

		if (!empty($wizardName)) {
			$this->cancel();
			$this->wizardName = $wizardName;
			$this->__getSteps();

			$first = reset($this->steps);
			$currentStep = $first['id'];
			$prev_step = $currentStep;
		} else {
			$wizardInfo = $this->Session->read('wizard');
			$this->wizardName = $wizardInfo['wizardName'];
			$this->wizardData = $wizardInfo['wizardData'];
			$currentStep = $this->data['Wizard']['current_step'];
			$prev_step = $this->data['Wizard']['prev_step'];
		}


		if (!empty($this->data)) {


			if ($this->data['Wizard']['current_step'] == 1) {

				$User = ClassRegistry::init('User');
				$dataUser = $User->get_personal_data($this->data['User']['document']);

				$user = $User->findByUsername($this->data['User']['document']);
				if (!empty($user)) {
					return $this->Session->setFlash(
						__('The user is already registered.', true),
						'flash_error'
					);
				} else {

					if (empty($dataUser[0]['error'])) {
						$this->data['User.full_name'] = $dataUser['apellido'] . ' ' . $dataUser['nombre'];
						$this->data['User.sex'] = $dataUser['sexo'];
					} else {
						return $this->Session->setFlash(
							__('Document was not found.', true),
							'flash_error'
						);
					}
				}
			} else if ($this->data['Wizard']['current_step'] == 2) {
				$User = ClassRegistry::init('User');
				$phone = $User->findByMobilePhone(
					$this->data['User']['phone_area'] . $this->data['User']['phone_number']
				);
				if (!empty($phone)) {
					return $this->Session->setFlash(
						__('The mobile phone is already registered.', true),
						'flash_error'
					);
				}
			} else if ($this->data['Wizard']['current_step'] == 3) {

				$User = ClassRegistry::init('User');
				$dataUser = $User->get_personal_data($this->wizardData['User.document']);
				if ($dataUser['street'] != $this->data['User']['street']) {
					// calle seleccionada incorrecta....
				}
			}
			
			$this->wizardData = array_merge(
				$this->wizardData,
				$this->Wizard->flatten($this->data)
			);

			if ($this->data['Wizard']['direction'] == 'next') {
				$step = $this->__getNextStep($currentStep);
			} else if ($this->data['Wizard']['direction'] == 'prev') {
				$step = $this->__getPrevStep($prev_step);
			}
			
		} else {
			$step = $this->__getStep($currentStep);
		}

		$this->Session->write('wizard',
			array(
				'wizardName'	=> $this->wizardName,
				'wizardData'	=> $this->wizardData,
				'wizardReports'	=> $this->wizardReports
			)
		);
		// validates data
		$validationStatus = $this->save(true);
		if ($validationStatus !== true) {
			$this->set('validationErrors', $validationStatus);
			$currentStep = $this->wizardData['Wizard.current_step'];
			$step = $this->__getStep($currentStep);
		}
		
		$this->set('wizard', true);
		$this->set('wizard_name', $wizardName);
		$this->set('current_step', $step['id']);
		
		$this->set('prev_step', $currentStep);


		$firstStep = reset($this->steps);
		if ($firstStep['id'] != $step['id']) {
			$this->set('prev', true);
		}
		$this->set('card', Inflector::singularize($step['card']));
		if ($step) {

			$this->data = $this->Wizard->unflatten($this->wizardData);
				
			$this->render(
				'../' . $step['card'] . '/' . $step['form_name']
			);
		} else {
			$data = $this->Wizard->unflatten($this->wizardData);
			unset($data['Wizard']);
			$this->set('data', $data);
			$this->render('resume');
		}
	}

	function cancel() {
		$this->wizardData = array();
		$this->Session->delete('wizard');
	}

	function save($validateOnly = false) {

		$wizard = $this->Session->read('wizard');
		$subject_id = null;
		$validationErrors = $savingErrors = null;
		$wizardData = $this->Wizard->unflatten($wizard['wizardData']);
		unset($wizardData['Wizard']);

		if (!empty($wizardData)) {
			foreach ($wizardData as $modelName => $data) {

				$save = null;
				$save = array($modelName => $data);

				$Model = ClassRegistry::Init($modelName);
				
				if (!empty($save)) {
					$Model->set($save);
					if (!$Model->validates()) {
						//$validationErrors[$Model->name] = $Model->invalidFields();
						foreach ($Model->invalidFields() as $invalidField => $message) {
							$validationErrors[$Model->name . Inflector::camelize($invalidField)] = $message;
						}
					}

					if (!$validateOnly) {
						$save['User']['password'] = $password = uniqid();
						$save['User']['mobile_phone'] = $save['User']['phone_area'] . $save['User']['phone_number'];
						$save['User']['username'] = $save['User']['document'];

						$message = sprintf(
							"Nombre de usuario: %s Contraseña: %s",
							$save['User']['document'],
							$save['User']['mobile_phone']
						);
						//Send sms to mobile phone
						$Model->send_sms($save['User']['mobile_phone'], $message);

						$Model->save($save);
						
						$savingErrors[] = __('Error saving', true) . ' ' . $modelName;
					}
				}
			}


			if (!empty($validationErrors)) {
				if ($validateOnly) {
					return $validationErrors;
				} else {
					if (!empty($savingErrors)) {
						return $this->setErrorAjaxFlash(
							implode('<br />', $savingErrors)
						);
					} else {
						return $this->setErrorAjaxFlash(
							__("Error saving data", true)
						);
					}
				}
			} elseif (!$validateOnly) {

				return $this->Session->setFlash(
					__('Data has been saved.', true),
					'flash_success'
				);
				
			}
		}
		if ($validateOnly) {
			return true;
		}
	}
}