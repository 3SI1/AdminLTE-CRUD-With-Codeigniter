<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_mahasiswa extends CI_Model
{
	public function select_all_mahasiswa()
	{
		$sql = "SELECT * FROM mahasiswa";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all()
	{
		$sql = "SELECT 
					mahasiswa.NIM AS NIM, 
					mahasiswa.nama AS nama, 
					mahasiswa.telp AS telp, 
					kota.nama AS kota, 
					kelamin.nama AS kelamin, 
					jurusan.nama AS jurusan 
				FROM mahasiswa, kota, kelamin, jurusan 
				WHERE 
					mahasiswa.id_kelamin = kelamin.id AND 
					mahasiswa.id_jurusan = jurusan.id AND 
					mahasiswa.id_kota = kota.id";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($NIM)
	{
		$sql = "SELECT 
					mahasiswa.NIM AS NIM, 
					mahasiswa.nama AS nama, 
					mahasiswa.id_kota, 
					mahasiswa.id_kelamin, 
					mahasiswa.id_jurusan, 
					mahasiswa.telp AS telp, 
					kota.nama AS kota, 
					kelamin.nama AS kelamin, 
					jurusan.nama AS jurusan 
				FROM mahasiswa, kota, kelamin, jurusan 
				WHERE 
					mahasiswa.id_kota = kota.id AND 
					mahasiswa.id_kelamin = kelamin.id AND 
					mahasiswa.id_jurusan = jurusan.id AND 
					mahasiswa.NIM = '{$NIM}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_jurusan($id)
	{
		$sql = "SELECT COUNT(*) AS jml FROM mahasiswa WHERE id_jurusan = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_kota($id)
	{
		$sql = "SELECT COUNT(*) AS jml FROM mahasiswa WHERE id_kota = {$id}";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data)
	{
		$sql = "UPDATE mahasiswa SET 
					nama='{$data['nama']}', 
					telp='{$data['telp']}', 
					id_kota={$data['kota']}, 
					id_kelamin={$data['jk']}, 
					id_jurusan={$data['jurusan']}
				WHERE NIM='{$data['NIM']}'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($NIM)
	{
		$sql = "DELETE FROM mahasiswa WHERE NIM='{$NIM}'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data)
	{
		$sql = "INSERT INTO MAHASISWA (NIM, nama, telp, id_kelamin, id_jurusan, id_kota)
				VALUES	(
					'{$data['NIM']}',
					'{$data['nama']}',
					'{$data['telp']}',
					{$data['jk']},
					{$data['jurusan']},
					{$data['kota']})";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data)
	{
		$this->db->insert_batch('mahasiswa', $data);

		return $this->db->affected_rows();
	}

	public function check_nama($nama)
	{
		$this->db->where('nama', $nama);
		$data = $this->db->get('mahasiswa');

		return $data->num_rows();
	}

	public function total_rows()
	{
		$data = $this->db->get('mahasiswa');

		return $data->num_rows();
	}
}

/* End of file M_mahasiswa.php */
/* Location: ./application/models/M_mahasiswa.php */