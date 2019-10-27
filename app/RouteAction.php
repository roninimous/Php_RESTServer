<?php

/**
 * Description of RouteAction
 * Defines the functions that correspond to the route actions
 */
include_once 'ContactsDB.php';

class RouteAction {

    var $contacts;

    function __construct() {
        $this->contacts = new ContactsDB();
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

    function getContacts($request, $response, $args) {
        $records = $this->contacts->getContacts();
        // return response header for JSON body content type
        return $response->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($records));
    }
    
    function getContact($request, $response, $args) {
        $id = $args['id'];
        $record = $this->contacts->getContact($id);
        // return response header for JSON body content type
        return $response->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($record));
    }
    
    function deleteContact($request, $response, $args) {
        $id = $args['id'];
        $success = $this->contacts->deleteContact($id);
        // return response header for JSON body content type
        return $response->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($success));
    }

    function searchContacts($request, $response, $args) {
        $keyword = $args['keyword'];
        $records = $this->contacts->searchContact($keyword);
        // return response header for JSON body content type
        return $response->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($records));
    }

    function addContact($request, $response, $args) {
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


        $success = $this->contacts->addContact($values);
        if ($success) {
            $message = "Contact has successfully added to Database. Loading View Contacts page in 5 seconds";
        } else {
            $message = 'Contact failed to add to Database';
        }
        $data = ['message' => $message];
        // return response header for JSON body content type
        return $response->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($data));
    }
    
    
    function updateContact($request, $response, $args) {
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


        $success = $this->contacts->editContact($id,$values);
        if ($success) {
            $message = "Contact has successfully updated. Loading View Contacts page in 5 seconds";
        } else {
            $message = 'Contact failed to updated';
        }
        $data = ['message' => $message];
        // return response header for JSON body content type
        return $response->withHeader('Content-Type', 'application/json')
                        ->write(json_encode($data));
    }

}
