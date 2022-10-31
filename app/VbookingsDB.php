<?php


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'vbookingsdb');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
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
class VbookingsDB {

    //put your code here
    var $pdo;
    var $dsn = "mysql:host=localhost;dbname=vbookingsdb";
    var $username = "root";
    var $password = "";

    function __construct() {
        $this->pdo = new PDO($this->dsn, $this->username, $this->password);
    }

    function getBookings() {
        // prepare the SQL statement
        $sql = "select * from vbookings";
        // Query the database for records 
        $statement = $this->pdo->query($sql);
        //!Set the fetch mode to return Associative Array
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        // Fetch all records
        $records = $statement->fetchAll();
        return $records;
    }

    function getBooking($id) {
//        $record = [];
        // prepare the SQL statement
        $sql = "select * from vbookings where id = $id";
        // Query the database for records 
        $statement = $this->pdo->query($sql);
        //Set the fetch mode to return Associative Array
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        // Fetch all records
        $records = $statement->fetchAll();
        return $records[0];
    }

    function getProfile($id) {
        //        $record = [];
                // prepare the SQL statement
                $sql = "select * from useraccount where id = $id";
                // Query the database for records 
                $statement = $this->pdo->query($sql);
                //Set the fetch mode to return Associative Array
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                // Fetch all records
                $records = $statement->fetchAll();
                return $records;
            }

    function addBooking($values) {
        $sql = "insert into vbookings 
        (first_name, last_name,email,mobile,booking_date,booking_time,venue,image_filename)
        values (?,?,?,?,?,?,?,?)";

//Create a prepared statement to insert records using wild cards 
        $statement = $this->pdo->prepare($sql);

//Execute insert records pass the array of values
        $success = $statement->execute($values);
        return $success;
    }
    
    function addUsers($values) {
        $sql = "insert into useraccount 
        (email,password,last_name,first_name,phone)
        values (?,?,?,?,?)";

//Create a prepared statement to insert records using wild cards 
        $statement = $this->pdo->prepare($sql);

//Execute insert records pass the array of values
        $success = $statement->execute($values);
        return $success;
    }

    function deleteBooking($id) {
        $sql = "delete from vbookings where id = $id";

        //Create a query statement to select all records from Contacts 
        $statement = $this->pdo->query($sql);

        $success = $statement->execute();
        return $success;
    }

    function searchBookings($keyword) {        
        $sqlSearch = "Select * from vbookings where
        id like '%$keyword%'
        or first_name like '%$keyword%'
        or last_name like '%$keyword%'
        or email like '%$keyword%'
        or mobile like '%$keyword%'
        or booking_date like '%$keyword%'
        or venue like '%$keyword%'
        or booking_time like '%$keyword%'";
//        or photo_filename like '%$keyword%'";

//Create a query statement to select all records matching keyword
        $statement = $this->pdo->query($sqlSearch);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $records = $statement->fetchAll();
        return $records;
    }
    // search for matching user account
    function searchAccounts($email,$password) {
//        $sqlSearch = "Select * from useraccount where
//        email = '$email'
//        AND password = '$password'";
       $sqlSearch = "SELECT * FROM useraccount where email = '$email' and password = '$password'";

//Create a query statement to select all records matching keyword
        $statement = $this->pdo->query($sqlSearch)->fetchColumn();
//                $statement->setFetchMode(PDO::FETCH_ASSOC);
//                $statement = $this->pdo->prepare($statement);
//        $records = $statement->fetchAll();
//        $statement->execute();
//        $num_row = $statement->fetchColumn();
        // echo $statement;


        if ($statement==0){
            $result = false;
     
        }
        else{
            $result = true;
           
        }
       
return $result;
//        return $records;
    //    return $statement;
    }
    
    
    // search for matching user account
    function loginUser($email,$password) {
//        $sqlSearch = "Select * from customer where
//        email = '$email'
//        AND password = '$password'";
       $sqlSearch = "SELECT first_name FROM useraccount where email = '$email' and password = '$password'";

//Create a query statement to select all records matching keyword
        $statement = $this->pdo->query($sqlSearch)->fetchColumn();

return $statement;
//        return $records;
//        return $statement;
    }
// TODO: fetch all column and return as array or json instead of single value.
    function loginId($email,$password) {
        //        $sqlSearch = "Select * from customer where
        //        email = '$email'
        //        AND password = '$password'";
               $sqlSearch = "SELECT id FROM useraccount where email = '$email' and password = '$password'";
        
        //Create a query statement to select all records matching keyword
                $statement = $this->pdo->query($sqlSearch)->fetchColumn();
        
        return $statement;
        //        return $records;
        //        return $statement;
            }

    function updateBooking($id, $values) {
        $sql = "update vbookings set first_name = ?,last_name = ?,email = ?,
        mobile = ?,booking_date = ?, booking_time = ?,venue = ?, image_filename = ? where id = $id";

//Create a prepared statement to insert records using wild cards 
        $statement = $this->pdo->prepare($sql);

//Execute insert records pass the array of values
        $success = $statement->execute($values);
        return $success;
    }

}
