<?php
session_start();

// Database connection
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "user_db";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch initiatives with initiative_type 'ocean_cleanup'
$stmt = $conn->prepare("SELECT * FROM initiatives WHERE initiative_type = ?");
$type = 'ocean_cleanup';
$stmt->bind_param("s", $type);
$stmt->execute();
$result = $stmt->get_result();

$initiatives = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $initiatives[] = $row;
    }
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ocean Clean Up Initiatives</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(135deg, #e0f7fa, #e1bee7);
      color: #333;
      margin: 0;
      padding: 0;
    }
    .main-container {
      max-width: 1200px;
      margin: 30px auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .initiative-bar {
      display: flex;
      align-items: center;
      border: 1px solid #eceff1;
      border-radius: 4px;
      padding: 15px;
      margin-bottom: 20px;
      background-color: #f8f8f8;
    }
    .initiative-bar img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 4px;
      margin-right: 20px;
    }
    .initiative-details h5 {
      margin: 0 0 10px;
    }
    .initiative-details p {
      margin: 2px 0;
    }
    .go-back {
      margin: 20px 0;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .go-back:hover {
      background-color: #45a049;
    }
    .intro {
      margin-bottom: 20px;
      font-size: 1.1rem;
    }
  </style>
</head>
<body>

<!-- Navigation (same header as habitats_data.php) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="../index.php">Marine Life Encyclopedia</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="species.php">Species</a></li>
        <li class="nav-item"><a class="nav-link" href="habitats.php">Habitats</a></li>
        <li class="nav-item"><a class="nav-link" href="conservation.php">Conservation</a></li>
      </ul>
      <ul class="navbar-nav">
        <?php if(isset($_SESSION['username'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo htmlspecialchars($_SESSION['username']); ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3z"/>
                <path fill-rule="evenodd" d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
              </svg>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-primary text-white ms-2" href="../Login_reg/logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="../Login_reg/Login_page.php">Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Go Back Button -->
<div class="container">
  <button class="go-back" onclick="window.location.href='conservation.php'">Go Back</button>
</div>

<!-- Main Container -->
<div class="container main-container">
  <h2 class="mb-4 text-center">Ocean Clean Up Initiatives</h2>
  <p class="intro">Ocean Clean Up conservation efforts focus on removing marine debris, especially plastic waste, from our oceans. These initiatives use advanced technologies like floating barriers and cleanup systems to collect and recycle waste, thereby reducing marine pollution and protecting ocean life. This approach not only cleans the ocean but also raises awareness and promotes sustainable practices worldwide.</p>
  <p style="font-size: 16px; line-height: 1.6; margin: 10px 0; color: #003366;">
  <p style="font-size: 16px; line-height: 1.6; margin: 10px 0; color: #003366;">
  <strong>What it does:</strong> Ocean Clean Up initiatives aim to remove harmful waste like plastics, fishing gear, and other pollutants from oceans and coastlines. These efforts involve deploying cleanup systems in oceans, organizing beach clean-ups, and raising awareness about reducing plastic use. The goal is to restore ocean health, protect marine life from ingesting or getting entangled in waste, and prevent further pollution from entering aquatic ecosystems.
</p>

  <h2 class="mb-4 text-left">Initiatives</h2>
  <?php if (!empty($initiatives)): ?>
    <?php foreach ($initiatives as $init): ?>
      <div class="initiative-bar">
        <?php if (!empty($init['image'])): ?>
          <img src="<?php echo htmlspecialchars($init['image']); ?>" alt="Initiative Image">
        <?php endif; ?>
        <div class="initiative-details">
          <h5><?php echo htmlspecialchars($init['started_by']); ?></h5>
          <p><strong>Hosted In:</strong> <?php echo htmlspecialchars($init['hosted_location']); ?></p>
          <p><strong>Details:</strong> <?php echo htmlspecialchars($init['details']); ?></p>
          <p><strong>Description:</strong> <?php echo htmlspecialchars($init['main_description']); ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="text-center">No initiatives found for Ocean Clean Up.</p>
  <?php endif; ?>
</div>

<!-- Footer (same as habitats_data.php) -->
<footer class="bg-dark text-light py-4 mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5>Marine Life Encyclopedia</h5>
        <p>Exploring the ocean's living world with comprehensive insights.</p>
      </div>
      <div class="col-md-4">
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="../pages/species.php" class="text-light">Species</a></li>
          <li><a href="../pages/habitats.php" class="text-light">Habitats</a></li>
          <li><a href="../pages/conservation.php" class="text-light">Conservation</a></li>
          <li><a href="../pages/feedback.php" class="text-light">Feedback</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Contact</h5>
        <p>If you have any questions or would like to get in touch with the team, feel free to contact us.</p>
        <ul>
          <li>Siddhant Shukla: <a href="mailto:siddhant.shukla@somaiya.edu" class="text-light">siddhant.shukla@somaiya.edu</a></li>
          <li>Yashraj Ola: <a href="mailto:yashraj.ola@somaiya.edu" class="text-light">yashraj.ola@somaiya.edu</a></li>
          <li>Shriya Shetty: <a href="mailto:shriya09@somaiya.edu" class="text-light">shriya09@somaiya.edu</a></li>
        </ul>
      </div>
    </div>
    <hr>
    <div class="text-center">
      <p>&copy; 2025 Marine Resources. All rights reserved.</p>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
</script>
</body>
</html>
