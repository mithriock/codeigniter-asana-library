<h2>codeigniter Asana Library</h2>
=========================

<h3>Usage</h3>
<p>Example of the Basic Config:</p>
<code>
$config = array('api_key' => 'enteryourapikey', 'format' => 'array');
</code>
<br />
<code>
$this->load->library('asana', $config);
</code>

<p>Example for get all projects:</p>
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

<p>Example for create a new task:</p>
<code>
	$params = array(
    <br />
		'workspace' => 'xxxxxxxxxxxx',
        <br />
		'name' => 'New Task by Codeigniter',
        <br />
		'notes' => 'Hi, this is my first task created by codeigniter',
        <br />
		'assignee' => 'mailtoassign@domain.com',
        <br />
		'assignee_status' => 'upcoming',
        <br />
		"followers" => array()
        <br />
		);
	<br />
	$user = $this->asana->post('task', 'XXXXXXXXXXXX');
</code>

<p>Example for update task:</p>
<code>
	$params = array(
    <br />
		'workspace' => 'xxxxxxxxxxxx',
        <br />
		'name' => 'Update Task by Codeigniter',
        <br />
		'notes' => 'Hi, this is my first task updated by codeigniter',
        <br />
		'assignee' => 'mailtoassign@domain.com',
        <br />
		'assignee_status' => 'today',
        <br />
		"followers" => array()
        <br />
		);
	<br />
	$user = $this->asana->put('task', 'XXXXXXXXXXXX');
</code>