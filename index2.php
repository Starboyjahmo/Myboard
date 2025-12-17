<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mycollege Website</title>

  <!-- Foundation CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.3/css/foundation.min.css">
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  
  <!-- Optional custom styles -->
  <style>
    body { padding-top: 20px; }
    .hero { background: #a5a4a4; padding: 40px 0; text-align: center; }
  </style>
</head>
<body>

  <!-- Header / Navigation -->
  <header class="header contain-to-grid">
    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name"><h1><a href="#">Mycollege Website</a></h1></li>
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
      </ul>

      <section class="top-bar-section">
        <ul class="left">
          <li><a href="home.php">Home</a></li>
          <li><a href="about us.php">About Us</a></li>
          <li><a href="faculities.php">Faculties</a></li>

          <!-- Academics Dropdown -->
          <li class="has-dropdown">
            <a href="#">Academics</a>
            <ul class="dropdown">
              <li><a href="department/computer_science.php">Department of Computer Science</a></li>
              <li><a href="department/art.php">Department of Art</a></li>
              <li><a href="department/commerce.php">Department of Commerce</a></li>
            </ul>
          </li>
        </ul>
      </section>
    </nav>
  </header>

  <!-- Hero Section -->
  <div class="hero">
    <div class="row">
      <div class="large-12 columns">
        <h2>Welcome to Mycollege Website</h2>
        <p>Explore our departments and learn more about our academic offerings.</p>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="row">
    <div class="large-12 columns">
      <p>Kniowing about the websites it goes down here and any text.</p>
    </div>
  </div>

  <!-- jQuery and Foundation JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.3/js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>

</body>
</html>


