<!DOCTYPE html>
<html>
<head>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <style>
    table {
      font-family: Arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
</head>

<body>

<h2>HTML Table</h2>

<table id="data-table">
  <thead>
    <tr>
      <th>fname</th>
      <th>lname</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Database connection
    $servername = "localhost"; // Replace with your server name
    $username = "root";        // Replace with your database username
    $password = "";            // Replace with your database password
    $dbname = "php_chat"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch existing messages
    $sql = "SELECT fname, lname FROM messages ORDER BY id asc";
    $result = $conn->query($sql);

    // Check for query errors
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Display existing messages
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row["fname"]) . "</td><td>" . htmlspecialchars($row["lname"]) . "</td></tr>";
        }
    }
    $conn->close();
    ?>
  </tbody>
</table>

<script>
  // Enable pusher logging - don't include this in production
  //Pusher.logToConsole = true;

  var pusher = new Pusher('key', {
    cluster: 'ap2'
  });

  var channel = pusher.subscribe('chat'); // Channel name
  channel.bind('2', function(data) { // Event name
    console.log('Data received:', data);

    // Check if data has fname and lname
    if (data.fname && data.lname) {
      // Get table body element
      var tbody = document.querySelector('#data-table tbody');

      // Create a new row
      var row = document.createElement('tr');

      // Create and append cells to the row
      var cell1 = document.createElement('td');
      cell1.textContent = data.fname;
      row.appendChild(cell1);

      var cell2 = document.createElement('td');
      cell2.textContent = data.lname;
      row.appendChild(cell2);

      // Append the new row to the bottom of the table
      tbody.appendChild(row);
    } else {
      console.error('Invalid data format:', data);
    }
  });
</script>
</body>
</html>
