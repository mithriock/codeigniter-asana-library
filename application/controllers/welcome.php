<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$params = array('api_key' => 'enteryourapikey', 'format' => 'array');
		$this->load->library('asana', $params);

		$data = array();

		// Get all projects
		$data['projects'] = $this->asana->get('projects');

		// Get all users
		$data['users'] = $this->asana->get('users');

		// Get specific user
		$data['user'] = $this->asana->get('user', 'xxxxxxxxxxxx');

		// Get specific project
		$data['project'] = $this->asana->get('project', 'xxxxxxxxxxxx');

		// Create new task
		$params = array(
			'workspace' => 'xxxxxxxxxxxx',
			'name' => 'New Task by Codeigniter',
			'notes' => 'Hi, this is my first task created by codeigniter',
			'assignee' => 'mailtoassign@domain.com',
			'assignee_status' => 'upcoming',
			"followers" => array()
			);

		// return all data of new task
		$data['new'] = $this->asana->post('task', $params);
		// var_export($data['new']);

		$this->load->view('welcome_message', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */