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

	public function __construct(){
        parent::__construct();
    }		

	public function index()
	{
		if(session_status() == PHP_SESSION_ACTIVE){
			session_destroy();
		}
		$this->load->view('page/login_utama');
	}

	public function logout()
	{
		session_destroy();
		$this->index();
	}

	public function regis_owner()
	{
		$this->load->view('page/owner/register_akun_owner');
	}

	public function regis_kontraktor()
	{
		$this->load->view('page/contractor/register_akun_kontraktor');
	}
	
	public function regis_pengawas()
	{	
		if(isset($_SESSION['user'])){
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/pengawas/register_akun_pengawas');
		} else {
			$this->index();
		}
	}

	public function owner_board()
	{
		if(isset($_SESSION['user'])){
			$data['proyek'] = json_decode($this->input->post('proyek'), true);
			$data['pengawas'] = json_decode($this->input->post('pengawas'), true);
			$data['kontraktor'] = json_decode($this->input->post('kontraktor'), true);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');	
			$this->load->view('page/owner/dashboard', $data);
		} else {
			$this->index();
		}
	}

	public function owner_monitoring()
	{	
		if(isset($_SESSION['user'])){
			$data['proyek'] = json_decode($this->input->post('proyek'), true);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/owner/proyek_monitoring', $data);
		} else {
			$this->index();
		}
	}

	public function owner_profil()
	{	
		if(isset($_SESSION['user'])){
			$data['user'] = $_SESSION['user'];
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/owner/profil', $data);
		} else {
			$this->index();
		}
	}

	public function owner_edit_profil()
	{
		if(isset($_SESSION['user'])){
			$data['user'] = $_SESSION['user'];
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/owner/edit_profil', $data);
		} else {
			$this->index();
		}
	}

	public function owner_edit_pengawas()
	{
		if(isset($_SESSION['user'])){
			$data['pengawas'] = json_decode($this->input->post('pengawas'), true);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/owner/edit_pengawas', $data);
		} else {
			$this->index();
		}
	}

	public function owner_edit_proyek()
	{
		if(isset($_SESSION['user'])){
			$data['proyek'] = json_decode($this->input->post('proyek'), true);
			$data['pengawas'] = json_decode($this->input->post('pengawas'), true);
			$data['kontraktor'] = json_decode($this->input->post('kontraktor'), true);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/owner/edit_proyek', $data);
		} else {
			$this->index();
		}
	}
	
	public function kontraktor_board()
	{
		if(isset($_SESSION['user'])){
			$data['proyek'] = json_decode($this->input->post('proyek'), true);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/contractor/dashboard', $data);
		} else {
			$this->index();
		}
	}

	public function kontraktor_profil()
	{
		if(isset($_SESSION['user'])){
			$data['user'] = $_SESSION['user'];
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/contractor/profil', $data);
		} else {
			$this->index();
		}
	}

	public function kontraktor_edit_profil()
	{
		if(isset($_SESSION['user'])){
			$data['user'] = $_SESSION['user'];
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/contractor/edit_profil', $data);
		} else {
			$this->index();
		}
	}

	public function kontraktor_data_proyek()
	{
		if(isset($_SESSION['user'])){
			$data['proyek'] = json_decode($this->input->post('proyek'), true);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/contractor/data_proyek', $data);
		} else {
			$this->index();
		}
	}

	public function kontraktor_submit_proyek()
	{
		if(isset($_SESSION['user'])){
			$data['proyek'] = json_decode($this->input->post('proyek'), true);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/contractor/submit_data_proyek',$data);
		} else {
			$this->index();
		}
	}

	public function pengawas_board()
	{
		if(isset($_SESSION['user'])){
			$data['proyek'] = json_decode($this->input->post('proyek'), true);
			$data['kontraktor'] = json_decode($this->input->post('kontraktor'), true);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/pengawas/dashboard', $data);
		} else {
			$this->index();
		}
	}

	public function pengawas_profil()
	{
		if(isset($_SESSION['user'])){
			$data['user'] = $_SESSION['user'];
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/pengawas/profil', $data);
		} else {
			$this->index();
		}
	}

	public function pengawas_edit_profil()
	{
		if(isset($_SESSION['user'])){
			$data['user'] = $_SESSION['user'];
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/pengawas/edit_profil', $data);
		} else {
			$this->index();
		}
	}

	public function pengawas_lihat_laporan()
	{
		if(isset($_SESSION['user'])){
			$data['proyek'] = json_decode($this->input->post('proyek'), true);
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('template/popup_form');
			$this->load->view('template/breadcrumbs');
			$this->load->view('page/pengawas/laporan_proyek', $data);
		} else {
			$this->index();
		}
	}

}
