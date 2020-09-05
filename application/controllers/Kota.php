<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kota extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_kota');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataKota'] 	= $this->M_kota->select_all();

		$data['page'] 		= "kota";
		$data['judul'] 		= "Data Kota";
		$data['deskripsi'] 	= "Manage Data Kota";

		$data['modal_tambah_kota'] = show_my_modal('modals/modal_tambah_kota', 'tambah-kota', $data);

		$this->template->views('kota/home', $data);
	}

	public function tampil() {
		$data['dataKota'] = $this->M_kota->select_all();
		$this->load->view('kota/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_kota->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Kota Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Kota Gagal ditambahkan', '20px');
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
		$data['dataKota'] 	= $this->M_kota->select_by_id($id);

		echo show_my_modal('modals/modal_update_kota', 'update-kota', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_kota->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Kota Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Kota Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_kota->delete($id);
		
		if ($result > 0) {
			echo show_succ_msg('Data Kota Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Kota Gagal dihapus', '20px');
		}
	}

	public function detail() {
		$data['userdata'] 	= $this->userdata;

		$id 				= trim($_POST['id']);
		$data['kota'] = $this->M_kota->select_by_id($id);
		$data['jumlahKota'] = $this->M_kota->total_rows();
		$data['dataKota'] = $this->M_kota->select_by_mahasiswa($id);

		echo show_my_modal('modals/modal_detail_kota', 'detail-kota', $data, 'lg');
	}

	public function export() {
	}

	public function import() {
	}
}

/* End of file Kota.php */
/* Location: ./application/controllers/Kota.php */