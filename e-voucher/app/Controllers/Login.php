<?php

namespace App\Controllers;
use CodeIgniter\Controller;


class Login extends Controller
{
    
    public function index()
    {
        $data = [
            'user_permission' => $this->permission,
            'company_data' => $this->settingsModel->getCompanyData()
        ]; 
        $data['validation'] = null;
       
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        if ($this->request->getMethod() == 'post') {

            if ($this->validate($rules)) {
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');

                $userdata = $this->loginModel->verifyEmail($email);

                if ($userdata) {
                    // if (password_verify($password, $userdata['password'])) {
                    if ($password === $userdata['password']) {
                        if ($userdata['user_status'] == 1) {
                            $this->session->set('logged_user', $userdata['user_id']);
                            $this->session->set('username', $userdata['email']);
                            $this->session->set('name', $userdata['first_name']);
                            $this->session->set('profile_pic', $userdata['profile_pic']);
                            $this->session->set('outlet', $userdata['outlet']);
                            $this->session->setTempdata('success', 'Login successful! Welcome back',3);
                            return redirect()->to('/dashboard');
                        }else{
                            $this->session->setTempdata('error', 'This account is inactive. Please reach out to the admin',3);
                            return redirect()->to(current_url());
                        }
                    }else{
                        $this->session->setTempdata('error', 'Sorry! Wrong password entered for that username',3);
                        return redirect()->to(current_url());
                    }                    
                }else{
                    $this->session->setTempdata('error', 'Sorry! User username does not exist',3);
                    return redirect()->to(current_url());
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        return view('login', $data);
    }

    public function logout() {        
        $this->session->setTempdata('success', 'You are successfully logged out',3);
        session()->remove('logged_user');
        session()->destroy();
        return redirect()->to('/login');
    }
}