<?php
session_start();

// Only allow access if logged in as an admin
$admin_ids = array('admin1', 'admin2', 'admin3');
if (!isset($_SESSION['loginid']) || !in_array($_SESSION['loginid'], $admin_ids)) {
    header("Location: ../Login_reg/Login_page.php");
    exit();
}

// Database connection
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "user_db";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// -------------------- Species Management --------------------

// Handle Add Species form submission
if (isset($_POST['add_species'])) {
    // Escape input values
    $name = $conn->real_escape_string($_POST['name']);
    $scientific_name = $conn->real_escape_string($_POST['scientific_name']);
    $description = $conn->real_escape_string($_POST['description']);
    $habitat = $conn->real_escape_string($_POST['habitat']);  // Options: Ocean, Coral Reef, Deep Sea, Freshwater
    $diet = $conn->real_escape_string($_POST['diet']);
    $conservation_status = $conn->real_escape_string($_POST['conservation_status']);
    $interesting_facts = $conn->real_escape_string($_POST['interesting_facts']);
    $related_species = $conn->real_escape_string($_POST['related_species']);
    $top_image_url = $conn->real_escape_string($_POST['top_image_url']);
    $bottom_image_url = $conn->real_escape_string($_POST['bottom_image_url']);
    $video_url = $conn->real_escape_string($_POST['video_url']);
    $final_description = $conn->real_escape_string($_POST['final_description']);
    $vulnerability = $conn->real_escape_string($_POST['vulnerability']); // Options: Low, Medium, High

    $sql = "INSERT INTO marine_animals (name, scientific_name, description, habitat, diet, conservation_status, interesting_facts, related_species, top_image_url, bottom_image_url, video_url, final_description, vulnerability)
            VALUES ('$name', '$scientific_name', '$description', '$habitat', '$diet', '$conservation_status', '$interesting_facts', '$related_species', '$top_image_url', '$bottom_image_url', '$video_url', '$final_description', '$vulnerability')";

    if ($conn->query($sql) === TRUE) {
        $message = "Species added successfully!";
    } else {
        $message = "Error adding species: " . $conn->error;
    }
}

// Handle Delete Species form submission
if (isset($_POST['delete_species'])) {
    $species_id = intval($_POST['species_id']);
    $sql = "DELETE FROM marine_animals WHERE id = $species_id";
    if ($conn->query($sql) === TRUE) {
        $delete_message = "Species deleted successfully!";
    } else {
        $delete_message = "Error deleting species: " . $conn->error;
    }
}

// Handle Update Species form submission
if (isset($_POST['update_species'])) {
    $id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $scientific_name = $conn->real_escape_string($_POST['scientific_name']);
    $description = $conn->real_escape_string($_POST['description']);
    $habitat = $conn->real_escape_string($_POST['habitat']);
    $diet = $conn->real_escape_string($_POST['diet']);
    $conservation_status = $conn->real_escape_string($_POST['conservation_status']);
    $interesting_facts = $conn->real_escape_string($_POST['interesting_facts']);
    $related_species = $conn->real_escape_string($_POST['related_species']);
    $top_image_url = $conn->real_escape_string($_POST['top_image_url']);
    $bottom_image_url = $conn->real_escape_string($_POST['bottom_image_url']);
    $video_url = $conn->real_escape_string($_POST['video_url']);
    $final_description = $conn->real_escape_string($_POST['final_description']);
    $vulnerability = $conn->real_escape_string($_POST['vulnerability']);

    $sql = "UPDATE marine_animals SET 
                name='$name',
                scientific_name='$scientific_name',
                description='$description',
                habitat='$habitat',
                diet='$diet',
                conservation_status='$conservation_status',
                interesting_facts='$interesting_facts',
                related_species='$related_species',
                top_image_url='$top_image_url',
                bottom_image_url='$bottom_image_url',
                video_url='$video_url',
                final_description='$final_description',
                vulnerability='$vulnerability'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $update_message = "Species updated successfully!";
    } else {
        $update_message = "Error updating species: " . $conn->error;
    }
}

// -------------------- Initiative Management --------------------

