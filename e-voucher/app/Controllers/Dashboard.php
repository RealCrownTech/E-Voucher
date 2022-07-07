<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Dashboard extends Controller
{

    public function index() {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Dashboard',
            'page_title' => 'Dashboard',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'users' => $this->userModel->getUserCount(),
            'outlets' => $this->settingsModel->getOutletCount(),
            'businesses' => $this->settingsModel->getBusinessCount()
        ];
        
        return view('dashboard', $data);
    }

    public function changelog() {
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }

        $data = [
            'user_permission' => $this->permission,
            'page_name' => 'Change Log',
            'page_title' => 'Change Log',            
            'company_data' => $this->settingsModel->getCompanyData(),
            'roles_data' => $this->settingsModel->getUserRoles(),
            'other_roles_data' => $this->settingsModel->getOtherUserRoles(),
            'users' => $this->userModel->getUserCount(),
            'outlets' => $this->settingsModel->getOutletCount(),
            'businesses' => $this->settingsModel->getBusinessCount()
        ];
        
        return view('changelog', $data);
    }
}