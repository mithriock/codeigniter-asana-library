<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * CodeIgniter Asana Class
 *
 * This class enable connect to Asana API.
 *
 * @category	Libraries
 * @author		Rodrigo Muñoz
 * @link		https://github.com/mithriock/codeigniter-asana-library/
 * @link		http://developer.asana.com/documentation/
 */

class Asana {

    public $api_key = '';
    public $format = 'json';

    private $data = array(); // for save data
    private $response = false;
    private $http_info = '';
    private $type_method = 3; // 1=>POST; 2=>PUT; 3=>GET (default)

    protected $_ci;

	/**
	 * Constructor - Sets Asana preferences
	 *
	 * The constructor can be passed an array of config values
	 */
	public function __construct($params = array())
	{
		$this->initialize($params);
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize preferences
	 *
	 * @access	public
	 * @param	array
	 * @return	void
	 */
	public function initialize($params = array())
	{
		// Set the super object to a local variable for use later
		$this->_ci =& get_instance();

		// Config settings
		foreach ($params as $key => $val)
		{
			if (isset($this->$key))
			{
				$method = 'set_'.$key;
				if (method_exists($this, $method))
				{
					$this->$method($val);
				}
				else
				{
					$this->$key = $val;
				}
			}
		}
		// Load asana config
		$this->_ci->config->load('asana');

		log_message('debug', "Asana Class Initialized");
	}


	/**
	 * Method for get data
	 * @access	public
	 * @param   string $method 	
	 * @param   string/array $data
	 * @return	string/array
	 */
	public function get($method = '', $data = NULL)
	{
		// verify api key
		if(empty($this->api_key))
		{
			log_message('error', "Asana Api key not declarated");
			return FALSE;
		}

		// Construct method to call
		$method = 'get_'.$method;
		// Verify method passed
		if (method_exists($this, $method))
		{
			// params
			if(!empty($data))
			{
				$this->$method($data);
			}
			else
			{
				$this->$method();
			}
			return $this->get_response();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Method for create into Asana
	 * @access	public
	 * @param   string $method 	
	 * @param   string/array $data
	 * @return	string/array
	 */
	public function post($method = '', $data = NULL)
	{
		// verify api key
		if(empty($this->api_key))
		{
			log_message('error', "Asana Api key not declarated");
			return FALSE;
		}
		// Construct method to call
		$method = 'save_'.$method;
		if (method_exists($this, $method) && !empty($data) && is_array($data))
		{
			// set data
			$this->set_data($data);
			$this->type_method = 1; // POST
			$this->$method();

			return $this->get_response();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Method for update data into Asana 
	 * @access	public
	 * @param   string $method 	
	 * @param   string/array $data
	 * @return	string/array
	 */
	public function put($method = '', $data = NULL)
	{
		// verify api key
		if(empty($this->api_key))
		{
			log_message('error', "Asana Api key not declarated");
			return FALSE;
		}
		// Construct method to call
		$method = 'save_'.$method;
		if (method_exists($this, $method) && !empty($data) && is_array($data))
		{
			// set data
			$this->set_data($data);
			$this->type_method = 2; // PUT
			$this->$method();

			return $this->get_response();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Get data task
	 * 
	 * @param 	string $task
	 * @return 	void
	 * @link 	http://developer.asana.com/documentation/#tasks
	 */
	public function get_task($task = '')
	{
		if(!empty($task))
		{
			$this->_execute(config_item('asana_task_url').'/'.$task);
		}
	}

	/**
	 * Create new task or update task
	 *
	 * @return 	void
	 * @link 	http://developer.asana.com/documentation/#tasks
	 */
	public function save_task()
	{
		if(!empty($this->data))
		{
			$this->_execute(config_item('asana_task_url'));
		}
	}

	/**
	 * Method for get workspaces
	 * @access	public
	 * @return	void
	 * @link 	http://developer.asana.com/documentation/#workspaces
	 */
	public function get_workspaces()
	{
		$this->_execute(config_item('asana_workspace_url'));
	}

	/**
	 * Method for get projects
	 * @access	public
	 * @param 	Strign $project
	 * @return	void
	 * @link 	http://developer.asana.com/documentation/#projects
	 */
	public function get_project($project = '')
	{
		if(!empty($project))
		{
			$this->_execute(config_item('asana_project_url').'/'.$project);
		}
	}

	/**
	 * Method for get specific project data
	 * @access	public
	 * @return	void
	 * @link 	http://developer.asana.com/documentation/#projects
	 */
	public function get_projects()
	{
		$this->_execute(config_item('asana_project_url'));
	}

	/**
	 * Method for get users
	 * @access	public
	 * @return	void
	 */
	public function get_users()
	{
		$this->_execute(config_item('asana_user_url'));
	}

	/**
	 * Method for get specific user data 
	 * @access	public
	 * @return	void
	 */
	public function get_user($user = 'me')
	{
		if(!empty($user) && is_string($user))
		{
			$this->_execute(config_item('asana_user_url').'/'.$user);
		}
	}

	/**
	 * Method for set api key
	 * @access	public
	 * @param	string	$key
	 * @return	void
	 * @link 	http://developer.asana.com/documentation/#users
	 */
	public function set_api_key($key = '')
	{
		if(!empty($key))
		{
			$this->api_key = $key.':';
		}
	}

	/**
	 * Method for get api key
	 * @access	public
	 * @return	string
	 * @link 	http://developer.asana.com/documentation/#Authentication
	 */
	public function get_api_key()
	{
		return $this->api_key;
	}

	/**
	 * Method for set data
	 * @access	public
	 * @param	array $data
	 * @return	void
	 * @link 	http://developer.asana.com/documentation/#Authentication
	 */
	public function set_data($data = array())
	{
		if(!empty($data))
		{
			$this->data = array('data' => $data);
		}
	}

	/**
	 * Method for get data
	 * @access	public
	 * @return	array
	 */
	public function get_data()
	{
		return json_encode($this->data);
	}

	/**
	 * Method for return data
	 * @access	public
	 * @return	array
	 */
	public function get_response()
	{
		// verify response
		if(!empty($this->response) && in_array($this->http_info, array_keys(config_item('asana_success_code'))))
		{
			// type of return data
			if ($this->format == 'json')
			{
				return $this->response;
			}
			else
			{
				return json_decode($this->response, TRUE);
			}
		}
		else
		{
			// get error codes
			$codes = config_item('asana_error_code');
			return $codes[$this->http_info];
		}
	}

	/**
	 * Method execute for connect with asana api
	 * @access	private
	 * @param	string $api_url
	 * @return	void
	 */
	private function _execute($api_url = '')
	{
		if(!empty($api_url))
		{
			$CURL = curl_init();
			curl_setopt($CURL, CURLOPT_URL, $api_url);

			switch ($this->type_method)
			{
				case 1:
					curl_setopt($CURL, CURLOPT_POST, TRUE);
					curl_setopt($CURL, CURLOPT_POSTFIELDS, $this->get_data());
					break;
				case 2:
					curl_setopt($CURL, CURLOPT_CUSTOMREQUEST, "PUT");
					curl_setopt($CURL, CURLOPT_POSTFIELDS, $this->get_data());
					break;
				default:
					break;
			}

			if(config_item('asana_time_out') != '')
			{
				curl_setopt($CURL, CURLOPT_CONNECTTIMEOUT, config_item('asana_time_out'));
				curl_setopt($CURL, CURLOPT_TIMEOUT, config_item('asana_time_out'));
			}

			if($this->get_api_key() != '')
			{
				curl_setopt($CURL, CURLOPT_USERPWD, $this->get_api_key());
			}

			curl_setopt($CURL, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($CURL, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($CURL, CURLOPT_FAILONERROR, TRUE);
			curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($CURL, CURLOPT_SSL_VERIFYHOST, 0);

			curl_setopt($CURL, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			$this->response = curl_exec($CURL);
			$this->http_info = curl_getinfo($CURL, CURLINFO_HTTP_CODE);
			curl_close($CURL);
		}
	}
}

/* End of file asana.php */
/* Location: ./application/libraries/asana.php */