<?php
    $action = $_GET['action'];

    if ($action == "name") {
        echo "saved you basic name information";
    } else if ($action == "profile-picture"){
        echo "successfully uploaded your profile picture";
    }  else if ($action == "age-sex"){
        echo "successfully uploaded birthday";
    }  else if ($action == "location-info"){
        echo "successfully uploaded location information";
    }  else if ($action == "contact-info"){
        echo "successfully uploaded contact information";
    } 

?>