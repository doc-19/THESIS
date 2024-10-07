<div id="addItemModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Add New Item</h2>
        <form id="addItemForm">
        <label for="medicine-name">Medicine Name:</label>
        <input type="text" id="medicine-name" name="medicine-name" required><br>

        <label for="brand-name">Brand Name:</label>
        <input type="text" id="brand-name" name="brand-name" required><br>

        <label for="stock-qty">Stock in Qty:</label>
        <input type="number" id="stock-qty" name="stock-qty" required><br>

        <label for="unit-measurement">Unit of Measurement:</label>
        <input type="text" id="unit-measurement" name="unit-measurement" required><br>

        <label for="cost-per-unit">Cost per Unit:</label>
        <input type="number" id="cost-per-unit" name="cost-per-unit" required><br>

        <label for="issuance-qty">Issuance:</label>
        <input type="number" id="issuance-qty" name="issuance-qty" required><br>

        <label for="total-amount-qty">Total Amount:</label>
        <input type="number" id="total-amount" name="total-amount" readonly><br>


        <button type="submit">Submit</button>
        </form>
    </div>
    </div>

    <script>
        function calculateTotalAmount() {
            const qty = parseFloat(document.getElementById("issuance-qty").value) || 0;
            const unitCost = parseFloat(document.getElementById("cost-per-unit").value) || 0;
                    const totalAmount = qty * unitCost;
            document.getElementById("total-amount").value = totalAmount.toFixed(2);
        }

        document.getElementById("issuance-qty").addEventListener("input", calculateTotalAmount);
        document.getElementById("cost-per-unit").addEventListener("input", calculateTotalAmount);

    </script>