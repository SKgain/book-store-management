// invoice.js

// Initialize variables
let itemCount = 1;
let grandTotal = 0;

// Update total price for the items
function updateTotal() {
  let total = 0;
  for (let i = 1; i <= itemCount; i++) {
    const price = parseFloat(document.getElementById('price' + i).value);
    const quantity = parseInt(document.getElementById('quantity' + i).value);
    if (!isNaN(price) && !isNaN(quantity)) {
      const itemTotal = price * quantity;
      document.getElementById('total' + i).innerText = itemTotal;
      total += itemTotal;
    }
  }
  document.getElementById('grandTotal').innerText = total;
}

// Add new item row
function addItem() {
  itemCount++;
  const table = document.getElementById('invoiceTable').getElementsByTagName('tbody')[0];
  const row = table.insertRow();
  row.innerHTML = `
    <td><input type="text" id="item${itemCount}" placeholder="Item Description"></td>
    <td><input type="number" id="price${itemCount}" placeholder="Unit Price" onchange="updateTotal()"></td>
    <td><input type="number" id="quantity${itemCount}" placeholder="Quantity" onchange="updateTotal()"></td>
    <td><span id="total${itemCount}">0</span></td>
    <td><button onclick="removeItem(${itemCount})">Remove</button></td>
  `;
}

// Remove item row
function removeItem(itemId) {
  document.getElementById('invoiceTable').deleteRow(itemId);
  itemCount--;
  updateTotal();
}

// Generate invoice (simulating a backend PHP call)
function generateInvoice() {
  const customerName = document.getElementById('customerName').innerText;
  const customerAddress = document.getElementById('customerAddress').innerText;
  const items = [];

  for (let i = 1; i <= itemCount; i++) {
    const description = document.getElementById('item' + i).value;
    const price = parseFloat(document.getElementById('price' + i).value);
    const quantity = parseInt(document.getElementById('quantity' + i).value);
    if (description && !isNaN(price) && !isNaN(quantity)) {
      items.push({ description, price, quantity, total: price * quantity });
    }
  }

  // Send data to PHP (this part can be implemented for saving invoice in the database)
  fetch('generate_invoice.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ customerName, customerAddress, items, total: grandTotal })
  })
  .then(response => response.json())
  .then(data => {
    alert('Invoice generated successfully!');
    // Redirect or download invoice if needed
  })
  .catch(error => {
    console.error('Error generating invoice:', error);
    alert('Error generating invoice.');
  });
}
