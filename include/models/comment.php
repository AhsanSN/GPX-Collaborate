<?php
include_once("../../global.php");
include_once("../core/dbmodel.php");
include_once("../core/session.php");

$pk = "comment_id"; // tables primary key is
$tableName = 'gpxcollaborate_comments'; // database tablename

$loginUserId = $_SESSION['userId'];

if(isset($loginUserId)){
	/**
	* insert form data of orders form
	**/
	if(isset($_POST['CREATE_COMMENT'])){
		if(!empty($_POST['body'])){
		    $createRecord = false;
			$data = [
				'comment_id' => getRandomString(),
				'body' => $_POST['body'],
				'user_id' => $loginUserId,
				'post_id' => $_POST['post_id'],
			];
			$createRecord = save($con,$tableName,$data);
			if($createRecord){
				setFlash("error","Comment added Successfully.","alert-success");
				header("Location: ../../post.php?id=".$data['post_id']);
				exit();
			}else{
				setFlash("error","Something went wrong, Please try again.","alert-danger");
				header("Location: ../../post.php?id=".$data['post_id']);
				exit();
			}
		}else{
			setFlash("error","Please choose all field correctly.","alert-danger");
			header("Location: ../../post.php?id=".$data['post_id']);
			exit();
		}
	}


	/**
	* Delete comment from table
	**/
	if(isset($_POST['DELETE_COMMENT'])){
		if($_POST['comment_id'] && $_POST['post_id']){
			$pk_value = $_POST['comment_id'];
			$post_id = $_POST['post_id'];
			$deleteRecord = delete($con,$tableName,$pk,$pk_value);
			if($deleteRecord){
				setFlash("error","Comment removed.","alert-success");
				header("Location: ../../post.php?id=$post_id");
				exit();
			}else{
				setFlash("error","Something went wrong, Please try again.","alert-danger");
				header("Location: ../../post.php?id=$post_id");
				exit();
			}
		}else{
			setFlash("error","Something went wrong.","alert-danger");
			header("Location: ../../post.php?id=$post_id");
			exit();
		}
	}
}else{
	//if user is not authenticated auth middlware
	setFlash("error","You are not authenticated.","alert-warning");
	header("Location: ../../index.php");
	exit();
}
?>