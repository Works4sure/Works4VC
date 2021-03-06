<?php mb_internal_encoding("UTF-8");

/**
 * Routing file
 * ------------
 * Do not change if you don't
 * know what you're doing. Contact the author
 * when in doubt.
 *
 * @author Christiaan Hemerik <chris@works4sure.nl>
 * @package	<Works4VC>
 * @version 0.1
 */	

// Load user routes
include_once('app/config/routes.php');

// Load user settings
include_once('app/config/settings.php');

// Load core settings
include_once('app/libs/core/config/settings.php');

// Load core Controller
include_once('app/libs/core/controllers/controller.php');

// Secure POST data:
if (isset($_POST) && is_array($_POST))
{
	foreach ($_POST as $post_key => $post_value)
	{
		$_POST[trim(stripslashes(htmlspecialchars($post_key)))]
			= trim(stripslashes(htmlspecialchars($post_value)));
	}
}

// Secure GET data:
if (isset($_GET) && is_array($_GET))
{
	foreach ($_GET as $get_key => $get_value)
	{
		$_GET[trim(stripslashes(htmlspecialchars($get_key)))]
			= trim(stripslashes(htmlspecialchars($get_value)));
	}
}

// Get URI segments
if (substr($_SERVER['REQUEST_URI'], -1) == '/')
{
	$_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], 0, -1);
}
$segments = explode('/', $_SERVER['REQUEST_URI']);

// Prevent XXS
foreach ($segments as $key => $value)
{
	$segments[trim($key)] = trim(htmlspecialchars($value));
	if (isset($segments[1])
		&& substr($segments[1], 0, 1) == '?') $segments[1] = DEFAULT_SEGMENT;
	else
	{
		if (stripos($segments[trim($key)], '?'))
		{
			$segments[trim($key)] = substr(
				$segments[trim($key)], 0, stripos($segments[trim($key)], '?')
			);
		}
	}
}

// Remove index.php from URI segments
if (isset($segments[CONTROLLER_SEGMENT])
	&& $segments[CONTROLLER_SEGMENT] == 'index.php')
{
	unset($segments[CONTROLLER_SEGMENT]);
	$segments = array_values($segments);
}

// If no segments, set default segment
if (! isset($segments[CONTROLLER_SEGMENT])
	|| empty($segments[CONTROLLER_SEGMENT]))
{
	$segments[CONTROLLER_SEGMENT] = DEFAULT_SEGMENT;
}

// Check user defined routes and set canonical constant if applicable
if (count($routes) > 0)
{
	$uri = substr($_SERVER['REQUEST_URI'], 1);
	if (! empty($uri) && array_key_exists($uri, $routes))
	{
		if (! defined('CANONICAL'))
			define('CANONICAL', BASEPATH.$routes[ $uri ]);
		$segments = explode('/', $routes[ $uri ]);
		$segments = array_combine(range(1, count($segments)), array_values($segments));
		unset($uri);
	}
}

// Route to requested controller
try
{
	if (file_exists('app/controllers/'.$segments[CONTROLLER_SEGMENT].'.php'))
	{
		include_once('app/controllers/'.$segments[CONTROLLER_SEGMENT].'.php');
		$controller_class = ucfirst($segments[CONTROLLER_SEGMENT]).'Controller';
		
		// Instantiate requested controller
		$controller = new $controller_class;
		$controller->index();
	}
	else
	{
		throw new Exception('<b>Fatal error</b>: The corresponding controller file could not be found. Please check your .htaccess and/or URI segment settings.');
	}
}
catch (Exception $e)
{
	die ($e->getMessage());
}