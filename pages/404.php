<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - Marine Life Encyclopedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <!-- Marine Life Encyclopedia That link now points to index.php -->
      <a class="navbar-brand" href="index.php">
        Marine Life Encyclopedia
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="pages/species.php">Species</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/habitats.php">Habitats</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/conservation.php">Conservation</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <?php if(isset($_SESSION['username'])): ?>
            <!-- When logged in, show an icon with tooltip -->
            <li class="nav-item">
              <a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo htmlspecialchars($_SESSION['username']); ?>">
                <!-- New icon: bi-person-fill -->
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

    <!-- 404 Content -->
    <div class="container py-5 text-center">
        <img src="https://images.unsplash.com/photo-1517783999520-f068d7431a60" 
             alt="Lost at sea" class="img-fluid mb-4" style="max-width: 400px;">
        <h1 class="display-4">Page Not Found</h1>
        <p class="lead">Looks like you've ventured into uncharted waters!</p>
        <p>The page you're looking for doesn't exist or has been moved.</p>
        <a href="../index.php" class="btn btn-primary btn-lg mt-3">Return to Home</a>
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
    <script src="/js/main.js"></script>
    <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  </script>
</body>
</html>
