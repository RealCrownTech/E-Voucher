<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class FileUpload extends Controller
{
	public function img_upload($type) {	
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'file_name' => 'uploaded[file_name]|max_size[file_name,1024]|ext_in[file_name,png,jpg,gif]',
			];
			if($this->validate($rules)){
				$file = $this->request->getFile('file_name');
				if ($file->isValid() && !$file->hasMoved()) {
					$newName = $file->getRandomName();
					//echo $type .' - ' . $newName;
					$data = [
						$type => $newName,
					];
					if ($this->settingsModel->img_upload($data)) {
						// $newName = $file->getName();
						if ($file->move('public/assets/img/photos/', $newName)) {
							$this->session->setTempdata('success', 'Image upload successful',3);
	                        return redirect()->to('/settings');
						} else {
							echo $file->getErrorString()." ".$file->getError();
						}
					}
				}
			}
		}
	}

	public function profile_upload($user_id) {	
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'file_name' => 'uploaded[file_name]|max_size[file_name,5120]|ext_in[file_name,png,jpg,gif]',
			];
			if($this->validate($rules)){
				$file = $this->request->getFile('file_name');
				if ($file->isValid() && !$file->hasMoved()) {
					$newName = $file->getRandomName();
					//echo $type .' - ' . $newName;
					$data = [
						'profile_pic' => $newName,
					];
					if ($this->userModel->profile_upload($data,$user_id)) {
						// $newName = $file->getName();
						if ($file->move('public/assets/img/avatars/', $newName)) {
							$this->session->setTempdata('success', 'Profile picture upload successful',3);
	                        return redirect()->to('/viewUser/'.$user_id);
						} else {
							echo $file->getErrorString()." ".$file->getError();
						}
					}
				}
			}
		}
	}
}