<?php
/**
 * Base Controller file for Plugin DocumentManager
 * Modify getUserId() and isAdmin() to match your Users management method  
 */

class DocumentManagerAppController extends AppController {
	public $helpers = array('DocumentManager.DocumentManager');
	public $components = array('DocumentManager.Documents');
	
	/**
	 * Checks if the current User has Admin rights or not 
	 */
	public function hasAdminRights() {
		if( !Configure::read('DocumentManager.authentification') || $this->isAdmin()) {// User has admin rights
			return true;
		};
		return false;
	}
	
	/**
	 * Checks if a folder belongs to a User, i.e. all files in thise folder belongts to him
	 */
	public function folderBelongsToUser($path) {
		if( !Configure::read('DocumentManager.authentification') || $this->Document->checkFolder($path, $this->getUserId())) {// file can be changed by current user
			return true;
		};
		return false;
	}
	
	/**
	 * Checks if the file belongs to a User
	 */
	public function fileBelongsToUser($user_id) {
		if( !Configure::read('DocumentManager.authentification') || $this->getUserId() == $user_id) {// file can be changed by current user
			return true;
		};
		return false;
	}
	
	/**
	 * Returns the logged user id, if not logged, return null 
	 */
	public function getUserId() {
		return $this->Authake->getUserId();
	}
	
	public function isAdmin() {
		return $this->Authake->isMemberOf(1);
	}
	
}

