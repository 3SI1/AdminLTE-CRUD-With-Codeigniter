<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_jurusan');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataJurusan'] = $this->M_jurusan->select_all();

		$data['page'] 		= "Jurusan";
		$data['judul'] 		= "Data Jurusan";
		$data['deskripsi'] 	= "Manage Data Jurusan";

		$data['modal_tambah_jurusan'] = show_my_modal('modals/modal_tambah_jurusan', 'tambah-jurusan', $data);

		$this->template->views('jurusan/home', $data);
	}

	public function tampil() {
		$data['dataJurusan'] = $this->M_jurusan->select_all();
		$this->load->view('jurusan/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('jurusan', 'jurusan', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_jurusan->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Jurusan Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Jurusan Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['dataJurusan'] = $this->M_jurusan->select_by_id($id);

		echo show_my_modal('modals/modal_update_jurusan', 'update-jurusan', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('jurusan', 'jurusan', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_jurusan->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Jurusan Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Jurusan Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_jurusan->delete($id);
		
		if ($result > 0) {
			echo show_succ_msg('Data Jurusan Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Jurusan Gagal dihapus', '20px');
		}
	}

	public function detail() {
		$data['userdata'] = $this->userdata;

		$id = trim($_POST['id']);
		$data['jurusan'] = $this->M_jurusan->select_by_id($id);
		$data['dataJurusan'] = $this->M_jurusan->select_by_mahasiswa($id);

		echo show_my_modal('modals/modal_detail_jurusan', 'detail-jurusan', $data, 'lg');
	}

	public function export() {
	}

	public function import() {
	}
}

/* End of file Jurusan.php */
/* Location: ./application/controllers/Jurusan.php */