<div id="editItemModal" class="modal">
  <div class="modal-content">
    <span class="close-btn">&times;</span>
    <h2>Edit Item</h2>
    <form id="editItemForm">
      <input type="hidden" id="edit-inventory-id">
      <label for="edit-medicine-name">Medicine Name</label>
      <input type="text" id="edit-medicine-name" required>
      
      <label for="edit-brand-name">Brand Name</label>
      <input type="text" id="edit-brand-name" required>
      
      <label for="edit-stock-qty">Stock Quantity</label>
      <input type="number" id="edit-stock-qty" required>
      
      <label for="edit-unit-measurement">Unit Measurement</label>
      <input type="text" id="edit-unit-measurement" required>
      
      <label for="edit-cost-per-unit">Cost per Unit</label>
      <input type="number" step="0.01" id="edit-cost-per-unit" required>
      
      <button type="submit">Update Item</button>
    </form>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const editModal = document.getElementById("editItemModal");
    const closeBtn = document.querySelector("#editItemModal .close-btn");

    closeBtn.addEventListener("click", function() {
        editModal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target === editModal) {
            editModal.style.display = "none";
        }
    });
});

</script>
