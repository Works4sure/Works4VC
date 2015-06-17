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
	 */
	protected $pdo;
	
	/**
	 * Data for view file
	 */
	private $data;
	
	// ------------------------------------------------------------------------
	
	/**
	 * Class constructor
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function __construct()
	{
		if (strlen(DB_HOST) > 0)
		{
			$this->connectDB();
		}
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
	 * Load a view file
	 * @access	protected
	 * @param	string	$viewfile
	 * @param	string	$data
	 * @return	void
	 */
	protected static function loadView( $viewfile, &$data = NULL)
	{
		$viewfile = trim(htmlspecialchars($viewfile));
		if (file_exists('app/views/'.$viewfile.'.php'))
		{
			include_once('app/views/'.$viewfile.'.php');
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Load a library file
	 * @access	protected
	 * @param	string	$libraryfile
	 * @param	string	$data
	 * @return	void
	 */
	protected static function loadLibrary( $libraryfile )
	{
		$libraryfile = trim(htmlspecialchars($libraryfile));
		if (file_exists('app/libs/'.$libraryfile.'.php'))
		{
			include_once('app/libs/'.$libraryfile.'.php');
		}
	}
}