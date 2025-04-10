<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Marine Life Encyclopedia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>
    mark {
      background-color: rgb(24, 202, 95);
      padding: 0 2px;
      border-radius: 3px;
    }
    .last-viewed-box {
      background-color: #e0f7fa;
      border: 1px solid #00838f;
      padding: 15px;
      margin: 20px auto;
      border-radius: 5px;
      max-width: 500px;
      width: 90%;
    }
    .last-viewed-box h4 {
      color: #006064;
    }
    .last-viewed-box a {
      text-decoration: none;
      color: #01579b;
      font-weight: bold;
    }
    .list-group-item.active {
      background-color: #0d6efd;
      color: #fff;
    }
  </style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="index.php">Marine Life Encyclopedia</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="pages/species.php">Species</a></li>
        <li class="nav-item"><a class="nav-link" href="pages/habitats.php">Habitats</a></li>
        <li class="nav-item"><a class="nav-link" href="pages/conservation.php">Conservation</a></li>
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
            <a class="nav-link btn btn-primary text-white ms-2" href="Login_reg/logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="Login_reg/Login_page.php">Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="hero position-relative">
  <img src="https://images.unsplash.com/photo-1682687982501-1e58ab814714?w=1920"
       class="w-100" style="height: 600px; object-fit: cover;" alt="Underwater scene">
  <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-lg-8 text-white">
          <?php if(isset($_SESSION['username'])): ?>
            <div class="mb-2">Logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></div>
          <?php endif; ?>
          <h1 class="display-4 fw-bold">Explore the Ocean's Living World</h1>
          <p class="lead">Comprehensive insights into all marine species.</p>
          <div class="mt-4 position-relative" style="max-width: 500px;">
            <!-- Search Form with Live Autocomplete -->
            <form class="d-flex" method="GET" action="pages/search.php" autocomplete="off">
              <input class="form-control form-control-lg me-2" id="searchBox" type="search" name="query"
                     placeholder="Search for any marine species..." aria-label="Search">
              <button class="btn btn-primary btn-lg" type="submit">Search</button>
            </form>
            <ul class="list-group position-absolute w-100" id="suggestions" style="z-index: 1000;"></ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Last Viewed Marine Animal -->
<?php
// Open a connection to the database
$conn = new mysqli("localhost", "root", "", "user_db");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in and using the correct session variable
if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Prepare statement to fetch the last viewed marine animal info for this user
    $stmt = $conn->prepare("
        SELECT ma.id, ma.name, ma.scientific_name, lv.viewed_at
        FROM last_viewed lv
        JOIN marine_animals ma ON lv.species_id = ma.id
        WHERE lv.LoginId = ?
        ORDER BY lv.viewed_at DESC
        LIMIT 1
    ");
    $stmt->bind_param("i", $user_id);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            echo "<div class='last-viewed-box text-center'>";
            echo "<h4>Last Viewed Marine Animal</h4>";
            echo "<a href='pages/animal_data.php?id=" . htmlspecialchars($row['id']) . "'>";
            echo htmlspecialchars($row['name']) . " <em>(" . htmlspecialchars($row['scientific_name']) . ")</em>";
            echo "</a>";
            echo "<p>Viewed on: " . htmlspecialchars($row['viewed_at']) . "</p>";
            echo "</div>";
        } else {
            echo "<div class='last-viewed-box text-center'>";
            echo "<h4>You haven't explored any species yet!</h4>";
            echo "<p>Start with the <a href='pages/species.php'>Species page</a>.</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Error fetching last viewed data: " . htmlspecialchars($stmt->error) . "</p>";
    }

    $stmt->close();
} else {
    echo "<div class='last-viewed-box text-center'>";
    echo "<h4>Welcome to Marine Life Encyclopedia!</h4>";
    echo "<p><a href='Login_reg/Login_page.php'>Login</a> to track your exploration history.</p>";
    echo "</div>";
}

$conn->close();
?>

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
          <li><a href="pages/species.php" class="text-light">Species</a></li>
          <li><a href="pages/habitats.php" class="text-light">Habitats</a></li>
          <li><a href="pages/conservation.php" class="text-light">Conservation</a></li>
          <li><a href="pages/feedback.php" class="text-light">Feedback</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Contact</h5>
        <ul>
          <li>Siddhant Shukla: <a href="mailto:siddhant.shukla@somaiya.edu">siddhant.shukla@somaiya.edu</a> | <a href="tel:8657248522">8657248522</a></li>
          <li>Yashraj Ola: <a href="mailto:yashraj.ola@somaiya.edu">yashraj.ola@somaiya.edu</a> | <a href="tel:9326680299">9326680299</a></li>
          <li>Shriya Shetty: <a href="mailto:shriya09@somaiya.edu">shriya09@somaiya.edu</a> | <a href="tel:7506886032">7506886032</a></li>
        </ul>
      </div>
    </div>
    <hr>
    <div class="text-center">
      <p>&copy; 2025 Marine Resources. All rights reserved.</p>
    </div>
  </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  const searchBox = document.getElementById('searchBox');
  const suggestions = document.getElementById('suggestions');

  searchBox.addEventListener('input', function () {
    const query = this.value;
    if (query.length === 0) {
      suggestions.innerHTML = '';
      return;
    }

    fetch(`pages/autocomplete.php?term=${encodeURIComponent(query)}`)
      .then(res => res.json())
      .then(data => {
        suggestions.innerHTML = '';
        const regex = new RegExp(`(${query})`, 'i');

        data.forEach(item => {
          const li = document.createElement('li');
          li.classList.add('list-group-item', 'list-group-item-action');
          li.innerHTML = item.replace(regex, '<mark>$1</mark>');
          li.addEventListener('click', () => {
            searchBox.value = item;
            suggestions.innerHTML = '';
          });
          suggestions.appendChild(li);
        });
      });
  });

  document.addEventListener('click', function (e) {
    if (!searchBox.contains(e.target)) {
      suggestions.innerHTML = '';
    }
  });

  searchBox.addEventListener('keydown', function (e) {
    const active = suggestions.querySelector('.active');
    const items = Array.from(suggestions.querySelectorAll('li'));

    if (e.key === 'ArrowDown') {
      e.preventDefault();
      const next = active ? items[(items.indexOf(active) + 1) % items.length] : items[0];
      if (active) active.classList.remove('active');
      if (next) {
        next.classList.add('active');
        searchBox.value = next.textContent;
      }
    } else if (e.key === 'ArrowUp') {
      e.preventDefault();
      const prev = active ? items[(items.indexOf(active) - 1 + items.length) % items.length] : items[items.length - 1];
      if (active) active.classList.remove('active');
      if (prev) {
        prev.classList.add('active');
        searchBox.value = prev.textContent;
      }
    } else if (e.key === 'Enter' && active) {
      e.preventDefault();
      searchBox.value = active.textContent;
      suggestions.innerHTML = '';
      searchBox.closest('form').submit();
    }
  });
</script>
</body>
</html>
