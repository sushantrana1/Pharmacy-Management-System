<?php
$conn = new mysqli("localhost", "root", "", "pharmacy");
$settings = $conn->query("SELECT * FROM stock_settings LIMIT 1")
                 ->fetch_assoc();
?>

<div class="settings-card">
  <h3>Stock Alert Configuration</h3>
  <form method="POST" action="update_settings.php">
    <label>Low Stock Threshold Quantity:</label>
    <input type="number" name="threshold_qty" 
           value="<?= $settings['threshold_qty'] ?>" 
           min="1" required>
    <small>Alert when medicine quantity falls to or below this number</small>
    <br><br>
    <button type="submit">Save Settings</button>
  </form>
</div>