<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Voucher extends Controller
{

    public function index() {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('viewVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Vouchers',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'vouchers' => $this->voucherModel->getAllVouchers(),
            'vouchers_by_outlet' => $this->voucherModel->getAllVouchersByOutlet(session()->get('outlet')),
            'users' => $this->userModel->getAllUsers(),
            'submitted' => $this->voucherModel->countSubmitted(),
            'processed' => $this->voucherModel->countProcessed(),
            'approved' => $this->voucherModel->countApproved(),
            'declined' => $this->voucherModel->countDeclined(),
            'submitted_by_outlet' => $this->voucherModel->countSubmittedByOutlet(session()->get('outlet')),
            'processed_by_outlet' => $this->voucherModel->countProcessedByOutlet(session()->get('outlet')),
            'approved_by_outlet' => $this->voucherModel->countApprovedByOutlet(session()->get('outlet')),
            'declined_by_outlet' => $this->voucherModel->countDeclinedByOutlet(session()->get('outlet')),
            'sum_daily_by_outlet' => $this->voucherModel->sumDailyByOutlet(session()->get('outlet'), date('d-m-Y')),
            'sum_monthly_by_outlet' => $this->voucherModel->sumMonthlyByOutlet(session()->get('outlet'), date('m-Y')),
            'sum_daily_all_outlet' => $this->voucherModel->sumDailyAllOutlet(date('d-m-Y')),
            'sum_monthly_all_outlet' => $this->voucherModel->sumMonthlyAllOutlet(date('m-Y')),
            
        ];
        
        return view('voucher/index', $data);
    }

    public function createPettyByCash() {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Create Petty Voucher By Cash',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'outlet' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
        ];
        $data['validation'] = null;

        $rules = [
            'outlet' => 'required',
            'business' => 'required',
            'amount' => 'required|numeric|less_than_equal_to[5000]',
            'being' => 'required',
            'paid_to' => 'required',
            'expense_category' => 'required',
            'attachment' => 'max_size[attachment,2048]|ext_in[attachment,png,jpg,gif,pdf,jpeg]',
        ];

        if ($this->request->getMethod() == 'post') {

            if ($this->validate($rules)) {
                $file = $this->request->getFile('attachment');
                if($file != ''){
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $voucherdata = [
                            'type' => 'petty',
                            'method' => 'cash',
                            'expense_category' => serialize($this->request->getVar('expense_category')),
                            'voucher_no' => 'PET-'.rand(10000000,99999999),
                            'amount' => $this->request->getVar('amount'),
                            'paid_to' => $this->request->getVar('paid_to'),
                            'being' => nl2br($this->request->getVar('being')),
                            'presented_by' => session()->get('logged_user'),
                            'outlet_id' => $this->request->getVar('outlet'),
                            'business_id' => $this->request->getVar('business'),
                            'date' => date('d-m-Y'),
                            'status' => '1',
                            'attachments' => $newName,
                        ];
                        if ($this->voucherModel->create($voucherdata) && $file->move('public/assets/img/vouchers/', $newName)) {
                            $this->session->setTempdata('success', 'Voucher successfully submitted',3);
                            return redirect()->to('/vouchers');
                        }else{
                            $this->session->setTempdata('error', 'Sorry! Unable to submit voucher',3);
                            return redirect()->to(current_url());
                        }
                    }
                }else{
                    $voucherdata = [
                        'type' => 'petty',
                        'method' => 'cash',
                        'expense_category' => serialize($this->request->getVar('expense_category')),
                        'voucher_no' => 'PET-'.rand(10000000,99999999),
                        'amount' => $this->request->getVar('amount'),
                        'paid_to' => $this->request->getVar('paid_to'),
                        'being' => nl2br($this->request->getVar('being')),
                        'presented_by' => session()->get('logged_user'),
                        'outlet_id' => $this->request->getVar('outlet'),
                        'business_id' => $this->request->getVar('business'),
                        'date' => date('d-m-Y'),
                        'status' => '1'
                    ];
                    if ($this->voucherModel->create($voucherdata)) {
                        $this->session->setTempdata('success', 'Voucher successfully submitted',3);
                        return redirect()->to('/vouchers');
                    }else{
                        $this->session->setTempdata('error', 'Sorry! Unable to submit voucher',3);
                        return redirect()->to(current_url());
                    }                    
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }

        return view('voucher/createpettybycash', $data);
    }

    public function editPettyByCash($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('editVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Edit Petty Voucher By Cash',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'outlet' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'voucher_data' => $this->voucherModel->getVoucherData($voucher_id),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
        ];
        $data['validation'] = null;

        $rules = [
            'outlet' => 'required',
            'business' => 'required',
            'amount' => 'required|numeric|less_than_equal_to[5000]',
            'being' => 'required',
            'paid_to' => 'required',
            'expense_category' => 'required',
        ];

        if ($this->request->getMethod() == 'post') {

            if ($this->validate($rules)) {
                $voucherdata = [
                    'type' => 'petty',
                    'method' => 'cash',
                    'expense_category' => serialize($this->request->getVar('expense_category')),
                    'voucher_no' => 'PET-'.rand(10000000,99999999),
                    'amount' => $this->request->getVar('amount'),
                    'paid_to' => $this->request->getVar('paid_to'),
                    'being' => nl2br($this->request->getVar('being')),
                    'presented_by' => session()->get('logged_user'),
                    'outlet_id' => $this->request->getVar('outlet'),
                    'business_id' => $this->request->getVar('business'),
                    'date' => date('d-m-Y'),
                    'status' => '1'
                ];
                if ($this->voucherModel->edit($voucher_id,$voucherdata)) {
                    $this->session->setTempdata('success', 'Voucher edit successful',3);
                    return redirect()->to('/vouchers');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to edit voucher',3);
                    return redirect()->to(current_url());
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }

        return view('voucher/editpettybycash', $data);
    }

    public function createPettyByTransfer() {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Create Petty Voucher By Transfer',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'outlet' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
        ];
        $data['validation'] = null;

        $rules = [
            'outlet' => 'required',
            'business' => 'required',
            'amount' => 'required|numeric|less_than_equal_to[5000]',
            'being' => 'required',
            'paid_to' => 'required',
            'account_number' => 'required|numeric|exact_length[10]',
            'bank_name' => 'required',
            'expense_category' => 'required',
            'attachment' => 'max_size[attachment,2048]|ext_in[attachment,png,jpg,gif,pdf,jpeg]',
        ];

        if ($this->request->getMethod() == 'post') {

            if ($this->validate($rules)) {
                $file = $this->request->getFile('attachment');
                if($file != ''){
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $voucherdata = [
                            'type' => 'petty',
                            'method' => 'transfer',
                            'expense_category' => serialize($this->request->getVar('expense_category')),
                            'voucher_no' => 'PET-'.rand(10000000,99999999),
                            'amount' => $this->request->getVar('amount'),
                            'paid_to' => $this->request->getVar('paid_to'),
                            'account_number' => $this->request->getVar('account_number'),
                            'bank_name' => $this->request->getVar('bank_name'),
                            'being' => nl2br($this->request->getVar('being')),
                            'presented_by' => session()->get('logged_user'),
                            'outlet_id' => $this->request->getVar('outlet'),
                            'business_id' => $this->request->getVar('business'),
                            'date' => date('d-m-Y'),
                            'status' => '1',
                            'attachments' => $newName,
                        ];
                        if ($this->voucherModel->create($voucherdata) && $file->move('public/assets/img/vouchers/', $newName)) {
                            $this->session->setTempdata('success', 'Voucher successfully submitted',3);
                            return redirect()->to('/vouchers');
                        }else{
                            $this->session->setTempdata('error', 'Sorry! Unable to submit voucher',3);
                            return redirect()->to(current_url());
                        }
                    }
                }else{
                    $voucherdata = [
                        'type' => 'petty',
                        'method' => 'transfer',
                        'expense_category' => serialize($this->request->getVar('expense_category')),
                        'voucher_no' => 'PET-'.rand(10000000,99999999),
                        'amount' => $this->request->getVar('amount'),
                        'paid_to' => $this->request->getVar('paid_to'),
                        'account_number' => $this->request->getVar('account_number'),
                        'bank_name' => $this->request->getVar('bank_name'),
                        'being' => nl2br($this->request->getVar('being')),
                        'presented_by' => session()->get('logged_user'),
                        'outlet_id' => $this->request->getVar('outlet'),
                        'business_id' => $this->request->getVar('business'),
                        'date' => date('d-m-Y'),
                        'status' => '1'
                    ];
                    if ($this->voucherModel->create($voucherdata)) {
                        $this->session->setTempdata('success', 'Voucher successfully submitted',3);
                        return redirect()->to('/vouchers');
                    }else{
                        $this->session->setTempdata('error', 'Sorry! Unable to submit voucher',3);
                        return redirect()->to(current_url());
                    }                    
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }

        return view('voucher/createpettybytransfer', $data);
    }

    public function editPettyByTransfer($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('editVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Edit Petty Voucher By Transfer',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'outlet' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'voucher_data' => $this->voucherModel->getVoucherData($voucher_id),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
        ];
        $data['validation'] = null;

        $rules = [
            'outlet' => 'required',
            'business' => 'required',
            'amount' => 'required|numeric|less_than_equal_to[5000]',
            'being' => 'required',
            'paid_to' => 'required',
            'account_number' => 'required|numeric|exact_length[10]',
            'bank_name' => 'required',
            'expense_category' => 'required',
        ];

        if ($this->request->getMethod() == 'post') {

            if ($this->validate($rules)) {
                $voucherdata = [
                    'type' => 'petty',
                    'method' => 'transfer',
                    'expense_category' => serialize($this->request->getVar('expense_category')),
                    'voucher_no' => 'PET-'.rand(10000000,99999999),
                    'amount' => $this->request->getVar('amount'),
                    'paid_to' => $this->request->getVar('paid_to'),
                    'account_number' => $this->request->getVar('account_number'),
                    'bank_name' => $this->request->getVar('bank_name'),
                    'being' => nl2br($this->request->getVar('being')),
                    'presented_by' => session()->get('logged_user'),
                    'outlet_id' => $this->request->getVar('outlet'),
                    'business_id' => $this->request->getVar('business'),
                    'date' => date('d-m-Y'),
                    'status' => '1'
                ];
                if ($this->voucherModel->edit($voucher_id,$voucherdata)) {
                    $this->session->setTempdata('success', 'Voucher edit successful',3);
                    return redirect()->to('/vouchers');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to edit voucher',3);
                    return redirect()->to(current_url());
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }

        return view('voucher/editpettybytransfer', $data);
    }

    public function createPaymentByCash() {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Create Payment Voucher By Cash',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'outlet' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
        ];
        $data['validation'] = null;

        $rules = [
            'outlet' => 'required',
            'business' => 'required',
            'amount' => 'required|numeric|greater_than_equal_to[5000]',
            'being' => 'required',
            'paid_to' => 'required',
            'expense_category' => 'required',
            'attachment' => 'max_size[attachment,2048]|ext_in[attachment,png,jpg,gif,pdf,jpeg]',
        ];

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $file = $this->request->getFile('attachment');
                if($file != ''){
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $voucherdata = [
                            'type' => 'payment',
                            'method' => 'cash',
                            'expense_category' => serialize($this->request->getVar('expense_category')),
                            'voucher_no' => 'PAY-'.rand(10000000,99999999),
                            'amount' => $this->request->getVar('amount'),
                            'paid_to' => $this->request->getVar('paid_to'),
                            'being' => nl2br($this->request->getVar('being')),
                            'presented_by' => session()->get('logged_user'),
                            'outlet_id' => $this->request->getVar('outlet'),
                            'business_id' => $this->request->getVar('business'),
                            'date' => date('d-m-Y'),
                            'status' => '1',
                            'attachments' => $newName,
                        ];
                        if ($this->voucherModel->create($voucherdata) && $file->move('public/assets/img/vouchers/', $newName)) {
                            $this->session->setTempdata('success', 'Voucher successfully submitted',3);
                            return redirect()->to('/vouchers');
                        }else{
                            $this->session->setTempdata('error', 'Sorry! Unable to submit voucher',3);
                            return redirect()->to(current_url());
                        }
                    }
                }else{
                    $voucherdata = [
                        'type' => 'payment',
                        'method' => 'cash',
                        'expense_category' => serialize($this->request->getVar('expense_category')),
                        'voucher_no' => 'PAY-'.rand(10000000,99999999),
                        'amount' => $this->request->getVar('amount'),
                        'paid_to' => $this->request->getVar('paid_to'),
                        'being' => nl2br($this->request->getVar('being')),
                        'presented_by' => session()->get('logged_user'),
                        'outlet_id' => $this->request->getVar('outlet'),
                        'business_id' => $this->request->getVar('business'),
                        'date' => date('d-m-Y'),
                        'status' => '1',
                    ];
                    if ($this->voucherModel->create($voucherdata)) {
                        $this->session->setTempdata('success', 'Voucher successfully submitted',3);
                        return redirect()->to('/vouchers');
                    }else{
                        $this->session->setTempdata('error', 'Sorry! Unable to submit voucher',3);
                        return redirect()->to(current_url());
                    }                    
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }

        return view('voucher/createpaymentbycash', $data);
    }

    public function editPaymentByCash($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('editVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Edit Payment Voucher By Cash',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'outlet' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'voucher_data' => $this->voucherModel->getVoucherData($voucher_id),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
        ];
        $data['validation'] = null;

        $rules = [
            'outlet' => 'required',
            'business' => 'required',
            'amount' => 'required|numeric|greater_than_equal_to[5000]',
            'being' => 'required',
            'paid_to' => 'required',
            'expense_category' => 'required',
        ];

        if ($this->request->getMethod() == 'post') {

            if ($this->validate($rules)) {
                $voucherdata = [
                    'type' => 'payment',
                    'method' => 'cash',
                    'expense_category' => serialize($this->request->getVar('expense_category')),
                    'voucher_no' => 'PAY-'.rand(10000000,99999999),
                    'amount' => $this->request->getVar('amount'),
                    'paid_to' => $this->request->getVar('paid_to'),
                    'being' => nl2br($this->request->getVar('being')),
                    'presented_by' => session()->get('logged_user'),
                    'outlet_id' => $this->request->getVar('outlet'),
                    'business_id' => $this->request->getVar('business'),
                    'date' => date('d-m-Y'),
                    'status' => '1'
                ];
                if ($this->voucherModel->edit($voucher_id,$voucherdata)) {
                    $this->session->setTempdata('success', 'Voucher edit successful',3);
                    return redirect()->to('/vouchers');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to edit voucher',3);
                    return redirect()->to(current_url());
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }

        return view('voucher/editpaymentbycash', $data);
    }

    public function createPaymentByTransfer() {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Create Payment Voucher By Transfer',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'outlet' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
        ];
        $data['validation'] = null;

        $rules = [
            'outlet' => 'required',
            'business' => 'required',
            'amount' => 'required|numeric|greater_than_equal_to[5000]',
            'being' => 'required',
            'paid_to' => 'required',
            'account_number' => 'required|numeric|exact_length[10]',
            'bank_name' => 'required',
            'expense_category' => 'required',
            'attachment' => 'max_size[attachment,2048]|ext_in[attachment,png,jpg,gif,pdf,jpeg]',
        ];

        if ($this->request->getMethod() == 'post') {

            if ($this->validate($rules)) {
                $file = $this->request->getFile('attachment');
                if($file != ''){
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $voucherdata = [
                            'type' => 'payment',
                            'method' => 'transfer',
                            'expense_category' => serialize($this->request->getVar('expense_category')),
                            'voucher_no' => 'PAY-'.rand(10000000,99999999),
                            'amount' => $this->request->getVar('amount'),
                            'paid_to' => $this->request->getVar('paid_to'),
                            'account_number' => $this->request->getVar('account_number'),
                            'bank_name' => $this->request->getVar('bank_name'),
                            'being' => nl2br($this->request->getVar('being')),
                            'presented_by' => session()->get('logged_user'),
                            'outlet_id' => $this->request->getVar('outlet'),
                            'business_id' => $this->request->getVar('business'),
                            'date' => date('d-m-Y'),
                            'status' => '1',                            
                            'attachments' => $newName,
                        ];
                        if ($this->voucherModel->create($voucherdata) && $file->move('public/assets/img/vouchers/', $newName)) {
                            $this->session->setTempdata('success', 'Voucher successfully submitted',3);
                            return redirect()->to('/vouchers');
                        }else{
                            $this->session->setTempdata('error', 'Sorry! Unable to submit voucher',3);
                            return redirect()->to(current_url());
                        }
                    }
                }else{
                    $voucherdata = [
                        'type' => 'payment',
                        'method' => 'transfer',
                        'expense_category' => serialize($this->request->getVar('expense_category')),
                        'voucher_no' => 'PAY-'.rand(10000000,99999999),
                        'amount' => $this->request->getVar('amount'),
                        'paid_to' => $this->request->getVar('paid_to'),
                        'account_number' => $this->request->getVar('account_number'),
                        'bank_name' => $this->request->getVar('bank_name'),
                        'being' => nl2br($this->request->getVar('being')),
                        'presented_by' => session()->get('logged_user'),
                        'outlet_id' => $this->request->getVar('outlet'),
                        'business_id' => $this->request->getVar('business'),
                        'date' => date('d-m-Y'),
                        'status' => '1'
                    ];
                    if ($this->voucherModel->create($voucherdata)) {
                        $this->session->setTempdata('success', 'Voucher successfully submitted',3);
                        return redirect()->to('/vouchers');
                    }else{
                        $this->session->setTempdata('error', 'Sorry! Unable to submit voucher',3);
                        return redirect()->to(current_url());
                    }                    
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }

        return view('voucher/createpaymentbytransfer', $data);
    }

    public function editPaymentByTransfer($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('editVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Edit Payment Voucher By Transfer',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'outlet' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'voucher_data' => $this->voucherModel->getVoucherData($voucher_id),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
        ];
        $data['validation'] = null;

        $rules = [
            'outlet' => 'required',
            'business' => 'required',
            'amount' => 'required|numeric|greater_than_equal_to[5000]',
            'being' => 'required',
            'paid_to' => 'required',
            'account_number' => 'required|numeric|exact_length[10]',
            'bank_name' => 'required',
            'expense_category' => 'required',
        ];

        if ($this->request->getMethod() == 'post') {

            if ($this->validate($rules)) {
                $voucherdata = [
                    'type' => 'payment',
                    'method' => 'transfer',
                    'expense_category' => serialize($this->request->getVar('expense_category')),
                    'voucher_no' => 'PAY-'.rand(10000000,99999999),
                    'amount' => $this->request->getVar('amount'),
                    'paid_to' => $this->request->getVar('paid_to'),
                    'account_number' => $this->request->getVar('account_number'),
                    'bank_name' => $this->request->getVar('bank_name'),
                    'being' => nl2br($this->request->getVar('being')),
                    'presented_by' => session()->get('logged_user'),
                    'outlet_id' => $this->request->getVar('outlet'),
                    'business_id' => $this->request->getVar('business'),
                    'date' => date('d-m-Y'),
                    'status' => '1'
                ];
                if ($this->voucherModel->edit($voucher_id,$voucherdata)) {
                    $this->session->setTempdata('success', 'Voucher edit successful',3);
                    return redirect()->to('/vouchers');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to edit voucher',3);
                    return redirect()->to(current_url());
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }

        return view('voucher/editpaymentbytransfer', $data);
    }

    public function viewpettybycash($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('viewVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Voucher Review',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'voucher_data' => $this->voucherModel->getVoucherData($voucher_id),
            'users' => $this->userModel->getAllUsers(),
            'outlets' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
            'hod' => $this->settingsModel->headDepartment(session()->get('logged_user')),
        ];
        $data['validation'] = null;
        
        return view('voucher/viewpettybycash', $data);
    }

    public function viewpettybytransfer($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('viewVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Voucher Review',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'voucher_data' => $this->voucherModel->getVoucherData($voucher_id),
            'users' => $this->userModel->getAllUsers(),
            'outlets' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
            'hod' => $this->settingsModel->headDepartment(session()->get('logged_user')),
        ];
        $data['validation'] = null;
        
        return view('voucher/viewpettybytransfer', $data);
    }

    public function approvepetty($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addProcessPayment', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() == 'post') {
            $data = [
                'approved_by' => session()->get('logged_user'),
                'status' => '3'
            ];
            if ($this->voucherModel->updateStatus($voucher_id,$data)) {
                $this->session->setTempdata('success', 'Voucher approved successfully',3);
                return redirect()->to('/vouchers');
            }else{
                $this->session->setTempdata('error', 'Sorry! Unable to approve voucher',3);
                return redirect()->to(current_url());
            }
        }

        return view('voucher/index', $data);
    }

    public function declinepetty($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addProcessPayment', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() == 'post') {
            $data = [
                'declined_by' => session()->get('logged_user'),                
                'reason' => nl2br($this->request->getVar('reason')),
                'status' => '4'
            ];
            if ($this->voucherModel->updateStatus($voucher_id,$data)) {
                $this->session->setTempdata('success', 'Voucher declined successfully',3);
                return redirect()->to('/vouchers');
            }else{
                $this->session->setTempdata('error', 'Sorry! Unable to decline voucher',3);
                return redirect()->to(current_url());
            }
        }

        return view('voucher/index', $data);
    }

    public function viewpaymentbycash($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('viewVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Voucher Review',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'voucher_data' => $this->voucherModel->getVoucherData($voucher_id),
            'users' => $this->userModel->getAllUsers(),
            'outlets' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
            'hod' => $this->settingsModel->headDepartment(session()->get('logged_user')),
        ];
        $data['validation'] = null;
        
        return view('voucher/viewpaymentbycash', $data);
    }

    public function viewpaymentbytransfer($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('viewVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Voucher Review',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'voucher_data' => $this->voucherModel->getVoucherData($voucher_id),
            'users' => $this->userModel->getAllUsers(),
            'outlets' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
            'hod' => $this->settingsModel->headDepartment(session()->get('logged_user')),
        ];
        $data['validation'] = null;
        
        return view('voucher/viewpaymentbytransfer', $data);
    }

    public function approvepayment($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addApprovePayment', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() == 'post') {
            $data = [
                'approved_by' =>  session()->get('logged_user'),
                'status' => '3'
            ];
            if ($this->voucherModel->updateStatus($voucher_id,$data)) {
                $this->session->setTempdata('success', 'Voucher approved successfully',3);
                return redirect()->to('/vouchers');
            }else{
                $this->session->setTempdata('error', 'Sorry! Unable to approve voucher',3);
                return redirect()->to(current_url());
            }
        }

        return view('voucher/index', $data);
    }

    public function processpayment($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        // if(!in_array('addProcessPayment', $this->permission)){
        //     $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
        //     return redirect()->to('/dashboard');
        // }

        if ($this->request->getMethod() == 'post') {
            $data = [
                'processed_by' =>  session()->get('logged_user'),
                'status' => '2'
            ];
            if ($this->voucherModel->updateStatus($voucher_id,$data)) {
                $this->session->setTempdata('success', 'Voucher processed successfully',3);
                return redirect()->to('/vouchers');
            }else{
                $this->session->setTempdata('error', 'Sorry! Unable to process voucher',3);
                return redirect()->to(current_url());
            }
        }

        return view('voucher/index', $data);
    }

    public function declinepayment($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addProcessPayment', $this->permission) || !in_array('addApprovePayment', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() == 'post') {
            $data = [
                'declined_by' => session()->get('logged_user'),
                'reason' => nl2br($this->request->getVar('reason')),
                'status' => '4'
            ];
            if ($this->voucherModel->updateStatus($voucher_id,$data)) {
                $this->session->setTempdata('success', 'Voucher declined successfully',3);
                return redirect()->to('/vouchers');
            }else{
                $this->session->setTempdata('error', 'Sorry! Unable to decline voucher',3);
                return redirect()->to(current_url());
            }
        }

        return view('voucher/index', $data);
    }

    public function delete($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('deleteVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $do_delete = $this->voucherModel->deleteVoucher($voucher_id);
        if ($do_delete) {
            $this->session->setTempdata('success', 'Voucher delete successful',3);
        } else {
            $this->session->setTempdata('error', 'Unable to delete voucher',3);
        }
        return redirect()->to('/vouchers');
    }

    public function search() {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('viewVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Generate Report',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'vouchers' => $this->voucherModel->getAllVouchers(),
            'vouchers_by_outlet' => $this->voucherModel->getAllVouchersByOutlet(session()->get('outlet')),
            'users' => $this->userModel->getAllUsers(),
            'outlet' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
        ];
        
        return view('voucher/search', $data);
    }

    public function generate_report() {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('viewVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }



        if ($this->request->getMethod() == 'post') {

            $date_from = date('d-m-Y', strtotime($this->request->getVar('date_from')));
            $date_to = date('d-m-Y', strtotime($this->request->getVar('date_to')));
            $outlet_id = $this->request->getVar('outlet');
            $business_id = $this->request->getVar('business');
            $expense_category = serialize($this->request->getVar('expense_category'));
            $voucher_no =$this->request->getVar('voucher_no');
            $type = $this->request->getVar('type');
            $method = $this->request->getVar('method');

            $generate = $this->voucherModel->generate($date_from,$date_to,$outlet_id,$business_id,$voucher_no,$type,$method);

            $data = [
                'user_permission' => $this->permission,
                'page_name' => 'Report',
                'page_title' => 'Search Result For Date Range Between '. date('d-M-Y', strtotime($date_from)) .' And '. date('d-M-Y', strtotime($date_to)),            
                'company_data' => $this->settingsModel->getCompanyData(),
                'roles_data' => $this->settingsModel->getUserRoles(),
                'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
                'vouchers' => $this->voucherModel->getAllVouchers(),
                'users' => $this->userModel->getAllUsers(),
                'outlet' => $this->settingsModel->allOutlets(),
                'businesses' => $this->settingsModel->allBusiness(),
                'expense_categories' => $this->settingsModel->allExpenseCategory(),
                'search_title' => 'Search Result For Date Range Between '. date('d-M-Y', strtotime($date_from)) .' And '. date('d-M-Y', strtotime($date_to)),
                'search_result' => $generate,
            ];
        }
        
        return view('voucher/generate', $data);
    }
    
    public function print_pbc($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('viewVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Print Expense Voucher',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'voucher_data' => $this->voucherModel->getVoucherData($voucher_id),
            'users' => $this->userModel->getAllUsers(),
            'outlets' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
            'hod' => $this->settingsModel->headDepartment(session()->get('logged_user')),
        ];
        $data['validation'] = null;
        
        return view('print/pbc', $data);
    }
    
    public function print_pbt($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('viewVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Print Expense Voucher',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'voucher_data' => $this->voucherModel->getVoucherData($voucher_id),
            'users' => $this->userModel->getAllUsers(),
            'outlets' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
            'hod' => $this->settingsModel->headDepartment(session()->get('logged_user')),
        ];
        $data['validation'] = null;
        
        return view('print/pbt', $data);
    }
    
    public function print_ibc($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('viewVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Print Expense Voucher',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'voucher_data' => $this->voucherModel->getVoucherData($voucher_id),
            'users' => $this->userModel->getAllUsers(),
            'outlets' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
            'hod' => $this->settingsModel->headDepartment(session()->get('logged_user')),
        ];
        $data['validation'] = null;
        
        return view('print/ibc', $data);
    }

    public function print_ibt($voucher_id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('viewVoucher', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Print Expense Voucher',
            'page_title' => 'Vouchers',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'voucher_data' => $this->voucherModel->getVoucherData($voucher_id),
            'users' => $this->userModel->getAllUsers(),
            'outlets' => $this->settingsModel->allOutlets(),
            'businesses' => $this->settingsModel->allBusiness(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
            'hod' => $this->settingsModel->headDepartment(session()->get('logged_user')),
        ];
        $data['validation'] = null;
        
        return view('print/ibt', $data);
    }
}