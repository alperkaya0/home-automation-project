<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="./scripts/main.js"></script>
    <link rel="icon" type="image/x-icon" href="./images/logo.png">
    <style>
        .chart-container {
            width: 90rem;
            height: 50%;
        }

        .add-device-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
        } 
        
    </style>
    <script>
        function showForm() {
            document.getElementById("deviceForm").style.display = "block";
        }
    </script>
    <style>
        #deviceForm {
            display: none;
        }
    </style>
<?php

$conn=mysqli_connect('localhost','meryem','localhost','web');
$username=$_SESSION["username"];
if(!$conn)
{
	echo "connection error: " . mysqli_connect_error();
}


    if(isset($_POST["deviceSubmit"])){
        $new=$_POST["deviceName"];
    
    
        if($new=="light"){

            $new=true;
            $a=false;
            $b=false;
            $c=false;
            $d=false;
            $e=false;
            
            
                $newquery = "INSERT INTO device VALUES('".$_SESSION["username"]."','$new','$a','$b','$c','$d','$e')";
                mysqli_query($conn, $newquery);
                
          
             
        }else if( $new=="airConditioning"){
            
            $new=true;
            $a=false;
            $b=false;
            $c=false;
            $d=false;
            $e=false;
    
            
                $query = "INSERT INTO device VALUES('".$_SESSION["username"]."','$a','$new','$b','$c','$d','$e')";
                mysqli_query($conn, $query);
           
              
        }else if( $new=="blinds"){
            
            $new=true;
            $a=false;
            $b=false;
            $c=false;
            $d=false;
            $e=false;
          
                $query = "INSERT INTO device VALUES('".$_SESSION["username"]."','$a','$b','$new','$c','$d','$e')";
                mysqli_query($conn, $query);
          
        
        }else if($new=="alarm"){
            $new=true;
            $a=false;
            $b=false;
            $c=false;
            $d=false;
            $e=false;
           
                $query = "INSERT INTO device VALUES('".$_SESSION["username"]."','$a','$b','$c','$new','$d','$e')";
            mysqli_query($conn, $query);
           
        }else if($new=="weather"){
            $new=true;
            $a=false;
            $b=false;
            $c=false;
            $d=false;
            $e=false;
    
            $query = "INSERT INTO device VALUES('".$_SESSION["username"]."','$a','$b','$c','$d','$new','$e')";
            mysqli_query($conn, $query);
           
        }else if ($new=="temperature"){
            $new=true;
            $a=false;
            $b=false;
            $c=false;
            $d=false;
            $e=false;
    
            $query = "INSERT INTO device VALUES('".$_SESSION["username"]."','$a','$b','$c','$d','$e','$new')";
            mysqli_query($conn, $query);
           
        }else{
            echo "invalid device name";
        }
    
    }


    

	


	?>
    
</head>
<body onload="onLoad();">
    <?php
        if (!isset($_SESSION["username"])) {
            header("Location: login.php");
            exit();
        }
        function alert($msg) { //you can use this function to alert the updates instead of echoing them at the bottom of the page
            echo "<script type='text/javascript'>alert('$msg')</script>";
        }
    ?>
    <?php include "../navbar.php" ?>

    <div class="mt-5 ms-5 mb-5">
        <h2 id="welcoming-message">Welcome Back,<span class="badge bg-secondary">Account Holder</span></h2>
    </div>

    <div class="shadow-lg p-3 mb-5 mx-5 bg-body rounded">Your Sensors And Controls    
    
    
    <button onclick="showForm()">Add a device</button>

    <form method="POST" id="deviceForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                         <div class="mb-3">
                            <br>  
                            <label for="info">alarm  weather airConditioning  light  blinds  temperature</label>


						<input type="text" name="deviceName" class="form-control" placeholder="device name" id="deviceName">
                      
					
						
					</div>
                   
        
        <br>
        <button type="submit" name="deviceSubmit" class="btn btn-primary" >Submit</button>


    </form>
    </div>
    
    <?php



