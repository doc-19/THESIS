<div id="addItemModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Add New Item</h2>
        <form id="addItemForm">
        <label for="medicine-name">Medicine Name:</label>
        <input type="text" id="medicine-name" name="medicine-name" required><br>

        <label for="medicine-id">Medicine ID:</label>
        <input type="text" id="medicine-id" name="medicine-id" required><br>

        <label for="stock-qty">Stock in Qty:</label>
        <input type="number" id="stock-qty" name="stock-qty" required><br>

        <label for="unit-measurement">Unit of Measurement:</label>
        <input type="text" id="unit-measurement" name="unit-measurement" required><br>

        <label for="cost-per-unit">Cost per Unit:</label>
        <input type="number" id="cost-per-unit" name="cost-per-unit" required><br>

        <button type="submit">Add Item</button>
        </form>
    </div>
    </div>