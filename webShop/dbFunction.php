<?php
    /****************************** NOTES ****************************** */
        // The only difference between the two is that require and its sister 
        // require_once throw a fatal error if the file is not found, 
        // whereas include and include_once only show a warning and 
        // continue to load the rest of the page.

        // this is a class includes all the functions related to database
        // operation in this project. We are doing it this way so that
        // whenever we have to do the same operation in different 
        // situations, we can simply call the function and use it instead 
        // of rewriting it on every places.
        // CONCEPT OF OOP
    /******************************************************************** */

    require_once "dbConnect.php";

    // class begins here 
    class dbFunction {

        private $conn;
        
        // Constructor 
        function __construct() {
            $dbc = new dbConnect();
            $this->conn = $dbc->getConnection();
        }

        // function to register user in the databse
        public function UserRegister($name, $address, $phone_number, $email, $password) { 
            // inserting the data into databse table called users, if failed
            // it prints the error message mysql gives and then terminated 
            // the running PHP script
            $qr = mysqli_query($this->conn, "INSERT INTO users(name, address, phone_number, email, password) 
                                values('".$name."','".$address."','".$phone_number."','".$email."','".$password."')") 
                                or die(mysqli_error());  
            return $qr;      
        } 

        // function to login user 
        public function UserLogin($email, $password) {
            // trying to fetch record from the database with the email 
            // and password that matches the details coming from the form
            $result = mysqli_query($this->conn, 
                                "SELECT * FROM users WHERE email = '".$email."' AND password = '".$password."'"
                            ) 
                            or die(mysqli_error()); 
            
            $user_data = mysqli_fetch_array($result);       // Storing the details of the fetched result in the variable
            $no_rows = mysqli_num_rows($result);            // Storing the number of rows fetched
            
            if ($no_rows == 1){
                // if login is true, we store some information about the user
                $_SESSION['login'] = true;
                $_SESSION['user_name'] = $user_data['name'];
                $_SESSION['user_email'] = $user_data['email'];
                return TRUE;  
            }  
            else  
            {  
                return FALSE;  
            }  
        }

        
    }

?>