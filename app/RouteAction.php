<?php

/**
 * Description of RouteAction
 * Defines the functions that correspond to the route actions
 */
include_once 'ContactsDB.php';
include_once 'VbookingsDB.php';
class RouteAction {

    var $contacts;
    var $bookings;

    function __construct() {
        $this->contacts = new ContactsDB();
        $this->bookings = new VbookingsDB();
    }

    function index($request, $response, $args) {
        return $response->write("<h1>Welcome to the REST Server page</h1>");
    }

    function getData($request, $response, $args) {

        // example records
        $records = [
            ['name' => 'John Smith', 'email' => 'john@yahoo.com', 'mobile' => '0412345678'],
            ['name' => 'Susan Jones', 'email' => 'susan@yahoo.com', 'mobile' => '0412345679'],
            ['name' => 'Peter Williams', 'email' => 'peter@yahoo.com', 'mobile' => '0412345677'],
            ['name' => 'Alice Richards', 'email' => 'alic@yahoo.com', 'mobile' => '0412345676']
        ];
        // return response header for JSON body content type
        return $response->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($records));
    }

    function getBookings($request, $response, $args) {
        $records = $this->bookings->getBookings();
        // return response header for JSON body content type
        return $response->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($records));
    }
    
    function getBooking($request, $response, $args) {
        $id = $args['id'];
        $record = $this->bookings->getBooking($id);
        // return response header for JSON body content type
        return $response->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($record));
    }
    
    function deleteBooking($request, $response, $args) {
        $id = $args['id'];
        $success = $this->bookings->deleteBooking($id);
        if ($success) {
            $message = "Booking has successfully deleted. Loading View Bookings page in 5 seconds";
        } else {
            $message = 'Booking failed to delete';
        }
        $data = ['message' => $message];
        // return response header for JSON body content type
        return $response->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($data));
    }

    function searchBookings($request, $response, $args) {
        $keyword = $args['keyword'];
        $records = $this->bookings->searchBookings($keyword);
        // return response header for JSON body content type
        return $response->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($records));
    }

    function addBooking($request, $response, $args) {
        $post = $request->getParsedBody();
        
        $first_name = $post["first_name"];
        $last_name = $post["last_name"];
        $email = $post["email"];
        $mobile = $post["mobile"];
        $booking_date = $post["booking_date"];
        $booking_time = $post["booking_time"];
        $venue = $post["venue"];
        $image_filename = $post['image_filename'];
        $values = ["$first_name", "$last_name", "$email", "$mobile", "$booking_date", "$booking_time", "$venue", "$image_filename"];
        $success = $this->bookings->addBooking($values);
        if ($success) {
            $message = "Booking has successfully added to Database. Loading View Bookings page in 5 seconds";
        } else {
            $message = 'Booking failed to add to Database';
        }
        $data = ['message' => $message];
        // return response header for JSON body content type
        return $response->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($data));
    }
    
    
    function editBooking($request, $response, $args) {
        $post = $request->getParsedBody();
        $id = $args['id'];
        $first_name = $post["first_name"];
        $last_name = $post["last_name"];
        $email = $post["email"];
        $mobile = $post["mobile"];
        $booking_date = $post["booking_date"];
        $booking_time = $post["booking_time"];
        $venue = $post["venue"];
        $image_filename = $post['image_filename'];
        $values = ["$first_name", "$last_name", "$email", "$mobile", "$booking_date", "$booking_time", "$venue", "$image_filename"];

        $success = $this->bookings->editBooking($id,$values);
        if ($success) {
            $message = "Booking has successfully updated. Loading View Bookings page in 5 seconds";
        } else {
            $message = 'Booking failed to update';
        }
        $data = ['message' => $message];
        // return response header for JSON body content type
        return $response->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($data));
    }

}
