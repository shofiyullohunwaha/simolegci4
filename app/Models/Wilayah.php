<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class wilayah extends CI_Model {

	public function get_provinsi() {
		return $this->db->get('provinsi');
	}

	public function get_kabupaten() {
		$id_provinsi = $this->input->get('provinsi_id');
		$this->db->where('provinsi_id', $id_provinsi);
		return $this->db->get('kab_kota');
	}

	public function get_kecamatan() {
		$id_kabupaten = $this->input->get('kab_id');
		$this->db->where('kab_id', $id_kabupaten);
		return $this->db->get('kecamatan');
	}
	public function get_desa() {
		$id_kecamatan = $this->input->get('kec_id');
		$this->db->where('kec_id', $id_kecamatan);
		return $this->db->get('desa');
	}
}