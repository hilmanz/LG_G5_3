<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LG extends CI_Controller {

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
	function __construct()
	{
	parent::__construct();
	$this->load->model('mymodel');
	}
	
		
	function header(){
		$data = array();
		return $this->load->view('global/header',$data,true);
	}
	
	function header2(){
		$data = array();
		return $this->load->view('global/header2',$data,true);
	}
		
	function footer(){
		$data = array();
		return $this->load->view('global/footer',$data,true);
	}
	
	
	
	public function index()
	 {	
		$d=date("Y-m-d H:i");
		
		$query = $this->mymodel->get_page($d);		
		$result['view']='';
		$result['event_start']='';
		$result['event_finish']='';
		foreach($query as $row) {
		$result['view']=$row->view;	 
		$result['event_start']=$row->event_start;	 
		$result['event_finish']=$row->event_finish;	 
		}
		
		echo $result['view']."<br>";
		$data['event_time'] = date("Y-m-d H:m:i",strtotime($result['event_finish']));
		if($result['view']=='home'){			
		$this->load->view('LG/index',$data);
		}else{
			$this->load->view('LG/index',$data);
		}
	
	 }
	 
	 
	 
     public function games1()
	 {
		$d=date("Y-m-d H:i");
		
		$query = $this->mymodel->get_page($d);		
		$result['view']='';
		$result['event_start']='';
		foreach($query as $row) {
		$result['view']=$row->view;	 
		$result['event_start']=$row->event_start;	 
		$result['event_finish']=$row->event_finish;	 
		}
		
		echo $result['view']."<br>";
		$data['event_time'] = date("Y-m-d H:m:i",strtotime($result['event_finish']));
		if($result['view']=='games-1'){			
		$data = array();
		$comp = array(
			'content' => $this->load->view('LG/games1',$data,true),
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		$this->load->view('layout/index',$comp);
		}				 		 
	 }
	 
	 public function games2()
	 {  	
		$data = array();
		$comp = array(
			'content' => $this->load->view('LG/games2',$data,true),
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		$this->load->view('layout/index',$comp);		
	 }
	 
	 public function games3()
	 {  	
		$data = array();
		$comp = array(
			'content' => $this->load->view('LG/games3',$data,true),
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		$this->load->view('layout/index',$comp);
	 }
	 
	 public function games4()
	 {  	
		$data = array();
		$comp = array(
			'content' => $this->load->view('LG/games4',$data,true),
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		$this->load->view('layout/index',$comp); 
	 }
	    
	 
	 public function notif()
	 {		
		$this->load->view('LG/notif'); 
	 }
	 
	 public function form()
	 {
		$data = array();
		$comp = array(
			'content' => $this->load->view('LG/form',$data,true),
			'header' => $this->header(),			
			'footer' => $this->footer(),			
		);
		$this->load->view('layout/index',$comp);  
	 }
	 
	 
	function register() {		
		$nama = $_POST['nama'];		
		$email = $_POST['email'];
		$telp = $_POST['telp'];

		$data = array(
			'nama' => $nama,
			'email' => $email,
			'telp' => $telp,			
		);	
		
		$res = $this->mymodel->InsertData('registration',$data);
		print json_encode(array('status'=>true));
	 }
	 
	function checkEmail()
	{
	
	$result['email']="";
	$result2['telp']="";
	$email = $_POST['email'];
	$telp = $_POST['telp'];

	$where1="where email = '$email'";
	$query1 = $this->mymodel->get_registration($where1);
	
	$where2="where telp = ".$telp;
	$query2 = $this->mymodel->get_registration($where2);
	
	foreach($query1 as $row1) {
	$result['email']=$row1->email;	 
	}
	
	foreach($query2 as $row2) {
	$result2['telp']=$row2->telp;	 
	}
	
	if(($result['email']) || ($result2['telp'])){		
		print_r(json_encode(array('status'=>1,'email'=>$result['email'],'telp'=>$result2['telp'])));	die;
	}else{					
		print_r(json_encode(array('status'=>0)));die;	
	}
	
	
	}
	
	
	 function phase01() {	
		$data = array();
		$comp = array(
			'content' => $this->load->view('LG/phase1',$data,true),
			'header' => $this->header2(),						
			'footer' => '',
		);
		$this->load->view('layout/index',$comp);  
	 }
	 
	 
	 function phase02() {	
		$data = array();
		$comp = array(
			'content' => $this->load->view('LG/phase2',$data,true),
			'header' => $this->header2(),						
			'footer' => '',
		);
		$this->load->view('layout/index',$comp);  
	 }
	 
	 function phase03() {	
		$data = array();
		$comp = array(
			'content' => $this->load->view('LG/phase3',$data,true),
			'header' => $this->header2(),						
			'footer' => '',
		);
		$this->load->view('layout/index',$comp);  
	 }
	 
	 
	 function phase04() {	
		$data = array();
		$comp = array(
			'content' => $this->load->view('LG/phase4',$data,true),
			'header' => $this->header2(),						
			'footer' => '',
		);
		$this->load->view('layout/index',$comp);  
	 }
	
	
	 
	  function kuesioner() {	
		$input = Request::all();		
		kuesioner::create($input);
		print json_encode(array('status'=>true));   
	 }
	 
	 
	 /**
	  * Update the specified resource in storage.
	  *
	  * @param  int  $id
	  * @return Status
	 **/ 
	 public function updatecontact()
	 {		
		$nama = $_POST['nama'];		
		$email = $_POST['email'];
		$telp = $_POST['telp'];
		$k=substr(md5($email),1, 5);
		$rand=rand(1111,9999);
		$kode=$rand.$k;
		
		
		$data = array(
			'nama' => $nama,
			'email' => $email,
			'telp' => $telp,			
			'kode' => $kode,
			'created_at' => date("Y-m-d H:i:s"),
			'updated_at' => date("Y-m-d H:i:s"),
		);	
		
		$res = $this->mymodel->InsertData('registration',$data);
		if($res){
			$input['nama']=$nama;
			$input['email']=$email;
			$input['kode']=$kode;
			
			$dataArray = array(
				'nama'=>$input['nama'],
				'email'=>$input['email'],
				'kode_unik'=>$kode,
			);
			$this->send_addmember($dataArray);
			print json_encode(array('status'=>true,'nama'=>$input['nama'],'email'=>$input['email'],'kode'=>$input['kode']));
		}else{
			print json_encode(array('status'=>false,'status'=>'gagal'));
		}
	 }
	 
	 function get_members($last_id, $num){
		$members = DB::table('contact')
		->where('id', '>', $last_id)
		->take($num)->get();
		return $members;
	}
	
	function send_email(){		
		$last_id = 0;
		$num = 2;
		$members = $this->get_members($last_id, $num);
		while ($members != null && !empty($members)) {
			foreach($members as $one_member) {			
				$last_id = $one_member->id;
				$username = trim($one_member->nama);
				$email = trim($one_member->email);
				echo "Sending to #{$last_id}: {$email}\n";
				$dataArray = array(
					'email' => $email,
					'namemember' => $username
				);
				$results = $this->send_addmember($dataArray);
				print_r($results); echo "\n\n";
			}
			unset($members);
			$members = '';
		}
		unset($members);
	}
	
		
	function template_email(){
		$template='
				   <html lang="en">
					<head>
						
							<link href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet" type="text/css">

							<style type="text/css">
								body {
									background: #ffffff;
									margin:0;
									padding:0;
									border:0;
									outline:0;
									font-size:100%;
									font-family: Droid Sans, sans-serif, Arial, Helvetica;
									color: #6c6d6f;
								}
								table {
									border-collapse:collapse;
									border-spacing:0;
								}
								h2 {
									margin-bottom:50px;
								}
							</style>
						</head>

					<body id="body" style="background: #ffffff;margin:0;padding:0;border:0;outline:0;font-size:100%;font-family: Droid Sans;color: #6c6d6f;">

						<table width="750" cellpadding="0" cellspacing="0">
								<tr>
									<td align="center" valign="top">
										<img src="http://lgindonesia.com/g5/image/header-email.jpg">
									</td>
								</tr>
								<tr>
									<td align="center" valign="top" style="padding-top:45px">
										<table border="0" cellpadding="0" cellspacing="0" width="75%">
											<tr>
												<td>
													<h2 style="margin-bottom:30px;font-family: Droid Sans, sans-serif, Arial, Helvetica;">Hi, !#NAME!</h2>
													<p style="margin-bottom:20px;font-family: Droid Sans, sans-serif, Arial, Helvetica;">
														Selamat kamu telah berhasil mencocokkan LG Friends dengan keunggulan yang dimilikinya.<br> 
														Berkat keberhasilanmu itu, kami akan memberimu kode unik yang bisa kamu tukarkan dengan hadiah spesial dari LG.
													</p>
													<h2 style="margin-bottom:30px;font-family: Droid Sans, sans-serif, Arial, Helvetica;">Kode Unik <span style="color:#a8b100">!#KODE_UNIK</span></h2>
													<p style="margin-bottom:20px;font-family: Droid Sans, sans-serif, Arial, Helvetica;">
														Tukarkan kode unik ini ke LG Store terdekat dan ambil hadiah spesialnya. 
														<br>
														Hadiah hanya diberikan untuk 50 (lima puluh) orang pertama yang datang ke LG Store yaaaa…!
													</p>
													<p style="margin-bottom:20px;font-family: Droid Sans, sans-serif, Arial, Helvetica;">
														Jangan lupa share foto keceriaanmu beserta pengalaman serumu bersama LG Friends untuk memenangkan LG G5 dan LG smartphone lainnya!
													</p>
													<h3 style="color:#a8b100;font-family: Droid Sans, sans-serif, Arial, Helvetica;">Come and Play with LG Friends!</h3>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td align="right" valign="bottom" style="padding-top:80px">
										<img src="http://lgindonesia.com/g5/image/footer-email.jpg">
									</td>
								</tr>
							</table>
					</html>';
		
		return $template;
	}
	
		
	function send_addmember($dataArray = null){		
		$results['msg'] = '';
		$results['status'] = '';
		$template=$this->template_email();		
		$template = str_replace('!#NAME', $dataArray['nama'], $template);
		$template = str_replace('!#KODE_UNIK', $dataArray['kode_unik'], $template);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);		
		curl_setopt($ch, CURLOPT_USERPWD, 'api:key-031f6c645c2c27d331e152ba8a959e28');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');		
		curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/mybmw.co.id/messages');
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
			'from' => 'LG-G5<admin@LG-G5.co.id>',
			//'to' => 'fauzi.rahman@kana.co.id',
			'to' => $dataArray['email'],
			'subject' => "Play With GFriend5",
			'html' => $template,
			'o:campaign' => 'fkdf5'
		));
		$result = curl_exec($ch);
		$info = curl_getinfo($ch);
		$res = json_decode($result, TRUE);
		//$res['email'] = $dataArray['email'];
		if ($info['http_code'] != '200') {
			$results['msg'] = $res['message'];
			$results['status'] = '0';
		}
		else {
			$results['msg'] = $res['message'];
			$results['status'] = '1';
		}
		curl_close($ch);
		//echo $result;

		return $results;
	}
}
