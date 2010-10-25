<?php

class AppController extends Controller {

	var $xcomponents = array('Auth');
	var $helpers = array('MyHtml', 'MyPaginator', 'MyForm', 'Session');
	//var $components = array('RequestHandler', 'Session', 'Cookie', 'Filter', 'Uploader');


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

	function add($formName = null) {
		
		if (!empty($this->data)) {
			$this->{$this->modelClass}->create();
			if ($this->{$this->modelClass}->save($this->data)) {
				return $this->setSuccessAjaxFlash(__('The record has been saved.', true));
			} else {
				return $this->setErrorAjaxFlash(
					__('The record could not be saved. Please, check errors and try again.', true)
				);
			}
		} else {
			if (!empty($this->params['named']['parent_id'])) {

				$parentId = $this->params['named']['parent_id'];


				//Check if matter is open, REQF47
				$data = $this->{$this->modelClass}->getDataFromParent(
					$this->{$this->modelClass}->getParentName(),
					$parentId
				);
				if ($this->__matterIsClosed($data)) {
					return $this->setErrorAjaxFlash(
						__('This matter is closed.', true)
					);
				}
				if (
					$this->__matterIsAssignedToMyOffice(
						$this->{$this->modelClass}->flatten($data)
					) == false
				) {
					return $this->setErrorAjaxFlash(
						__('The matter is not assigned to your office.', true)
					);
				}

				$findByParentId = 'findBy'. $this->{$this->modelClass}->getParentName() . 'Id';

				if ($this->{$this->modelClass}->getRalation() == '1:1') {
					$exists = $this->{$this->modelClass}->{$findByParentId}($parentId);
					if (!empty($exists)) {
						return $this->setErrorAjaxFlash(
							__('Can not add a new record to a 1:1 relation card that has an existing record. Please update the existing one.', true)
						);
					}
				}


				if ($this->modelClass == 'Matter') {
					$offices = getConf('/App/Offices/Office/.');
					foreach ($offices as $office) {
						${$office['type']} = $this->Matter->getOfficesListByType($office['type']);
						$this->set($office['type'], ${$office['type']});
					}

				}

				$this->set('parent_id', $parentId);
			}
		}
  $this->set('form_name', $formName);
		if (!empty($formName)) {
			$this->render($formName);
		}
	}

	function view($id = null) {

		if (!empty($id)) {
			// Get active branch data
			$activeBranchData = $this->{$this->modelClass}->getActiveBranchData($id);

			$this->checkPermissions($activeBranchData, array('what' => 'card'));





			// Get extra necessary data
			if (!empty($this->{$this->modelClass}->pathToNode)) {
				$contain = array_diff(
					array_keys($this->{$this->modelClass}->belongsTo),
					explode('|', $this->{$this->modelClass}->pathToNode)
				);
			} else {
				$contain = array_keys($this->{$this->modelClass}->belongsTo);
			}

			if (!empty($contain)) {
				$this->{$this->modelClass}->contain($contain);
				$extraData = $this->{$this->modelClass}->findById($id);
				unset($extraData[$this->modelClass]);

				if (!empty($extraData)) {
					$activeBranchData += $this->{$this->modelClass}->flatten($extraData);
				}
			}


			$this->set('data', $activeBranchData);

			$user = User::get('/.');

			if ($this->modelClass == 'Matter') {
				if (!empty($activeBranchData['Matter.subject_id'])) { 
					$subject = $this->Matter->Subject->findById(
						$activeBranchData['Matter.subject_id']
					);
					$user['Subject'] = $subject['Subject'];
				}
				$user['Matter']['id'] = $id;
				$user['Matter']['open'] = $activeBranchData['Matter.subject_id'];
				$this->Session->write('User', $user);
			}

			$render = 'view';

			//When in query mode must render resume view
			if ($user['User']['mode'] == 'query') {
				$render = 'view_resume';
			} else {
				
				//Check if matter is assigned to my office, REQF47
				if (!$this->__matterIsAssignedToMyOffice($activeBranchData)) {
						$render = 'view_resume';
				}
			}
			$this->render($render);
		} else {
			$this->autoRender = false;
		}
	}


	function edit($formName = null, $id = null) {

		/*if (!$this->userAllowed($this->name, $this->params['named']['form_name'])) {
			return $this->setErrorAjaxFlash(
				__("Your user type can't access the form", true)
			);
		}*/
		if (!empty($this->data)) {
			$error = false;
			foreach ($this->data as $modelName => $data) {
				$Model = ClassRegistry::init($modelName);
				if (empty($data['form_name'])) {
					$data['form_name'] = $formName;
				} else {
					$formName = $data['form_name'];
				}
				if (!$Model->save(array($modelName => $data))) {
					//return $this->setSuccessAjaxFlash(__('The record has been saved.', true));
					$error = true;
				}
			}
			if ($error) {
				return $this->setErrorAjaxFlash(
					__('The record could not be saved. Please, check errors and try again.', true)
				);
			} else {
				return $this->setSuccessAjaxFlash(__('The record has been saved.', true));
			}
		} else {
			
			// REQF48
			$cardName = Inflector::underscore($this->name);
			$currentCard = getConf('/App/Cards/Card[name=' . $cardName . ']/.');
			if (empty($currentCard['Forms']['Form'][1])) {
				$currentCard['Forms']['Form'] = array($currentCard['Forms']['Form']);
			}
			foreach ($currentCard['Forms']['Form'] as $form) {
				$currentCardForms[$form['name'] . '_' . strtolower($form['mode'])] = $form;
			}

			if (!empty($this->params['named']['form_name'])) {
				$formName = $this->params['named']['form_name'];
			}
			$this->data = $this->{$this->modelClass}->getActiveBranchData($id,
				array('flatten' => 'unidimentional')
			);
			
			
			//Check if matter is open, REQF47
			if ($this->__matterIsClosed($this->data)) {
				return $this->setErrorAjaxFlash(
					__('This matter is closed.', true)
				);
			}

			if (
				$this->__matterIsAssignedToMyOffice(
					$this->{$this->modelClass}->flatten($this->data)
				) == false
			) {
				return $this->setErrorAjaxFlash(
					__('The matter is not assigned to your office.', true)
				);
			}


			foreach (array_unique(
				Set::extract('/card', $currentCardForms[$formName]['Attributes']['Attribute'])
			) as $card) {

				$modelName = getModelName($card);
				if ($modelName != $this->modelClass && empty($this->data[$modelName]['id'])) {
					return $this->setErrorAjaxFlash(
						sprintf(__('A related record in card %s is missing. Can not use this form until the record is filled.', true), $card)
					);
					break;
				}

			}

			if ($this->modelClass == 'Matter') {
				$offices = getConf('/App/Offices/Office/.');
				foreach ($offices as $office) {
					${$office['type']} = $this->Matter->getOfficesListByType($office['type']);
					$this->set($office['type'], ${$office['type']});
				}

			}
			if (!empty($this->params['named']['parent_id'])) {
				$parent_id = $this->params['named']['parent_id'];
				$this->set('parent_id', $parent_id);
			}
			$this->set('form_name', $formName);
			$this->render($formName);
		}

	}


}