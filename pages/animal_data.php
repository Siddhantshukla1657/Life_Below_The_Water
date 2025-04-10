<?php
session_start();

// Enable MySQLi error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Database connection parameters
$host    = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "user_db"; // Replace with your actual database name

// Create a new connection
$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if an 'id' is provided; if not, redirect to species page
if (!isset($_GET['id'])) {
    header("Location: species.php");
    exit();
}

$id = intval($_GET['id']);

// Fallback: If $_SESSION['id'] is not set, try to retrieve it using the username
if (!isset($_SESSION['id']) && isset($_SESSION['username'])) {
    // Adjust the query if your users table uses a different column name for the ID
    $username = $_SESSION['username'];
    $query = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()){
        $_SESSION['id'] = $row['id'];
    }
    $stmt->close();
}

// If the user is logged in (i.e., the session has the user ID), update/insert last_viewed record
if (isset($_SESSION['id'])) {
    $query = "
        INSERT INTO last_viewed (loginId, species_id)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE species_id = ?, viewed_at = CURRENT_TIMESTAMP
    ";
    $stmt_view = $conn->prepare($query);
    if (!$stmt_view) {
        die("Prepare failed: " . $conn->error);
    }
    // Bind the user's ID and species ID (with species ID repeated for the UPDATE clause)
    $stmt_view->bind_param("iii", $_SESSION['id'], $id, $id);
    if (!$stmt_view->execute()) {
        die("Execute failed: " . $stmt_view->error);
    }
    $stmt_view->close();
}

// Fetch species data by id from the marine_animals table
$stmt = $conn->prepare("SELECT * FROM marine_animals WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    header("Location: 404.php");
    exit();
}

$data = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animal Data</title>
  <!-- Bootstrap & external stylesheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <!-- Custom CSS for the Animal Data Page -->
  <style>
    .animal-data-container {
      font-family: 'Roboto', sans-serif;
      margin: 30px auto;
      max-width: 1200px;
      background: #fff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
      padding: 20px;
    }
    .animal-data-container .top-row {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
    }
    .animal-data-container .top-image {
      flex: 1;
    }
    .animal-data-container .top-image img {
      width: 100%;
      height: 100%;
      display: block;
      border-radius: 4px;
      max-height: 350px;
      object-fit: cover;
      transition: transform 0.3s;
    }
    .animal-data-container .top-image img:hover {
      transform: scale(1.05);
    }
    .animal-data-container .details-box {
      flex: 2;
      background-color: #f8f8f8;
      padding: 15px;
      border: 1px solid #eceff1;
      border-radius: 4px;
    }
    .animal-data-container .details-box ul {
      list-style-type: none;
      padding: 0;
    }
    .animal-data-container .details-box li {
      margin-bottom: 8px;
    }
    .animal-data-container .description-box,
    .animal-data-container .facts-box,
    .animal-data-container .video-section,
    .animal-data-container .final-row {
      margin-top: 20px;
    }
    .animal-data-container .video-section iframe {
      width: 100%;
      height: 400px;
      border: none;
      border-radius: 4px;
    }
    .animal-data-container .final-row {
      display: flex;
      gap: 20px;
      margin-top: 20px;
    }
    .animal-data-container .final-row .final-desc {
      flex: 2;
      border: 1px solid #eceff1;
      padding: 15px;
      background-color: #f8f8f8;
      border-radius: 4px;
    }
    .animal-data-container .final-row .bottom-image {
      flex: 1;
    }
    .animal-data-container .final-row .bottom-image img {
      width: 100%;
      border-radius: 4px;
      transition: transform 0.3s;
    }
    .animal-data-container .final-row .bottom-image img:hover {
      transform: scale(1.05);
    }
    /* Go Back button styling */
    .go-back {
      margin: 20px;
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
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #e0f7fa, #e1bee7);
      color: #333;
    }
  </style>
</head>
<body>
  <!-- Header -->
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                     class="bi bi-person-fill" viewBox="0 0 16 16">
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
  <button class="go-back" onclick="window.location.href='species.php'">Go Back</button>
  
  <!-- Animal Data Content -->
  <div class="animal-data-container">
    <!-- Top Image + Details -->
    <div class="top-row section">
      <div class="top-image">
        <img src="<?php echo htmlspecialchars($data['top_image_url']); ?>" alt="<?php echo htmlspecialchars($data['name']); ?>">
      </div>
      <div class="details-box">
        <ul>
          <li><h1><?php echo nl2br(htmlspecialchars($data['name'])); ?></h1></li>
          <li><strong>Scientific Name:</strong> <?php echo htmlspecialchars($data['scientific_name']); ?></li>
          <li><strong>Habitat:</strong> <?php echo htmlspecialchars($data['habitat']); ?></li>
          <li><strong>Diet:</strong> <?php echo htmlspecialchars($data['diet']); ?></li>
          <li><strong>Conservation Status:</strong> <?php echo htmlspecialchars($data['conservation_status']); ?></li>
          <li><strong>Vulnerability:</strong> <?php echo htmlspecialchars($data['vulnerability']); ?></li>
          <li><strong>Related Species:</strong><br>
              <?php echo nl2br(htmlspecialchars($data['related_species'])); ?>
          </li>
        </ul>
      </div>
    </div>
    
    <!-- Description Box -->
    <div class="description-box section">
      <h2>Description</h2>
      <p><?php echo nl2br(htmlspecialchars($data['description'])); ?></p>
    </div>
    
    <!-- Interesting Facts -->
    <div class="facts-box section">
      <h2>Interesting Facts</h2>
      <p><?php echo nl2br(htmlspecialchars($data['interesting_facts'])); ?></p>
    </div>
    
    <!-- Video Section -->
    <div class="video-section section">
      <iframe src="<?php echo htmlspecialchars($data['video_url']); ?>" 
              title="Video player"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen></iframe>
    </div>
    
    <!-- Final Row: Final Description & Bottom Image -->
    <div class="final-row section">
      <div class="final-desc">
        <h2>Final Description</h2>
        <p><?php echo nl2br(htmlspecialchars($data['final_description'])); ?></p>
      </div>
      <div class="bottom-image">
        <img src="<?php echo htmlspecialchars($data['bottom_image_url']); ?>" alt="<?php echo htmlspecialchars($data['name']); ?>">
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
          <p>If you have any questions or would like to get in touch, feel free to contact us:</p>
          <ul>
            <li>Siddhant Shukla: <a href="mailto:siddhant.shukla@somaiya.edu">siddhant.shukla@somaiya.edu</a> | Phone: <a href="tel:8657248522">8657248522</a></li>
            <li>Yashraj Ola: <a href="mailto:yashraj.ola@somaiya.edu">yashraj.ola@somaiya.edu</a> | Phone: <a href="tel:9326680299">9326680299</a></li>
            <li>Shriya Shetty: <a href="mailto:shriya09@somaiya.edu">shriya09@somaiya.edu</a> | Phone: <a href="tel:7506886032">7506886032</a></li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="text-center">
        <p>&copy; 2025 Marine Resources. All rights reserved.</p>
      </div>
    </div>
  </footer>
  
  <!-- JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/js/main.js"></script>
  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  </script>
</body>
</html>
