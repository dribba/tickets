<?php
App::import('Vendor', 'Calculation', true,
	array(APP . 'vendors' . DS . 'xmlrpc'),
	'xmlrpc.inc'
);
class User extends AppModel {

	protected function _initialitation() {

		//$this->options = array(0 => __('No', true), 1 => __('Yes', true));

		$this->validate = array(
			'document' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __("Document can't be empty", true),
					'last' => true, // Stop validation after this rule
				),
			),
			'email' => array(
				'notempty' => array(
					'rule' => array('email'),
					'message' => __("Enter a valid email", true),
					'last' => true, // Stop validation after this rule
				),
			),
			'phone_area' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __("Phone area can't be empty", true),
					'last' => true, // Stop validation after this rule
				),
			),
			'phone_number' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __("Phone number can't be empty", true),
					'last' => true, // Stop validation after this rule
				),
			),
			'birthday' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => __("Birthday can't be empty", true),
					'last' => true, // Stop validation after this rule
				),
				'valid' => array(
					'rule' => array('date'),
					'message' => __("Enter a valid date", true),
					'last' => true, // Stop validation after this rule
				)
			),
		);

    }

    function isSamePassword($values) {
        if (md5($values['re-password']) == $this->data['User']['password']) {
            return true;
        } else {
            return false;
        }
    }


/**
* Validates a users.
*
* @return mixed. User data array on a succesfull login, false in other case.
*/
    function validate($data) {

			/** TODO: Remove hardcoded */
            $user = $this->find('first',
				array(
					'conditions'	=> array(
						'User.username'	=> 'agency'
						//'User.username'	=> $data['User']['username'],
						//'User.password'	=> $data['User']['password'],
						//'User.state'	=> 'active'
					),
				)
            );
			//$user['User']['environment'] = getConf('/App/environment');
			//$user['User']['show_closed_matters'] = getConf('/App/show_closed_matters');
			//return $user;

            if (!empty($user)) {
				return $user;
            } else {
				return false;
            }

    }


/**
* Update last login field.
*
* @return mixed. Last login date on success, false in other case.
*/
    function updateLastLogin($id) {

		$date = date('Y-m-d h:i:s');
		if ($this->save(
			array('User' => array(
				'id'			=> $id,
				'last_login'	=> $date
				)
			),
			array('validate' => false)
		)) {
			return $date;
		} else {
			return $date;
		}
    }


/**
* Update password field.
* @param int $id The User Id
* @param string $password The new password to store, not hashed
* @return mixed. Hashed password on success, false in other case.
*/
    function updatePassword($id, $password) {
            $hashedPassword = md5($password);
            if ($this->save(array('User' => array(
				'id' 		=> $id,
				'password' 	=> $hashedPassword)), array('validate' => false))) {
				return $hashedPassword;
            } else {
				return false;
            }
    }


/**************************************************************************************************
*
http://www.pseudocoder.com/archives/2008/10/06/accessing-user-sessions-from-models-or-anywhere-in-cakephp-revealed/
*
**************************************************************************************************/
    function &getInstance($user=null) {
		static $instance = array();

		if ($user) {
			$instance[0] =& $user;
		}

		if (!$instance) {
			trigger_error(__('User not set.', true), E_USER_WARNING);
			return false;
		}

		return $instance[0];
    }


    function store($user) {
		if (empty($user)) {
				return false;
		}

		User::getInstance($user);
    }


    function get($path = '/User/.') {

		$_user = User::getInstance();
/*
		//$path = str_replace('.', '/', $path);
		if (strpos($path, 'User') !== 0) {
				$path = sprintf('User/%s', $path);
		}

		if (strpos($path, '/') !== 0) {
				$path = sprintf('/%s', $path);
		}
*/
		$value = Set::extract($path, $_user);

		if (!$value) {
				return false;
		}

		return $value[0];
    }

	function send_sms($to, $message) {
		$c = curl_init();
		$url = sprintf(
			'http://ws.intertronmobile.com/Gateway/WSMessage.asmx/SendNow?pUser=userRol&pPassword=r07nl1n3.&pToNum=%s&pToCompany=4&pFromNum=11011&pMessage=%s&pmsgId=45',
			$to,
			$message
		);
   
		curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		$out = curl_exec($c);
		curl_close($c);
		
		return $out;
	}

	function get_personal_data($document, $sex) {
		$r = $this->xmlrpc_query(
			array(
				array('documento' => $document, 'sexo' => $sex)
			)
		);
		return $r;
	}

	/**
	* XML-RPC Query
	*
	*/
	function xmlrpc_query($params = false, $debug = 0) {

		// Configuracion para conectar desde fuera
		// Proveedor: ROL
		$server = 'http://web.riesgoonline.com/servicios/';
		
		// Servicio a ejecutar, para obtener simplemente una identificacion
		$service = 'riesgoonlineProcess.obtenerIdentificacion';
		$service = 'riesgoonlineProcess.obtenerValidacion';

		$defaultParams[] = 'consultas'; //user
		$defaultParams[] = 'consultas21215'; //pass
		$defaultParams[] = ''; //uidx

		if ($params) {
			$params = array_merge($defaultParams, $params);
			foreach ($params as $k => $v) {
				$params[$k] = php_xmlrpc_encode($v);
			}
		}

		$f = new xmlrpcmsg($service, $params);
		$c = new xmlrpc_client($server);
		$c->setDebug($debug);
		$r = $c->send($f);

		if (!$r->faultCode()) {

			$data = array();

			foreach ($r->value()->me['array'][0]->me['struct'] as $key => $value) {
				$data[$key] = $value->me['string'];
			}

			return $data;

		} else {

			return array(
				array('error' => array($r->faultCode() => htmlspecialchars($r->faultString())))
			);

		}
	}

	


}