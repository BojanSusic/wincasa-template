<?php
function get_slider(){
	$id = $_GET['id'];
	$slider = get_popups($id);
	return $slider;
}

function get_all_flats(){ 

		static $buildings = '';
	 if ($buildings) {
        return $buildings;
    }
	$buildings = do_shortcode("[get_wohnungen_all_table]");
	  return  $buildings ;		   
 
}
function get_free_flats(){ 
		static $freeFlats = '';
	 if ($freeFlats) {
        return $freeFlats;
    }
	$body = json_decode(file_get_contents('php://input'));
	if($body->device == 'desktop' ){
		$freeFlats = do_shortcode("[get_wohnungen_free_table]");
		return $freeFlats; 
		
	}else{
		$freeFlats = do_shortcode("[get_mobile_cards_wohnungen]");
		return $freeFlats ;
	}	   
 
}
function get_all_parking_spaces(){ 
	
		static $parking_spaces = '';
	 if ($parking_spaces) {
        return $parking_spaces;
    }
	$parking_spaces = do_shortcode("[get_park_all_table]");
	  return  $parking_spaces ;		   
 
}
function get_free_parking_spaces(){ 
		static $free_parking_spaces = '';
	 if ($free_parking_spaces) {
        return $free_parking_spaces;
    }
	$body = json_decode(file_get_contents('php://input'));
	if($body->device == 'desktop' ){
		$free_parking_spaces = do_shortcode("[get_park_free_table]");
		return $free_parking_spaces; 
		
	}else{
		$free_parking_spaces = do_shortcode("[get_mobile_cards_park]");
		return $free_parking_spaces ;
	}	   
 
}
function get_all_offices(){ 
	
		static $offices = '';
	 if ($offices) {
        return  $offices;
    }
	 $offices = do_shortcode("[get_gewerbe_all_table]");
	  return   $offices ;		   
 
}
function get_free_offices(){ 
		static $free_offices = '';
	 if ($free_offices) {
        return $free_offices;
    }
	$body = json_decode(file_get_contents('php://input'));
	if($body->device == 'desktop' ){
		$free_offices = do_shortcode("[get_gewerbe_free_table]");
		return $free_offices; 
		
	}else{
		$free_offices = do_shortcode("[get_mobile_cards_gewerbe]");
		return $free_offices ;
	}	   
 
}
add_action('rest_api_init', function () {

    register_rest_route('api/v1/', 'get-all-flats', [
        'methods' => 'POST',
        'callback' => 'get_all_flats',
    ]);
    register_rest_route('api/v1/', 'get-free-flats', [
        'methods' => 'POST',
        'callback' => 'get_free_flats',
    ]);
	    register_rest_route('api/v1/', 'get-all-parking-spaces', [
        'methods' => 'POST',
        'callback' => 'get_all_parking_spaces',
    ]);
	    register_rest_route('api/v1/', 'get-free-parking-spaces', [
        'methods' => 'POST',
        'callback' => 'get_free_parking_spaces',
    ]);
		    register_rest_route('api/v1/', 'get-all-offices', [
        'methods' => 'POST',
        'callback' => 'get_all_offices',
    ]);
	    register_rest_route('api/v1/', 'get-free-offices', [
        'methods' => 'POST',
        'callback' => 'get_free_offices',
    ]);
		    register_rest_route('api/v1/', 'get-slider', [
        'methods' => 'GET',
        'callback' => 'get_slider',
    ]);


});
