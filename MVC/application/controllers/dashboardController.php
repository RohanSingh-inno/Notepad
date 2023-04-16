<?php
  class dashboardController extends framework {
    /** 
     * Function to load dashboard.
     * This function will load the Dashboard on successful login.
     */
    public function show()
    {
      session_start();
      if ($_SESSION['LoggedIN'] == true) {
        $_SESSION['Fname'];
        $this->model('dashboardModel');
        $getPic = new dashboardModel;
  
        $this->view("Dashboard");
      } else {
        header("location: /loginController/login");
      }
    }
  
    /** 
     * Function to show add note.
     * This function will load loadMoreData page based on the data returned from database.
     */
    public function loadMore()
    {
      $this->model('dashboardModel');
      $getPic = new dashboardModel;
      $GLOBALS['data'] = $getPic->getDetails();
      if (!is_string($GLOBALS['data'])) {
        echo $this->view("loadMoreData");
      } else {
        echo $GLOBALS['data'];
      }
  
    }
  
    /** 
     * Function to show add note.
     * If logged in load addNote page else load login page.
     */
    public function showAddNote()
    {
      session_start();
      if ($_SESSION['LoggedIN'] == true) {
        $this->view("addNote");
      } else {
        header("location: /loginController/login");
      }
  
    }
  
    /** 
     * Function to show user profile.
     * If logged in load userProfile page else load login page.
     */
    public function showUserProfile()
    {
      session_start();
      $this->model("dashboardModel");
      $data = new dashboardModel;
      if (isset($_SESSION['LoggedIN'])) {
        $this->view("userProfile");
      } else {
        header("location: /loginController/login");
      }
    }
  
    /** 
     * Function for signout.
     * This function will destroy session variables and redirect to login page.
     */
    public function signOut()
    {
      session_start();
      session_unset();
      session_destroy();
      header("location: /loginController/login");
  
    }
  
    /** 
     * Function to add a note.
     * This function will add note to the database this call is made via ajax.
     */
    public function addNote()
    {
      session_start();
      $title = $_POST['Notetitle'];
      $note = $_POST['body'];
      $this->model('dashboardModel');
      $addFiles = new dashboardModel;
      echo $addFiles->addNote($title, $note, $_SESSION['UserNumber']);
    }
  
    /** 
     * Function to show the page having note details.
     * This function will showup the note details page.
     */
    public function notePage($data)
    {
      session_start();
      if ($_SESSION['LoggedIN'] == true) {
        $this->model('dashboardModel');
        $noteData = new dashboardModel;
        $GLOBALS['Info'] = $noteData->Note($data);
        $this->view("NotePage");
      } else {
        header("location: /loginController/login");
      }
    }
  
    /** 
     * Function to update a note.
     * This function will update note's data in the database this call is made via ajax.
     */
    public function updateNotes()
    {
      $title = $_POST['Notetitle'];
      $note = $_POST['body'];
      $this->model('dashboardModel');
      $addFiles = new dashboardModel;
      echo $addFiles->updateNote($title, $note);
    }
  
    /** 
     * Function to delete a note.
     * This function will delete a note in the database.
     */
    public function deleteNotes()
    {
      $this->model('dashboardModel');
      $addFiles = new dashboardModel;
      if ($addFiles->deleteNote($_POST['numberofNote'])) {
        $this->view('Dashboard');
      }
  
    }
  }

?>