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

	public function __construct(){
        parent::__construct();
    }		

	public function index()
	{
		$this->load->view('dinamis/login_utama');
	}

	public function regis_owner()
	{
		$this->load->view('dinamis/owner/register_akun_owner');
		
	}

	public function regis_kontraktor()
	{
		$this->load->view('dinamis/contractor/register_akun_kontraktor');
	}
	
	public function regis_pengawas()
	{
		$this->load->view('dinamis/contractor/register_akun_pengawas');
	}

	public function owner_board()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_owner');
		$this->load->view('dinamis/dashboard');
		$this->load->view('static/footer');
	}

	public function owner_profil()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_owner');
		$this->load->view('dinamis/owner/profil');
		$this->load->view('static/footer');
	}
	
	public function kontraktor_board()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_kontraktor');
		$this->load->view('dinamis/dashboard');
		$this->load->view('static/footer');
	}

	public function kontraktor_profil()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_kontraktor');
		$this->load->view('dinamis/kontraktor/profil');
		$this->load->view('static/footer');
	}

	public function kontraktor_data_proyek()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_kontraktor');
		$this->load->view('dinamis/kontraktor/data_proyek');
		$this->load->view('static/footer');
	}

	public function pengawas_board()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_pengawas');
		$this->load->view('dinamis/dashboard');
		$this->load->view('static/footer');
	}

	public function pengawas_profil()
	{
		$this->load->view('static/header');
		$this->load->view('static/sidebar_pengawas');
		$this->load->view('dinamis/pengawas/profil');
		$this->load->view('static/footer');
	}

}
