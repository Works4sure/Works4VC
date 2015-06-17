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
	 * Index for this controller
	 * @access	public
	 * @param	void
	 * @return	void
	 */
	public function index()
	{
		$this->loadView('home_view', $this->data);
	}
}