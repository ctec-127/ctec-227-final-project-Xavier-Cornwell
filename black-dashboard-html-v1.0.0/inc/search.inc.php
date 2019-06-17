<?php // Filename: connect.inc.php

require_once  "mysqli_connect.php";




// Code to display search results
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // build SQL


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

    if (!empty($_POST["country"])) {
        $country= $_POST["country"];
        $countrySQL = " AND country=" . '"'. $country . '"';
    } else {
        $countrySQL = '';
    }

   

//query for the form using concatination
    $sql = "SELECT * FROM company  WHERE name" ."$nameSQL" . "$serviceSQL"  . "$countrySQL" ;

    $result = $db->query($sql);

    ?>      
       <div class="content col-12 pl-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-5">
                            <div class="card-header">
                                <h2 class="title">Results</h2>
                                <p class="category">Reviews for you're consumer satisfaction
                                    
                                </p>
                            </div>
                            <div class="card-body all-icons">
                                <div class="row">
    <?php  
    if ($result->num_rows > 0) {
         
            while ($row = $result->fetch_assoc()){
                
                $companyID=$row['company_id'];
                $company = $row['name'];
                $service= $row['service'];
                $country =$row['country'];
                $logo =  $row['logo_path'];
        
                ?>

                                    <div class="font-icon-list  col-sm-6 col-md-4 " >
                                        <div class="font-icon-detail pt-0">
                                            <a href="dashboard.php?id=<?php echo $companyID;?>">
                                            <img class="" src="uploads/<?php echo $logo; ?>" alt="..." class="responsive" style="height:300px; width:100%;">
                                            </a>
                                            <h4 class="text-center mb-0 mt-3"><?php echo $company; ?></h4>
                                            <p class="mt-0"> <?php echo $service; ?></p>
                                            <p class="mt-0"> <?php echo $country; ?></p>
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
            echo'</div >';
            ?>

 
</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        <?php
    } else {
        echo "<h3 class=\"mt-5\">Rut-roh. No data was found for your query.</h3>";
    }

}


?>
