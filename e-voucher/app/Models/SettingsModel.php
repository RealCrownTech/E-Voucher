<?php
	namespace App\Models;
	use \CodeIgniter\Model;

	class SettingsModel extends Model {

		public function getCompanyData() {
			$builder = $this->db->table('company');
			$result = $builder->get();
			return $result->getRowArray();
		}

		public function getUserRoles() {
			$builder = $this->db->table('roles');
			$builder->orderBy('role_name', 'ASC');
			$result = $builder->get();
			return $result->getResultArray();
		}

		public function getOtherUserRoles() {
			$builder = $this->db->table('roles');
			$builder->where('role_id !=', 1);			
			$builder->orderBy('role_name', 'ASC');
			$result = $builder->get();
			return $result->getResultArray();
		}

		public function getUserRole($role_id) {
			$builder = $this->db->table('roles');
			$builder->where('role_id', $role_id);
			$result = $builder->get();
			return $result->getRowArray();
		}
		
		public function create($data) {
			$builder = $this->db->table('company');
			$builder->where('id', '1');
			$res = $builder->update($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function addUserRole($data) {
			$builder = $this->db->table('roles');
			$res = $builder->insert($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function updatePermission($role_id, $data) {
			$builder = $this->db->table('roles');
			$builder->where('role_id', $role_id);
			$res = $builder->update($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function deleteRole($id) {
			$builder = $this->db->table('roles');
			$builder->where('role_id', $id);
			$builder->delete();
			return true;
		}

		public function img_upload($data) {
			$builder = $this->db->table('company');
			$res = $builder->update($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function allBusiness() {
			$builder = $this->db->table('business');
			$result = $builder->get();
			if (count ($result->getResultArray()) > 0) {
				return $result->getResultArray();
			}else{
				return false;
			}
		}

		public function allOutlets() {
			$builder = $this->db->table('outlets');
			$builder->orderBy('outlet_name', 'ASC');
			$result = $builder->get();
			if (count ($result->getResultArray()) > 0) {
				return $result->getResultArray();
			}else{
				return false;
			}
		}

		public function allExpenseCategory() {
			$builder = $this->db->table('expense_category');
			$result = $builder->get();
			if (count ($result->getResultArray()) > 0) {
				return $result->getResultArray();
			}else{
				return false;
			}
		}

		public function allDepartments() {
			$builder = $this->db->table('departments');
			$result = $builder->get();
			if (count ($result->getResultArray()) > 0) {
				return $result->getResultArray();
			}else{
				return false;
			}
		}

		public function headDepartment($user_id) {
			$builder = $this->db->table('departments');
			$builder->where('department_head', $user_id);
			$result = $builder->get();
			return $result->getRowArray();
		}

		public function addBusiness($data) {
			$builder = $this->db->table('business');
			$res = $builder->insert($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function editBusiness($id,$data) {
			$builder = $this->db->table('business');
			$builder->where('business_id', $id);
			$res = $builder->update($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function deleteBusiness($id) {
			$builder = $this->db->table('business');
			$builder->where('business_id', $id);
			$builder->delete();
			return true;
		}

		public function addOutlet($data) {
			$builder = $this->db->table('outlets');
			$res = $builder->insert($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function editOutlet($id,$data) {
			$builder = $this->db->table('outlets');
			$builder->where('outlet_id', $id);
			$res = $builder->update($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function deleteOutlet($id) {
			$builder = $this->db->table('outlets');
			$builder->where('outlet_id', $id);
			$builder->delete();
			return true;
		}

		public function addDepartment($data) {
			$builder = $this->db->table('departments');
			$res = $builder->insert($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function editDepartment($id,$data) {
			$builder = $this->db->table('departments');
			$builder->where('department_id', $id);
			$res = $builder->update($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function deleteDepartment($id) {
			$builder = $this->db->table('departments');
			$builder->where('department_id', $id);
			$builder->delete();
			return true;
		}

		public function getOutletCount() {
			$builder = $this->db->table('outlets');
			$result = $builder->get();
			return count($result->getResultArray());
		}

		public function getBusinessCount() {
			$builder = $this->db->table('business');
			$result = $builder->get();
			return count($result->getResultArray());
		}

		public function addExpenseCategory($data) {
			$builder = $this->db->table('expense_category');
			$res = $builder->insert($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function deleteExpenseCategory($id) {
			$builder = $this->db->table('expense_category');
			$builder->where('category_id', $id);
			$builder->delete();
			return true;
		}
	}

