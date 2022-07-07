<?php
	namespace App\Models;
	use \CodeIgniter\Model;

	class VoucherModel extends Model {

		public function getAllVouchers($user_id = '') {
			$builder = $this->db->table('vouchers');
			$builder->orderBy('voucher_id', 'DESC');
			$result = $builder->get();
			if (count ($result->getResultArray()) > 0) {
				return $result->getResultArray();
			}else{
				return false;
			}
		}		

		public function countSubmitted() {
			$builder = $this->db->table('vouchers');
			$builder->where('status', 1);
			$result = $builder->get();
			return count($result->getResultArray());
		}

		public function countProcessed() {
			$builder = $this->db->table('vouchers');
			$builder->where('status', 2);
			$result = $builder->get();
			return count($result->getResultArray());
		}

		public function countApproved() {
			$builder = $this->db->table('vouchers');
			$builder->where('status', 3);
			$result = $builder->get();
			return count($result->getResultArray());
		}

		public function countDeclined() {
			$builder = $this->db->table('vouchers');
			$builder->where('status', 4);
			$result = $builder->get();
			return count($result->getResultArray());
		}	

		public function getAllVouchersByOutlet($outlet_id) {
			$builder = $this->db->table('vouchers');
			$builder->where('outlet_id', $outlet_id);
			$builder->orderBy('voucher_id', 'DESC');
			$result = $builder->get();
			if (count ($result->getResultArray()) > 0) {
				return $result->getResultArray();
			}else{
				return false;
			}
		}
		
		public function sumDailyByOutlet($outlet_id, $date) {
			$builder = $this->db->table('vouchers');
			$builder->selectSum('amount');
			$builder->where('status', '3');
			$builder->where('outlet_id', $outlet_id);
			$builder->where('date', $date);
			$result = $builder->get();
			return $result->getRowArray();
		}
		
		public function sumMonthlyByOutlet($outlet_id, $date) {
			$builder = $this->db->table('vouchers');
			$builder->selectSum('amount');
			$builder->where('status', '3');
			$builder->where('outlet_id', $outlet_id);
			$builder->like('date', $date);
			$result = $builder->get();
			return $result->getRowArray();
		}
		
		public function sumDailyAllOutlet($date) {
			$builder = $this->db->table('vouchers');
			$builder->selectSum('amount');
			$builder->where('status', '3');
			$builder->where('date', $date);
			$result = $builder->get();
			return $result->getRowArray();
		}
		
		public function sumMonthlyAllOutlet($date) {
			$builder = $this->db->table('vouchers');
			$builder->selectSum('amount');
			$builder->where('status', '3');
			$builder->like('date', $date);
			$result = $builder->get();
			return $result->getRowArray();
		}

		public function countSubmittedByOutlet($outlet_id) {
			$builder = $this->db->table('vouchers');
			$builder->where('status', 1);
			$builder->where('outlet_id', $outlet_id);
			$result = $builder->get();
			return count($result->getResultArray());
		}

		public function countProcessedByOutlet($outlet_id) {
			$builder = $this->db->table('vouchers');
			$builder->where('status', 2);
			$builder->where('outlet_id', $outlet_id);
			$result = $builder->get();
			return count($result->getResultArray());
		}

		public function countApprovedByOutlet($outlet_id) {
			$builder = $this->db->table('vouchers');
			$builder->where('status', 3);
			$builder->where('outlet_id', $outlet_id);
			$result = $builder->get();
			return count($result->getResultArray());
		}

		public function countDeclinedByOutlet($outlet_id) {
			$builder = $this->db->table('vouchers');
			$builder->where('status', 4);
			$builder->where('outlet_id', $outlet_id);
			$result = $builder->get();
			return count($result->getResultArray());
		}

		public function getVoucherData($voucher_id) {
			$builder = $this->db->table('vouchers');
			$builder->where('voucher_id', $voucher_id);
			$result = $builder->get();
			if (count ($result->getResultArray()) > 0) {
				return $result->getRowArray();
			}else{
				return false;
			}
		}

		public function create($data) {
			$builder = $this->db->table('vouchers');
			$res = $builder->insert($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function edit($voucher_id, $data) {
			$builder = $this->db->table('vouchers');
			$builder->where('voucher_id', $voucher_id);
			$res = $builder->update($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}

		public function updateStatus($voucher_id, $data) {
			$builder = $this->db->table('vouchers');
			$builder->where('voucher_id', $voucher_id);
			$res = $builder->update($data);
			if ($this->db->affectedRows() == 1 ) {
				return true;
			}else{
				return false;
			}
		}	

		public function deleteVoucher($id) {
			$builder = $this->db->table('vouchers');
			$builder->where('voucher_id', $id);
			$builder->delete();
			return true;
		}

		public function generate($date_from,$date_to,$outlet_id,$business_id,$voucher_no,$type,$method) {
			$builder = $this->db->table('vouchers');
			$builder->where('date >=', $date_from);
			$builder->where('date <=', $date_to);
			$builder->like('outlet_id', $outlet_id);
			$builder->like('business_id', $business_id);
			// $builder->like('expense_category', $expense_category);
			$builder->like('voucher_no', $voucher_no);
			$builder->like('type', $type);
			$builder->like('method', $method);
			$builder->orderBy('voucher_id', 'ASC');
			$result = $builder->get();
			if (count ($result->getResultArray()) > 0) {
				return $result->getResultArray();
			}else{
				return false;
			}
		}
	}