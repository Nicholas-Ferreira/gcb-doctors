<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('doctor_model');

		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index(){
		$this->load->view('dashboard');
	}

	public function specialtyToHtml($crm){
		$data_specialty = $this->doctor_model->getDoctorSpecialty($crm);
		$specialties = '';

		foreach ($data_specialty->result() as $row){
			$specialties .= "* ".$row->specialty."<br>";
		}

		return $specialties;
	}

	public function search(){
		$output = '';
		$query = '';

		$output .= '
		<table id="dtDoctors" class="table table-hover">
			<thead>
				<tr>
				<th scope="col">CRM</th>
				<th scope="col">Nome</th>
				<th scope="col">Telefone</th>
				<th scope="col">Cidade</th>
				<th scope="col">Especialidades</th>
				<th scope="col">Ações</th>
				</tr>
			</thead>
			<tbody>
			';

		if($this->input->post('query')){
			$query = $this->input->post('query');
		}

		$data = $this->doctor_model->getDoctors($query);

		if($data->num_rows() > 0){
			foreach ($data->result() as $row){
				$query_specialty = $this->specialtyToHtml($row->crm);

				$output .= "
				<tr>
					<th scope='row'>".$row->crm."</td>
					<td scope='col'>".$row->name."</td>
					<td scope='col'>".$row->phone."</td>
					<td scope='col'>".$row->city." - ".$row->state."</td>
					<td scope='col'>
						<div class='mytooltip'>Sobre
							<span class='mytooltiptext'>".$query_specialty."</span>
						</div>
					</td>
					<td>
						<a href=".base_url('doctor/'.$row->crm)." role='button' class='btn btn-outline-info btn-sm'>Abrir</a>
					</td>
				</tr>
				";
			}
		}else{
			$output .= "<td scope='col' colspan=6>Sem médicos cadastrados com <b>".$query."</b></td>";
		}
		$output .= '</tbody></table>';
		echo $output;
	}
}