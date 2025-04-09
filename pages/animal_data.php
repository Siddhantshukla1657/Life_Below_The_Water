<?php
session_start();

// Database connection parameters
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "user_db"; // Replace with your actual database name

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

// Fetch species data by id
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
  <title><?php echo htmlspecialchars($data['name']); ?> Details</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #e0f7fa, #e1bee7);
      color: #333;
    }
    .container {
      max-width: 1200px;
      margin: 30px auto;
      background: #fff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      border-radius: 8px;
      overflow: hidden;
      padding: 20px;
    }
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
    h1, h2, h3 {
      color: #00695c;
    }
    .section {
      margin-bottom: 30px;
    }
    .top-image img {
      height:100%
      width: 100%;
      display: block;
      border-radius: 4px;
      max-height: 350px; /* ✅ You can adjust this to 300px or 400px if needed */
      object-fit: cover; /* Keeps the image visually nice if it's tall */
      transition: transform 0.3s;
    }

    .bottom-image img {
      width: 100%;
      display: block;
      border-radius: 4px;
      transition: transform 0.3s;
    }
    .top-image img:hover,
    .bottom-image img:hover {
      transform: scale(1.05);
    }
    .details-box {
      border: 1px solid #eceff1;
      background-color: #f8f8f8;
      padding: 15px;
      border-radius: 4px;
      margin-top: 20px;
    }
    .details-box ul {
      list-style-type: none;
      padding: 0;
    }
    .details-box li {
      margin-bottom: 8px;
    }
    .description-box, .facts-box, .final-description-box {
      margin-top: 20px;
    }
    .video-section {
      margin-top: 20px;
    }
    .video-section iframe {
      width: 100%;
      height: 400px;
      border: none;
      border-radius: 4px;
    }
    .final-row {
      display: flex;
      gap: 20px;
      margin-top: 20px;
    }
    .final-row .final-desc {
      flex: 2;
      border: 1px solid #eceff1;
      padding: 15px;
      background-color: #f8f8f8;
      border-radius: 4px;
    }
    .final-row .bottom-image {
      flex: 1;
    }
    .final-row .bottom-image img {
      width: 100%;
      border-radius: 4px;
      transition: transform 0.3s;
    }
    .final-row .bottom-image img:hover {
      transform: scale(1.05);
    }
    .top-row {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
      }

      .top-row .top-image {
        flex: 1;
      }

      .top-row .top-image img {
        width: 100%;
        border-radius: 4px;
        max-height: 350px;
        object-fit: cover;
        transition: transform 0.3s;
      }

      .top-row .details-box {
        flex: 2;
        background-color: #f8f8f8;
        padding: 15px;
        border: 1px solid #eceff1;
        border-radius: 4px;
      }

  </style>
</head>
<body>

<!-- Go Back Button -->
<button class="go-back" onclick="window.location.href='species.php'">Go Back</button>

<div class="container">
  <!-- 1 & 2. Top Image + Details Side-by-Side -->
    <div class="top-row section">
      <div class="top-image">
        <img src="<?php echo htmlspecialchars($data['top_image_url']); ?>" alt="<?php echo htmlspecialchars($data['name']); ?>">
      </div>

      <div class="details-box">
        <ul>
        <li><strong></strong><h1> <?php echo nl2br(htmlspecialchars($data['name'])); ?></li>
          <li><strong>Scientific Name:</strong> <?php echo htmlspecialchars($data['scientific_name']); ?></li>
          <li><strong>Habitat:</strong> <?php echo htmlspecialchars($data['habitat']); ?></li>
          <li><strong>Diet:</strong> <?php echo htmlspecialchars($data['diet']); ?></li>
          <li><strong>Conservation Status:</strong> <?php echo htmlspecialchars($data['conservation_status']); ?></li>
          <li><strong>Vulnerability:</strong> <?php echo htmlspecialchars($data['vulnerability']); ?></li>
          <li><strong>Related Species:</strong><br> <?php echo nl2br(htmlspecialchars($data['related_species'])); ?></li>
        </ul>
      </div>
    </div>

  
  <!-- 3. Description Box -->
  <div class="description-box section">
    <h2>Description</h2>
    <p><?php echo nl2br(htmlspecialchars($data['description'])); ?></p>
  </div>
  
  <!-- 4. Interesting Facts -->
  <div class="facts-box section">
    <h2>Interesting Facts</h2>
    <p><?php echo nl2br(htmlspecialchars($data['interesting_facts'])); ?></p>
  </div>
  
  <!-- 5. Video Section -->
  <div class="video-section section">
    <iframe src="<?php echo htmlspecialchars($data['video_url']); ?>" 
            title="Video player"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
  </div>
  
  <!-- 6. Final Row: Final Description & Bottom Image -->
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

</body>
</html>
