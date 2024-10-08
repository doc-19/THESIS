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
          <td>${item.issuance}</td>
          <td>${item.ending_balance}</td>
          <td>₱${item.total_cost}</td>
          
          <td>
            <button class="edit-btn" data-id="${item.inventory_id}">Edit</button>
            <button class="delete-btn" data-id="${item.inventory_id}">
              Delete
            </button>
          </td>
        `;

        

        const editButton = row.querySelector(".edit-btn");
        editButton.addEventListener("click", () => openEditModal(item));

        const deleteButton = row.querySelector(".delete-btn");
        deleteButton.addEventListener("click", () => deleteItem(item.inventory_id));

        
  
        tableBody.appendChild(row); 
      });
    };

    const openEditModal = (item) => {
      const editModal = document.getElementById("editItemModal");
      document.getElementById("edit-inventory-id").value = item.inventory_id;
      document.getElementById("edit-medicine-name").value = item.item_description;
      document.getElementById("edit-brand-name").value = item.brand_name;
      document.getElementById("edit-stock-qty").value = item.beginning_quantity;
      document.getElementById("edit-unit-measurement").value = item.unit_measurement;
      document.getElementById("edit-cost-per-unit").value = item.unit_cost;
      document.getElementById("edit-issuance-qty").value = item.issuance;
      const totalAmount = item.unit_cost * item.issuance;  
      document.getElementById("edit-total-amount").value = totalAmount.toFixed(2);


      editModal.style.display = "block"; 
  }

  
  document.getElementById("editItemForm").addEventListener("submit", async function(event) {
      event.preventDefault();

      const inventoryId = document.getElementById("edit-inventory-id").value;
      const medicineName = document.getElementById("edit-medicine-name").value;
      const brand_name = document.getElementById("edit-brand-name").value;
      const stockQty = document.getElementById("edit-stock-qty").value;
      const unitMeasurement = document.getElementById("edit-unit-measurement").value;
      const costPerUnit = document.getElementById("edit-cost-per-unit").value;
      const issuanceQty = parseFloat(document.getElementById("edit-issuance-qty").value);
      
      const updatedItem = {
          inventory_id: inventoryId,
          medicine_name: medicineName,
          brand_name: brand_name,
          stock_qty: stockQty,
          unit_measurement: unitMeasurement,
          cost_per_unit: costPerUnit,
          issuance_qty: issuanceQty
      };

      try {
          const response = await fetch('API/InventoryAPI.php', {
              method: 'PUT',
              headers: {
                  'Content-Type': 'application/json'
              },
              body: JSON.stringify(updatedItem)
          });
          
          const result = await response.json();

          if (response.ok) {
              alert(result.message);
              document.getElementById("editItemModal").style.display = "none"; // Hide the modal
              fetchInventoryData();  
          } else {
              alert(result.message);
          }
      } catch (error) {
          console.error("Error updating item:", error);
      }
  });
    
  //FETCHING TEYBOL
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
      const stockQty = parseFloat(document.getElementById("stock-qty").value);
      const unit_measurement = document.getElementById("unit-measurement").value;
      const costPerUnit = document.getElementById("cost-per-unit").value;
      const issuanceQty = parseFloat(document.getElementById("issuance-qty").value);
      const totalAmount = (parseFloat(issuanceQty) * parseFloat(costPerUnit)).toFixed(2);

      
  
      const newItem = {
        medicine_name: medicineName,
        brand_name: brand_name,
        stock_qty: stockQty,
        unit_measurement: unit_measurement,
        cost_per_unit: costPerUnit,
        issuance_qty: issuanceQty,
        totalAmount: totalAmount
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
      console.log('Stock Qty:', stockQty, 'Issuance Qty:', issuanceQty, "UNIT:" ,  unit_measurement);

      } catch (error) {
        console.error("Error adding item:", error);
      }
    });
  
  
  });
  