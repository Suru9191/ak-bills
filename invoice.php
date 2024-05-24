<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AK WATERS</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: powderblue;
        }

        .button-container {
            margin-bottom: 20px;
        }

        button {
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>AK WATER SUPPLIERS</h1>
        <div class="invoice-details">
            <?php
            // Define initial invoice details
            $invoice_number = "000000";
            $customer_name = "";
            $invoice_date = date("d-m-Y");
            $due_date = date('Y-m-d', strtotime($invoice_date . ' + 30 days'));
            ?>
            <div class="invoice-details">
                <label for="invoice_number">Invoice Number:</label>
                <input type="text" id="invoice_number" name="invoice_number" value="<?php echo $invoice_number; ?>">

                <label for="customer_name">Customer Name:</label>
                <input type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>">

                <label for="invoice_date">Invoice Date:</label>
                <input type="date" id="invoice_date" name="invoice_date" value="<?php echo $invoice_date; ?>">

                <label for="due_date">Due Date:</label>
                <input type="date" id="due_date" name="due_date" value="<?php echo $due_date; ?>">
            </div>


            <div class="button-container">
                <button onclick="addRow()" class="btn btn-primary">Add Row</button>
                <button onclick="printBill()">Print Bill</button>
                <button onclick="ViewBill()">View Bill</button>
            </div>
            <table id="myTable">
                <thead>
                    <tr>
                        <th>DATE</th>
                        <th>LITER</th>
                        <th>Challan</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Table body will be dynamically populated -->
                </tbody>
            </table>

            <div id="billSummaryContainer">
                <!-- Bill summary will be displayed here -->
            </div>
        </div>

        <script>
function printBill() {
    // Get the content of the bill summary container
    var billContent = document.getElementById('billSummaryContainer').innerHTML;

    // Open a new window for printing
    var printWindow = window.open('', '_blank');
    
    // Write the bill content to the new window
    printWindow.document.write('<html><head><title>JAI BAJRANGBALI</title>');
    printWindow.document.write('<style>');
    printWindow.document.write('body { font-family: Arial, sans-serif; }');
    printWindow.document.write('table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }');
    printWindow.document.write('table, th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }');
    printWindow.document.write('th { background-color: powderblue; }');
    printWindow.document.write('</style>');
    printWindow.document.write('</head><body>');

    // Header for the printed bill
    printWindow.document.write('<h1 style="text-align: center;">AK WATER SUPPLIERS</h1>');

    // Write invoice details
    var invoiceNumber = document.getElementById("invoice_number").value;
    var customerName = document.getElementById("customer_name").value;
    var invoiceDate = document.getElementById("invoice_date").value;
    var dueDate = document.getElementById("due_date").value;

    printWindow.document.write('<div><strong>Invoice Number:</strong> ' + invoiceNumber + '</div>');
    printWindow.document.write('<div><strong>Customer Name:</strong> ' + customerName + '</div>');
    printWindow.document.write('<div><strong>Invoice Date:</strong> ' + invoiceDate + '</div>');
    printWindow.document.write('<div><strong>Due Date:</strong> ' + dueDate + '</div>');

    // Write table of items
    printWindow.document.write('<table>');
    printWindow.document.write('<thead><tr><th>Date</th><th>Liter</th><th>Challan</th><th>Quantity</th><th>Price</th><th>Total</th></tr></thead>');
    printWindow.document.write('<tbody>');

    var tableBody = document.getElementById("tableBody");
    var rows = tableBody.getElementsByTagName("tr");
    var grandTotal = 0;

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        if (cells.length > 0) {
            var date = cells[0].querySelector('.dateInput').value;
            var liter = cells[1].querySelector('.literInput').value;
            var challan = cells[2].querySelector('.challanInput').value;
            var quantity = parseFloat(cells[3].querySelector('.quantityInput').value);
            var price = parseFloat(cells[4].querySelector('.priceInput').value);
            var total = isNaN(quantity) || isNaN(price) ? '-' : (quantity * price).toFixed(2);

            printWindow.document.write('<tr><td>' + date + '</td><td>' + liter + '</td><td>' + challan + '</td><td>' + quantity + '</td><td>' + price.toFixed(2) + '</td><td>' + total + '</td></tr>');

            if (!isNaN(quantity) && !isNaN(price)) {
                grandTotal += parseFloat(total);
            }
        }
    }

    printWindow.document.write('</tbody>');
    printWindow.document.write('</table>');

    // Write total amount
    printWindow.document.write('<h3 style="text-align: right;">Total Amount: ' + grandTotal.toFixed(2) + '</h3>');

    printWindow.document.write('</body></html>');

    // Close the document for printing
    printWindow.document.close();

    // Print the newly opened window
    printWindow.print();

    // Close the print window after printing
    printWindow.close();
}
</script>
<script>



              function generateBill() {
                // Retrieve invoice details from input fields
                var invoiceNumber = document.getElementById("invoice_number").value;
                var customerName = document.getElementById("customer_name").value;
                var invoiceDate = document.getElementById("invoice_date").value;
                var dueDate = document.getElementById("due_date").value;

                var tableBody = document.getElementById("tableBody");
                var rows = tableBody.getElementsByTagName("tr");

                var billSummary = '<h2>AK WATER SUPPILERS</h2>';
                billSummary += '<div><strong>Invoice Number:</strong> ' + invoiceNumber + '</div>';
                billSummary += '<div><strong>Customer Name:</strong> ' + customerName + '</div>';
                billSummary += '<div><strong>Invoice Date:</strong> ' + invoiceDate + '</div>';
                billSummary += '<div><strong>Due Date:</strong> ' + dueDate + '</div>';
                billSummary += '<table>';
                billSummary += '<thead><tr><th>Date</th><th>Liter</th><th>Challan</th><th>Quantity</th><th>Price</th><th>Total</th></tr></thead>';
                billSummary += '<tbody>';

                var grandTotal = 0;
                for (var i = 0; i < rows.length; i++) {
                    var cells = rows[i].getElementsByTagName("td");
                    if (cells.length > 0) {
                        var date = cells[0].querySelector('.dateInput').value;
                        var liter = cells[1].querySelector('.literInput').value;
                        var challan = cells[2].querySelector('.challanInput').value;
                        var quantity = parseFloat(cells[3].querySelector('.quantityInput').value);
                        var price = parseFloat(cells[4].querySelector('.priceInput').value);
                        var total = isNaN(quantity) || isNaN(price) ? '-' : (quantity * price).toFixed(2);

                        billSummary += '<tr><td>' + date + '</td><td>' + liter + '</td><td>' + challan + '</td><td>' + quantity + '</td><td>' + price.toFixed(2) + '</td><td>' + total + '</td></tr>';

                        if (!isNaN(quantity) && !isNaN(price)) {
                            grandTotal += parseFloat(total);
                        }
                    }
                }

                billSummary += '</tbody>';
                billSummary += '</table>';
                billSummary += '<h3>Total Amount: ' + grandTotal.toFixed(2) + '</h3>';

                var billSummaryContainer = document.getElementById('billSummaryContainer');
                if (billSummaryContainer) {
                    billSummaryContainer.innerHTML = billSummary;
                } else {
                    console.error('Bill summary container not found.');
                }
                window.print();
            }
            function addRow() {
                var tableBody = document.getElementById("tableBody");
                var newRow = tableBody.insertRow();

                // Define cell elements
                var dateCell = newRow.insertCell();
                var literCell = newRow.insertCell();
                var challanCell = newRow.insertCell(); // New cell for Challan
                var quantityCell = newRow.insertCell();
                var priceCell = newRow.insertCell();
                var totalCell = newRow.insertCell();
                var actionCell = newRow.insertCell();

                // Populate cells with input fields and buttons
                dateCell.innerHTML = '<input type="date" class="dateInput" value="' + getCurrentDate() + '">';
                literCell.innerHTML = '<input type="text" class="literInput">';
                challanCell.innerHTML = '<input type="text" class="challanInput">'; // Input field for Challan
                quantityCell.innerHTML = '<input type="number" class="quantityInput">';
                priceCell.innerHTML = '<input type="number" class="priceInput">';
                totalCell.innerHTML = '-';
                actionCell.innerHTML = '<button onclick="calculateTotal(this)" class="btn btn-success">Calculate</button> ' +
                    '<button onclick="editRow(this)">Edit</button> ' +
                    '<button onclick="deleteRow(this)" class="btn btn-danger">Delete</button>';
            }

            function calculateTotal(button) {
                var row = button.parentNode.parentNode;
                var quantity = parseFloat(row.cells[3].querySelector('.quantityInput').value);
                var price = parseFloat(row.cells[4].querySelector('.priceInput').value);
                var total = isNaN(quantity) || isNaN(price) ? '-' : (quantity * price).toFixed(2);
                row.cells[5].textContent = total;
            }

            function editRow(button) {
                var row = button.parentNode.parentNode;
                var dateInput = row.cells[0].querySelector('.dateInput');
                var literInput = row.cells[1].querySelector('.literInput');
                var challanInput = row.cells[2].querySelector('.challanInput');
                var quantityInput = row.cells[3].querySelector('.quantityInput');
                var priceInput = row.cells[4].querySelector('.priceInput');

                // Enable input fields for editing
                dateInput.removeAttribute('disabled');
                literInput.removeAttribute('disabled');
                challanInput.removeAttribute('disabled'); // Enable Challan input
                quantityInput.removeAttribute('disabled');
                priceInput.removeAttribute('disabled');

                // Change button text to "Save"
                button.textContent = 'Save';
                button.setAttribute('onclick', 'saveRow(this)');
            }

            function saveRow(button) {
                var row = button.parentNode.parentNode;
                var dateInput = row.cells[0].querySelector('.dateInput');
                var literInput = row.cells[1].querySelector('.literInput');
                var challanInput = row.cells[2].querySelector('.challanInput');
                var quantityInput = row.cells[3].querySelector('.quantityInput');
                var priceInput = row.cells[4].querySelector('.priceInput');

                // Disable input fields after saving
                dateInput.setAttribute('disabled', 'true');
                literInput.setAttribute('disabled', 'true');
                challanInput.setAttribute('disabled', 'true'); // Disable Challan input after saving
                quantityInput.setAttribute('disabled', 'true');
                priceInput.setAttribute('disabled', 'true');

                // Change button text back to "Edit"
                button.textContent = 'Edit';
                button.setAttribute('onclick', 'editRow(this)');
            }

            function deleteRow(button) {
                var row = button.parentNode.parentNode;
                row.remove();
            }

          

            function ViewBill() {
                // Retrieve invoice details from input fields
                var invoiceNumber = document.getElementById("invoice_number").value;
                var customerName = document.getElementById("customer_name").value;
                var invoiceDate = document.getElementById("invoice_date").value;
                var dueDate = document.getElementById("due_date").value;

                var tableBody = document.getElementById("tableBody");
                var rows = tableBody.getElementsByTagName("tr");

                var billSummary = '<h2>AK WATER SUPPILERS</h2>';
                billSummary += '<div><strong>Invoice Number:</strong> ' + invoiceNumber + '</div>';
                billSummary += '<div><strong>Customer Name:</strong> ' + customerName + '</div>';
                billSummary += '<div><strong>Invoice Date:</strong> ' + invoiceDate + '</div>';
                billSummary += '<div><strong>Due Date:</strong> ' + dueDate + '</div>';
                billSummary += '<table>';
                billSummary += '<thead><tr><th>Date</th><th>Liter</th><th>Challan</th><th>Quantity</th><th>Price</th><th>Total</th></tr></thead>';
                billSummary += '<tbody>';

                var grandTotal = 0;
                for (var i = 0; i < rows.length; i++) {
                    var cells = rows[i].getElementsByTagName("td");
                    if (cells.length > 0) {
                        var date = cells[0].querySelector('.dateInput').value;
                        var liter = cells[1].querySelector('.literInput').value;
                        var challan = cells[2].querySelector('.challanInput').value;
                        var quantity = parseFloat(cells[3].querySelector('.quantityInput').value);
                        var price = parseFloat(cells[4].querySelector('.priceInput').value);
                        var total = isNaN(quantity) || isNaN(price) ? '-' : (quantity * price).toFixed(2);

                        billSummary += '<tr><td>' + date + '</td><td>' + liter + '</td><td>' + challan + '</td><td>' + quantity + '</td><td>' + price.toFixed(2) + '</td><td>' + total + '</td></tr>';

                        if (!isNaN(quantity) && !isNaN(price)) {
                            grandTotal += parseFloat(total);
                        }
                    }
                }

                billSummary += '</tbody>';
                billSummary += '</table>';
                billSummary += '<h3>Total Amount: ' + grandTotal.toFixed(2) + '</h3>';

                // Display the bill summary
                var billSummaryContainer = document.getElementById('billSummaryContainer');
                if (billSummaryContainer) {
                    billSummaryContainer.innerHTML = billSummary;
                } else {
                    console.error('Bill summary container not found.');
                }
            
            }

            function getCurrentDate() {
                var now = new Date();
                var year = now.getFullYear();
                var month = (now.getMonth() + 1).toString().padStart(2, '0');
                var day = now.getDate().toString().padStart(2, '0');
                return `${year}-${month}-${day}`;
            }
        </script>

    </div>

</body>

</html>