// Handle Add Initiative form submission
if (isset($_POST['add_initiative'])) {
    $started_by = $conn->real_escape_string($_POST['started_by']);
    $hosted_location = $conn->real_escape_string($_POST['hosted_location']);
    $details = $conn->real_escape_string($_POST['details']);
    $main_description = $conn->real_escape_string($_POST['main_description']);
    $initiative_type = $conn->real_escape_string($_POST['initiative_type']);
    $image = $conn->real_escape_string($_POST['image']);

    $sql = "INSERT INTO initiatives (started_by, hosted_location, details, main_description, initiative_type, image)
            VALUES ('$started_by', '$hosted_location', '$details', '$main_description', '$initiative_type', '$image')";

    if ($conn->query($sql) === TRUE) {
        $initiative_message = "Initiative added successfully!";
    } else {
        $initiative_message = "Error adding initiative: " . $conn->error;
    }
}

// Handle Update Initiative form submission
if (isset($_POST['update_initiative'])) {
    $id = intval($_POST['initiative_id']);
    $started_by = $conn->real_escape_string($_POST['started_by']);
    $hosted_location = $conn->real_escape_string($_POST['hosted_location']);
    $details = $conn->real_escape_string($_POST['details']);
    $main_description = $conn->real_escape_string($_POST['main_description']);
    $initiative_type = $conn->real_escape_string($_POST['initiative_type']);
    $image = $conn->real_escape_string($_POST['image']);

    $sql = "UPDATE initiatives SET 
                started_by='$started_by',
                hosted_location='$hosted_location',
                details='$details',
                main_description='$main_description',
                initiative_type='$initiative_type',
                image='$image'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $initiative_update_message = "Initiative updated successfully!";
    } else {
        $initiative_update_message = "Error updating initiative: " . $conn->error;
    }
}

// Handle Delete Initiative form submission
if (isset($_POST['delete_initiative'])) {
    $initiative_id = intval($_POST['initiative_id_delete']);
    $sql = "DELETE FROM initiatives WHERE id = $initiative_id";
    if ($conn->query($sql) === TRUE) {
        $initiative_delete_message = "Initiative deleted successfully!";
    } else {
        $initiative_delete_message = "Error deleting initiative: " . $conn->error;
    }
}

