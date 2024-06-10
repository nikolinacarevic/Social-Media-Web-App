<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8"/>
    <title>PZI-homework</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/font-awesome.min.css"/>
    <link rel="stylesheet" href="style/styles.css"/>
  </head>

  <body>
    
    <header>
      <span><b>Social network</b></span>
    </header>

    <main>      
      <div class="content-container">
            
            <div class="info-container">
                <img src="images/user-image.png" alt="profile-picture"/>
                <p><b>Nikolina Carević</b></p>
                <p>@carevicnikolina</p>
                <p><b>Followers:</b> 120</p>
                <p><b>Follow:</b> 150</p>
            </div>

            <div class="posts-container">
                <button id="button">New post</button>

                <?php 
                  require_once("php/posts.php");
                  echo(generatePostsHtml());
                ?>
            </div>
        </div>
      </main>

      <footer>
      Copyright Nikolina Carević @FESB 2023 PZI
      </footer>
      <script src="https://kit.fontawesome.com/9f01e4adc8.js" crossorigin="anonymous"></script>
      <script src="scripts/posts.js"></script>
  </body>

</html>