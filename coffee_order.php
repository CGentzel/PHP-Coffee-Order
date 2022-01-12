<?php

define('Title','Coffee House');

//Reset AbortPrint Key
$abortPrint = 'neutral';

if (isset($_POST['Submit'])){

    $totalcost;

    include 'header.php';

    $coffeetype = $_POST["CoffeeType"];
    $caffeinetype = $_POST["Caffeine"];
    $quantity = $_POST["Quantity"];
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $phone = $_POST["Telephone"];
    $address = $_POST["Address"];
    $city = $_POST["City"];
    $state = $_POST["State"];
    $zip = $_POST["Zip"];

    switch ($coffeetype){
        case "Boca Villa":
            $coffeetypeprice = 7.99;
            break;
        case "South Beach Rhythm":
            $coffeetypeprice = 8.99;
            break;
        case "Pumpkin Paradise":
            $coffeetypeprice = 8.99;
            break;
        case "Sumatran Sunset":
            $coffeetypeprice = 9.99;
            break;
        case "Bali Batur":
            $coffeetypeprice = 10.95;
            break;
        case "Double Dark":
            $coffeetypeprice = 9.95;
            break;
    }

    $infoForm = array($coffeetype, $caffeinetype, $quantity, $name, $email, $phone, $address, $city, $state, $zip);
 
    if ($caffeinetype == "Decaffeinated"){
        $caffeineAddedPrice = 1.00;
    } else {
        $caffeineAddedPrice = 0.00;
    }

    //Set Abort Key => neutral
    $abortPrint = "neutral";
    //Process to look for missing Values
    foreach($infoForm as $key => $checkvalue){ //key is current value in array
        switch ($infoForm[$key]){
            case Null:
                //if nothing in field of value in array > cancel print > set this value as MISSING & abort key => abort
                $abortPrint = "abort";
                $infoForm[$key] = "MISSING";
                break;
        }
    }

    
}
?>


