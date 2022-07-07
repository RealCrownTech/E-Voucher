<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Settings extends Controller
{
    
    public function index()
    {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Settings',
            'page_title' => 'Settings',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),            
            'businesses' => $this->settingsModel->allBusiness(),
            'outlets' => $this->settingsModel->allOutlets(),
            'expense_categories' => $this->settingsModel->allExpenseCategory(),
            'departments' => $this->settingsModel->allDepartments(),
            'users' => $this->userModel->getAllUsers(),
        ];

        $data['validation'] = null;

        return view('settings/index', $data);
    }

    public function company()
    {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Settings',
            'page_title' => 'Settings',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
        ];

        $rules = [
            'site_title' => 'required',
            'company_name' => 'required',
            'company_email' => 'required|valid_email',
            // 'company_phone' => 'required|numeric|exact_length[11]',
            'company_phone' => 'required',
            'company_website' => 'required',
            'company_address' => 'required'
        ];

        $data['validation'] = null;
        

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $company_data = [
                    'site_title' => $this->request->getVar('site_title'),
                    'company_name' => $this->request->getVar('company_name'),
                    'tagline' => $this->request->getVar('tagline'),
                    'company_email' => $this->request->getVar('company_email'),
                    'company_phone' => $this->request->getVar('company_phone'),
                    'company_mobile' => $this->request->getVar('company_mobile'),
                    'company_website' => $this->request->getVar('company_website'),
                    'company_address' => $this->request->getVar('company_address')
                ];
                if ($this->settingsModel->create($company_data)) {
                    $this->session->setTempdata('success', 'Company info update successful',3);
                    return redirect()->to('/settings');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to update company info',3);
                    return redirect()->to(current_url());
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        
        return view('settings/index', $data);
    }

    public function bank()
    {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Settings',
            'page_title' => 'Settings',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
        ];
        
        $rules = [
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required|numeric|exact_length[10]',
        ];

        $data['validation'] = null;
        

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $company_data = [
                    'bank_name' => $this->request->getVar('bank_name'),
                    'account_name' => $this->request->getVar('account_name'),
                    'account_number' => $this->request->getVar('account_number'),
                    'show_on_invoice' => $this->request->getVar('show_on_invoice')
                ];
                if ($this->settingsModel->create($company_data)) {
                    $this->session->setTempdata('success', 'Bank details update successful',3);
                    return redirect()->to('/settings');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to update bank details',3);
                    return redirect()->to(current_url());
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        
        return view('settings/index', $data);
    }

    public function add_user_role()
    {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Settings',
            'page_title' => 'Settings',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
        ];
        
        $rules = [
            'role' => 'required|is_unique[roles.role_name]'
        ];

        $data['validation'] = null;
        

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $role_data = [
                    'role_name' => $this->request->getVar('role')
                ];
                if ($this->settingsModel->addUserRole($role_data)) {
                    $this->session->setTempdata('success', 'User role successfully added',3);
                    return redirect()->to('/settings');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to add user role',3);
                    return redirect()->to(current_url());
                }
            }else{
                // $data['validation'] = $this->validator;
                $this->session->setTempdata('error', 'Role name exist',3);
                return redirect()->to('/settings');
            }
        }
        
        return view('settings/index', $data);
    }

    public function permission($role_id)
    {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('editPermission', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }
        if($role_id == 1 && session()->get('logged_user') != 1 ){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }
        
        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Permission',
            'page_title' => 'Permission',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'user_role' => $this->settingsModel->getUserRole($role_id)
        ];

        $data['validation'] = null;

        if ($this->request->getMethod() == 'post') {
            $permission_data = [
                'permissions' => serialize($this->request->getVar('permission'))
            ];
            if ($this->settingsModel->updatePermission($role_id, $permission_data)) {
                $this->session->setTempdata('success', 'Permission update successful',3);
                return redirect()->to('/privileges/'.$role_id);
            } else {
                $this->session->setTempdata('error', 'Unable to update permission',3);
                return redirect()->to('/privileges/'.$role_id);
            }
        }

        echo view('settings/permissions', $data);
    }

    public function deleteRole($id) {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }
        
        $do_delete = $this->settingsModel->deleteRole($id);
        if ($do_delete) {
            $this->session->setTempdata('success', 'User role delete successful',3);
        } else {
            $this->session->setTempdata('error', 'Unable to delete user role',3);
        }
        return redirect()->to('/settings');
    }

    public function addBusiness()
    {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Settings',
            'page_title' => 'Settings',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
        ];
        
        $rules = [
            'business_name' => 'required|is_unique[business.business_name]'
        ];

        $data['validation'] = null;
        

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $business_data = [
                    'business_name' => $this->request->getVar('business_name')
                ];
                if ($this->settingsModel->addBusiness($business_data)) {
                    $this->session->setTempdata('success', 'Business successfully added',3);
                    return redirect()->to('/settings');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to add business',3);
                    return redirect()->to('/settings');
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        
        return view('settings/index', $data);
    }

    public function editBusiness($business_id)
    {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Settings',
            'page_title' => 'Settings',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
        ];
        
        $rules = [
            'business_name' => 'required'
        ];

        $data['validation'] = null;
        

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $business_data = [
                    'business_name' => $this->request->getVar('business_name')
                ];
                if ($this->settingsModel->editBusiness($business_id,$business_data)) {
                    $this->session->setTempdata('success', 'Business edit successful',3);
                    return redirect()->to('/settings');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to edit business',3);
                    return redirect()->to('/settings');
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        
        return view('settings/index', $data);
    }

    public function deleteBusiness($id) {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }
        
        $do_delete = $this->settingsModel->deleteBusiness($id);
        if ($do_delete) {
            $this->session->setTempdata('success', 'Business delete successful',3);
        } else {
            $this->session->setTempdata('error', 'Unable to delete business',3);
        }
        return redirect()->to('/settings');
    }

    public function addOutlet()
    {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Settings',
            'page_title' => 'Settings',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
        ];
        
        $rules = [
            'outlet_name' => 'required|is_unique[outlets.outlet_name]'
        ];

        $data['validation'] = null;
        

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $outlet_data = [
                    'outlet_name' => $this->request->getVar('outlet_name'),
                    'outlet_businesses' => serialize($this->request->getVar('business'))
                ];
                if ($this->settingsModel->addOutlet($outlet_data)) {
                    $this->session->setTempdata('success', 'Outlet successfully added',3);
                    return redirect()->to('/settings');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to add outlet',3);
                    return redirect()->to('/settings');
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        
        return view('settings/index', $data);
    }

    public function editOutlet($outlet_id)
    {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Settings',
            'page_title' => 'Settings',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
        ];
        
        $rules = [
            'outlet_name' => 'required'
        ];

        $data['validation'] = null;
        

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $outlet_data = [
                    'outlet_name' => $this->request->getVar('outlet_name'),
                    'outlet_businesses' => serialize($this->request->getVar('business'))
                ];
                if ($this->settingsModel->editOutlet($outlet_id,$outlet_data)) {
                    $this->session->setTempdata('success', 'Outlet edit successful',3);
                    return redirect()->to('/settings');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to edit outlet',3);
                    return redirect()->to('/settings');
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        
        return view('settings/index', $data);
    }

    public function deleteOutlet($id) {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }
        
        $do_delete = $this->settingsModel->deleteOutlet($id);
        if ($do_delete) {
            $this->session->setTempdata('success', 'Outlet delete successful',3);
        } else {
            $this->session->setTempdata('error', 'Unable to delete outlet',3);
        }
        return redirect()->to('/settings');
    }

    public function addDepartment()
    {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Settings',
            'page_title' => 'Settings',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
        ];
        
        $rules = [
            'department_name' => 'required|is_unique[departments.department_name]',
            'hod' => 'required'
        ];

        $data['validation'] = null;
        

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $department_data = [
                    'department_name' => $this->request->getVar('department_name'),
                    'department_head' => $this->request->getVar('hod')
                ];
                if ($this->settingsModel->addDepartment($department_data)) {
                    $this->session->setTempdata('success', 'Department successfully added',3);
                    return redirect()->to('/settings');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to add department',3);
                    return redirect()->to('/settings');
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        
        return view('settings/index', $data);
    }

    public function editDepartment($department_id)
    {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Settings',
            'page_title' => 'Settings',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
        ];
        
        $rules = [
            'department_name' => 'required',
            'hod' => 'required'
        ];

        $data['validation'] = null;
        

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $department_data = [
                    'department_name' => $this->request->getVar('department_name'),
                    'department_head' => $this->request->getVar('hod')
                ];
                if ($this->settingsModel->editDepartment($department_id,$department_data)) {
                    $this->session->setTempdata('success', 'Department edit successful',3);
                    return redirect()->to('/settings');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to edit department',3);
                    return redirect()->to('/settings');
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        
        return view('settings/index', $data);
    }

    public function deleteDepartment($id) {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }
        
        $do_delete = $this->settingsModel->deleteDepartment($id);
        if ($do_delete) {
            $this->session->setTempdata('success', 'Department delete successful',3);
        } else {
            $this->session->setTempdata('error', 'Unable to delete department',3);
        }
        return redirect()->to('/settings');
    }

    public function addExpenseCategory()
    {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Settings',
            'page_title' => 'Settings',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
        ];
        
        $rules = [
            'exp_cat' => 'required|is_unique[expense_category.category_name]'
        ];

        $data['validation'] = null;
        

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $data = [
                    'category_name' => $this->request->getVar('exp_cat')
                ];
                if ($this->settingsModel->addExpenseCategory($data)) {
                    $this->session->setTempdata('success', 'Expense category successfully added',3);
                    return redirect()->to('/settings');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to add expense category',3);
                    return redirect()->to(current_url());
                }
            }else{
                // $data['validation'] = $this->validator;
                $this->session->setTempdata('error', 'Expense category name exist',3);
                return redirect()->to('/settings');
            }
        }
        
        return view('settings/index', $data);
    }

    public function deleteExpenseCategory($id) {
        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addSetting', $this->permission) || !in_array('editSetting', $this->permission) || !in_array('viewSetting', $this->permission) || !in_array('deleteSetting', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }
        
        $do_delete = $this->settingsModel->deleteExpenseCategory($id);
        if ($do_delete) {
            $this->session->setTempdata('success', 'Expense category delete successful',3);
        } else {
            $this->session->setTempdata('error', 'Unable to delete expense category',3);
        }
        return redirect()->to('/settings');
    }
}