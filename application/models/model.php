<?php 
 
class Model extends CI_Model{	


    protected $table = 't_transaksi';

	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}	
	
	function save_admin($table,$username,$password)
	{
		$pass = md5($password);
		$data = array
		(
			'username' => $username,
			'password' => $pass
		);
		
		return $this->db->insert($table,$data);
	}
	
	function save_barang($table,$data)
	{
		$this->db->insert($table,$data);
	}

	function insert_stok_barang($data)
	{
		$this->db->insert('t_history_barang',$data);
	}
	
	function save_pelanggan($table,$data)
	{
		$this->db->insert($table,$data);
	}

	function save_supplier($table,$data)
	{
		$this->db->insert($table,$data);
	}
	
	function save_transaksi($table,$data)
	{
		$this->db->insert($table,$data);
		$this->db->select('kode_transaksi');
		$this->db->order_by('kode_transaksi',"desc");
		$this->db->limit(1);
		$query = $this->db->get($table);
		$result = $query->result();
		return $result;
	}

	function save_transaksi_temp($table,$data)
	{
		$this->db->insert($table,$data);
	}

	function save_transaksi_child2($data)
	{
		$this->db->insert('t_transaksi_child',$data);
	}

	function save_transaksi_child($data)
	{
		foreach($data as $value)
		{
			$this->db->insert('t_transaksi_child',$value);

		}
	}
	
	function get_transaksi($date1='',$date2='',$limit,$start)
	{
		$this->db->select("t_transaksi.*");
		$this->db->select("t_pelanggan.toko_pelanggan");
		if(!empty($date1) || !empty($date2))
		{
			$this->db->where('tanggal >=', $date1);
			$this->db->where('tanggal <=', $date2);
		}
		else
		{
			$month = date('m');
			$year = date('Y');
			$this->db->where('MONTH(tanggal)',$month);
			$this->db->where('YEAR(tanggal)',$year);
		}
		$this->db->join("t_pelanggan","t_pelanggan.kode_pelanggan = t_transaksi.kode_pelanggan","left outer");
		$query = $this->db->get($this->table);
		$result = $query->result();
		
		return $result;
	}

	 public function transaksi_count() {
        return $this->db->count_all($this->table);
    }


	function get_transaksi_child($kode_transaksi)
	{
		$this->db->select("t_barang.*");
		$this->db->select("t_transaksi_child.*");
		$this->db->join("t_barang","t_barang.kode_barang = t_transaksi_child.kode_barang","left outer");
		$this->db->where("t_transaksi_child.kode_transaksi",$kode_transaksi);
		$query = $this->db->get('t_transaksi_child');
		$result = $query->result();
		return $result;
	}

	function get_transaksi_temp()
	{
		$this->db->select("t_barang.*");
		$this->db->select("t_transaksi_temp.*");
		$this->db->join("t_barang","t_barang.kode_barang = t_transaksi_temp.kode_barang","left outer");
		$query = $this->db->get('t_transaksi_temp');
		$result = $query->result();
		return $result;
	}
	
	function get_transaksi_temp2()
	{
		$query = $this->db->get('t_transaksi_temp');
		$result = $query->result();
		return $result;
	}

	function get_barang()
	{
		$query = $this->db->get('t_barang');
		$result = $query->result();
		return $result;
	}

	function get_stok($id_barang)
	{
		$this->db->select('stok');
		$this->db->where('kode_barang',$id_barang);
		$query = $this->db->get('t_barang');
		$result = $query->row();
		return $result->stok;
	}
	
	function get_history_barang($id_barang)
	{
		$this->db->select('t_history_barang.*');
		$this->db->select('t_supplier.toko_supplier');
		$this->db->join("t_supplier","t_history_barang.kode_supplier = t_supplier.kode_supplier","left outer");
		$this->db->where('t_history_barang.id_barang',$id_barang);
		$query = $this->db->get('t_history_barang');
		$result = $query->result();
		return $result;
	}

	function get_barang_log($id_barang)
	{
		$this->db->select('t_barang_log.*');
		$this->db->select('t_transaksi.nota_transaksi,marketplace');
		$this->db->select('t_transaksi_child.quantity,kode_barang');
		$this->db->join("t_transaksi","t_barang_log.id_transaksi = t_transaksi.kode_transaksi","left outer");
		$this->db->join("t_transaksi_child","t_transaksi.kode_transaksi = t_transaksi_child.kode_transaksi","left outer");
		$this->db->where('t_barang_log.id_barang',$id_barang);
		$this->db->where('t_transaksi_child.kode_barang',$id_barang);
		$query = $this->db->get('t_barang_log');
		$result = $query->result();
		return $result;
	}
	
	function get_pelanggan()
	{
		$query = $this->db->get('t_pelanggan');
		$result = $query->result();
		return $result;
	}

	function get_supplier()
	{
		$query = $this->db->get('t_supplier');
		$result = $query->result();
		return $result;
	}

	function get_kode_transaksi($kode_transaksi_child)
	{
		$this->db->select('kode_transaksi');
		$this->db->where('id',$kode_transaksi_child);
		$query = $this->db->get('t_transaksi_child');
		$result = $query->row();
		return $result;	
	}
	
	function get_user()
	{
		$query = $this->db->get('user');
		$result = $query->result();
		return $result;
	}
	
	function update_transaksi($id)
	{
		$this->db->select("t_transaksi.*");
		$this->db->select("t_pelanggan.*");
		
		$this->db->join("t_pelanggan","t_pelanggan.kode_pelanggan = t_transaksi.kode_pelanggan","left outer");
		$this->db->where("kode_transaksi",$id);
		$query = $this->db->get('t_transaksi');
		$result = $query->result();
		return $result;
	}
	
	function update_barang($id)
	{
		$this->db->where("kode_barang",$id);
		$query = $this->db->get('t_barang');
		$result = $query->result();
		return $result;
	}
	
	function update_pelanggan($id)
	{
		$this->db->where("kode_pelanggan",$id);
		$query = $this->db->get('t_pelanggan');
		$result = $query->result();
		return $result;
	}

	function update_supplier($id)
	{
		$this->db->where("kode_supplier",$id);
		$query = $this->db->get('t_supplier');
		$result = $query->result();
		return $result;
	}
	
	function update_admin($id)
	{
		$this->db->where("username",$id);
		$query = $this->db->get('user');
		$result = $query->result();
		return $result;
	}
	
	function update_stok($id_barang,$data)
	{
		$this->db->where("kode_barang",$id_barang);
		$result = $this->db->update('t_barang',$data);
		return $result;
	}
	
	function doupdate_barang($table,$data,$kode)
	{
		$this->db->where("kode_barang",$kode);
		$result = $this->db->update($table,$data);
		return $result;
	}

	function doupdate_pelanggan($table,$data,$kode)
	{
		$this->db->where("kode_pelanggan",$kode);
		$result = $this->db->update($table,$data);
		return $result;
	}
	
	function doupdate_supplier($table,$data,$kode)
	{
		$this->db->where("kode_supplier",$kode);
		$result = $this->db->update($table,$data);
		return $result;
	}
	
	function doupdate_transaksi($table,$data,$kode)
	{
		$this->db->where("kode_transaksi",$kode);
		$result = $this->db->update($table,$data);
		return $result;
	}
	
	function doupdate_admin($table,$data,$kode)
	{
		$this->db->where("username",$kode);
		$result = $this->db->update($table,$data);
		return $result;
	}
	
	function cari_transaksi($dari,$sampai)
	{
		$this->db->select("t_barang.*");
		$this->db->select("t_transaksi.*");
		$this->db->select("t_pelanggan.*");
		$this->db->join("t_barang","t_barang.kode_barang = t_transaksi.kode_barang","left outer");
		$this->db->join("t_pelanggan","t_pelanggan.kode_pelanggan = t_transaksi.kode_pelanggan","left outer");
		$this->db->where('tanggal >=', $dari);
		$this->db->where('tanggal <=', $sampai);
		$query = $this->db->get('t_transaksi');
		$result = $query->result();
		return $result;
	}
	
	function cari_barang($cari)
	{
		$this->db->like('nama_barang', $cari);
		$query = $this->db->get('t_barang');
		$result = $query->result();
		return $result;
	}
	
	function cari_pelanggan($cari)
	{
		$this->db->or_like('toko_pelanggan', $cari);
		$this->db->or_like('pic_pelanggan', $cari);
		$this->db->or_like('alamat_pelanggan', $cari);
		$this->db->or_like('telp_pelanggan', $cari);
		$query = $this->db->get('t_pelanggan');
		$result = $query->result();
		return $result;
	}

	function cari_supplier($cari)
	{
		$this->db->or_like('toko_supplier', $cari);
		$this->db->or_like('pic_supplier', $cari);
		$this->db->or_like('alamat_supplier', $cari);
		$this->db->or_like('telp_supploer', $cari);
		$query = $this->db->get('t_supplier');
		$result = $query->result();
		return $result;
	}
	
	function delete_transaksi($kode)
	{
		$this->db->where('kode_transaksi', $kode);
		$this->db->delete('t_transaksi');
	}
	
	function delete_barang($kode)
	{
		$this->db->where('kode_barang', $kode);
		$this->db->delete('t_barang');
	}
	
	function delete_pelanggan($kode)
	{
		$this->db->where('kode_pelanggan', $kode);
		$this->db->delete('t_pelanggan');
	}

	function delete_supplier($kode)
	{
		$this->db->where('kode_supplier', $kode);
		$this->db->delete('t_supplier');
	}

	function delete_transaksi_temp($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('t_transaksi_temp');
	}

	function empty_transaksi_temp()
	{
		$this->db->empty_table('t_transaksi_temp');
	}

	function delete_transaksi_child($kode)
	{
		$this->db->where('id', $kode);
		$this->db->delete('t_transaksi_child');
	}

	function delete_transaksi_child2($kode)
	{
		$this->db->where('kode_transaksi', $kode);
		$this->db->delete('t_transaksi_child');
	}
}