//alarm kontrol
    $query = "SELECT * FROM device WHERE username = '".$_SESSION["username"]."'AND alarm = 1";
    $result= mysqli_query($conn, $query);
       if ($result) {
        $row_count = mysqli_num_rows($result);
    
        if ($row_count > 0) {
            echo '
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card" id="emergencyAlert">
                        <img id="emergencyImage" src="./images/emergency.png" class="card-img-top" alt="emergency_image" height="235" style="object-fit: contain">
                        <div class="card-body">
                            <div class="container text-center">
                                <h5 class="card-title">Emergency Alert</h5>
                                <p id="emergencyParagraph" class="card-text">Emergency alert is <b>ON</b></p>
                            </div>
                            <div class="container text-center">
                                <div class="row justify-content-center">
                                    <div class="col">
                                        <button class="btn btn-primary" type="button" onclick="onClickEmergency();">Toggle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

        } else {
           
        }
  }
  echo '<br>';

 //hava durumu kontrol
    $query = "SELECT * FROM device WHERE username = '".$_SESSION["username"]."'AND weather = 1";
    $result= mysqli_query($conn, $query);

       if ($result) {
        $row_count = mysqli_num_rows($result);
    
        if ($row_count > 0) {
            echo '
            <div class="carousel-inner">
                <div class="carousel-item active">
            <div class="card">
                <a href="#chart-4">
                    <img id="weatherImage" src="./images/sunny.png" class="card-img-top" alt="..." height="235" style="object-fit: contain;">
                </a>
                <div class="card-body">
                    <div class="container text-center">
                        <h5 class="card-title">Weather Forecast</h5>
                        <p class="card-text">Forecasted weather for tomorrow is <b id="weatherParagraph">sunny</b>.</p>
                        <!-- TO GIVE SOME SPACE -->
                        <div class="mb-4"></div>
                        <!-- TO GIVE SOME SPACE -->
                    </div>
                </div>
            </div>
            </div>
        </div>';

      //  echo '<div class="col"><div class="text-center mt-3" style="font-size: 0.8rem; color: gray"><p>Weather of Last Year</p></div><canvas id="chart-4"></canvas></div>';


        } else {
          
        }
  }
  echo '<br>';

   
  //klima kontrol
  $query = "SELECT * FROM device WHERE username = '".$_SESSION["username"]."'AND airConditioning = 1";
    $result= mysqli_query($conn, $query);
       if ($result) {
        $row_count = mysqli_num_rows($result);
    
        if ($row_count > 0) {

            echo '
            <div class="card" id="airConditioning">
                <a href="#chart-3">
                    <img id="acGif" src="./images/workingFan.gif" class="card-img-top" alt="..." height="235" width="432" style="object-fit: contain;">
                </a>
                <div class="card-body">
                    <div class="container text-center">
                        <h5 class="card-title">Air Conditioning</h5>
                        <p id="acParagraph" class="card-text">You can turn on/off AC.</p>
                    </div>
                    <div class="container text-center">
                        <div class="row justify-content-center">
                            <div class="col">
                                <button class="btn btn-primary" onclick="onClickAc();">AC Toggle</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            
     //   echo '<div class="col"><div class="text-center mt-3" style="font-size: 0.8rem; color: gray"><p>Energy Consumption</p></div><canvas id="chart-3"></canvas></div>';

        } else {
          
        }
    }
    echo '<br>';

         //IŞIK kontrol
        $query = "SELECT * FROM device WHERE username = '".$_SESSION["username"]."'AND light = 1";
         $result= mysqli_query($conn, $query);
       if ($result) {
        $row_count = mysqli_num_rows($result);
    
        if ($row_count > 0) {
          
            echo '
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card" id="emergencyAlert">
                        <a href="#chart-2">
                            <img id="lightsImage" src="./images/lightsOn.png" class="card-img-top" alt="..." height="235" width="432" style="object-fit: contain;">
                        </a>
                        <div class="card-body">
                            <div class="container text-center">
                                <h5 class="card-title">Switch Lights</h5>
                                <p class="card-text">You can switch lights on and off from here. It\'s <b id="lightsParagraph">on</b> now.</p>
                            </div>
                            <div class="container text-center">
                                <div class="row justify-content-center">
                                    <div class="col">
                                        <button class="btn btn-primary" onclick="onClickLightsOn();">Lights Toggle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            

//                    echo '<div class="col"><canvas id="chart-2"></canvas></div>';

        } else {
          
        }
   }
   echo '<br>';

    //blind kontrol
    $query = "SELECT * FROM device WHERE username = '".$_SESSION["username"]."'AND blinds = 1";
    $result= mysqli_query($conn, $query);
       if ($result) {
        $row_count = mysqli_num_rows($result);
    
        if ($row_count > 0) {
            echo '
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="card" id="blindsCard">
                        <img id="blindsImage" src="./images/blindsOpened.png" class="card-img-top" alt="..." height="235" width="432" style="object-fit: contain;">
                        <div class="card-body">
                            <div class="container text-center">
                                <h5 class="card-title">Control Window Blinds</h5>
                                <p class="card-text">You can control them anytime you want.</p>
                            </div>
                            <div class="container text-center">
                                <div class="row justify-content-between">
                                    <div class="col">
                                        <button class="btn btn-primary" onclick="onClickWindow();">Window Blind Toggle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            
            



        } else {
          
        }
       

    }   
    echo '<br>';

         //sıcaklık kontrol
  $query = "SELECT * FROM device WHERE username = '".$_SESSION["username"]."'AND temperature = 1";
    $result= mysqli_query($conn, $query);
       if ($result) {
        $row_count = mysqli_num_rows($result);
    
        if ($row_count > 0) {
          
            echo '
            <div class="carousel-inner">
                <div class="carousel-item active">
                <div class="card" id="temperature">
                    <a href="#chart">
                        <img src="./images/temperature.png" class="card-img-top" alt="Temperature image" height="235" width="432" style="object-fit: contain;">
                    </a>
                    <div class="card-body">
                        <div class="container text-center">
                            <h5 class="card-title">Temperature</h5>
                            <p class="card-text">House temperature is <b id="temperatureParagraph"></b><b>C.</b></p>
                        </div>
                        <div class="container text-center">
                            <div class="row justify-content-between">
                                <div class="col-6">
                                    <button class="btn btn-primary" type="button" onclick="onClickTemperatureUp();">+</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-primary" type="button" onclick="onClickTemperatureDown();">-</button>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                </div>';
                
               // echo '<div class="col"><canvas id="chart"></canvas></div>';

        } else {
          
        }
  }

  

        if($_SESSION["username"]=="alperkaya" || $_SESSION["username"]=="meryemAhiskali"){
            echo '<br>';

            echo '<br>';
            echo '<br>';
            echo '<br>';  echo '<br>';
            echo '<br>';
            echo '<br>';  echo '<br>';
            echo '<br>';
            echo '<br>';echo '<br>';

            echo '<br>';
            echo '<br>';
            echo '<br>';  echo '<br>';
            echo '<br>';
            echo '<br>';  echo '<br>';
            echo '<br>';
          
            echo '<br>';
            echo '<br>';
          
            echo '<br>';
            echo '<br>';
          
        
            echo '<div class="shadow-lg p-3 mb-5 mx-5 bg-body rounded">Your House Statistics</div>';
            echo '<div class="card chart-container m-2 py-2">';
            echo '<div class="row justify-content-center">';
                //temp
                $query = "SELECT * FROM device WHERE username = '".$_SESSION["username"]."'AND temperature = 1";
                $result= mysqli_query($conn, $query);
                   if ($result) {
                    $row_count = mysqli_num_rows($result);
                
                            if ($row_count > 0) {
                                    //temp


                                    echo '<div class="col" style="margin-top: 60px;">
                                    <img src="celsius.png" alt="homes" width="260" height="260" style="margin-left: 150px;">
                                </div>';
                                

                                echo '<div class="col"><canvas id="chart"></canvas></div>';

                        echo '</div>';
                            }
                        }

            echo '</div>';
            echo '<br>';
             echo '<div class="card chart-container m-2 py-2">';
            echo '<div class="row justify-content-center">';
            //light
            $query = "SELECT * FROM device WHERE username = '".$_SESSION["username"]."'AND light = 1";
            $result= mysqli_query($conn, $query);
                if ($result) {
                $row_count = mysqli_num_rows($result);

                if ($row_count > 0) {

                            

                                echo '<div class="col"><canvas id="chart-2"></canvas></div>';
                                echo '<div class="col">
                    <img src="light-bulb.png" alt="homes" width="240" height="240" style="margin-left: 220px; margin-top: 80px;">
                </div>';

                    echo '</div>';

                }
            echo '</div>';
            echo '<br>';
            echo '<div class="card chart-container m-2 py-2">';

            echo '<div class="row justify-content-center">';

                $query = "SELECT * FROM device WHERE username = '".$_SESSION["username"]."'AND airConditioning = 1";
                 $result= mysqli_query($conn, $query);
                        if ($result) {
                            $row_count = mysqli_num_rows($result);
                        
                            if ($row_count > 0) {
                                echo '<div class="col">
                                <img src="lighting.png" alt="homes" width="260" height="260" style="margin-top: 80px; margin-left: 300px;">
                            </div>';
                      
                                echo '<div class="col">
                                <div class="text-center mt-1" style="font-size: 0.8rem; color: gray"><p>Energy Consumption</p></div>
                                <canvas id="chart-3"></canvas>
                            </div>';
                    

                            
                            
                        echo '</div>';

                            }
                        }

                        echo '</div>';
                        echo '<br>';

                        echo '<div class="card chart-container m-2 py-2">';
                        echo '<div class="row justify-content-center">';
            $query = "SELECT * FROM device WHERE username = '".$_SESSION["username"]."'AND weather = 1";
                $result= mysqli_query($conn, $query);
            
                   if ($result) {
                    $row_count = mysqli_num_rows($result);
                
                        if ($row_count > 0) {
                            //weather
                            echo '<div class="col">
                            <div class="text-center mt-3" style="font-size: 0.8rem; color: gray"><p>Weather of Last Year</p></div>
                            <canvas id="chart-4"></canvas>
                        </div>';
              
                        echo '<div class="col">
                                <img src="cloudy.png" alt="homes" width="260" height="260" style="margin-top: 80px; margin-left: 300px;">
                            </div>';
                            echo '</div>';

                    }
                }
                
               
                echo '</div>';

            echo '<div class="container text-center my-5"><div class="row"><div class="col-12"><img src="./images/seperator.png" height="20rem" style="opacity:0.8"></div></div></div>';
        }



    }  
        ?>



             
    
    <?php include '../toast.php' ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>

    <?php include "../footer.php" ?>
</body>
</html>
    
