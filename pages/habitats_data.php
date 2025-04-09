<?php
session_start();

// Optional: Enforce session if desired
// if (!isset($_SESSION['username'])) {
//     header("Location: ../Login_reg/Login_page.php");
//     exit();
// }

$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "user_db";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a habitat id is provided; if not, redirect to habitats.php list page
if (!isset($_GET['id'])) {
    header("Location: habitats.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch habitat data by id from habitats table
$stmt = $conn->prepare("SELECT * FROM habitats WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    header("Location: 404.php");
    exit();
}

$habitat = $result->fetch_assoc();
$stmt->close();

// Now fetch species from marine_animals that have the same habitat tag
$speciesStmt = $conn->prepare("SELECT * FROM marine_animals WHERE habitat = ?");
$speciesStmt->bind_param("s", $habitat['habitat_name']);
$speciesStmt->execute();
$speciesResult = $speciesStmt->get_result();

$speciesList = [];
if ($speciesResult->num_rows > 0) {
    while ($row = $speciesResult->fetch_assoc()) {
        $speciesList[] = $row;
    }
}
$speciesStmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($habitat['habitat_name']); ?> Habitat Details</title>
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
    .container.main-container {
      max-width: 1200px;
      margin: 30px auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
    .top-row {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
    }
    .top-row .habitat-image {
      flex: 1;
    }
    .top-row .habitat-image img {
      width: 100%;
      max-height: 350px;
      object-fit: cover;
      border-radius: 4px;
      transition: transform 0.3s;
    }
    .top-row .habitat-details {
      flex: 2;
      background-color: #f8f8f8;
      padding: 15px;
      border: 1px solid #eceff1;
      border-radius: 4px;
    }
    .species-grid {
      margin-top: 40px;
    }
    .species-grid .card-img-top {
      height: 200px;
      object-fit: cover;
    }
    .species-grid .card:hover {
      transform: scale(1.02);
      transition: transform 0.3s;
    }
  </style>
</head>
<body>

<!-- Navigation -->
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
  <button class="go-back" onclick="window.location.href='habitats.php'">Go Back</button>
</div>

<!-- Main Container -->
<div class="container main-container">
  <!-- Top Row: Habitat Image and Details -->
  <div class="top-row">
    <div class="habitat-image">
      <?php if (!empty($habitat['image_url'])): ?>
        <img src="<?php echo htmlspecialchars($habitat['image_url']); ?>" alt="<?php echo htmlspecialchars($habitat['habitat_name']); ?>">
      <?php endif; ?>
    </div>
    <div class="habitat-details">
      <h2><?php echo htmlspecialchars($habitat['habitat_name']); ?> Habitat</h2>
      <h4>Description</h4>
      <p><?php echo nl2br(htmlspecialchars($habitat['full_description'])); ?></p>
    </div>
  </div>
  
  <!-- Species Grid: Display all species with matching habitat -->
  <div class="species-grid">
    <h2 class="mb-4 text-center"><?php echo htmlspecialchars($habitat['habitat_name']); ?> Species</h2>
    <div class="row">
      <?php if (!empty($speciesList)): ?>
        <?php foreach ($speciesList as $species): ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <?php if (!empty($species['top_image_url'])): ?>
                <img src="<?php echo htmlspecialchars($species['top_image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($species['name']); ?>">
              <?php endif; ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($species['name']); ?></h5>
                <p class="card-text"><em><?php echo htmlspecialchars($species['scientific_name']); ?></em></p>
                <p class="card-text"><?php echo htmlspecialchars(substr($species['description'], 0, 100)); ?>...</p>
              </div>
              <div class="card-footer">
                <a href="../pages/animal_data.php?id=<?php echo $species['id']; ?>" class="btn btn-primary btn-sm">Learn More</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center">No species found for this habitat.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Footer -->
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
<script src="/js/main.js"></script>
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle=\"tooltip\"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
</script>
</body>
</html>
