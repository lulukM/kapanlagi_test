<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_diri extends CI_Controller {

	public function __construct(){	
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Data_model');
		$this->load->library('upload');
	}

	public function index()
	{
		$res = $this->Data_model->getData()->result();
		// $row = json_encode($res);
		// $x['x'] = json_decode($row,true);
		$data=array('res'=>$res);
		$this->load->view('form_datadiri',$data);
	}

	public function add_data(){
		$config['upload_path'] = './asset/images/'; //path folder
        $config['allowed_types'] = 'jpg'; //type yang dapat diakses bisa anda sesuaikan
        // $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
 
        $this->upload->initialize($config);
        if(!empty($_FILES['filefoto']['name'])){
 			
            if ($this->upload->do_upload('filefoto')){

                $gbr = $this->upload->data();
                //Compress Image first size
                $config['image_library']='gd2';
                $config['source_image']='./asset/images/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 600;
                $config['height']= 600;
                $config['max_size'] = 2048;
                $newname = str_replace('.jpg', '-'.$config['width'].'x'.$config['height'].'.jpg', $_FILES['filefoto']['name']);
                $gbr['file_name'] = $newname;
                $config['new_image']= './asset/images/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);                
                $this->image_lib->resize();

 				// if ($this->upload->do_upload('filefoto')){
                $data = array(
					'name' => $this->input->post('nama'),
					'birthdate' => $this->input->post('tgllahir'),
					'address' => $this->input->post('alamat'),
					'email' => $this->input->post('email'),
					'photo' => $gbr['file_name']
					);

                $this->Data_model->add_user($data);				
                echo "Image berhasil diupload";
                redirect('data_diri');
        	}else{
        		$error = array('error' => $this->upload->display_errors());
                echo $this->upload->display_errors();               
        	}
                      
        }else{
            echo "Image yang diupload kosong";
        }

		// if ($this->input->post('uploadimg')) {
   //          $path = ROOT_UPLOAD_PATH;
   //          // Define file rules
   //          $initi = $this->upload->initialize(array(
   //              "upload_path" => $path,
   //              "allowed_types" => "jpg",
   //              "remove_spaces" => TRUE
   //          ));
   //          // $imagename = 'no-img.jpg';

   //          if (!$this->upload->do_upload('filefoto')) {
   //              $error = array('error' => $this->upload->display_errors());
   //              echo $this->upload->display_errors();
   //          } else {
                
   //              // $imagename = str_replace('.jpg', '-'.$image_sizes[0].'x'.$image_sizes[1].'.jpg', $_FILES['filefoto']['name']);
			// 	// $imagename = $data['file_name'];                
   //          }    
   //          $data = $this->upload->data();
   //          $imagename = $data['file_name'];        
   //          // create Thumbnail -- IMAGE_SIZES;
   //          $image_sizes = array('600x600'=>array(600,600), '240x240'=>array(240,240));
   //          // load library
   //          $this->load->library('image_lib');
   //          foreach ($image_sizes as $key=>$resize) {
   //              $config = array(
   //                  'source_image' => $data['full_path'],
   //                  'new_image' => ROOT_UPLOAD_PATH .'/'.$key,
   //                  'maintain_ratio' => FALSE,
   //                  'width' => $resize[0],
   //                  'height' => $resize[1],
   //                  'quality' =>70,
   //              );
   //              $this->image_lib->initialize($config);
   //              $this->image_lib->resize();
   //              $this->image_lib->clear();
   //          }            
   //          $this->load->library('image_lib', $config);
   //          $this->image_lib->resize();
   //          // $this->Data_model->setURL($imagename);            
   //          // $this->Data_model->create();
   //          $isi = array(
			// 		'name' => $this->input->post('nama'),
			// 		'birthdate' => $this->input->post('tgllahir'),
			// 		'address' => $this->input->post('alamat'),
			// 		'email' => $this->input->post('email'),
			// 		'photo' => $imagename
			// 		); 
			// $this->Data_model->add_user($isi);                          
   //          // $this->session->set_flashdata('img_uploaded_msg', '<div class="alert alert-success">Image uploaded successfully!</div>');
   //          // $this->session->set_flashdata('img_uploaded', $imagename);
   //          redirect('data_diri');
        // }
		

		
	}

	public function user_v_edit($id){
		$data=$this->Data_model->get_data_user($id);
      	$this->js($data);
	}

	public function update_data(){

	    $id = $this->input->post('id');
	    $data = array(
			'name' => $this->input->post('nama'),
			'birthdate' => $this->input->post('tgllahir'),
			'address' => $this->input->post('alamat'),
			'email' => $this->input->post('email')
			);

        $this->Data_model->update_user($id,$data);				
        redirect('data_diri');        
	}

	public function delete_data($id){
      $this->Data_model->delete_user($id);
      $log['status']="oke";
      $this->js($log);
    }

    public function upload_image(){
    	$config['upload_path'] = './asset/images/'; //path folder
        $config['allowed_types'] = 'jpg'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
 
        $this->upload->initialize($config);
        if(!empty($_FILES['filefoto']['name'])){
 
            if ($this->upload->do_upload('filefoto')){
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./asset/images/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 600;
                $config['height']= 600;
                $config['new_image']= './asset/images/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
 
                $gambar=$gbr['file_name'];
                $judul=$this->input->post('xjudul');
                $this->m_upload->simpan_upload($judul,$gambar);
                echo "Image berhasil diupload";
            }
                      
        }else{
            echo "Image yang diupload kosong";
        }
          
    }

	public function js($data) {
      header('Content-Type: application/json');
      echo json_encode($data);
    }

}
