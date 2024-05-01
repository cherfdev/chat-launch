<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <div class="class">
        <i class="fa fa-face-smile"></i>
        <input type="text" name="message" class="input-field" placeholder="Entrez votre message..." autocomplete="off" id="message">
        <label for="file" style="cursor: pointer;"><i class="fa fa-circle-plus"></i></label>
        <input type="file" name="file" class="file-input" id="file" accept="image/x-png,image/gif,image/jpeg,image/jpg" style="display: none;">
        <button id="cl" style="text-align: center;display:flex;justify-content:center;align-items:center"><i class="bx bxs-send"></i></button>
        </div>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
