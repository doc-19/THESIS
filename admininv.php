<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RMS Inventory</title>
    <link rel="stylesheet" href="styles/css/dash.css" />
    <link rel = "stylesheet" href = "styles/css/addItem.css" />
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="container">
      <div class="sidebar">
        <div class="logo-details">
          <div class="icon" style="font-size: 40px">AMS</div>
          <i class="bx bx-menu" id="btn"></i>
        </div>
        <ul class="sidebar-nav">
          <li>
            <a href="admindash.html">
              <i class='bx bx-grid-alt' id="icons"></i>
              <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
          </li>
          <li>
            <a href="admininv.html">
              <i class='bx bx-box' id="icons"></i>
              <span class="links_name">Inventory</span>
            </a>
            <span class="tooltip">Inventory</span>
          </li>
          <li>
            <a href="adminppmp.html">
              <i class='bx bxs-edit' id="icons"></i>
              <span class="links_name">PPMP</span>
            </a>
            <span class="tooltip">PPMP</span>
          </li>
          <li>
            <a href="adminsc.html" >
              <i class='bx bx-shape-circle' id="icons"></i>
              <span class="links_name">Supply Chain</span>
            </a>
            <span class="tooltip">Supply Chain</span>
          </li>
          <li>
            <a href="index.html" id="mlists">
              <i class='bx bx-log-out-circle' id="icons"></i>
              <span class="links_name">Logout</span>
            </a>
            <span class="tooltip">Logout</span>
          </li>
        </ul>
      </div>

      <div class="main-content">
        <header class="dashboard-header">
          <div class="date-time">
            <p>May 10, 2024</p>
            <p>8:00 AM</p>
          </div>
          <button class="download-btn">Download Report</button>
        </header>

        <section class="inventory-header">
          <div class="inventory-title">
            <h2>Inventory</h2>
            <p>List of medicines supplies.</p>
          </div>
          <div class="inventory-stats">
            <h3>Total Quantity of Medicines</h3>
            <p class="total-medicines">5,403</p>
            <div class="inventory-graph"></div>
          </div>
          <div class="inventory-controls">
            <input type="search" placeholder="Search the ID of Medicines..." />
            <button class="quick-edit-btn">Quick Edit</button>
            <button class="add-item-btn">Add New Item</button>
            <button class="check-items-btn">Import Items</button>
          </div>
        </section>

        <!-- Inventory Table -->
        <section class="inventory-table">
          <table>
            <thead>
              <tr>
                <th>Medicine Name</th>
                <th>Medicine ID</th>
                <th>Brand Name</th>
                <th>Stock in Qty</th>
                <th>Unit of Measurement</th>
                <th>Cost per Unit</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </section>
      </div>
    </div>
    <?php require_once 'assets/add_item_modal.php' ?>
    <?php require_once 'assets/edit_item_modal.php' ?>
    <script src="styles/js/app.js"></script>
    <script src = "Controller/InventoryController.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("addItemModal");
        var btn = document.querySelector(".add-item-btn");
        var span = document.querySelector(".close-btn");
        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
            modal.style.display = "none";
            }
        }

        form.addEventListener("submit", function(event) {
            event.preventDefault();
            alert("Item added successfully!");
            modal.style.display = "none";
        });

    });
    
    </script>
  </body>
</html>
