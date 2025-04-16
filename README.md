# 🌊 Marine Life Encyclopedia

A Marine life information website that allows users to explore detailed species data, watch videos, and provide feedback — all through a dynamic, user-friendly interface.

---

## ⚙️ Setup Instructions

1. **Clone the repository**  
    bash
   git clone `https://github.com/Siddhantshukla1657/Life_Below_The_Water`

2. **Import the SQL database**
   - Open your MySQL client (like phpMyAdmin or MySQL Workbench).
   - Import the provided `.sql`.

3. **Configure your environment**
   - In the `.php` files, update the following:
     php codes snnipet
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "user-db";

4. **Run the server**
   - Use XAMPP, WAMP, or any local PHP server.
   - Place the project in the `htdocs` folder (for XAMPP).
   - Start Apache and MySQL services.
   - Access via `http://localhost/Life_Below_The_Water`

---

## 🛠 Tech Stack

- **Frontend**: HTML, CSS (Blue-themed design),Bootstrap, JavaScript (for search & filters),
- **Backend**: PHP
- **Database**: MySQL
- **Web Server**: Apache (via XAMPP)

---

## 🌟 Features

- 🔍 **Live Search with Autocomplete**  
  Real-time species name suggestions as users type.

- 🐠 **Dynamic Species Cards**  
  Fetched from the database with filterable tags for habitat and vulnerability.

- 📄 **Detailed Species Page**  
  Displays name, scientific name, images, videos, habitat, diet, conservation status, fun facts, and related species.

- 🧱 **Framed Navigation System**  
  Split layout with sidebars and bottom navigation for seamless browsing.

- 🔐 **Admin Panel**  
  Protected login admin accounts to:
  - Add, Update or remove species
  - Add, Update or remove initiative
  - View user feedback

- 💬 **User Feedback Form**  
  Logged-in users can submit feedback (100 words max), stored in a linked database table.

- 🌿 **Habitat & Conservation Tags**
  Each species is tagged with one of three habitat types  and one of three conservation vulnerability levels.
  - These tags are filterable and visually highlighted for quick reference.