// -------------------- Feedback Section --------------------
$feedback_results = $conn->query("SELECT * FROM user_feedback");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Marine Life Encyclopedia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .section-title {
      margin-top: 2rem;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>
  <!-- Admin Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="admin.php">Admin Dashboard</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link btn btn-danger text-white" href="../Login_reg/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <!-- -------------------- Species Management Section -------------------- -->
    <div class="row">
      <!-- Add Species Section (Left Column) -->
      <div class="col-md-6">
        <h2 class="section-title">Add New Species</h2>
        <?php if (isset($message)) echo '<div class="alert alert-info">'.$message.'</div>'; ?>
        <form method="POST" action="admin.php">
          <!-- Species form fields -->
          <div class="mb-3">
            <label for="name" class="form-label">Species Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="scientific_name" class="form-label">Scientific Name</label>
            <input type="text" class="form-control" id="scientific_name" name="scientific_name">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="habitat" class="form-label">Habitat</label>
            <select class="form-select" id="habitat" name="habitat">
              <option value="Ocean">Ocean</option>
              <option value="Coral Reef">Coral Reef</option>
              <option value="Deep Sea">Deep Sea</option>
              <option value="Freshwater">Freshwater</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="diet" class="form-label">Diet</label>
            <input type="text" class="form-control" id="diet" name="diet">
          </div>
          <div class="mb-3">
            <label for="conservation_status" class="form-label">Conservation Status</label>
            <select class="form-select" id="conservation_status" name="conservation_status">
              <option value="Vulnerable">Vulnerable</option>
              <option value="Endangered">Endangered</option>
              <option value="Least Concern">Least Concern</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="interesting_facts" class="form-label">Interesting Facts</label>
            <textarea class="form-control" id="interesting_facts" name="interesting_facts" rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label for="related_species" class="form-label">Related Species</label>
            <input type="text" class="form-control" id="related_species" name="related_species">
          </div>
          <div class="mb-3">
            <label for="top_image_url" class="form-label">Top Image URL</label>
            <input type="text" class="form-control" id="top_image_url" name="top_image_url">
          </div>
          <div class="mb-3">
            <label for="bottom_image_url" class="form-label">Bottom Image URL</label>
            <input type="text" class="form-control" id="bottom_image_url" name="bottom_image_url">
          </div>
          <div class="mb-3">
            <label for="video_url" class="form-label">Video URL</label>
            <input type="text" class="form-control" id="video_url" name="video_url">
          </div>
          <div class="mb-3">
            <label for="final_description" class="form-label">Final Detailed Description</label>
            <textarea class="form-control" id="final_description" name="final_description" rows="4"></textarea>
          </div>
          <div class="mb-3">
            <label for="vulnerability" class="form-label">Vulnerability</label>
            <select class="form-select" id="vulnerability" name="vulnerability">
              <option value="Low">Low</option>
              <option value="Medium">Medium</option>
              <option value="High">High</option>
            </select>
          </div>
          <button type="submit" name="add_species" class="btn btn-success">Add Species</button>
        </form>
      </div>

      <!-- Update Species Section (Right Column) -->
      <div class="col-md-6">
        <h2 class="section-title">Update Species</h2>
        <?php if (isset($update_message)) echo '<div class="alert alert-info">'.$update_message.'</div>'; ?>
        <div class="mb-3">
          <label for="species_id_fetch" class="form-label">Enter Species ID to Fetch Data</label>
          <div class="input-group">
            <input type="number" class="form-control" id="species_id_fetch" placeholder="Species ID">
            <button type="button" class="btn btn-primary" onclick="fetchSpecies()">Fetch</button>
          </div>
        </div>
        <form id="updateForm" method="POST" action="admin.php">
          <!-- Hidden field for species ID -->
          <input type="hidden" id="id" name="id">
          <div class="mb-3">
            <label for="name_update" class="form-label">Species Name</label>
            <input type="text" class="form-control" id="name_update" name="name">
          </div>
          <div class="mb-3">
            <label for="scientific_name_update" class="form-label">Scientific Name</label>
            <input type="text" class="form-control" id="scientific_name_update" name="scientific_name">
          </div>
          <div class="mb-3">
            <label for="description_update" class="form-label">Description</label>
            <textarea class="form-control" id="description_update" name="description" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="habitat_update" class="form-label">Habitat</label>
            <select class="form-select" id="habitat_update" name="habitat">
              <option value="Ocean">Ocean</option>
              <option value="Coral Reef">Coral Reef</option>
              <option value="Deep Sea">Deep Sea</option>
              <option value="Freshwater">Freshwater</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="diet_update" class="form-label">Diet</label>
            <input type="text" class="form-control" id="diet_update" name="diet">
          </div>
          <div class="mb-3">
            <label for="conservation_status_update" class="form-label">Conservation Status</label>
            <select class="form-select" id="conservation_status_update" name="conservation_status">
              <option value="Vulnerable">Vulnerable</option>
              <option value="Endangered">Endangered</option>
              <option value="Least Concern">Least Concern</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="interesting_facts_update" class="form-label">Interesting Facts</label>
            <textarea class="form-control" id="interesting_facts_update" name="interesting_facts" rows="2"></textarea>
          </div>
          <div class="mb-3">
            <label for="related_species_update" class="form-label">Related Species</label>
            <input type="text" class="form-control" id="related_species_update" name="related_species">
          </div>
          <div class="mb-3">
            <label for="top_image_url_update" class="form-label">Top Image URL</label>
            <input type="text" class="form-control" id="top_image_url_update" name="top_image_url">
          </div>
          <div class="mb-3">
            <label for="bottom_image_url_update" class="form-label">Bottom Image URL</label>
            <input type="text" class="form-control" id="bottom_image_url_update" name="bottom_image_url">
          </div>
          <div class="mb-3">
            <label for="video_url_update" class="form-label">Video URL</label>
            <input type="text" class="form-control" id="video_url_update" name="video_url">
          </div>
          <div class="mb-3">
            <label for="final_description_update" class="form-label">Final Detailed Description</label>
            <textarea class="form-control" id="final_description_update" name="final_description" rows="4"></textarea>
          </div>
          <div class="mb-3">
            <label for="vulnerability_update" class="form-label">Vulnerability</label>
            <select class="form-select" id="vulnerability_update" name="vulnerability">
              <option value="Low">Low</option>
              <option value="Medium">Medium</option>
              <option value="High">High</option>
            </select>
          </div>
          <button type="submit" name="update_species" class="btn btn-warning">Update Species</button>
        </form>
      </div>
    </div>

    <hr>

    <!-- Delete Species Section -->
    <h2 class="section-title">Delete Species</h2>
    <?php if (isset($delete_message)) echo '<div class="alert alert-info">'.$delete_message.'</div>'; ?>
    <form method="POST" action="admin.php">
      <div class="mb-3">
        <label for="species_id" class="form-label">Species ID</label>
        <input type="number" class="form-control" id="species_id" name="species_id" required>
      </div>
      <button type="submit" name="delete_species" class="btn btn-danger">Delete Species</button>
    </form>

    <hr>

    <!-- -------------------- Initiative Management Section -------------------- -->
    <div class="row">
      <!-- Add Initiative Section (Left Column) -->
      <div class="col-md-6">
        <h2 class="section-title">Add New Initiative</h2>
        <?php if (isset($initiative_message)) echo '<div class="alert alert-info">'.$initiative_message.'</div>'; ?>
        <form method="POST" action="admin.php">
          <div class="mb-3">
            <label for="started_by" class="form-label">Started By</label>
            <input type="text" class="form-control" id="started_by" name="started_by" required>
          </div>
          <div class="mb-3">
            <label for="hosted_location" class="form-label">Hosted Location</label>
            <input type="text" class="form-control" id="hosted_location" name="hosted_location" required>
          </div>
          <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea class="form-control" id="details" name="details" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="main_description" class="form-label">Main Description</label>
            <textarea class="form-control" id="main_description" name="main_description" rows="4"></textarea>
          </div>
          <div class="mb-3">
            <label for="initiative_type" class="form-label">Initiative Type</label>
            <select class="form-select" id="initiative_type" name="initiative_type">
              <option value="ocean_cleanup">Ocean Clean Up</option>
              <option value="marine_protected_areas">Marine Protected Areas</option>
              <option value="sustainable_fishing">Sustainable Fishing</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="image" name="image">
          </div>
          <button type="submit" name="add_initiative" class="btn btn-success">Add Initiative</button>
        </form>
      </div>

      <!-- Update Initiative Section (Right Column) -->
      <div class="col-md-6">
        <h2 class="section-title">Update Initiative</h2>
        <?php if (isset($initiative_update_message)) echo '<div class="alert alert-info">'.$initiative_update_message.'</div>'; ?>
        <div class="mb-3">
          <label for="initiative_id_fetch" class="form-label">Enter Initiative ID to Fetch Data</label>
          <div class="input-group">
            <input type="number" class="form-control" id="initiative_id_fetch" placeholder="Initiative ID">
            <button type="button" class="btn btn-primary" onclick="fetchInitiative()">Fetch</button>
          </div>
        </div>
        <form id="updateInitiativeForm" method="POST" action="admin.php">
          <!-- Hidden field for initiative ID -->
          <input type="hidden" id="initiative_id" name="initiative_id">
          <div class="mb-3">
            <label for="started_by_update" class="form-label">Started By</label>
            <input type="text" class="form-control" id="started_by_update" name="started_by">
          </div>
          <div class="mb-3">
            <label for="hosted_location_update" class="form-label">Hosted Location</label>
            <input type="text" class="form-control" id="hosted_location_update" name="hosted_location">
          </div>
          <div class="mb-3">
            <label for="details_update" class="form-label">Details</label>
            <textarea class="form-control" id="details_update" name="details" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="main_description_update" class="form-label">Main Description</label>
            <textarea class="form-control" id="main_description_update" name="main_description" rows="4"></textarea>
          </div>
          <div class="mb-3">
            <label for="initiative_type_update" class="form-label">Initiative Type</label>
            <select class="form-select" id="initiative_type_update" name="initiative_type">
              <option value="ocean_cleanup">Ocean Clean Up</option>
              <option value="marine_protected_areas">Marine Protected Areas</option>
              <option value="sustainable_fishing">Sustainable Fishing</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="image_update" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="image_update" name="image">
          </div>
          <button type="submit" name="update_initiative" class="btn btn-warning">Update Initiative</button>
        </form>
      </div>
    </div>

    <hr>

    <!-- Delete Initiative Section -->
    <h2 class="section-title">Delete Initiative</h2>
    <?php if (isset($initiative_delete_message)) echo '<div class="alert alert-info">'.$initiative_delete_message.'</div>'; ?>
    <form method="POST" action="admin.php">
      <div class="mb-3">
        <label for="initiative_id_delete" class="form-label">Initiative ID</label>
        <input type="number" class="form-control" id="initiative_id_delete" name="initiative_id_delete" required>
      </div>
      <button type="submit" name="delete_initiative" class="btn btn-danger">Delete Initiative</button>
    </form>

    <hr>

    <!-- -------------------- Feedback Section -------------------- -->
    <h2 class="section-title">User Feedback</h2>
    <?php if ($feedback_results && $feedback_results->num_rows > 0): ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Feedback ID</th>
            <th>Login ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Feedback</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $feedback_results->fetch_assoc()): ?>
            <tr>
              <td><?php echo $row['feedback_id']; ?></td>
              <td><?php echo $row['loginId']; ?></td>
              <td><?php echo $row['username']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['feedback']; ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p>No feedback available.</p>
    <?php endif; ?>
  </div>

  <?php $conn->close(); ?>

  <!-- JavaScript to fetch species data for update form -->
  <script>
    function fetchSpecies() {
      const speciesId = document.getElementById('species_id_fetch').value;
      if (!speciesId) {
        alert('Please enter a Species ID.');
        return;
      }
      fetch(`get_species.php?id=${speciesId}`)
        .then(response => response.json())
        .then(data => {
          if (data && data.id) {
            // Fill hidden ID field
            document.getElementById('id').value = data.id;
            // Fill update form fields for species
            document.getElementById('name_update').value = data.name;
            document.getElementById('scientific_name_update').value = data.scientific_name;
            document.getElementById('description_update').value = data.description;
            document.getElementById('habitat_update').value = data.habitat;
            document.getElementById('diet_update').value = data.diet;
            document.getElementById('conservation_status_update').value = data.conservation_status;
            document.getElementById('interesting_facts_update').value = data.interesting_facts;
            document.getElementById('related_species_update').value = data.related_species;
            document.getElementById('top_image_url_update').value = data.top_image_url;
            document.getElementById('bottom_image_url_update').value = data.bottom_image_url;
            document.getElementById('video_url_update').value = data.video_url;
            document.getElementById('final_description_update').value = data.final_description;
            document.getElementById('vulnerability_update').value = data.vulnerability;
          } else {
            alert("Species not found!");
          }
        })
        .catch(error => {
          console.error("Error fetching species:", error);
          alert("Error fetching species data.");
        });
    }

    // Function to fetch initiative data for update form
    function fetchInitiative() {
      const initiativeId = document.getElementById('initiative_id_fetch').value;
      if (!initiativeId) {
        alert('Please enter an Initiative ID.');
        return;
      }
      fetch(`get_initiative.php?id=${initiativeId}`)
        .then(response => response.json())
        .then(data => {
          if (data && data.id) {
            // Fill hidden initiative ID field
            document.getElementById('initiative_id').value = data.id;
            // Fill update form fields for initiative
            document.getElementById('started_by_update').value = data.started_by;
            document.getElementById('hosted_location_update').value = data.hosted_location;
            document.getElementById('details_update').value = data.details;
            document.getElementById('main_description_update').value = data.main_description;
            document.getElementById('initiative_type_update').value = data.initiative_type;
            document.getElementById('image_update').value = data.image;
          } else {
            alert("Initiative not found!");
          }
        })
        .catch(error => {
          console.error("Error fetching initiative:", error);
          alert("Error fetching initiative data.");
        });
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
