<?php

class dashboardModel
{

  public string $servername = "localhost";
  public string $dbusername = "root";
  public string $dbpassword = "Anju@8274";
  public string $dbname = "notepad";
  public bool $changeStatus = false; //for user profile update

  public string $uploadErr = '';
  public bool $checkUpload = false;

  /* 
   * this function checks if the database is successfully connected or not 
   */
  function checkConnection()
  {
    //Create connection
    $conn = new mysqli($this->servername, $this->dbusername, $this->dbpassword, $this->dbname);
    //Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
  }

  /* 
   * getting data from  database
   */
  public function getDetails()
  {
    $conn = $this->checkConnection();
    $limit = 1;
    $page = "";
    if (isset($_POST['page_no'])) {
      $page = $_POST['page_no'];
    } else {
      $page = 0;
    }
    $query1 = 'select * from Notes LIMIT ' . $page . ', ' . $limit . ';';
    $res = $conn->query($query1);

    if (mysqli_num_rows($res) > 0) {
      $output = "";
      while ($row = mysqli_fetch_assoc($res)) {
        return $row;
      }
    } else {
      return "<h4 class='last'>Add some notes!</h4>";
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
  public function addNote($title,$NoteBody,$UserNum)
  {
    $conn = $this->checkConnection();

    $stmt = $conn->prepare("INSERT INTO Notes(title,Notebody,currentDate,UserNum) VALUES (?,?,CURDATE(),?)");
    $stmt->bind_param('sss', $title, $NoteBody, $UserNum);

    $query1 = "SELECT title FROM Notes where title = '" . $title . "';";
    $res = $conn->query($query1);

    $num1 = mysqli_num_rows($res);
    if ($num1 == 0) {
      if ($stmt->execute()) {
        return 1;
      }else{
        return 0;
      }
    }
  }

  /** 
   * Add note function to add note  
   * 
   *  @param int $data
   *    takes the unique note number.
   */
  public function Note($data){
    $conn = $this->checkConnection();
    $query1 = 'select * from Notes where numberOfNotes = '.$data.';';
    $res = $conn->query($query1);
    $info  = [];

    while($data = mysqli_fetch_assoc($res)){
      $info = $data;
    }
    //returns the detail of note according to unique note number
    return $info;
  }

  /**
   * UpdateNote function to update note.  
   *  
   *  @param string $title
   *    Note's title
   * 
   *  @param string $NoteBody
   *    Note's body
   */
  public function updateNote($title,$NoteBody){
    $conn = $this->checkConnection();
    $query1 = 'Update Notes SET title = "' . $title . '"  , NoteBody = "' . $NoteBody .  '";';
    $res = $conn->query($query1);

    if ($res) {
     return 1;
    }
    return 0;
  }

  /** 
   * Add note function to add note  
   * 
   *  @param int $data
   *    takes the unique note number.
   */
  public function deleteNote($data){
    $conn = $this->checkConnection();
    $query1 = 'delete from Notes where numberOfNotes = '.$data .';';
    $res = $conn->query($query1);
    if ($res) {
      return true;
    }
    return false;
  }
}

?>

