<?php session_start();//at first I wanted to use $GLOBALS but it wasn't stable across different requests(button clicks) ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="../producer/scripts/main.js"></script>
    <title>Landing Page</title>

    <link rel="icon" type="image/x-icon" href="../consumer/images/logo.png"></head>
<body onload="onLoad();">
    <?php
        /*
        These are my ideas to add as sensory data for my producer to produce:
            1. Lights                               DONE
            2. Windows closed/onn                   DONE
            3. Temperature                          DONE
            4. AC                                   DONE
            5. Weather                              DONE
            6. Emergency alerts                     DONE
        */
        //default boolean behavior is "false"
    ?>
    <?php include "../navbar.php" ?>

        <div class="mt-4 mb-5 mx-5"><h2>Welcome Back, Meryem Ahıskalı<span class="badge bg-primary">Admin</span></h2></div>

        <div class="shadow-lg p-3 mb-5 mx-5 bg-body rounded">Control Panel - <b id="userParagraph"></b></div>

        <script>
            function onClickDropDown(tag) {
                console.log(tag.innerHTML);
                fetch('../producer/landingPage.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        value: tag.innerHTML
                    }),
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                });
                onLoad();
            }
        </script>
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $body = file_get_contents('php://input');
                $username = json_decode($body)->value;
                $_SESSION["username"] = $username;
                echo $_SESSION["username"];
            }
        ?>
        <div class="btn-group mx-5 mb-5">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Select User
            </button>
            <ul class="dropdown-menu">
            <?php
                $conn=mysqli_connect('localhost','meryem','localhost','web');
                
                if(!$conn)
                {
                    echo "connection error: " . mysqli_connect_error();
                }
                $sql = "SELECT username FROM register;";
                $result = mysqli_query($conn, $sql);

                while ($row = $result->fetch_assoc()) {
                    echo '<li><a class="dropdown-item" onclick="onClickDropDown(this);">'.$row["username"].'</a></li>';
                }
            ?>
            </ul>
        </div>

        <div class="accordion mx-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Toggle Buttons
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                        <div class="container">
                            <div class="row justify-content-around">
                                <div id="lightsElement" class="col text-center">
                                    <button onclick="onClickLightsOn();" class="btn btn-primary" type="button">Lights Toggle</button>
                                    <p><b id="lightsParagraph">ON</b></p>
                                </div>
                                <div id="airElement" class="col text-center">
                                    <button class="btn btn-primary" type="button" onclick="onClickAc();">AC Toggle</button>
                                    <p><b id="acParagraph">ON</b></p>
                                </div>
                                <div id="windowElement" class="col text-center">
                                    <button class="btn btn-primary" type="button" onclick="onClickWindow();">Window Toggle</button>
                                    <p><b id="blindsParagraph">ON</b></p>
                                </div>
                                <div id="emergencyElement" class="col text-center">
                                    <button class="btn btn-primary" type="button" onclick="onClickEmergency();">Emergency</button>
                                    <p><b id="emergencyParagraph">ON</b></p>
                                </div>
                            </div>
                        </div>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Change Temperature
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div id="temperatureElement" class="container">
                        <div class="row justify-content-between">
                            <div class="col">
                                <input id="temperatureInput" type="text" placeholder="Please enter temperature(as Celcius)..." name="temperature" style="width: 18rem; height: 2.1rem;">
                                <button onclick="onClickTemperature(false);" class="btn btn-primary" type="button">Change</button>
                                <button onclick="onClickTemperature(true);" class="btn btn-primary" type="button">Random</button>
                            </div>
                            <div class="col-3">
                                <p>Right now, it is <b id="temperatureParagraph"></b><b>C</b> degrees.</p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Change Weather Forecast
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div id="weatherElement" class="container">
                        <div class="row justify-content-between">
                            <div class="col">
                                <form method="POST">
                                    <select id="weathers" name="weatherForecast" id="weatherForecastId" style="width: 18rem; height: 2.1rem;">
                                        <option value="sunny">Sunny</option>
                                        <option value="rainy">Rainy</option>
                                        <option value="stormy">Stormy</option>
                                        <option value="windy">Windy</option>
                                        <option value="cloudy">Cloudy</option>
                                    </select>
                                    <button onclick="onClickWeather(false);" class="btn btn-primary" type="button" name="weatherForecastButton">Change</button>
                                    <button onclick="onClickWeather(true);" class="btn btn-primary" type="button" name="weatherRandomButton">Random</button>
                                </form>
                            </div>
                            <div class="col-3">
                                <p>Right now, it is <b id="weatherParagraph">Sunny</b>.</p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        
        <?php include '../toast.php' ?>
        <?php include "../footer.php" ?>


    <?php

        function alert($msg) {//you can use this function to alert the updates instead of echoing them at the bottom of the page
            echo "<script type='text/javascript'>alert('$msg')</script>";
        }
    ?>
</body>
</html>