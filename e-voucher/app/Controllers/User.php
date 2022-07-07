<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class User extends Controller
{    

    public function create()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('addUser', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Add User',
            'page_title' => 'Add User',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'outlets' => $this->settingsModel->allOutlets(),
        ];
        $data['validation'] = null;

        $rules = [
            'user_role' => 'required',
            'first_name' => 'required|min_length[3]|max_length[16]',
            'last_name' => 'required|min_length[3]|max_length[16]',
            'user_password' => 'required|min_length[6]',
            'user_email' => 'required|valid_email|is_unique[users.email]',
            'user_status' => 'required',
            'outlet' => 'required'
        ];

        if ($this->request->getMethod() == 'post') {

            if ($this->validate($rules)) {
                $userdata = [
                    'user_role' => serialize($this->request->getVar('user_role')),
                    'first_name' => $this->request->getVar('first_name'),
                    'middle_name' => $this->request->getVar('middle_name'),
                    'last_name' => $this->request->getVar('last_name'),
                    'email' => $this->request->getVar('user_email'),
                    'mobile' => $this->request->getVar('user_mobile'),
                    'gender' => $this->request->getVar('gender'),
                    'user_status' => $this->request->getVar('user_status'),
                    'outlet' => $this->request->getVar('outlet'),
                    // 'department' => $this->request->getVar('department'),
                    // 'state' => $this->request->getVar('user_state'),
                    'address' => nl2br($this->request->getVar('address')),
                    'join_date' => date('d-m-Y'),
                    //'password' => password_hash($this->request->getVar('user_password'), PASSWORD_DEFAULT),
                    'password' => $this->request->getVar('user_password')
                ];
                if ($this->userModel->create($userdata)) {
                    $this->session->setTempdata('success', 'User added successfully',3);
                    return redirect()->to('/users');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to add user',3);
                    return redirect()->to(current_url());
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        return view('users/add', $data);
    }

    public function edit($user_id = '')
    {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('editUser', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Edit User Profile',
            'page_title' => 'Edit User Profile',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'user_info' => $this->userModel->getUserData($user_id),
            'outlets' => $this->settingsModel->allOutlets(),
        ];
        $data['validation'] = null;

        if ($this->request->getVar('user_password') == '') {
            $rules = [
                'user_role' => 'required',
                'first_name' => 'required|min_length[3]|max_length[16]',
                // 'middle_name' => 'required|min_length[3]|max_length[16]',
                'last_name' => 'required|min_length[3]|max_length[16]',
                'user_email' => 'required|valid_email',
                'user_mobile' => 'required|numeric|exact_length[11]',
                'gender' => 'required',
                'user_status' => 'required',
                // 'user_state' => 'required',
                // 'address' => 'required',
                'outlet' => 'required'
            ];
        }else{
            $rules = [
                'user_role' => 'required',
                'first_name' => 'required|min_length[3]|max_length[16]',
                // 'middle_name' => 'required|min_length[3]|max_length[16]',
                'last_name' => 'required|min_length[3]|max_length[16]',
                'user_email' => 'required|valid_email',
                'user_password' => 'min_length[6]',
                'user_mobile' => 'required|numeric|exact_length[11]',
                'gender' => 'required',
                'user_status' => 'required',
                // 'user_state' => 'required',
                // 'address' => 'required',
                'outlet' => 'required'
            ];
        }

        if ($this->request->getMethod() == 'post') {

            if ($this->validate($rules)) {
                if ($this->request->getVar('user_password') == '') {
                    $userdata = [
                        'user_role' => serialize($this->request->getVar('user_role')),                        
                        'outlet' => $this->request->getVar('outlet'),
                        'first_name' => $this->request->getVar('first_name'),
                        'middle_name' => $this->request->getVar('middle_name'),
                        'last_name' => $this->request->getVar('last_name'),
                        'email' => $this->request->getVar('user_email'),
                        'mobile' => $this->request->getVar('user_mobile'),
                        'gender' => $this->request->getVar('gender'),
                        'user_status' => $this->request->getVar('user_status'),
                        // 'state' => $this->request->getVar('user_state'),
                        'address' => $this->request->getVar('address')
                    ];
                }else{
                    $userdata = [
                        'user_role' => serialize($this->request->getVar('user_role')),
                        'outlet' => $this->request->getVar('outlet'),
                        'first_name' => $this->request->getVar('first_name'),
                        'middle_name' => $this->request->getVar('middle_name'),
                        'last_name' => $this->request->getVar('last_name'),
                        'email' => $this->request->getVar('user_email'),
                        'mobile' => $this->request->getVar('user_mobile'),
                        'gender' => $this->request->getVar('gender'),
                        'user_status' => $this->request->getVar('user_status'),
                        // 'state' => $this->request->getVar('user_state'),
                        'address' => nl2br($this->request->getVar('address')),
                        //'password' => password_hash($this->request->getVar('user_password'), PASSWORD_DEFAULT)
                        'password' => $this->request->getVar('user_password')
                    ];
                }
                if ($this->userModel->edit($user_id, $userdata)) {
                    $this->session->setTempdata('success', 'User profile edit successful',3);
                    return redirect()->to('/users');
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to edit user profile',3);
                    return redirect()->to(current_url());
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        return view('users/edit', $data);
    }


    public function view() {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('viewUser', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }
        
        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Users',
            'page_title' => 'Users',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'users' => $this->userModel->getAllUsers(),
            'outlets' => $this->settingsModel->allOutlets(),
        ];
        echo view('users/view', $data);
    }

    public function deleteUser($id) {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('deleteUser', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }
        
        $do_delete = $this->userModel->deleteUser($id);
        if ($do_delete) {
            $this->session->setTempdata('success', 'User delete successful',3);
        } else {
            $this->session->setTempdata('error', 'Unable to delete user',3);
        }
        return redirect()->to('/users');
    }

    public function user_profile($user_id = '') {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }
        if(!in_array('viewUser', $this->permission)){
            $this->session->setTempdata('error', 'You are not permitted to perform this action',3);
            return redirect()->to('/dashboard');
        }

        $user_data = $this->userModel->getUserData($user_id);
        $user_role = $user_data['user_role'];
        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'User Profile',
            'page_title' => 'User Profile',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'user_info' => $this->userModel->getUserData($user_id),
            'user_role' => $this->settingsModel->getUserRole($user_role),
        ];

        return view('users/profile', $data);
    }

    public function change_password() {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Change Password',
            'page_title' => 'User Profile',
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
        ];
        $data['validation'] = null;

        $rules = [
            'old_password' => 'required|is_not_unique[users.password]',
            'password' => 'required|min_length[8]|differs[users.password]',
            'passconf' => 'required|matches[password]',
        ];        

        $user_id = session()->get('logged_user');

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {                

                $password_data = [
                    'password' => $this->request->getVar('password')
                ];

                if ($this->userModel->edit($user_id, $password_data)) {
                    $this->session->setTempdata('success', 'User password changed successfully',3);
                    return redirect()->to(current_url());
                }else{
                    $this->session->setTempdata('error', 'Sorry! Unable to change user password',3);
                    return redirect()->to(current_url());
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }

        return view('users/change_password', $data);
    }
}