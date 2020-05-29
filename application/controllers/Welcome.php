<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 
	function __construct(){
		parent::__construct();		
		$this->load->model('model');
		$this->load->helper('url');
		$this->load->library('pagination');
	}
	public function index()
	{
		if($this->session->userdata('status') != "login"){
			$this->load->view('login');
		}
		else
		{
			$this->list_transaksi();
		}
	}
	
	private function _render_admin_layout($view,$data) {
		if($this->session->userdata('status') != "login"){
			$this->load->view('login');
		}
		else
		{
			$name = $this->session->userdata('username');
			$name_admin['name'] = $this->model->update_admin($name);
			$this->load->view('header',$name_admin);
			$this->load->view($view,$data);
			$this->load->view('footer');			
		}
    }
	
	function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->model->cek_login("user",$where)->num_rows();
		if($cek > 0){
 
			$data_session = array(
				'username' => $username,
				'password' => $password,
				'status' => 'login'
				);
 
			$this->session->set_userdata($data_session);
			$this->list_transaksi();
 
		}else{
			$this->session->set_flashdata('login','Username atau Password Salah');
			$this->index();
		}
	}
 
	function logout(){
		$this->session->sess_destroy();
		redirect('welcome');
	}
	
	public function list_transaksi($date1='',$date2='')
	{
		$data['controller'] = $this; 

		$config = array();
        $config["base_url"] = base_url() . "welcome";
        $config["total_rows"] = $this->model->transaksi_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 2;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $data["links"] = $this->pagination->create_links();

		$data['data'] = $this->model->get_transaksi($date1,$date2,$config["per_page"], $page);
		$this->_render_admin_layout('list_transaksi',$data);
	}

	public function list_transaksi_child($kode_transaksi)
	{
		$data['child'] = $this->model->get_transaksi_child($kode_transaksi);
		return $data;
	}
	
	public function list_barang()
	{
		$data['data'] = $this->model->get_barang();
		$this->_render_admin_layout('list_barang',$data);
	}
	
	public function list_pelanggan()
	{
		$data['data'] = $this->model->get_pelanggan();
		$this->_render_admin_layout('list_pelanggan',$data);
	}
	
	public function list_admin()
	{
		$data['data'] = $this->model->get_user();
		$this->_render_admin_layout('list_admin',$data);
	}
	
	public function tambah_transaksi()
	{
		$data['data'] = $this->model->get_barang();
		$data['data2'] = $this->model->get_pelanggan();
		$data['data3'] = $this->model->get_transaksi_temp();
		$this->_render_admin_layout('tambah_transaksi',$data);
	}
	
	public function tambah_pelanggan()
	{
		$this->_render_admin_layout('tambah_pelanggan','');
	}
	
	public function tambah_barang()
	{
		$this->_render_admin_layout('tambah_barang','');
	}
	
	public function tambah_admin()
	{
		$this->_render_admin_layout('tambah_admin','');
	}
	
	public function save_admin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$konfirmasi_password = $this->input->post('konfirmasi_password');
		
		if($password == $konfirmasi_password)
		{	
			$this->model->save_admin('user',$username,$password);
		}
	}
	
	public function save_barang()
	{
		$nama_barang = $this->input->post('nama_barang');
		$harga_barang = $this->input->post('harga_barang');
		
		$data = array(
			'nama_barang' => $nama_barang,
			'harga_barang' => $harga_barang
		);
		
		$this->model->save_barang('t_barang',$data);
		$this->list_barang();
	}
	
	public function save_pelanggan()
	{
		$toko_pelanggan = $this->input->post('toko_pelanggan');
		$pic_pelanggan = $this->input->post('pic_pelanggan');
		$alamat_pelanggan = $this->input->post('alamat_pelanggan');
		$telp_pelanggan = $this->input->post('telp_pelanggan');
		
		$data = array(
			'toko_pelanggan' => $toko_pelanggan,
			'pic_pelanggan' => $pic_pelanggan,
			'alamat_pelanggan' => $alamat_pelanggan,
			'telp_pelanggan' => $telp_pelanggan
		);
		
		$this->model->save_pelanggan('t_pelanggan',$data);
		$this->list_pelanggan();
	}
	
	public function save_transaksi()
	{
		$nota_transaksi = $this->input->post('nota');
		$tanggal = $this->input->post('tanggal');
		$kode_pelanggan = $this->input->post('pelanggan');
		$diskon = $this->input->post('diskon');
		$total_profit = $this->input->post('total');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nota', 'Nota', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		$this->form_validation->set_rules('pelanggan', 'pelanggan', 'required');
		$this->form_validation->set_error_delimiters('', '');
		if ($this->form_validation->run() == TRUE)
		{
			
			$data = array
			(
				'nota_transaksi' => $nota_transaksi,
				'tanggal' => $tanggal,
				'kode_pelanggan' => $kode_pelanggan,
				'diskon' => $diskon,
			);

			$kode_transaksi = $this->model->save_transaksi('t_transaksi',$data);
			$kode = json_encode($kode_transaksi);
			$id = json_decode($kode,true);
			$transaksi_temp = $this->model->get_transaksi_temp2();
			$transaksi = json_encode($transaksi_temp);
			$parameter = [];
			foreach ($transaksi_temp as  $key => $value) {
				$parameter['data']['kode_transaksi'] = $id[0]['kode_transaksi'];;
				$parameter['data']['kode_barang'] = $value->kode_barang;
				$parameter['data']['quantity'] = $value->quantity;
				$parameter['data']['harga_modal'] = $value->harga_modal;
				$parameter['data']['harga_jual'] = $value->harga_jual;
				$parameter['data']['total_profit'] = $value->total_profit;
				$this->model->save_transaksi_child($parameter);
			}
			$this->model->empty_transaksi_temp();
			$this->list_transaksi();
		}
		else
		{
			if(form_error('nota'))	
				$message[] = "Kolom `Nota` masih kosong";
			if(form_error('tanggal'))	
				$message[] = "Kolom `Tanggal` masih kosong";
			if(form_error('pelanggan'))	
				$message[] = "Kolom `Pelanggan` masih kosong";
			$result = implode("<br />",$message); 

			$this->session->set_flashdata('error',$result);
			$this->tambah_transaksi();
		}
	}

	public function save_transaksi_temp()
	{
		$kode_barang = $this->input->post('tipe_barang');
		$quantity = $this->input->post('quantity');
		$harga_modal = $this->input->post('harga_modal');
		$harga_jual = $this->input->post('harga_jual');
		$profit = $this->input->post('profit');
		
		$data = array(
			'kode_barang' => $kode_barang,
			'quantity' => $quantity,
			'harga_modal' => $harga_modal,
			'harga_jual' => $harga_jual,
			'total_profit' => $profit
		);
		
		$this->model->save_transaksi_temp('t_transaksi_temp',$data);
		$this->tambah_transaksi();
	}

	public function save_transaksi_child($kode)
	{
		$kode_barang = $this->input->post('tipe_barang');
		$quantity = $this->input->post('quantity');
		$harga_modal = $this->input->post('harga_modal');
		$harga_jual = $this->input->post('harga_jual');
		$profit = $this->input->post('profit');
		
		$data = array(
			'kode_transaksi' => $kode,
			'kode_barang' => $kode_barang,
			'quantity' => $quantity,
			'harga_modal' => $harga_modal,
			'harga_jual' => $harga_jual,
			'total_profit' => $profit
		);
		
		$this->model->save_transaksi_child2($data);
		$this->update_transaksi($kode);
	}
	
	public function update_barang()
	{
		$select = $this->uri->segment(3);
		$data['data'] = $this->model->update_barang($select);
		$this->_render_admin_layout('update_barang',$data);
	}
	
	public function update_pelanggan()
	{
		$select = $this->uri->segment(3);
		$data['data'] = $this->model->update_pelanggan($select);
		$this->_render_admin_layout('update_pelanggan',$data);
	}
	
	public function update_transaksi($kode='')
	{
		if(!empty($kode))
		{
			$select = $kode;
		}
		else
		{
			$select = $this->uri->segment(3);
		}
		$data['data'] = $this->model->update_transaksi($select);
		$data['data2'] = $this->model->get_pelanggan();
		$data['data3'] = $this->model->get_transaksi_child($select);
		$data['data4'] = $this->model->get_barang($select);
		$this->_render_admin_layout('update_transaksi',$data);
	}
	
	public function update_admin($username)
	{
		if($username == "")
		{
			$select = $this->uri->segment(3);
		}
		else
		{
			$select = $username;
		}
		$data['data'] = $this->model->update_admin($select);
		$this->_render_admin_layout('update_admin',$data);
	}
	
	public function doupdate_barang()
	{
		$action = $this->input->post('action');
		$kode_barang = $this->input->post('kode_barang');
		if($action == "simpan")
		{
			$nama_barang = $this->input->post('nama_barang');
			$harga_barang = $this->input->post('harga_barang');
			
			$data = array(
				'nama_barang' => $nama_barang,
				'harga_barang' => $harga_barang
			);
			$query = $this->model->doupdate_barang('t_barang',$data,$kode_barang);
			if($query)
			{
				$this->list_barang();
			}
		}
		elseif($action == "hapus")
		{
			$this->model->delete_barang($kode_barang);
			$this->list_barang();
		}		
	}
	
	public function doupdate_admin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$konfirmasi_password = $this->input->post('konfirmasi_password');
		
		if($password == $konfirmasi_password)
		{
			$data = array(
				'password' => md5($password)
			);
			
			$query = $this->model->doupdate_admin('user',$data,$username);
			if($query)
			{
				$this->list_admin();
			}			
		}
		else
		{
			$this->session->set_flashdata('password','1');
			$this->update_admin($username);
		}	
	}
	
	public function doupdate_pelanggan()
	{
		$action = $this->input->post('action');
		$kode_pelanggan = $this->input->post('kode_pelanggan');
		if($action == "simpan")
		{
			$toko_pelanggan = $this->input->post('toko_pelanggan');
			$pic_pelanggan = $this->input->post('pic_pelanggan');
			$telp_pelanggan = $this->input->post('telp_pelanggan');
			$alamat_pelanggan = $this->input->post('alamat_pelanggan');
			
			$data = array(
				'toko_pelanggan' => $toko_pelanggan,
				'pic_pelanggan' => $pic_pelanggan,
				'telp_pelanggan' => $telp_pelanggan,
				'alamat_pelanggan' => $alamat_pelanggan
			);
			
			$query = $this->model->doupdate_pelanggan('t_pelanggan',$data,$kode_pelanggan);
			if($query)
			{
				$this->list_pelanggan();
			}
		}
		elseif($action=="hapus")
		{
			$this->model->delete_pelanggan($kode_pelanggan);
			$this->list_pelanggan();
		}
	}
	
	public function doupdate_transaksi($kode_transaksi)
	{
		$nota_transaksi = $this->input->post('nota');
		$tanggal = $this->input->post('tanggal');
		$kode_pelanggan = $this->input->post('pelanggan');
		$diskon = $this->input->post('diskon');
		
		$data = array(
			'nota_transaksi' => $nota_transaksi,
			'tanggal' => $tanggal,
			'kode_pelanggan' => $kode_pelanggan,
			'diskon' => $diskon,
		);
		
		$this->model->doupdate_transaksi('t_transaksi',$data,$kode_transaksi);
		$this->list_transaksi();
	}
	
	public function ajax_barang()
	{
		$kode = $this->input->post('barang');
		$data = $this->model->update_barang($kode);
		echo json_encode($data);
	}
	
	public function cari_transaksi()
	{
		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');
		$this->list_transaksi($dari,$sampai);
	}
	
	public function cari_barang()
	{
		$cari = $this->input->post('cari');
		$data['data'] = $this->model->cari_barang($cari);
		$this->_render_admin_layout('cari_barang',$data);
	}
	
	public function cari_pelanggan()
	{
		$cari = $this->input->post('cari');
		$data['data'] = $this->model->cari_pelanggan($cari);
		$this->_render_admin_layout('cari_pelanggan',$data);
	}

	public function delete_transaksi_temp()
	{
		$select = $this->uri->segment(3);
		$this->model->delete_transaksi_temp($select);
		$this->tambah_transaksi();
	}

	public function delete_transaksi_child()
	{
		$select = $this->uri->segment(3);
		$kode_transaksi = $this->model->get_kode_transaksi($select);
		$this->model->delete_transaksi_child($select);
		$this->update_transaksi($kode_transaksi->kode_transaksi);
	}

	public function delete_transaksi($kode_transaksi)
	{
		$this->model->delete_transaksi_child2($kode_transaksi);
		$this->model->delete_transaksi($kode_transaksi);
		$this->list_transaksi();
	}
}
