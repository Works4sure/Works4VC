<?php mb_internal_encoding("UTF-8");

/**
 * Core controller class
 * ---------------------
 * @author Christiaan Hemerik <chris@works4sure.nl>
 * @package	<Works4VC>
 * @version 0.1
 */
class Controller
{
	/**
	 * PDO object
	 * @access	protected
	 * @param	object
	 */
	protected $pdo;
	
	/**
	 * Data for view file
	 * @access	protected
	 * @param	mixed
	 */
	protected $data;
	
	/**
	 * URI segments
	 * @access	protected
	 * @param	array
	 */
	protected $segments;
	
	/**
	 * Last segment value
	 * @access	protected
	 * @param	string
	 */
	protected $last_segment;
	
	/**
	 * User defined routes
	 * @access	private
	 * @param	array
	 */
	private $routes;
	
	// ------------------------------------------------------------------------
	
	/**
	 * Class constructor
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function __construct( $routes = NULL )
	{
		// Connect to database (is applicable):
		if (strlen(DB_HOST) > 0)
		{
			$this->connectDB();
		}
		
		// Set routes property:
		$this->routes = $routes;
		
		// Get URI segments for use in controllers:
		Controller::getURISegments();
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Connect with the database
	 * @access	private
	 * @param	void
	 * @return	void
	 */
	private function connectDB()
	{
		$this->pdo = new PDO(
			'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS
		);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get URI segments for use in controllers
	 * @access	private
	 * @param	void
	 * @return	void
	 */
	private function getURISegments()
	{
		if (substr($_SERVER['REQUEST_URI'], -1) == '/')
		{
			$_SERVER['REQUEST_URI'] =
				substr($_SERVER['REQUEST_URI'], 0, -1);
		}
		$this->segments = explode('/', $_SERVER['REQUEST_URI']);
		foreach ($this->segments as $key => $value)
		{
			$this->segments[trim($key)] = trim(htmlspecialchars($value));
			if (stripos($this->segments[trim($key)], '?'))
			{
				$this->segments[trim($key)] = substr(
					$this->segments[trim($key)], 0, stripos($this->segments[trim($key)], '?')
				);
			}
		}
		if (isset($this->segments[CONTROLLER_SEGMENT])
			&& $this->segments[CONTROLLER_SEGMENT] == 'index.php')
		{
			unset($this->segments[CONTROLLER_SEGMENT]);
			$this->segments = array_values($this->segments);
		}
		
		// Check user defined routes
		if (isset($this->segments[CONTROLLER_SEGMENT]))
		{
			if (count($this->routes) > 0)
			{
				$uri = substr($_SERVER['REQUEST_URI'], 1);
				if (! empty($uri) && array_key_exists($uri, $this->routes))
				{
					if (! defined('CANONICAL'))
						define('CANONICAL', BASEPATH.$this->routes[ $uri ]);
					$this->segments = explode('/', $this->routes[ $uri ]);
					$this->segments = array_combine(
						range(1, count($this->segments)), array_values($this->segments)
					);
				}
			}
		}
		
		// Retrieve last URI segment:
		end ($this->segments);
		$this->last_segment = $this->segments[key($this->segments)];
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Load a view file
	 * @access	protected
	 * @param	string	$viewfile
	 * @param	string	$data
	 * @return	void
	 */
	protected function loadView( $viewfile, &$data = NULL)
	{
		$viewfile = trim(htmlspecialchars($viewfile));
		try
		{
			if (file_exists('app/views/'.$viewfile.'.php'))
			{
				include_once('app/views/'.$viewfile.'.php');
			} else throw new Exception('<b>Fatal error</b>: The corresponding view file could not be found.');
		}
		catch (Exception $e)
		{
			die ($e->getMessage());
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Load a library file
	 * @access	protected
	 * @param	string	$libraryfile
	 * @return	void
	 */
	protected function loadLibrary( $libraryfile )
	{
		$libraryfile = trim(htmlspecialchars($libraryfile));
		try
		{
			if (file_exists('app/libs/'.$libraryfile.'.php'))
			{
				include_once('app/libs/'.$libraryfile.'.php');
			} else throw new Exception('<b>Fatal error</b>: The corresponding library file could not be found.');
		}
		catch (Exception $e)
		{
			die ($e->getMessage());
		}
	}
}