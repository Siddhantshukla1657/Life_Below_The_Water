<?php
session_start();

$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "user_db";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all habitat details
$sql = "SELECT * FROM habitats";
$result = $conn->query($sql);

$habitats = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $habitats[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Habitats - Marine Life Encyclopedia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <style>
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
    .card:hover {
      transform: scale(1.02);
      transition: transform 0.3s;
    }
  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="../index.php">Marine Life Encyclopedia</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="species.php">Species</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="habitats_data.php">Habitats</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="conservation.php">Conservation</a>
          </li>
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

  <!-- Main Content: Display Habitats in Card Format -->
  <div class="container py-5">
    <h1 class="mb-4 text-center">Marine Habitats</h1>
    <div class="row">
      <?php if (!empty($habitats)): ?>
        <?php foreach ($habitats as $habitat): ?>
          <div class="col-md-3 mb-4">
            <div class="card h-100">
              <?php if (!empty($habitat['image_url'])): ?>
                <img src="<?php echo htmlspecialchars($habitat['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($habitat['habitat_name']); ?>">
              <?php endif; ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($habitat['habitat_name']); ?></h5>
                <p class="card-text"><?php echo nl2br(htmlspecialchars($habitat['description'])); ?></p>
              </div>
              <div class="card-footer">
                <a href="habitats_data.php?id=<?php echo $habitat['id']; ?>" class="btn btn-primary">Explore</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No habitats found.</p>
      <?php endif; ?>
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
            <li><a href="species.php" class="text-light">Species</a></li>
            <li><a href="habitats_data.php" class="text-light">Habitats</a></li>
            <li><a href="conservation.php" class="text-light">Conservation</a></li>
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
