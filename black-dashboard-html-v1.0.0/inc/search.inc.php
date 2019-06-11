<?php // Filename: connect.inc.php

require_once __DIR__ . "/../db/mysqli_connect.inc.php";
require_once __DIR__ . "/../app/config.inc.php";



// Code to display search results
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // build SQL
    //checking if the form is empty. if it is post null if its not generate a string for the query for search
    if (!empty($_POST["name"])) {
        $name = $_POST["name"];
        $company = " AND name = " .  '"' . $name. '"';
    } else {
        $name = '';
    }

    if (!empty($_POST["role"])) {
        $service = $_POST["role"];
        $serviceSQL =  " AND service =" . '"' .  $service . '"';
    } else {
        $serviceSQL = '';
    }
    //last is disfferent since it is the first query. It is set to not null at the beggining incase there is no last name input
    if (!empty($_POST["name"])) {
        $name = $_POST["name"];
        $nameSQL= '=' . '"' . $name .'"';
    } else {
        $nameSQL = '!=' . '"'. "null" .'"'  ;
    }

    if (!empty($_POST["email"])) {
        $email = $_POST["email"];
        $emailSQL = " AND email =" . '"'. $email . '"';
    } else {
        $emailSQL = '';
    }
    if (!empty($_POST["phone"])) {
        $phone = $_POST["phone"];
        $phoneSQL = " AND phone =" . '"' . $phone .  '"';
    } else {
        $phoneSQL = '';
    }
   

//query for the form using concatination
    $sql = "SELECT * FROM company  WHERE name" ."$nameSQL" . "$serviceSQL"  . "$countrySQL" ;

    $result = $db->query($sql);

    if ($result->num_rows > 0) {
         
            while ($row = $result->fetch_assoc()){?>
                # display rows and columns of data
                <div class="font-icon-list  col-sm-4 col-xs-6 col-xs-6">
                                            
                <div class="font-icon-detail pt-0">
                    <img class="" src="<?php echo $row['logo_path']?>" alt="..." class="responsive mb-3">
                    <h4 class="text-center mb-0 mt-3"><?php echo $row['name']?></h4>
                    <p class="mt-0"><?php echo $row['service']?></p>
                    <div class="ratings">
                        <span class="fa fa-heart checked"></span>
                        <span class="fa fa-heart checked"></span>
                        <span class="fa fa-heart checked"></span>
                        <span class="fa fa-heart"></span>
                        <span class="fa fa-heart"></span>
                      </div>
                </div>
            </div>
           
           <?php
            } // end while
            // closing table tag and div
            echo '</table>';
            echo '</div> ';
            //echoing out javascript to send the user to the bottom of the page when the post is made
            echo '<script type="text/javascript">location.href = "advanced-search.php#table";</script>';
            ?>
        <?php
    } else {
        echo "<h3 class=\"mt-5\">Rut-roh. No data was found for your query.</h3>";
    }

}
?>
