<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

        public function getDoctor($id){
                $this->db->select("*");
                $this->db->from("tbdoctors");
                $this->db->where('crm', $id);
                $query = $this->db->get();
                $result = $query->row();

                return $result;
        }

	public function getDoctors($query){
                $this->db->select("*");
                $this->db->from("tbdoctors");

                if($query != ''){
                        $this->db->like("crm", $query);
                        $this->db->or_like("name", $query);
                }
                return $this->db->get();
        }

        public function getSpecialties(){
                $this->db->select('*');
                $this->db->from('tbspecialties');
                
                return $this->db->get();
        }
        
        public function getDoctorSpecialty($crm = FALSE){
                $this->db->select('tbspecialties.id_specialty, tbspecialties.specialty');
                $this->db->from('tbspecialties');
                $this->db->join('doctor_specialty','doctor_specialty.id_specialty=tbspecialties.id_specialty','inner');
                $this->db->where('doctor_specialty.crm', $crm);
                
                return $this->db->get();
        }

        public function saveDoctor($data){
                $this->db->insert('tbdoctors',$data);
        }
        
        public function updateDoctor($data){
                $this->db->update('tbdoctors',$data, 'crm='.$data['crm']);
        }

        public function saveSpecialty($crm, $data){
                $this->db->delete('doctor_specialty', array('crm' => $crm));

                foreach ($data as $spec){
                        $this->db->set('crm', $crm);
                        $this->db->set('id_specialty', $spec);
                        $this->db->insert('doctor_specialty');
                }
        }
        

        public function delete($crm){
                $this->db->delete('tbdoctors', array('crm' => $crm));
                $this->db->delete('doctor_specialty', array('crm' => $crm));
        }

}