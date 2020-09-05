<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends AUTH_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_mahasiswa');
		$this->load->model('M_jurusan');
		$this->load->model('M_kota');
	}

	public function index()
	{
		$data['jml_mahasiswa'] = $this->M_mahasiswa->total_rows();
		$data['jml_jurusan'] = $this->M_jurusan->total_rows();
		$data['jml_kota'] = $this->M_kota->total_rows();
		$data['userdata'] = $this->userdata;

		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

		$jurusan = $this->M_jurusan->select_all();
		$index = 0;
		foreach ($jurusan as $value) {
			$color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];

			$mahasiswa_by_jurusan = $this->M_mahasiswa->select_by_jurusan($value->id);

			$data_jurusan[$index]['value'] = $mahasiswa_by_jurusan->jml;
			$data_jurusan[$index]['color'] = $color;
			$data_jurusan[$index]['highlight'] = $color;
			$data_jurusan[$index]['label'] = $value->nama;

			$index++;
		}

		$kota = $this->M_kota->select_all();
		$index = 0;
		foreach ($kota as $value) {
			$color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];

			$mahasiswa_by_kota = $this->M_mahasiswa->select_by_kota($value->id);

			$data_kota[$index]['value'] = $mahasiswa_by_kota->jml;
			$data_kota[$index]['color'] = $color;
			$data_kota[$index]['highlight'] = $color;
			$data_kota[$index]['label'] = $value->nama;

			$index++;
		}

		$data['data_jurusan'] = json_encode($data_jurusan);
		$data['data_kota'] = json_encode($data_kota);

		$data['page'] = "home";
		$data['judul'] = "Beranda";
		$data['deskripsi'] = "Manage Data CRUD";
		$this->template->views('home', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */