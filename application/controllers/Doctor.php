<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('doctor_model');
		
		$this->load->helper('form');
		$this->load->helper('url');

		$this->load->library('form_validation');
	}

	public function view($CRM = NULL, $error = ''){
		$data['error'] = $error;
		$data['action'] = $CRM;
		
		// Get Doctor Informations
		$data['doctor'] = $this->doctor_model->getDoctor($CRM);
		if (empty($data['doctor']) && $CRM != "new"){
			show_404();
		}

		// Get All Specialty
		$data['specialties'] = $this->doctor_model->getSpecialties($CRM);
		// Get Doctor Specialty
		$data['doctorSpecialty'] = $this->doctor_model->getDoctorSpecialty($CRM);

		$this->load->view('doctor', $data);
	}

	public function save(){
		$form_data = $this->input->post();
		json_encode($form_data);

		$query = array(
			'crm' => $form_data['crm'],
			'name' => $form_data['name'],
			'phone' => $form_data['phone'],
			'state' => $form_data['uf'],
			'city' => $form_data['cidade']
			);


		// Check for CRM
		if($form_data['action'] == 'new'){
			$result = $this->doctor_model->getDoctor($form_data['crm']);
			if(count($result) > 0){
				$this->view('new', 'CRM já cadastrado');
			}else{
				$this->doctor_model->saveDoctor($query);
				$this->doctor_model->saveSpecialty($form_data['crm'], $form_data['specialty']);

				$this->load->view('doctor');
			}
		}else{
			$this->doctor_model->updateDoctor($query);
			$this->doctor_model->saveSpecialty($form_data['crm'], $form_data['specialty']);
			
			$this->view($form_data['crm']);
		}
	}

	public function delete($CRM = NULL){
		$this->doctor_model->delete($CRM);
		$this->load->view('dashboard');
	}

}
