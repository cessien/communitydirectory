<?php
	global $wpdb;
	private $TABLE_PERSON = "npcc_person";
	private $TABLE_FAMILY = "npcc_family";
	private $TABLE_COMMUNITY = "npcc_community";
	private $TABLE_COMMUNITY_ROLE = "npcc_community_role";
	private $TABLE_RELATIONSHIP = "npcc_relationship";
	
    $action = $_GET['action'];
	$type = $_GET['type'];
	

    if ($action == "name") {
		$_SESSION['person']['first_name'] = $_POST['first_name'];
		$_SESSION['person']['middle_name'] = $_POST['middle_name'];
		$_SESSION['person']['last_name'] = $_POST['name_name'];
        echo "sucessfully added your changes";
    } else if ($action == "profile-picture"){
		$_SESSION['person']['picture'] = $_POST['picture'];
        echo "successfully uploaded your profile picture";
    }  else if ($action == "age-sex"){
		$_SESSION['person']['birthday'] = $_POST['birthday'];
		$_SESSION['person']['sex'] = $_POST['sex'];
        echo "successfully uploaded birthday";
    }  else if ($action == "location-info"){
		$_SESSION['person']['address_line1'] = $_POST['address_line1'];
		$_SESSION['person']['address_line2'] = $_POST['address_line2'];
		$_SESSION['person']['city'] = $_POST['city'];
		$_SESSION['person']['zip'] = $_POST['zip'];
		$_SESSION['person']['state'] = $_POST['state'];
        echo "successfully uploaded location information";
    }  else if ($action == "contact-info"){
		$_SESSION['person']['primary_email'] = $_POST['birthday'];
		$_SESSION['person']['primary_phone'] = $_POST['primary_phone'];
        echo "successfully uploaded contact information";
    } 
	
	if ($action == "all"){
		if ($type == "person"){
			$_SESSION['person']['first_name'] = $_POST['first_name'];
			$_SESSION['person']['middle_name'] = $_POST['middle_name'];
			$_SESSION['person']['last_name'] = $_POST['name_name'];
			
			#$_SESSION['person']['picture'] = $_POST['picture'];

			#$_SESSION['person']['birthday'] = $_POST['birthday'];
			#$_SESSION['person']['sex'] = $_POST['sex'];

			#$_SESSION['person']['address_line1'] = $_POST['address_line1'];
			#$_SESSION['person']['address_line2'] = $_POST['address_line2'];
			#$_SESSION['person']['city'] = $_POST['city'];
			#$_SESSION['person']['zip'] = $_POST['zip'];
			#$_SESSION['person']['state'] = $_POST['state'];

			#$_SESSION['person']['primary_email'] = $_POST['birthday'];
			#$_SESSION['person']['primary_phone'] = $_POST['primary_phone'];
			
			submit_person($_SESSION['person']);
		}
	}
	
	function submit_person($person){
		$wpdb->insert(
			$TABLE_PERSON,
			$person
		);
	}

?>