<?php
// Establish database connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'assigment1';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $annualIncome = $_POST['annual_income'];
    $deductions = $_POST['deductions'];

    // Validate and sanitize input data
    $name = mysqli_real_escape_string($conn, $name);
    $number = mysqli_real_escape_string($conn, $number);
    $email = mysqli_real_escape_string($conn, $email);
    $age = intval($age);
    $annualIncome = floatval($annualIncome);
    $deductions = floatval($deductions);

    // Calculate taxable income
    $taxableIncome = max(0, $annualIncome - $deductions);
    $taxAsPerNewRegime = calculateTaxAsPerNewRegime($taxableIncome);
    $taxAsPerOldRegime = calculateTaxAsPerOldRegime($taxableIncome);

    // Store the details in the database
    $sql = "INSERT INTO users (name, number, email, age, annual_income, deductions, taxable_income, tax_new_regime, tax_old_regime)
            VALUES ('$name', '$number', '$email', $age, $annualIncome, $deductions, $taxableIncome, $taxAsPerNewRegime, $taxAsPerOldRegime)";

    if ($conn->query($sql) === TRUE) {
        echo "Record created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    // Close the database connection
    $conn->close();
}

// Function to calculate tax as per the new regime
function calculateTaxAsPerNewRegime($taxableIncome) {
    
    $slabs = array(
        0 => array('rate' => 0, 'limit' => 250000),
        1 => array('rate' => 5, 'limit' => 500000),
        2 => array('rate' => 10, 'limit' => 750000),
        3 => array('rate' => 15, 'limit' => 1000000),
        4 => array('rate' => 20, 'limit' => 1250000),
        5 => array('rate' => 25, 'limit' => 1500000),
        6 => array('rate' => 30, 'limit' => PHP_INT_MAX)
    );

    $tax = 0;
    $remainingIncome = $taxableIncome;

    // Iterate through the slabs to calculate the tax
    foreach ($slabs as $slab) {
        $rate = $slab['rate'];
        $limit = $slab['limit'];

        if ($remainingIncome <= 0) {
            break;
        }

        $taxableAmount = min($remainingIncome, $limit);
        $tax += ($taxableAmount * $rate) / 100;
        $remainingIncome -= $taxableAmount;
    }

    return $tax;// Perform the tax calculation based on the new regime rules
    // Replace this with your own logic to calculate tax
    //return $taxAsPerNewRegime;
}

// Function to calculate tax as per the old regime
function calculateTaxAsPerOldRegime($taxableIncome) {
    // Perform the tax calculation based on the old regime rules
    // Replace this with your own logic to calculate tax
    $slabs = array(
        0 => array('rate' => 0, 'limit' => 250000),
        1 => array('rate' => 5, 'limit' => 500000),
        2 => array('rate' => 20, 'limit' => PHP_INT_MAX)
    );

    $tax = 0;
    $remainingIncome = $taxableIncome;

    // Iterate through the slabs to calculate the tax
    foreach ($slabs as $slab) {
        $rate = $slab['rate'];
        $limit = $slab['limit'];

        if ($remainingIncome <= 0) {
            break;
        }

        $taxableAmount = min($remainingIncome, $limit);
        $tax += ($taxableAmount * $rate) / 100;
        $remainingIncome -= $taxableAmount;
    }

    return $tax;
    //return $taxAsPerOldRegime;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Income Tax Calculator</title>
<!-- css-->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        h2 {
            text-align: center;
        }
        
        form {
            width: 400px;
            margin: 0 auto;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        
        .summary {
            width: 400px;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 10px;
        }
        h1{
            text-align: center;
        }
    </style>


</head>
<body>
    <h1><a href="index.php">HOME</a></h1>
    <h2>Income Tax Calculator</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Number:</label>
        <input type="text" name="number" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Age:</label>
        <input type="number" name="age" required><br>

        <label>Annual Income:</label>
        <input type="number" name="annual_income" required><br>

        <label>Deductions:</label>
        <input type="number" name="deductions" required><br>

        <input type="submit" value="Calculate">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // ...

        // Display the summary to the user
        echo "<div class='summary'>";
        echo "<h3>Tax Calculation Summary:</h3>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Number:</strong> $number</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Age:</strong> $age</p>";
        echo "<p><strong>Annual Income:</strong> $annualIncome</p>";
        echo "<p><strong>Deductions:</strong> $deductions</p>";
        echo "<p><strong>Taxable Income:</strong> $taxableIncome</p>";
        echo "<p><strong>Tax as per New Regime:</strong> $taxAsPerNewRegime</p>";
        echo "<p><strong>Tax as per Old Regime:</strong> $taxAsPerOldRegime</p>";
        echo "</div>";
    }
    ?>


</body>
</html>