<!DOCTYPE html
          PUBLIC "-//W3C//DTD XHTML 1.1//EN"
          "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
    <!-- Cadmus Gentzel -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

    <head>
        <link rel="stylesheet" href="style.css"/>
        <style>
            #OutputTable{
                border: 1px solid #ddd;
                padding: 12px;
            }
            #ErrorTable{
                border: 1px red solid;
                border-collapse: collapse;
                width: 65%;
                text-align: center;
            }
        </style>
    </head>
    
    <h1>The Coffee House</h1>

    <form method="post" action="coffee_order.php" >
        <table>
            <tr>
                <td>
                    Coffee:
                </td>
                <td>
                    <select id="CoffeeType" name="CoffeeType">
                        <option value ="Boca Villa">Boca Vila</option>
                        <option value ="South Beach Rhythm">South Beach Rhythm</option>
                        <option value ="Pumpkin Paradise">Pumpkin Paradise</option>
                        <option value ="Sumatran Sunset">Sumatran Sunset</option>
                        <option value ="Bali Batur">Bali Batur</option>
                        <option value ="Double Dark">Double Dark</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Type: 
                </td>
                <td>
                    <input type="radio" name="Caffeine" value="Regular" checked="checked"> Regular <br>
                    <input type="radio" name="Caffeine" value="Decaffeinated"> Decaffeinated
                </td>
            </tr>
            <tr>
                <td>
                    Quantity (in pounds):
                </td>
                <td>
                    <input type="text" name="Quantity">
                </td>
            </tr>
            <tr>
                <td>
                    Name: 
                </td>
                <td>
                    <input type="text" name="Name">
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <input type="text" name="Email">
                </td>
            </tr>
            <tr>
                <td>
                    Telephone#:
                </td>
                <td>
                    <input type="text" name="Telephone">
                </td>
            </tr>
            <tr>
                <td>
                    Address:
                </td>
                <td>
                    <input type="text" name="Address">
                </td>
            </tr>
            <tr>
                <td>
                    City:
                </td>
                <td>
                    <input type="text" name="City">
                </td>
            </tr>
            </tr>
            <tr>
                <td>
                    State:
                </td>
                <td>
                    <input type="text" name="State">
                </td>
            </tr>
            </tr>
            <tr>
                <td>
                    Zip:
                </td>
                <td>
                    <input type="text" name="Zip">
                </td>
            </tr>
       <!-- Form Submit  -->
            <tr>
                <td>
                    <input type="Submit" type="submit" value="submit" name="Submit"> 
                </td>
                <td>
                    <input type="Reset" type="reset" value="reset">
                </td>
            </tr>
        </table> 
    </form>

    </br>

    <?php 
    
    if ($abortPrint == "abort"){
        echo "<table id = 'ErrorTable'>";
            echo "<tr>". "<td>" . "MISSING INFORMATION!!!" . "</td>" . "</tr>";
        foreach($infoForm as $key => $value){
            switch ($infoForm[$key]){
                case "MISSING":
                    if ($key == "2"){
                        echo "<tr>" . "<td>" . "Please Enter a numeric value for quantity." . "</td>" . "</tr>";
                    }elseif ($key =="3"){
                        echo "<tr>" . "<td>" . "Please enter a name." . "</td>" . "</tr>";
                    }elseif ($key =="4"){
                        echo "<tr>" . "<td>" . "Please enter an e-mail address." . "</td>" . "</tr>";
                    }elseif ($key =="5"){
                        echo "<tr>" . "<td>" . "Please enter a phone number." . "</td>" . "</tr>";
                    }elseif ($key =="6"){
                        echo "<tr>" . "<td>" . "Please enter an address" . "</td>" . "</tr>";
                    }elseif ($key =="7"){
                        echo "<tr>" . "<td>" . "Please enter a city." . "</td>" . "</tr>";
                    }elseif ($key =="8"){
                        echo "<tr>" . "<td>" . "Please enter a state." . "</td>" . "</tr>";
                    }elseif ($key =="9"){
                        echo "<tr>" . "<td>" . "Please enter a zip code." . "</td>" . "</tr>";   
                    }
            }
            //echo "<p>", $value, "</p>";
        }
        echo "</table>" . "<br>";
    }else if (isset($_POST['Submit'])){     


        //process order total 
        $totalcost = $coffeetypeprice * $quantity + $caffeineAddedPrice;

        echo "<table>";
        echo "<tr>" . "<td>" . "Name:" . "</td>" . "<td>" . $infoForm[3] . "</td>" . "</tr>";
        echo "<tr>" . "<td>" . "Address" . "</td>" . "<td>" . $infoForm[6] . "</td>" . "</tr>";
        echo "<tr>" . "<td>" . "City, State, Zip:" . "</td>" . "<td>" . $infoForm[7] . ", " .  $infoForm[8] . ", " . $infoForm[9]  . "</td>" . "</tr>";
        echo "<tr>" . "<td>" . "Phone#:" . "</td>" . "<td>" . $infoForm[5] ."</td>" . "</tr>";
        echo "<tr>" . "<td>" . "E-mail:" . "<td>" . $infoForm[4] . "</td>" . "</tr>";
        echo "</table> <br>";



        echo "<table id='OutputTable'>";
        echo "<tr> <td> Coffee </td> <td> Type </td> <td> Quantity </td>  <td> Unit Cost </td>  <td> Total </td>";
        echo "<tr> <td>" . $coffeetype . "</td> <td>" . $caffeinetype . "</td> <td>" . $quantity . "lbs(s)" . "</td> <td>"
        . $coffeetypeprice . "</td> <td>" . $totalcost . "</td> <td>";

        echo "</table>";

        echo "<a href='coffee_order.php'>Return to order form</a>";

    } else {

        //Reset Post Superglobal
        $_POST = array();
    }
    ?>

</html>