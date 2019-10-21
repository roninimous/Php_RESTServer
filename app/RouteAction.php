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

    function index($request, $response, $args){
        return $response->write("<h1>Welcome to the REST Server page</h1>");
    }

    function getData($request, $response, $args){
        
        // example records
        $records = [
        
            ['name'=>'John Smith', 'email'=>'john@yahoo.com', 'mobile'=>'0412345678'],
            ['name'=>'Susan Jones', 'email'=>'susan@yahoo.com', 'mobile'=>'0412345679'],
            ['name'=>'Peter Williams', 'email'=>'peter@yahoo.com', 'mobile'=>'0412345677'],
            ['name'=>'Alice Richards', 'email'=>'alic@yahoo.com', 'mobile'=>'0412345676']
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

}

