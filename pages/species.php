<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Species - Marine Life Encyclopedia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
  <style>
    /* Optional: Style for the species ID badge */
    .species-id-badge {
      position: absolute;
      top: 8px;
      right: 8px;
      background: rgba(0, 0, 0, 0.7);
      color: #fff;
      padding: 3px 6px;
      border-radius: 4px;
      font-size: 0.8rem;
    }
    .card.position-relative {
      position: relative;
    }
  </style>
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <!-- Marine Life Encyclopedia link now points to index.php -->
      <a class="navbar-brand" href="../index.php">
        Marine Life Encyclopedia
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="species.php">Species</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="habitats.php">Habitats</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="conservation.php">Conservation</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <?php if(isset($_SESSION['username'])): ?>
            <!-- When logged in, show an icon with tooltip -->
            <li class="nav-item">
              <a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo htmlspecialchars($_SESSION['username']); ?>">
                <!-- Using bi-person-fill icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3z"/>
                  <path fill-rule="evenodd" d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg>
              </a>
            </li>
            <li class="nav-item">
              <!-- Logout button styled like the login button -->
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

  <!-- Main Content -->
  <div class="container py-5">
    <h1 class="mb-4">Marine Species Directory</h1>
    <?php if(isset($_SESSION['username'])): ?>
      <div class="mb-2">Logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></div>
    <?php endif; ?>

    <!-- Filter Form (if needed) -->
    <div class="row mb-4">
      <div class="col-md-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Filters</h5>
            <form method="GET">
              <div class="mb-3">
                <label class="form-label">Conservation Status</label>
                <select class="form-select" name="status">
                  <option value="">All</option>
                  <option value="Endangered">Endangered</option>
                  <option value="Vulnerable">Vulnerable</option>
                  <option value="Least Concern">Least Concern</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Habitat</label>
                <select class="form-select" name="habitat">
                  <option value="">All</option>
                  <option value="Ocean">Ocean</option>
                  <option value="Coral Reef">Coral Reef</option>
                  <option value="Deep Sea">Deep Sea</option>
                  <option value="Freshwater">Freshwater</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Apply Filters</button>
            </form>
          </div>
        </div>
      </div>
      
      <div class="col-md-9">
        <div class="row">
          <?php
            // Database connection
            $servername = "localhost";
            $db_username = "root";
            $db_password = "";
            $dbname = "user_db";
            $conn = new mysqli($servername, $db_username, $db_password, $dbname);
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            
            // Build the query with filtering if set via GET parameters
            $query = "SELECT * FROM marine_animals";
            $conditions = array();
            if (!empty($_GET['status'])) {
              $status = $conn->real_escape_string($_GET['status']);
              $conditions[] = "conservation_status='$status'";
            }
            if (!empty($_GET['habitat'])) {
              $habitat = $conn->real_escape_string($_GET['habitat']);
              $conditions[] = "habitat='$habitat'";
            }
            if (count($conditions) > 0) {
              $query .= " WHERE " . implode(" AND ", $conditions);
            }
            
            $result = $conn->query($query);
            
            if ($result && $result->num_rows > 0):
              while ($row = $result->fetch_assoc()):
          ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card position-relative">
              <!-- Species ID Badge -->
              <div class="species-id-badge">ID: <?php echo $row['id']; ?></div>
              <img src="<?php echo $row['top_image_url']; ?>" 
                   class="card-img-top" style="height: 200px; object-fit: cover;" 
                   alt="<?php echo htmlspecialchars($row['name']); ?>">
              <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                <p class="card-text"><em><?php echo htmlspecialchars($row['scientific_name']); ?></em></p>
                <p class="card-text"><?php echo htmlspecialchars(substr($row['description'], 0, 100)); ?>...</p>
                <span class="badge bg-danger"><?php echo htmlspecialchars($row['conservation_status']); ?></span>
                <span class="badge bg-info"><?php echo htmlspecialchars($row['habitat']); ?></span>
              </div>
              <div class="card-footer">
                <!-- Dynamic Learn More link -->
                <a href="../pages/animal_data.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Learn More</a>
              </div>
            </div>
          </div>
          <?php
              endwhile;
            else:
          ?>
          <p>No species found.</p>
          <?php
            endif;
            $conn->close();
          ?>
        </div>
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
          <p>If you have any questions or would like to get in touch with the team, feel free to contact us at the following:</p>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/main.js"></script>
  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  </script>
</body>
</html>
