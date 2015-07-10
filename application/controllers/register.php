<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {
	private $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->model('teacher_model');
		$this->load->model('project_model');
		$this->load->model('member_model');
		$this->load->model('keyword_model');
	}
	
	public function index()
	{
		log_message('debug',$this->input->post("action"));
		$action = $this->input->post("action");
		if ($action == "teacher") {
			echo json_encode($this->teacher_model->get_teacher());
		} else if ($action == "finish") {
			$this->finish();
		} else if ($action == "update") {
			$this->update();
		}		
	}

	private function setUploadAttr()
	{
		//設定上傳參數
		$config['upload_path'] = './upload/';//設定上傳目錄
		$config['encrypt_name'] = TRUE;//上傳檔名將會被隨機的加密字串取代
		$config['allowed_types'] = '*';// 指定上傳格式，如'gif|jpg|png';
		$config['max_size']	= '0';//允許上傳文件大小的最大值（以K為單位）。該參數為0則不限制。
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
	}
	
	private function update() {	
		$this->setUploadAttr();

		//取得表單資料
		$project_id = $this->input->post("p_id");
		$project_year = $this->input->post("project_year");
		$leader_name = $this->input->post("leader_name");
		$leader_number = $this->input->post("leader_number");
		$project_name = $this->input->post("project_name");
		$project_description = $this->input->post("project_description");
		$project_teacher = $this->input->post("project_teacher");
		$project_type = $this->input->post("project_type");
			
		$array = array(
			"p_name" => $project_name, 
			"p_adviser" => $project_teacher,
			"p_type" => $project_type,
			"p_description" => $project_description,
			"p_leader_name" => $leader_name,
			"p_leader_number" => $leader_number,
			"p_date" => date("Y-m-d")
		);
		//更新專題資料到project表格
		$this->project_model->update_projectByPID($project_id,$array); 
		log_message('debug',"update a new project is $project_name");			
		//$x = $this->project_model->get_projectbySQL("SELECT max(p_id) as p_id FROM project");

//			$db->insert("project", $array);			
//			$db->select("project", "p_id=(SELECT max(p_id) FROM project)");
//			$x = $db->getOne();
		if(substr($leader_number,1,2)<'90')
		    $enter_year = '100' + substr($leader_number,1,2);
		else
		    $enter_year = substr($leader_number,1,2);
		$array = array(
			"s_project" => $project_id,
			"s_name" => $leader_name,
			"s_id" => $leader_number,
			"entre_year" => $enter_year // modified by Yeh 2015/5/12
//			"entre_year" => substr($leader_number,1,2)
		);
		$this->member_model->update_memberByID($leader_number,$array); // 更新組長資料到member表格			
		log_message('debug',"update a leader member is $leader_name");
		
		$na = explode(",", $this->input->post("stu_name"));
		$nu = explode(",", $this->input->post("stu_num"));//紀錄使用者傳過來的組員資料
//			var_dump($na);
//		$stack = array();
		
		$result = $this->member_model->get_memberByPID($project_id);//get the member record with the same project id
		foreach ($result as $row) {
			$ab[] = $row['s_id'];
        }
		for ($i = 0; $i < count($na); $i++) { // 更新組員資料到member表格
			if($nu[$i]=='')	break;
			if(substr($nu[$i],1,2)<'90')
				$enter_year = '100' + substr($nu[$i],1,2);
			else
				$enter_year = substr($nu[$i],1,2);
			$array = array(
				"s_project" => $project_id,
				"s_name" => $na[$i],
				"s_id" => $nu[$i],
				"entre_year" => $enter_year // modified by Yeh 2015/5/12
//				"entre_year" => substr($nu[$i],1,2)
			);
			if(in_array($nu[$i],$ab))
				$this->member_model->update_memberByID($nu[$i], $array);
			else
				$this->member_model->set_member($array);
//			array_push($stack,$award_id);
			log_message('debug',"update a member is $na[$i], $nu[$i]");
		}
		// 找出被刪除的組員-比對原來存在資料表的組員，與傳過來的組員
		

		foreach (array_diff($ab,$nu) as $key => $value) {
			$this->member_model->del_memberByID($value);
			log_message('debug',"刪除組員資料為 $key " . $value);
        }
		unset($ab);
		// 先刪除所有關鍵字，再新增關鍵字資料到keyword表格
		$this->keyword_model->delete_keywordByPID($project_id);
		$nux = explode(",", $this->input->post("project_keyword"));
		log_message('debug',"add a keyword list is " . $this->input->post("project_keyword"));
		for ($i = 0; $i < count($nux); $i++) { 
			if($nux[$i]=="")	break;
			$array = array(
				"k_project" => $project_id,
				"k_value" => $nux[$i]
			);
			$this->keyword_model->set_keyword($array);
		}
		
		// 處理得獎紀錄，沒上傳檔案的，更新資料表；有上傳檔案的，更新資料表並刪除檔案
		$i=0;
		$stack = array();
		$award_type = $this->input->post("award_type" . $i);
		
//		log_message('debug',"award_type is $award_type");

		while($award_type){
			$award_id = $this->input->post("award_id" . $i);//這個函數在你要取得的項目不存在時會回傳 FALSE (boolean)，無值則新增，有值則更新。
			$a_name = $this->input->post("a_name" . $i);
			$awardfile = $this->input->post('awardfile' . $i);

			if(!$awardfile) {//有指定檔案
				if( ! $this->upload->do_upload('awardfile' . $i) ) //將檔案寫入伺服器 
					echo json_encode($this->upload->display_errors());	
				$field_name = $this->upload->data();
				$field_name = $field_name['file_name'];
				log_message('debug',"upload file is $field_name");	
			} else {//沒有指定檔案
				$field_name = "";
				log_message('debug',"no upload file");	
			}
			if(!$award_id) {// insert an award record
				$array = array(
					"a_project" => $project_id,
					"a_type" => $award_type,
					"a_name" => $a_name,
					"a_url" => $field_name
				);//delete_files('path')
				$this->member_model->set_award($array); // 新增得獎紀錄在award資料表
				log_message('debug',"新增得獎紀錄在award資料表");
			} else { // update an award record with the specified award_id
				array_push($stack,$award_id);//紀錄修改的編號
				$result = $this->member_model->get_awardByID($award_id);//get file location
				if(!$awardfile){ //有指定檔案
					if( $result[0]['a_url'] ) {//且先前有上傳檔案
						unlink('./upload/' . $result[0]['a_url']); //delete the original file
						log_message('debug',"delete file " . './upload/' . $result[0]['a_url']);
					}
				}else
					$field_name = $result[0]['a_url']; //沿用舊檔名
				$array = array(
					"a_project" => $project_id,
					"a_type" => $award_type,
					"a_name" => $a_name,
					"a_url" => $field_name
				);//delete_files('path')
				log_message('debug',"更新得獎紀錄 " . $award_id . " - " . $field_name);
				$this->member_model->update_awardByID($award_id, $array); // 更新得獎紀錄在award資料表
			}
			$i++;
			$award_type = $this->input->post("award_type" . $i);
		}
		$result = $this->member_model->get_awardByPID($project_id);//get the award record with the same project id
		foreach ($result as $row) {
			$ab[] = $row['a_id'];
        }
		foreach (array_diff($ab,$stack) as $key => $value) {
			$this->member_model->del_awardByID($value);
			log_message('debug',"刪除得獎資料為 $key " . $value);
        }
		unset($ab);
		//$ab = array_map(function($element){return $element['a_id']}, $result);
//		log_message('debug',"刪除得獎資料為 " . json_encode(array_diff($ab,$stack)));
		
	}
	
	
	private function finish() {	
			
			//設定上傳參數
			$config['upload_path'] = './upload/';//設定上傳目錄
			$config['encrypt_name'] = TRUE;//上傳檔名將會被隨機的加密字串取代
			$config['allowed_types'] = '*';// 指定上傳格式，如'gif|jpg|png';
			$config['max_size']	= '0';//允許上傳文件大小的最大值（以K為單位）。該參數為0則不限制。
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			//取得表單資料
			$leader_name = $this->input->post("leader_name");
			$leader_number = $this->input->post("leader_number");
			$project_name = $this->input->post("project_name");
			$project_description = $this->input->post("project_description");
			$project_teacher = $this->input->post("project_teacher");
			$project_type = $this->input->post("project_type");
			
//			$s =$this->teacher_model->get_teacher($project_teacher); //取得教師姓名，以後可考慮取消
			//log_message('debug',$s[0]['name']);
			$array = array(
				"p_name" => $project_name, 
				"p_adviser" => $project_teacher,
//				"p_adviser" => $s[0]['name'],
				"p_type" => $project_type,
				"p_description" => $project_description,
				"p_leader_name" => $leader_name,
				"p_leader_number" => $leader_number,
				"p_date" => date("Y-m-d")
			);
			
			$this->project_model->set_project($array); //新增專題資料到project表格
			log_message('debug',"add a new project is $project_name");			
			$x = $this->project_model->get_projectbySQL("SELECT max(p_id) as p_id FROM project");

//			$db->insert("project", $array);			
//			$db->select("project", "p_id=(SELECT max(p_id) FROM project)");
//			$x = $db->getOne();
			if(substr($leader_number,1,2)<'90')
			    $enter_year = '100' + substr($leader_number,1,2);
			else
			    $enter_year = substr($leader_number,1,2);
			$array = array(
				"s_project" => $x[0]['p_id'],
				"s_name" => $leader_name,
				"s_id" => $leader_number,
				"entre_year" =>  $enter_year
//				"entre_year" => substr($leader_number,1,2)
			);
			$this->member_model->set_member($array); // 新增組長資料到member表格			
			log_message('debug',"add a leader member is $leader_name");
			
			$na = explode(",", $this->input->post("stu_name"));
			$nu = explode(",", $this->input->post("stu_num"));
//			var_dump($na);
			for ($i = 0; $i < count($na); $i++) { // 新增組員資料到member表格
				if($nu[$i]=='')	break;
				if(substr($nu[$i],1,2)<'90')
				    $enter_year = '100' + substr($nu[$i],1,2);
				else
				    $enter_year = substr($nu[$i],1,2);
				$array = array(
					"s_project" => $x[0]['p_id'],
					"s_name" => $na[$i],
					"s_id" => $nu[$i],
					"entre_year" => $enter_year // modified by Yeh 2015/5/12
//					"entre_year" => substr($nu[$i],1,2)
				);
				$this->member_model->set_member($array);
				log_message('debug',"add a new member is $na[$i]");
			}
			$nux = explode(",", $this->input->post("project_keyword"));
			log_message('debug',"add a keyword list is " . $this->input->post("project_keyword"));
			for ($i = 0; $i < count($nux); $i++) { // 新增關鍵字資料到keyword表格
				if($nux[$i]=="")	break;
				$array = array(
					"k_project" => $x[0]['p_id'],
					"k_value" => $nux[$i]
				);
				$this->keyword_model->set_keyword($array);
//				$db->insert("keyword", $array);
			}
			

			$i=0;
			$award_type = $this->input->post("award_type" . $i);
			log_message('debug',"award_type is $award_type");
			while($award_type){
				$a_name = $this->input->post("a_name" . $i);
				if( ! $this->upload->do_upload('awardfile' . $i) ) 
					echo json_encode($this->upload->display_errors());	
				$field_name = $this->upload->data();
				$field_name = $field_name['file_name'];
				$array = array(
					"a_project" => $x[0]['p_id'],
					"a_type" => $award_type,
					"a_name" => $a_name,
					"a_url" => $field_name
				);
				$this->member_model->set_award($array); // 新增得獎紀錄在award資料表
				log_message('debug',"upload fils is $field_name");	
				$i++;
				$award_type = $this->input->post("award_type" . $i);
			}

			if(mkdir("/nas/project/$leader_number")) //建立資料存放路徑
			{	
				$this->load->model('member_model');
                        	$member = $this->member_model->get_member($this->session->userdata('id'));
                        if($member==0)
                                $this->session->set_userdata('group', 'unreg_student');
                        else if($member[0]['isLeader']==1)
                                $this->session->set_userdata('group', 'member');
                        else if($member[0]['isLeader']==2)
                                $this->session->set_userdata('group', 'leader');
				redirect("welcome/login");
			}
	}
}

?>
