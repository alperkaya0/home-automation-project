function onLoad() {
    //LOAD USERNAME
    fetch('../consumer/buttons-backend/getFullName.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let p   = document.getElementById("userParagraph");
        p.innerHTML = response;
    });
    //LOAD EMERGENCY PART
    fetch('../consumer/buttons-backend/buttons_emergency.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let p   = document.getElementById("emergencyParagraph");
        if (response == "true") {
            p.innerHTML = "ON";
        } else {
            p.innerHTML = "OFF";
        }
    });
    //LOAD AC PART
    fetch('../consumer/buttons-backend/buttons_ac.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let p   = document.getElementById("acParagraph");
        if (response == "true") {
            p.innerHTML = "ON";
        } else {
            p.innerHTML = "OFF";
        }
    });
    //LOAD WEATHER PART
    fetch('../consumer/buttons-backend/buttons_weather.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let p   = document.getElementById("weatherParagraph");
        var select = document.getElementById('weathers');
        var option = select.options[select.selectedIndex];
        option.innerHTML = capitalizeFirstLetter(response);
        option.value = response;
        p.innerHTML = response;
    });
    //LOAD LIGHTS PART
    fetch('../consumer/buttons-backend/buttons_lights.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let p   = document.getElementById("lightsParagraph");
        
        if (response == "true") {
            p.innerHTML = "ON";
        } else {
            p.innerHTML = "OFF";
        }
    });
    //LOAD WINDOW BLIND PART
    fetch('../consumer/buttons-backend/buttons_window.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let p = document.getElementById("blindsParagraph");
        
        if (response == "true") {
            p.innerHTML = "ON";
        } else {
            p.innerHTML = "OFF";
        }
    });
    //LOAD TEMPERATURE PART
    fetch('../consumer/buttons-backend/buttons_temperature.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let p = document.getElementById("temperatureParagraph");
        p.innerHTML = response;
    });
    loadUnvisible();
}

function loadUnvisible() {
    fetch('../producer/backend/get_devices.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        /*
            lightsElement - light
            airElement - airConditioning
            windowElement - blinds
            emergencyElement - alarm
            weatherElement - weather
            temperatureElement - temperature
        */
        if (response["light"] == 0) {
            let element = document.getElementById("lightsElement");
            element.setAttribute("hidden", true);
        }
        if (response["airConditioning"] == 0) {
            let element = document.getElementById("airElement");
            element.setAttribute("hidden", true);
        }
        if (response["blinds"] == 0) {
            let element = document.getElementById("windowElement");
            element.setAttribute("hidden", true);
        }
        if (response["alarm"] == 0) {
            let element = document.getElementById("emergencyElement");
            element.setAttribute("hidden", true);
        }
        if (response["weather"] == 0) {
            let element = document.getElementById("weatherElement");
            element.setAttribute("hidden", true);
        }
        if (response["temperature"] == 0) {
            let element = document.getElementById("temperatureElement");
            element.setAttribute("hidden", true);
        }
    });
}

function onClickEmergency() {
    console.log("worksEmergency");
    //change image of emergency too
    let p   = document.getElementById("emergencyParagraph");
    fetch('../consumer/buttons-backend/buttons_emergency.php', {
        method: 'POST',
        body: JSON.stringify({
            isEmergency: (p.innerHTML == "ON" ? "false" : "true")
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        if (p.innerHTML == "ON") {
            p.innerHTML = "OFF";
        } else {
            p.innerHTML = "ON";
        }
    });
}

function onClickAc() {
    console.log("worksAc");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let p   = document.getElementById("acParagraph");
    fetch('../consumer/buttons-backend/buttons_ac.php', {
        method: 'POST',
        body: JSON.stringify({
            isAcOn: (p.innerHTML == "ON" ? "false" : "true")
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        if (p.innerHTML == "ON") {
            p.innerHTML = "OFF";
        } else {
            p.innerHTML = "ON";
        }
    });
}

function onClickLightsOn() {
    console.log("worksLightsOn");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let p   = document.getElementById("lightsParagraph");
    fetch('../consumer/buttons-backend/buttons_lights.php', {
        method: 'POST',
        body: JSON.stringify({
            isLightsOn: (p.innerHTML == "ON" ? "false" : "true")
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        if (p.innerHTML == "ON") {
            p.innerHTML = "OFF";
        } else {
            p.innerHTML = "ON";
        }
    });
}

function onClickWindow() {
    console.log("worksWindow");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let p = document.getElementById("blindsParagraph");
    fetch('../consumer/buttons-backend/buttons_window.php', {
        method: 'POST',
        body: JSON.stringify({
            isWindowBlindOn: (p.innerHTML == "ON" ? "false" : "true")
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        if (p.innerHTML == "ON") {
            p.innerHTML = "OFF";
        } else {
            p.innerHTML = "ON";
        }
    });
}

function onClickTemperature(isRandom) {
    console.log("worksTemperature");
    if (isRandom) {
        //change image of emergency too
        //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
        let input = document.getElementById("temperatureInput");
        let num = parseInt(Math.random()*1000);
        input.value = num;
        console.log(input.value);
        fetch('../consumer/buttons-backend/buttons_temperature.php', {
            method: 'POST',
            body: JSON.stringify({
                temperature: num
            }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(response => {
            console.log(JSON.stringify(response));
            let p = document.getElementById("temperatureParagraph");
            p.innerHTML = parseInt(input.value);
        });
    } else {
        //change image of emergency too
        //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
        let input = document.getElementById("temperatureInput");
        console.log(input.value);
        fetch('../consumer/buttons-backend/buttons_temperature.php', {
            method: 'POST',
            body: JSON.stringify({
                temperature: parseInt(input.value)
            }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(response => {
            console.log(JSON.stringify(response));
            let p = document.getElementById("temperatureParagraph");
            p.innerHTML = parseInt(input.value);
        });
    }
}

function onClickWeather(isRandom) {
    if (isRandom) {
        var select = document.getElementById('weathers');
        var option = select.options[select.selectedIndex];
        let p = document.getElementById("weatherParagraph");
        let weathers = ["sunny", "rainy", "cloudy", "stormy", "windy"];
        let randomValue = weathers[parseInt(Math.random()*5)];

        console.log(option);

        fetch('../consumer/buttons-backend/buttons_weather.php', {
            method: 'POST',
            body: JSON.stringify({
                weatherForecast: randomValue
            }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(response => {
            console.log(JSON.stringify(response));
            p.innerHTML = randomValue;
            option.value = randomValue;
            option.innerHTML = capitalizeFirstLetter(randomValue);
        });
    } else {
        var select = document.getElementById('weathers');
        var option = select.options[select.selectedIndex];
        let p = document.getElementById("weatherParagraph");
        console.log(option);

        fetch('../consumer/buttons-backend/buttons_weather.php', {
            method: 'POST',
            body: JSON.stringify({
                weatherForecast: option.value
            }),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(response => response.json())
        .then(response => {
            console.log(JSON.stringify(response));
            p.innerHTML = option.value;
        });
    }
    
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}