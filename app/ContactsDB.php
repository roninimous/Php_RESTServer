<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactsDB
 *
 * @author s4597377
 */
class ContactsDB {

    //put your code here
    var $pdo;
    var $dsn = "mysql:host=localhost;dbname=vbookingsdb";
    var $username = "root";
    var $password = "";

    function __construct() {
        $this->pdo = new PDO($this->dsn, $this->username, $this->password);
    }

    function getContacts() {
        // prepare the SQL statement
        $sql = "select * from vbookings";
        // Query the database for records 
        $statement = $this->pdo->query($sql);
        //Set the fetch mode to return Associative Array
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        // Fetch all records
        $records = $statement->fetchAll();
        return $records;
    }

    function getContact($id) {
        $record = [];
        // prepare the SQL statement
        $sql = "select * from vbookings where id = $id";
        // Query the database for records 
        $statement = $this->pdo->query($sql);
        //Set the fetch mode to return Associative Array
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        // Fetch all records
        $record = $statement->fetchAll();
        return $record;
    }

    function addContact($values) {
        $sql = "insert into vbookings 
        (first_name, last_name,email,mobile,booking_date,booking_time,image_filename)
        values (?,?,?,?,?,?,?)";

//Create a prepared statement to insert records using wild cards 
        $statement = $this->pdo->prepare($sql);

//Execute insert records pass the array of values
        $success = $statement->execute($values);
        return $success;
    }

    function deleteContact($id) {
        $sql = "delete from vbookings where id = $id";

        //Create a query statement to select all records from Contacts 
        $statement = $this->pdo->query($sql);

        $success = $statement->execute();
        return $success;
    }

    function searchContact($keyword) {
        $sqlSearch = "Select * from vbookings where
        id like '%$keyword%'
        or first_name like '%$keyword%'
        or last_name like '%$keyword%'
        or email like '%$keyword%'
        or mobile like '%$keyword%'
        or booking_date like '%$keyword%'
        or booking_time like '%$keyword%'";
//        or photo_filename like '%$keyword%'";

//Create a query statement to select all records matching keyword
        $statement = $this->pdo->query($sqlSearch);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $records = $statement->fetchAll();
        return $records;
    }

    function editContact($id, $values) {
        $sql = "update vbookings set first_name = ?,last_name = ?,email = ?,
        mobile = ?,booking_date = ?, booking_time = ?, image_filename = ? where id = $id";

//Create a prepared statement to insert records using wild cards 
        $statement = $this->pdo->prepare($sql);

//Execute insert records pass the array of values
        $success = $statement->execute($values);
        return $success;
    }

}
