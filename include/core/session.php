<?php
	session_start();
    
	function setFlash($key, $value, $type){
        $_SESSION['flash_msg'][$key] = ['type' => $type, 'msg' => $value];
    }

    function getFlash($key){
        return $_SESSION['flash_msg'][$key]['msg'] ?? false;
    }

    function getFlashType($key){
    	return $_SESSION['flash_msg'][$key]['type'] ?? false;
    }

    function removeFlash($key){
        unset($_SESSION['flash_msg'][$key]);
    }
?>