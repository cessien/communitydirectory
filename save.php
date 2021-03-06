<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/wordpress/wp-config.php' );
	global $wpdb;
	
    if(!session_id()) {
        session_start();
    }

	$TABLE_PERSON = "npcc_person";
	$TABLE_FAMILY = "npcc_family";
	$TABLE_COMMUNITY = "npcc_community";
	$TABLE_COMMUNITY_ROLE = "npcc_community_role";
	$TABLE_RELATIONSHIP = "npcc_relationship";
	
    $action = $_GET['action'];

    if ($action == "name") {
        echo "saved your basic name information";
		$_SESSION['person']['first_name'] = $_POST['first_name'];
		$_SESSION['person']['middle_name'] = $_POST['middle_name'];
		$_SESSION['person']['last_name'] = $_POST['name_name'];
        echo "sucessfully added your changes";
    } else if ($action == "profile-picture"){
		$_SESSION['person']['profile_picture'] = $_POST['profile_picture'];
        echo "successfully uploaded your profile picture";
    }  else if ($action == "age-sex"){
		$_SESSION['person']['birthday'] = $_POST['birthday'];
		$_SESSION['person']['sex'] = $_POST['sex'];
        echo "successfully uploaded birthday";
    }  else if ($action == "location-info"){
		$_SESSION['person']['address_line1'] = $_POST['address_line1'];
		$_SESSION['person']['address_line2'] = $_POST['address_line2'];
		$_SESSION['person']['city'] = $_POST['city'];
		$_SESSION['person']['zipcode'] = $_POST['zipcode'];
		$_SESSION['person']['state'] = $_POST['state'];
        echo "successfully uploaded location information";
    }  else if ($action == "contact-info"){
		$_SESSION['person']['primary_email'] = $_POST['primary_email'];
		$_SESSION['person']['primary_phone'] = $_POST['primary_phone'];
        echo "successfully uploaded contact information";
    } 
	
	if ($action == "all"){
		$type = $_GET['type'];
		if ($type == "person"){
            //TODO make sure js passes every parameter in the sql
			$_SESSION['person']['first_name'] = $_POST['first_name'];
			$_SESSION['person']['middle_name'] = $_POST['middle_name'];
			$_SESSION['person']['last_name'] = $_POST['last_name'];

            $_SESSION['person']['birthday'] = $_POST['birthday'];
            $_SESSION['person']['sex'] = $_POST['sex'];
//
            $_SESSION['person']['profile_picture'] = $_POST['profile_picture'];
//
            $_SESSION['person']['address_line1'] = $_POST['address_line1'];
            $_SESSION['person']['address_line2'] = $_POST['address_line2'];
            $_SESSION['person']['city'] = $_POST['city'];
            $_SESSION['person']['zipcode'] = $_POST['zipcode'];
            $_SESSION['person']['state'] = $_POST['state'];
//
            $_SESSION['person']['primary_email'] = $_POST['primary_email'];
			$_SESSION['person']['primary_phone'] = $_POST['primary_phone'];
            $_SESSION['person']['member'] = $_POST['member'];

            $_SESSION['person']['date_updated'] = current_time('mysql', '1');

            echo "Create new person";
			createPerson($_SESSION['person']);
		} else if($type == "family"){
            $fam_action = $_POST['action'];
            if ($fam_action == "create" || $fam_action == "update"){
                $_SESSION['family']['name'] = $_POST['name'];
                $_SESSION['family']['primary_email'] = $_POST['primary_email'];
                $_SESSION['family']['secondary_email'] = $_POST['secondary_email'];
                $_SESSION['family']['primary_email'] = $_POST['primary_email'];
                $_SESSION['family']['secondary_email'] = $_POST['secondary_email'];
                $_SESSION['family']['address_line1'] = $_POST['address_line1'];
                $_SESSION['family']['address_line2'] = $_POST['address_line2'];
                $_SESSION['family']['city'] = $_POST['city'];
                $_SESSION['family']['zipcode'] = $_POST['zipcode'];

                $_SESSION['person']['date_updated'] = current_time('mysql', '1');

                if($fam_action == "create"){
                    $_SESSION['person']['date_created'] = current_time('mysql', '1');
                    echo "Create new family";
                    createFamily($_SESSION['family']);
                } else {
                    echo "Updating family";

                }
            }

        }
	}



	function createPerson($person){
		global $wpdb;
        global $TABLE_PERSON;
		$result = $wpdb->insert(
			$TABLE_PERSON,
			$person
		);
        if ($result === 1){
            echo "uid:".$wpdb->insert_id;
            $_SESSION['person']['uid'] = $wpdb->insert_id;
        } else {
            echo "failed to insert new person";
        }
	}

    function editPerson($person){
        global $wpdb;
        global $TABLE_PERSON;
        $result = $wpdb->update(
            $TABLE_PERSON,
            $person,
            array( 'uid' => $person->uid ),
            null,
            array( '%d' )
        );
        if ($result === 1){
            echo "udpated person".$wpdb->insert_id;
        } else {
            echo "failed to update person";
        }
    }

    function deletePerson($person){
        global $wpdb;
        global $TABLE_PERSON;
        $result = $wpdb->delete(
            $TABLE_PERSON,
            array( 'uid' => $person->uid ),
            array( '%d' )
        );
        if ($result === 1){
            echo "deleted person".$wpdb->insert_id;
        } else {
            echo "failed to delete person";
        }
    }

    function createFamily($family){
        global $wpdb;
        global $TABLE_FAMILY;
        $result = $wpdb->insert(
            $TABLE_FAMILY,
            $family
        );
        if ($result === 1){
            echo "uid:".$wpdb->insert_id;
            $_SESSION['family']['uid'] = $wpdb->insert_id;
            $_SESSION['person']['family_uid'] = $wpdb->insert_id;
            editPerson($_SESSION['person']);
        } else {
            echo "failed to insert new person";
        }
    }

    function editFamily($family){
        global $wpdb;
        global $TABLE_FAMILY;
        $result = $wpdb->update(
            $TABLE_FAMILY,
            $family,
            array( 'uid' => $family->uid ),
            null,
            array( '%d' )
        );
        if ($result === 1){
            echo "udpated family".$wpdb->insert_id;
        } else {
            echo "failed to update family";
        }
    }

    //TODO get final structure of family and members
    function addPersonToFamily($person_uid, $family_uid){
        global $wpdb;
        global $TABLE_FAMILY;
        $wpdb->insert(

        );
    }

    function deleteFamily($family){
        global $wpdb;
        global $TABLE_FAMILY;
        $result = $wpdb->delete(
            $TABLE_FAMILY,
            array( 'uid' => $family->uid ),
            array( '%d' )
        );
        if ($result === 1){
            echo "deleted family".$wpdb->insert_id;
        } else {
            echo "failed to delete family";
        }
    }

?>