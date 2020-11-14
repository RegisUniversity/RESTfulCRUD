<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $spirit = $beer = "";
$name_err = $spirit_err = $beer_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate spirit
    $input_spirit = trim($_POST["spirit"]);
    if(empty($input_spirit)){
        $spirit_err = "Please enter a spirit.";     
    } else{
        $spirit = $input_spirit;
    }
    
    // Validate beer
    $input_beer = trim($_POST["beer"]);
    if(empty($input_beer)){
        $beer_err = "Please enter a beer.";     
    //} elseif(!ctype_digit($input_beer)){
        $beer_err = "Please enter a value.";
    } else{
        $beer = $input_beer;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($spirit_err) && empty($beer_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO people (name, spirit, beer) VALUES (?, ?, ?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_name, $param_spirit, $param_beer);
            
            // Set parameters
            $param_name = $name;
            $param_spirit = $spirit;
            $param_beer = $beer;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add afficionado record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Afficionado Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($spirit_err)) ? 'has-error' : ''; ?>">
                            <label>Spirit</label>
                            <textarea name="spirit" class="form-control"><?php echo $spirit; ?></textarea>
                            <span class="help-block"><?php echo $spirit_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($beer_err)) ? 'has-error' : ''; ?>">
                            <label>Beer</label>
                            <input type="text" name="beer" class="form-control" value="<?php echo $beer; ?>">
                            <span class="help-block"><?php echo $beer_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
