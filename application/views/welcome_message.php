<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter Asana Library!</h1>

	<div id="body">
		<p>Config Library: </p>
		<code>
			$config = array('api_key' => 'yourapikey', 'format' => 'array');
			<br />
			$this->load->library('asana', $config);
		</code>
		
		<p>Example for get all projects: </p>
		<code>
			$projects = $this->asana->get('projects');
		</code>
		<p>Example for get especific project</p>
		<code>
			$project = $this->asana->get('project', 'XXXXXXXXXXXX');
		</code>
		<p>Example for get especific user</p>
		<code>
			$user = $this->asana->get('user', 'XXXXXXXXXXXX');
		</code>
		<p>Example for create new task</p>
		<code>
			$params = array(
				'workspace' => 'xxxxxxxxxxxx',
				'name' => 'New Task by Codeigniter',
				'notes' => 'Hi, this is my first task created by codeigniter',
				'assignee' => 'mailtoassign@domain.com',
				'assignee_status' => 'upcoming',
				"followers" => array()
				);
			<br />
			$user = $this->asana->post('task', 'XXXXXXXXXXXX');
		</code>
		<p>Example for update task</p>
		<code>
			$params = array(
				'workspace' => 'xxxxxxxxxxxx',
				'name' => 'Update Task by Codeigniter',
				'notes' => 'Hi, this is my first task updated by codeigniter',
				'assignee' => 'mailtoassign@domain.com',
				'assignee_status' => 'today',
				"followers" => array()
				);
			<br />
			$user = $this->asana->put('task', 'XXXXXXXXXXXX');
		</code>
		<p>
		<label for="project">Example list all projects:</label>
		<select id="projects" name="projects">
			<option>Select</option>
			<?php
			foreach ($projects['data'] as $key => $value) {
			?>
				<option value="<?=$value['id']?>"><?=$value['name']?></option>
			<?php
			}
			?>
		</select>
		</p>
		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>