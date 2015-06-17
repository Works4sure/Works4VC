<?php mb_internal_encoding("UTF-8");

/**
 * Home controller class. (EXAMPLE)
 *
 * @extends Controller
 * @package	<Works4VC>
 * @version 0.1
 */	
class HomeController extends Controller
{
	// ------------------------------------------------------------------------
	
	/**
	 * Class constructor
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->loadView('home_view', $this->data);
	}
}