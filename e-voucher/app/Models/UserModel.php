<?php
	namespace App\Models;
	use \CodeIgniter\Model;

	class UserModel extends Model {

		public function create($data) {
			$builder = $this->db->table('users');
			$res = $builder->insert($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function edit($user_id, $data) {
			$builder = $this->db->table('users');
			$builder->where('user_id', $user_id);
			$res = $builder->update($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		// public function getAllUsersPlusSuper() {
		// 	$builder = $this->db->table('users');
		// 	$result = $builder->get();
		// 	if (count ($result->getResultArray()) > 0) {
		// 		return $result->getResultArray();
		// 	}else{
		// 		return false;
		// 	}
		// }

		public function getAllUsers() {
			$builder = $this->db->table('users');
			$builder->where('user_id !=', 1);
			$builder->orderBy('first_name', 'ASC');
			$result = $builder->get();
			if (count ($result->getResultArray()) > 0) {
				return $result->getResultArray();
			}else{
				return false;
			}
		}

		public function getUserCount() {
			$builder = $this->db->table('users');
			$builder->where('user_id !=', 1);
			$result = $builder->get();
			return count($result->getResultArray());
		}

		public function getUserData($user_id) {
			$builder = $this->db->table('users');
			$builder->where('user_id', $user_id);
			$result = $builder->get();
			if (count ($result->getResultArray()) > 0) {
				return $result->getRowArray();
			}else{
				return false;
			}
		}

		public function deleteUser($id) {
			$builder = $this->db->table('users');
			$builder->where('user_id', $id);
			$builder->delete();
			return true;
		}

		public function profile_upload($data,$user_id) {
			$builder = $this->db->table('users');
			$builder->where('user_id', $user_id);
			$res = $builder->update($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}
	}