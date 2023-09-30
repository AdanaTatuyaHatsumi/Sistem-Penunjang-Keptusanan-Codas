<?php

class NilaiKeputusan extends CI_Controller{
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
    public function tampilNilai($alter){

        $username = $this->session->userdata('username');

        $data['username'] = $this->session->userdata('username');

        $data['alternatif'] = $this->db->query("SELECT * FROM alternatif WHERE alternatif = '$alter' && username = '$username'")->result();

        $data['kriteria'] = $this->db->query("SELECT * FROM kriteria WHERE username = '$username'")->result();


        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/settingPanel');
        $this->load->view('templates/sidebar');
        $this->load->view('nilaiKeputusan',$data);
        $this->load->view('templates/footer');
    }
    public function tambahNilai($alter){

        $username = $this->session->userdata('username');

        $data['alternatif'] = $alter;

        $data['kriteria'] = $this->db->query("SELECT * FROM kriteria WHERE username = '$username'")->result();


        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/settingPanel');
        $this->load->view('templates/sidebar');
        $this->load->view('tambahNilaiKeputusan',$data);
        $this->load->view('templates/footer');
    }
    public function tambahNilaiAksi(){

        $username = $this->session->userdata('username');

        $cekKriteria = $this->db->query("SELECT * FROM kriteria WHERE username = '$username'")->result();

        $this->_rulesKeputusan();

        $alternatif1 = $this->input->post('alternatif1');

        if ($this->form_validation->run() == FALSE) {
            $this->tambahNilai($alternatif1);
        } else {
            for($i=1; $i<=count($cekKriteria); $i++){
                $alternatif         = strtolower($this->input->post('alternatif'.$i));          
                $kode               = strtolower($this->input->post('kode'.$i));
                $nilai              = $this->input->post('nilai'.$i);
                


                $data = array(
                    'alternatif'        =>  $alternatif,
                    'kode'              =>  $kode,
                    'nilai'             =>  $nilai,
                    'username'          =>  $username,
                );

                $this->CodasModel->insert_data($data,'membentuk_matriks_keputusan');
            }
            $this->session->set_flashdata('pesan','<div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Data Berhasil Ditambahkan!</strong>
                </div>');
            redirect('NilaiKeputusan/tampilNilai/'.$alternatif1);
        }
    }
    public function editNilai($alter){

        $data['alternatif'] = $alter;
        $data['username']   = $this->session->userdata('username');
        $username = $this->session->userdata('username');

        $data['kriteria'] = $this->db->query("SELECT * FROM kriteria WHERE username = '$username'")->result();


        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/settingPanel');
        $this->load->view('templates/sidebar');
        $this->load->view('editNilaiKeputusan',$data);
        $this->load->view('templates/footer');
    }
    public function editNilaiAksi(){
        $username = $this->session->userdata('username');

        $cekKriteria = $this->db->query("SELECT * FROM kriteria WHERE username = '$username'")->result();

        $this->_rulesKeputusan();

        $alternatif1 = $this->input->post('alternatif1');

        if ($this->form_validation->run() == FALSE) {
            $this->editNilai($alternatif1);
        } else {
            for($i=1; $i<=count($cekKriteria); $i++){
                $alternatif         = strtolower($this->input->post('alternatif'.$i));          
                $kode               = strtolower($this->input->post('kode'.$i));
                $nilai              = $this->input->post('nilai'.$i);
                


                $data = array(                   
                    'nilai'             =>  $nilai,
                );

                $where = array(
                    'alternatif'        =>  $alternatif,
                    'kode'              =>  $kode,
                    'username'          =>  $username,
                );

                $this->CodasModel->update_data('membentuk_matriks_keputusan',$data,$where);
            }
            $this->session->set_flashdata('pesan','<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Data Berhasil Diupdate!</strong>
                </div>');
            redirect('NilaiKeputusan/tampilNilai/'.$alternatif1);
        }
    }
    public function deleteNilai($alter){
        $username = $this->session->userdata('username');
        $where = array('alternatif' => $alter, 'username' => $username);
        $this->CodasModel->delete_data($where,'membentuk_matriks_keputusan');
        $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data Berhasil Dihapus!</strong>
        </div>');

		redirect('NilaiKeputusan/tampilNilai/'.$alter);
    } 
    public function _rulesKeputusan(){
        $username = $this->session->userdata('username');
        $cekKriteria = $this->db->query("SELECT * FROM kriteria WHERE username = '$username'")->result();
        for ($i=1; $i <= count($cekKriteria); $i++) { 
            $this->form_validation->set_rules('nilai'.$i,'Nilai C'.$i,'required');
        }
    }
    
}

?>