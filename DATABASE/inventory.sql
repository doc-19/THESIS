CREATE DATABASE resource_management_system_inventory;

USE  resource_management_system_inventory;

CREATE TABLE system_item_requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    inventory_id INT NOT NULL,  -- Foreign key referencing the inventory table in system_inventory
    requested_quantity int NOT NULL,
    total_price DECIMAL(20, 2),
    request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    status_completed ENUM('Pending', 'Completed') DEFAULT 'Pending',
    FOREIGN KEY (inventory_id) REFERENCES inventory(inventory_id),
    FOREIGN KEY (user_id) REFERENCES resource_management_system_user.other_user(other_id)
);

CREATE TABLE inventory (
    inventory_id INT AUTO_INCREMENT PRIMARY KEY,
    item_description TEXT,
    unit_measurement VARCHAR(20),
    beginning_quantity INT NOT NULL,
    unit_cost FLOAT NOT NULL,
    issuance INT NOT NULL,
    ending_balance INT NOT NULL,
    total_cost FLOAT NOT NULL
);

