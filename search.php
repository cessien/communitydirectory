<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wordpress/wp-config.php' );
global $wpdb;

if(!session_id()) {
    session_start();
}

$data = json_decode(file_get_contents("php://input"));
$keyword = $data->keywords;
?>
<?php
if ( $_GET["action"] == "init" && $_GET["step"] == "family") { //Get all families to return to the client via JSON
    //Query the family table for familes
    $query = "SELECT npcc_person.first_name, npcc_person.last_name, npcc_family.name, npcc_family.uid, npcc_family.city, npcc_family.state FROM npcc_person INNER JOIN npcc_family ON npcc_person.family_uid = npcc_family.uid ORDER BY npcc_family.name ASC, npcc_family.uid LIMIT 0, 500";
    
    //store and pass the results as JSON
    $results = $wpdb->get_results($query,ARRAY_A);
    
    echo json_encode($results);
    
} else if($_GET["action"] == "init" && $_GET["step"] == "communities") {
    
     $query = "SELECT * FROM npcc_community WHERE 1 LIMIT 0, 500";
    
    //store and pass the results as JSON
    $results = $wpdb->get_results($query,ARRAY_A);
    
    echo json_encode($results);
    
} else if ( $_GET["action"] == "family" && !isset($_GET["fam"])){ //Search by last name for family records
    //Query the family table for familes
    $query = "SELECT uid FROM npcc_family WHERE SOUNDEX(name) = SOUNDEX('".$keyword."') OR name LIKE '%".$keyword."%' LIMIT 0, 30";
    
    //store and pass the results as JSON
    $results = $wpdb->get_results($query,ARRAY_A);
    
    echo json_encode($results);
 
} else if ( $_GET["action"] == "family" && isset($_GET["fam"])) { //Search for a specific family record 
    $query = "SELECT *, LPAD(npcc_family.zipcode, 5, '0') FROM npcc_family WHERE uid = ".$_GET["fam"]." LIMIT 0,1";
    
    //store and pass the results as JSON
    $results = $wpdb->get_results($query,ARRAY_A);
    
    echo json_encode($results);

} else if ( $_GET["action"] == "init-communities") { //Search for a specific family record 
    $query = "SELECT * FROM npcc_community RIGHT OUTER JOIN npcc_community_role ON npcc_community.uid=npcc_community_role.community_uid RIGHT OUTER JOIN  npcc_person ON npcc_community_role.person_uid=npcc_person.uid GROUP BY npcc_community.name, npcc_community_role.role";
    
    //store and pass the results as JSON
    $results = $wpdb->get_results($query,ARRAY_A);
    
    echo json_encode($results);

} else if ( $_GET["action"] == "init-people") {
    $query = "SELECT LPAD(npcc_person.zipcode, 5, '0'), npcc_person.*, npcc_family.name FROM npcc_person LEFT OUTER JOIN npcc_family ON npcc_person.family_uid = npcc_family.uid ORDER BY npcc_person.family_uid ASC, npcc_family.uid LIMIT 0, 5000";
    //$query = "SELECT * from npcc_person ORDER BY family_uid ASC";
    
    //store and pass the results as JSON
    $results = $wpdb->get_results($query,ARRAY_A);

    echo json_encode($results);
} else if ( $_GET["action"] == "init-family" ) {
    //Query the family table for familes
    $query = "SELECT npcc_person.first_name, npcc_family.* FROM npcc_person INNER JOIN npcc_family ON npcc_person.family_uid = npcc_family.uid ORDER BY npcc_family.name ASC, npcc_family.uid LIMIT 0, 500";

    //store and pass the results as JSON
    $results = $wpdb->get_results($query,ARRAY_A);
    $familiesArray = array();

    foreach($results as $row){
        $uid = $row['uid'];
        if(!$familiesArray[$uid]){
            $familiesArray[$uid]['uid'] = $uid;
            $familiesArray[$uid]['name'] = $row['name'];
            $familiesArray[$uid]['primary_email'] = $row['primary_email'];
            $familiesArray[$uid]['secondary_email'] = $row['secondary_email'];
            $familiesArray[$uid]['primary_phone'] = $row['primary_phone'];
            $familiesArray[$uid]['secondary_phone'] = $row['secondary_phone'];
            $familiesArray[$uid]['address_line1'] = $row['address_line1'];
            $familiesArray[$uid]['address_line2'] = $row['address_line2'];
            $familiesArray[$uid]['city'] = $row['city'];
            $familiesArray[$uid]['state'] = $row['state'];
            $familiesArray[$uid]['zipcode'] = $row['zipcode'];
            $familiesArray[$uid]['members'] = array($row['first_name']);
        } else {
            array_push($familiesArray[$uid]['members'], $row['first_name']);
        }
    }

    echo json_encode($familiesArray);

//    echo json_encode($results);
} else {?>
NOT DATA
<?php }?>