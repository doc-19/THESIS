document.addEventListener("DOMContentLoaded", () => {
    const fetchInventoryData = async () => {
      try {
        const response = await fetch('API/InventoryAPI.php');
        console.log(response);
        const inventory = await response.json();
  
        
        if (Array.isArray(inventory)) {
          populateInventoryTable(inventory); 
        } else {
          console.error("No inventory data available.");
        }
      } catch (error) {
        console.error("Error fetching inventory data:", error);
      }
    };
  
    
    
    const populateInventoryTable = (items) => {
      const tableBody = document.querySelector("tbody");
      tableBody.innerHTML = ""; 
  
      
      items.forEach(item => {
        const row = document.createElement("tr");
  
        row.innerHTML = `
          <td>${item.item_description}</td>
          <td>${item.inventory_id}</td>

          <td>${item.beginning_quantity}</td>
          <td>${item.unit_measurement}</td>
          <td>₱${item.unit_cost}</td>
        `;
  
        tableBody.appendChild(row); 
      });

      document.getElementById("no-data-message").style.display = "none";
    };
    
    const displayNoDataMessage = () => {
        document.getElementById("no-data-message").style.display = "block";
      };
    
    fetchInventoryData();
  });
  