<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Note</title>
  <link rel="stylesheet" href="/assets/css/NotePage.css">

</head>

<body>
  <div class="body">
    <header>
      <div class="navbar flex">
        <div class="logo">
          <p>NotePad</p>
        </div>
        <div class="nav-items">
          <a href="">Hi!
            <?php if (isset($_SESSION['Fname'])) {
              echo $_SESSION['Fname'];
            } ?>
          </a>
          <a href="/dashboardController/show">Dashboard </a>
          <a href="/dashboardController/showAddNote">Add Notes </a>
          <a href="/dashboardController/signOut">Sign Out</a>
        </div>
      </div>
    </header>

    <div class="container">
      <div class="content">
        <div id="corrSub">
        </div>

        <form action="/dashboardController/deleteNotes" method="post" enctype="multipart/form-data">
         <div class="flex">
            <div class="login-sec">
              <label for="First name">Note Number</label><br>
              <input type="text" placeholder="number"  id="Number"
                value="<?php echo $GLOBALS['Info']['numberOfNotes']; ?>" name="numberofNote">
            </div>
          </div>
          <div class="flex">
            <div class="login-sec">
              <label for="First name">Title</label><br>
              <input type="text" placeholder="Title" name="titleSec" id="title"
                value="<?php echo $GLOBALS['Info']['title']; ?>">
            </div>
          </div>
          <div class="flex">
            <div class="login-sec">
              <label for="Note">Note</label><br>
              <textarea placeholder="Note" name="noteSec" id="noteBody" rows="10"
                cols="50"><?php echo $GLOBALS['Info']['NoteBody']; ?></textarea>
            </div>
          </div>
          <br>
          <div class="flex btnspecial">
            <div class="btn">
              <input type="submit" value="Save" class="login-btn" id="update" name='save'>
            </div>
            <div class="btn">
              <input type="submit" value="Delete" class="login-btn" id="delete" name='delete'>
            </div>
          </div>
      </div>
    </div>

    </form>
  </div>
  </div>

  </div>
  <footer>
    <p>Developed By Rohan Singh - Free for you <span class="footer-heart">&#10084;</span> </p>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="/assets/js/update.js"></script>
</body>

</html>