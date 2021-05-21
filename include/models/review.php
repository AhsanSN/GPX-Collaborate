<?php
include_once("../../global.php");
include_once("../core/dbmodel.php");
include_once("../core/session.php");

$pk = "review_id"; // tables primary key is
$tableName = 'gpxCollaborate_reviews'; // database tablename

$loginUserId = $_SESSION['userId'];

if(isset($loginUserId)){
	/**
	* insert form data of orders form
	**/
	if(isset($_POST['CREATE_REVIEW'])){
		if(!empty($_POST['rate'])){
		    $createRecord = false;
			$data = [
				'review_id' => getRandomString(),
				'rate' => $_POST['rate'],
				'user_id' => $loginUserId,
				'post_id' => $_POST['post_id'],
				'description' => $_POST['description'],
				'difficulty_rates' => $_POST['difficulty_rates'],
				'view_rates' => $_POST['view_rates'],
				'crowdesness_rates' => $_POST['crowdesness_rates'],
				'surface_rates' => $_POST['surface_rates'],
			];
			$createRecord = save($con,$tableName,$data);
			if($createRecord){
				setFlash("review-error","Review added Successfully.","alert-success");
				header("Location: ../../post.php?id=".$data['post_id']);
				exit();
			}else{
				setFlash("review-error","Something went wrong, Please try again.","alert-danger");
				header("Location: ../../post.php?id=".$data['post_id']);
				exit();
			}
		}else{
			setFlash("review-error","Please choose all field correctly.","alert-danger");
			header("Location: ../../post.php?id=".$data['post_id']);
			exit();
		}
	}


	/**
	* Delete comment from table
	**/
	if(isset($_POST['DELETE_REVIEW'])){
		if($_POST['review_id'] && $_POST['post_id']){
			$pk_value = $_POST['review_id'];
			$post_id = $_POST['post_id'];
			$deleteRecord = delete($con,$tableName,$pk,$pk_value);
			if($deleteRecord){
				setFlash("review-error","Review removed.","alert-success");
				header("Location: ../../post.php?id=$post_id");
				exit();
			}else{
				setFlash("review-error","Something went wrong, Please try again.","alert-danger");
				header("Location: ../../post.php?id=$post_id");
				exit();
			}
		}else{
			setFlash("review-error","Something went wrong.","alert-danger");
			header("Location: ../../post.php?id=$post_id");
			exit();
		}
	}
}else{
	//if user is not authenticated auth middlware
	setFlash("review-error","You are not authenticated.","alert-warning");
	header("Location: ../../index.php");
	exit();
}
?>