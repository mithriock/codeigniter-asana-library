<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Api Version
|--------------------------------------------------------------------------
|
| version of the Asana API 
|
*/
$config['asana_api_version'] = '1.0';

/*
|--------------------------------------------------------------------------
| URL Version
|--------------------------------------------------------------------------
|
| URL for access to Asana API 
|
*/
$config['asana_api_url'] = 'https://app.asana.com/api/';

/*
|--------------------------------------------------------------------------
| Time Out
|--------------------------------------------------------------------------
|
| Timeout of the response
|
*/
$config['asana_time_out'] = '30';

/*
|--------------------------------------------------------------------------
| Http status code
|--------------------------------------------------------------------------
|
| List of success http status code
|
*/
$config['asana_success_code'] = array(
	'200' => 'Success', 
	'201' => 'Success (for object creation)'
	);

/*
|--------------------------------------------------------------------------
| Http status code
|--------------------------------------------------------------------------
|
| List of error http status code
|
*/
$config['asana_error_code'] = array(
	'400' => 'Invalid request', 
	'401' => 'No authorization', 
	'403' => 'Access denied', 
	'404' => 'Not found', 
	'500' => 'Server error'
	);

/*
|--------------------------------------------------------------------------
| URL Task
|--------------------------------------------------------------------------
|
| Specific URL the access to tasks
|
*/
$config['asana_task_url'] = $config['asana_api_url'].$config['asana_api_version'].'/tasks';

/*
|--------------------------------------------------------------------------
| URL User
|--------------------------------------------------------------------------
|
| Specific URL the access to Users
|
*/
$config['asana_user_url'] = $config['asana_api_url'].$config['asana_api_version'].'/users';

/*
|--------------------------------------------------------------------------
| URL Project
|--------------------------------------------------------------------------
|
| Specific URL the access to Projects
|
*/
$config['asana_project_url'] = $config['asana_api_url'].$config['asana_api_version'].'/projects';

/*
|--------------------------------------------------------------------------
| URL Workspace
|--------------------------------------------------------------------------
|
| Specific URL the access to Workspaces
|
*/
$config['asana_workspace_url'] = $config['asana_api_url'].$config['asana_api_version'].'/workspaces';

/*
|--------------------------------------------------------------------------
| URL Story
|--------------------------------------------------------------------------
|
| Specific URL the access to stories
|
*/
$config['asana_story_url'] = $config['asana_api_url'].$config['asana_api_version'].'/stories';


/* End of file asana.php */
/* Location: ./application/config/asana.php */