<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class contractor extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	// public function index()
	// {
	// 	$this->load->view('static/header');
	// 	$this->load->view('dinamis/dashboard');
	// 	$this->load->view('static/footer');
	// }

	public function index()
	{
		$this->load->view('login_utama');
	}

	public function dashboard_owner()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_owner');
		$this->load->view('dinamis/owner/dashboard');
		$this->load->view('static/footer');
	}

	public function dashboard_profil_owner()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_owner');
		$this->load->view('dinamis/owner/profil');
		$this->load->view('static/footer');
	}

	public function dashboard_kontraktor()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_kontraktor');
		$this->load->view('dinamis/kontraktor/dashboard');
		$this->load->view('static/footer');
	}

	public function dashboard_profil_kontraktor()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_kontraktor');
		$this->load->view('dinamis/kontraktor/profil');
		$this->load->view('static/footer');
	}

	public function dashboard_data_proyek_kontraktor()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_kontraktor');
		$this->load->view('dinamis/kontraktor/data_proyek');
		$this->load->view('static/footer');
	}

	public function dashboard_pengawas()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_pengawas');
		$this->load->view('dinamis/pengawas/dashboard');
		$this->load->view('static/footer');
	}

	public function dashboard_profil_pengawas()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_pengawas');
		$this->load->view('dinamis/pengawas/profil');
		$this->load->view('static/footer');
	}

}
