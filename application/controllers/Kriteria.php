<?php 

class Kriteria extends CI_Controller{
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

        $username = $this->session->userdata('username');

        $data['kriteria'] = $this->db->query("SELECT * FROM kriteria WHERE username = '$username'")->result();

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/settingPanel');
        $this->load->view('templates/sidebar');
        $this->load->view('kriteria',$data);
        $this->load->view('templates/footer');
		 
    }
    public function tambahKriteria(){

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/settingPanel');
        $this->load->view('templates/sidebar');
        $this->load->view('tambahKriteria');
        $this->load->view('templates/footer');
    }
    public function tambahKriteriaAksi(){
        $this->_rulesKriteria();

        $username = $this->session->userdata('username');

        if ($this->form_validation->run() == FALSE) {
            $this->tambahKriteria();
        } else {
            $kode = strtolower($this->input->post('kode'));
            
            $cek = $this->db->query("SELECT * FROM kriteria WHERE kode = '$kode' && username = '$username'")->result();
            if (!empty($cek)) {
                $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Kode Kriteria Sudah Ada!</strong> Silahkan input ulang :)
              </div>');
              $this->tambahKriteria();
            } else {
                $kri        = strtolower($this->input->post('kriteria'));
                $kriteria   = str_replace(" ","-",$kri);
                $bobot      = $this->input->post('bobot');

                $data = array(
                    'kode'      =>  $kode,
                    'kriteria'   =>  $kriteria,
                    'bobot'     =>  $bobot,
                    'username'  =>  $username,
                );

                $this->CodasModel->insert_data($data,'kriteria');
                $this->session->set_flashdata('pesan','<div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Data Berhasil Ditambahkan!</strong>
                </div>');
                redirect('kriteria');
            }
        }
    }
    public function editKriteria($id){

        $data['selectKriteria'] = $this->db->query("SELECT * FROM kriteria WHERE id = '$id'")->result();

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/settingPanel');
        $this->load->view('templates/sidebar');
        $this->load->view('editKriteria',$data);
        $this->load->view('templates/footer');
    }
    public function editKriteriaAksi(){
        $this->_rulesKriteria();

        $id = $this->input->post('id');

        if ($this->form_validation->run() == FALSE) {
            $this->editKriteria($id);
        } else {
            $kode = strtolower($this->input->post('kode'));
            $kri        = strtolower($this->input->post('kriteria'));
            $kriteria   = str_replace(" ","-",$kri);
            $bobot      = $this->input->post('bobot');

            $data = array(
                'kode'      =>  $kode,
                'kriteria'   =>  $kriteria,
                'bobot'     =>  $bobot,
            );
            $where = array(
                'id' => $id,
            );

            $this->CodasModel->update_data('kriteria',$data,$where);
            $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Data Berhasil Diupdate!</strong>
            </div>');
            redirect('kriteria');
        }
    }
    public function deleteKriteria($id){
        $where = array('id' => $id);
		$this->CodasModel->delete_data($where,'kriteria');
        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data Berhasil Dihapus!</strong>
    </div>');

		redirect('kriteria');
    }
    public function _rulesKriteria(){
        $this->form_validation->set_rules('kode','Kode','required');
        $this->form_validation->set_rules('kriteria','Kriteria','required');
        $this->form_validation->set_rules('bobot','Bobot','required');
    }
}

?>