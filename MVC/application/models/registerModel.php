<?php

class registerModel
{

  public string $servername = "localhost";
  public string $dbusername = "root";
  public string $dbpassword = "Anju@8274";
  public string $dbname = "notepad";
  public string $fnameErr = '';
  public string $LnameErr = '';
  public string $EmailErr = '';
  public string $NumErr = '';
  public string $AgeErr = '';
  public string $passErr = '';
  public string $RefisErr = '';

  public $checkSubmit = false;

  /**
   * function to check input. 
   * 
   *  @param string $data
   *    input data
   */
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  /**
   * function to validate firstName. 
   * 
   *  @param string $firstName
   *    user's firstName
   */
  function firstNameValid($firstName)
  {
    $fname = $this->test_input($firstName);
    if (!preg_match("/^[a-zA-Z-']*$/", $fname)) {
      $this->fnameErr = '* Only letters and white spaces allowed';
      return false;
    } else {
      $this->fnameErr = '';
      return true;
    }
  }

  /**
   * function to validate lastName. 
   * 
   *  @param string $lastName
   *    user's lastName
   */
  function lastNameValid($lastName)
  {
    $lname = $this->test_input($lastName);
    if (!preg_match("/^[a-zA-Z-']*$/", $lname)) {
      $this->LnameErr = '* Only letter and white space allowed';
      return false;
    } else {
      $this->LnameErr = '';
      return true;
    }
  }

  /**
   * function to validate users email. 
   * 
   *  @param string $email
   *    user's email
   */
  function emailValid($email)
  {
    $mailId = $this->test_input($email);
    if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $mailId)) {
      $this->EmailErr = '* Not a valid email';
      return false;
    } else {
      $this->EmailErr = '';
      return true;
    }
  }

  /**
   * Add note function to add note. 
   * 
   *  @param string $mobileNumber
   *    user's mobile number
   */
  function numberValid($mobileNumber)
  {
    $number = htmlspecialchars($mobileNumber);
    if (!preg_match('/^[+][9][1]?[6-9]\d{9}$/', $number)) {
      $this->NumErr = '* Not a valid number';
      return false;
    } else {
      $this->NumErr = '';
      return true;
    }
  }

  /**
   * Add note function to add note. 
   * 
   *  @param string $title
   *    Note's title
   * 
   *  @param string $NoteBody
   *    Note's body
   * 
   *  @param string $UserNum
   *    User's unique id
   */
  function passwordValid($password)
  {
    $pass = htmlspecialchars($password);
    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/', $pass)) {
      $this->passErr = '* Not a valid password';
      return false;
    } else {
      $this->passErr = '';
      return true;
    }
  }

  /* 
   * this function checks if the database is successfully connected or not 
   */
  function checkConnection()
  {
    //Create connection 
    $conn = new mysqli($this->servername, $this->dbusername, $this->dbpassword, $this->dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
  }



  /**
   * function to check registration 
   * 
   *  @param string $fname
   *    User's firstaame
   * 
   *  @param string $lname
   *    User's lastname
   * 
   *  @param string $email
   *    User's unique email
   * 
   *  @param string $phone
   *    User's mobile number
   * 
   *  @param string $pass
   *    User's password
   */
  function register($fname, $lname, $email, $phone, $pass)
  {
    $this->firstNameValid($fname);
    $this->lastNameValid($lname);
    $this->emailValid($email);
    $this->numberValid($phone);
    $this->passwordValid($pass);

    if (($this->firstNameValid($fname) == true) && ($this->lastNameValid($lname) == true) && ($this->emailValid($email) == true) && ($this->numberValid($phone) == true) && ($this->passwordValid($pass) == true)) {
      $conn = $this->checkConnection();
      $stmt = $conn->prepare("INSERT INTO userInfo(fname,lname,email,phone,password) VALUES (?,?,?,?,?)");
      $stmt->bind_param('sssss', $fname, $lname, $email, $phone, $pass);

      $query1 = "SELECT email FROM userInfo where email = '" . $email . "';";
      $res = $conn->query($query1);

      $num1 = mysqli_num_rows($res);
      if ($num1 == 0) {
        if ($stmt->execute()) {
          $this->RefisErr = '';
          $this->checkSubmit = true;
          $stmt->close();
          $conn->close();
          return true;
        } else {
          $this->RefisErr = '* Unable to execute';
          $stmt->close();
          $this->$conn->close();
          return false;
        }
      } else {
        $this->RefisErr = '* Email Already in use!! <br> try with another email';
        $stmt->close();
        return false;
      }
    } else {
      $this->RefisErr = '* Error sending Data to database';
    }

  }
}

?>

