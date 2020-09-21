<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Breadcrumbs {

	/**
	 * breadcrumbs untuk codeigniter 3
	 * cara menggunakan
	 * ===============================================
	 * controller
	 * -----------------------------------------------
	 * $this->breadcrumbs->insert('User', '/user');
	 * $this->breadcrumbs->insert('Add', '/user/add');
	 * $this->breadcrumbs->main('Home', '/');
	 * ===============================================
	 * view
	 * -----------------------------------------------
	 * $this->breadcrumbs->view();
	 */
	private $breadcrumbs = [];

	public function __construct()
	{	
		$this->ci              =& get_instance();
		$this->tag_open        = '<ol class="breadcrumb float-sm-right">';
		$this->tag_close       = '</ol>';
		$this->crumb_open      = '<li classs="breadcrumb-item">';
		$this->crumb_last_open = '<li class="breadcrumb-item active">';
		$this->crumb_close     = '</li>';
		$this->crumb_divider   = '<span class="divider">&nbsp&nbsp/&nbsp&nbsp</span>';
		
		log_message('debug', "Breadcrumbs Class Initialized");
	}

	function insert($page, $href)
	{
		if (!$page || !$href) return;
		$href = site_url($href);
		$this->breadcrumbs[$href] = ['page' => $page, 'href' => $href];
	}

	function main($page, $href)
	{
		if (!$page || !$href) return;
		$href = site_url($href);
		array_unshift($this->breadcrumbs, ['page' => $page, 'href' => $href]);
	}
	
	function view()
	{
		if ($this->breadcrumbs) {
			$result = $this->tag_open;
			$num = count($this->breadcrumbs);
            $i = 0;
            foreach ($this->breadcrumbs as $crumb) {
                if (++$i === $num) {
                    $result .= $this->crumb_last_open . '' . $crumb['page'] . '' . $this->crumb_close;
                } else {
                    $result .= $this->crumb_open.'<a href="' . $crumb['href'] . '">' . $crumb['page'] . '</a>'.$this->crumb_divider.$this->crumb_close;
                }
            }
			return $result . $this->tag_close . PHP_EOL;
		}
		return '';
	}

}

/* End of file Breadcrumbs.php */
/* Location: ./application/libraries/Breadcrumbs.php */