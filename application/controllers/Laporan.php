<?php 

class Laporan extends CI_Controller{
    public function __construct(){
		parent::__construct();
		if($this->session->userdata('role') != 'user'){

			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Anda belum login</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>');
				redirect('welcome');
		}
	}
    public function index(){
        $data['username'] = $this->session->userdata('username');
        $username = $this->session->userdata('username');

        $data['alternatif'] = $this->db->query("SELECT * FROM alternatif WHERE username = '$username'")->result();
        

        $data['kriteria'] = $this->db->query("SELECT * FROM kriteria WHERE username = '$username'")->result();
        

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/settingPanel');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan',$data);
        $this->load->view('templates/footer');
    }
}

?>