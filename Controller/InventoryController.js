document.addEventListener("DOMContentLoaded", () => {
    const fetchInventoryData = async () => {
        const response = await fetch('API/InventoryAPI.php');
        const inventory = await response.json();

        console.log(inventory);

        populateInventoryTable(inventory); 

    };
  
    
    
    const populateInventoryTable = (items) => {
      const tableBody = document.querySelector("tbody");
      tableBody.innerHTML = ""; 
  
      
      items.forEach(item => {
        const row = document.createElement("tr");
  
        row.innerHTML = `
          <td>${item.item_description}</td>
          <td>${item.inventory_id}</td>
          <td>${item.brand_name}</td>
          <td>${item.beginning_quantity}</td>
          <td>${item.unit_measurement}</td>
          <td>₱${item.unit_cost}</td>
          <td>
            <button class="delete-btn" data-id="${item.inventory_id}">
              Delete
            </button>
          </td>
        `;

        const deleteButton = row.querySelector(".delete-btn");
        deleteButton.addEventListener("click", () => deleteItem(item.inventory_id));
  
        tableBody.appendChild(row); 
      });

      // document.getElementById("no-data-message").style.display = "none";
    };
    
    // const displayNoDataMessage = () => {
    //     document.getElementById("no-data-message").style.display = "block";
    //   };
    
    fetchInventoryData();
    
    //Function DeleteItem
    function deleteItem(inventoryId) {
      if (confirm("Are you sure you want to delete this item?")) {
          fetch(`API/InventoryAPI.php`, {  
              method: 'DELETE',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify({ inventory_id: inventoryId }) 
          })
          .then(response => response.json())
          .then(data => {
                console.log(data); 
    
                if (data.message === 'Item deleted successfully') {
                    alert("Item deleted successfully.");
                    location.reload();  
                } else {
                    alert(data.message);  
                }
            })
            .catch(error => {
                console.error("Error deleting item:", error);
                alert("An error occurred while deleting the item.");
            });
        }
    }

    //POSTING 
    document.getElementById("addItemForm").addEventListener("submit", async function(event) {
      event.preventDefault();
      
      const medicineName = document.getElementById("medicine-name").value;
      const brand_name = document.getElementById("brand-name").value;
      const stockQty = document.getElementById("stock-qty").value;
      const unitMeasurement = document.getElementById("unit-measurement").value;
      const costPerUnit = document.getElementById("cost-per-unit").value;
  
      const newItem = {
        medicine_name: medicineName,
        brand_name: brand_name,
        stock_qty: stockQty,
        unit_measurement: unitMeasurement,
        cost_per_unit: costPerUnit
      };
  
      try {
        
        const response = await fetch('API/InventoryAPI.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(newItem)
        });
  
        const result = await response.json();
  
        if (response.ok) {
          alert(result.message); 
          document.getElementById("addItemForm").reset(); 
          document.getElementById("addItemModal").style.display = "none"; 
          fetchInventoryData(); 
        } else {
          alert(result.message); 
        }
      } catch (error) {
        console.error("Error adding item:", error);
      }
    });
  
  
  });
  