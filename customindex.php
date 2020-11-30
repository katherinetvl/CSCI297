<!-- home page -->
<?php 
session_start();

$inputName = "Valued Customer";
$foodToAvoid = array(); 
$foodToAvoid[] = "None";
$allowAlcohol = "No";

$_SESSION['customerName'] = $inputName;
$_SESSION['customerAge'] = 15;
$_SESSION['xDrink'] = $allowAlcohol;
$_SESSION['xFood'] = $foodToAvoid;
?>
<?php
    require_once('filefunctions.php');
    $fileName = "fooditems.tsv";
    $foodItems = readLines($fileName);
    $foodType = array();

    foreach($foodItems as $key => $foodListing)
    {
        array_push($foodType, $foodListing[0]);
    }

    $foodType = array_unique($foodType);
?>
<!DOCTYPE html> 
<html>
<head>
    <title> Tailored Restaurant - Start Online Order </title>
</head> 
<body>
    <h1> Welcome to Customer Ordering Online! </h1> 
    <p> To begin, please fill out a little information about yourself: </p>
    <p> Then, click 'Next' to continue to view menu </p> 
    <p> ------------------------------------------- </p>
    <?php 
       if($_SERVER['REQUEST_METHOD'] == 'GET')
       {
        ?>
        <form method = "POST" action = "customindex.php">
            <label> Name: <input type = "text" name = "inputName"> </input></label>
            <label>  Age: <input type = "number" name = "inputAge" min = "15" max = "110"> </input></label></br>
            <p> Please select food types you do not eat, for any reason (allergy, religion, personal preference): </p>
            <label> Food Types: 
            <br>
                <select name = "foodTypes[]" size = 2 multiple>
                <?php
                    foreach($foodType as $foodCategory)
                    {
                        echo "<option value='{$foodCategory}'> {$foodCategory} </option>";
                    }
                ?>
                </select>
            </label>
            <br>
            <button type = "submit"> Submit </button></br>
        </form>
        <?php 
       }
    else if(isset($_POST['inputName']) && isset($_POST['inputAge']))
    {
        if($_POST['inputName'] != '')
        {
            $_SESSION['customerName'] = $_POST['inputName'];
        }

        if(is_numeric($_POST['inputAge']))
        {
            $userAge = $_POST['inputAge'];
            $_SESSION['customerAge'] = $userAge; 
            if($userAge >= 21)
            {
                $doAllowAlcohol = "Yes";
                $_SESSION['xDrink'] = $doAllowAlcohol;
            }
            else
            {
                $_SESSION['xDrink'] = "No";
            }
        }

        if(isset($_POST['foodTypes']))
        {
            $foodChosenToAvoid = array();
            foreach ($_POST['foodTypes'] as $foodType)
            {
                $foodChosenToAvoid[] = $foodType;
            }
            $foodToAvoid = array_replace($foodToAvoid, $foodChosenToAvoid);
            $_SESSION['xFood'] = $foodToAvoid;
        }

        // Continue to Food Menu
        echo "<br> This is page 1/4 </br>";
        echo "<a href='food.php'>" . "Next" . "</a>";
    }
    else
    {
        echo "Please fill out form to continue.";
    }
    ?>
</body>
</html>