function onLoad() {
    //LOAD EMERGENCY PART
    fetch('http://localhost/home-automation-project/consumer/buttons_emergency.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let img = document.getElementById("emergencyImage");
        let p   = document.getElementById("emergencyParagraph");
        if (response == "true") {
            img.setAttribute("src", "./images/emergency.png");
            p.innerHTML = "Emergency alert is <b>ON</b>";
        } else {
            img.setAttribute("src", "./images/nonEmergency.png");
            p.innerHTML = "Emergency alert is <b>OFF</b>";
        }
    });
    //LOAD AC PART
    fetch('http://localhost/home-automation-project/consumer/buttons_ac.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let img = document.getElementById("acGif");
        let p   = document.getElementById("acParagraph");
        if (response == "true") {
            img.setAttribute("src", "./images/workingFan.gif");
            p.innerHTML = "Emergency alert is <b>ON</b>";
        } else {
            img.setAttribute("src", "./images/stoppedFan.png");
            p.innerHTML = "Emergency alert is <b>OFF</b>";
        }
    });
    //LOAD WEATHER PART
    fetch('http://localhost/home-automation-project/consumer/buttons_weather.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let img = document.getElementById("weatherImage");
        let p   = document.getElementById("weatherParagraph");
        
        img.setAttribute("src", "./images/"+ response +".png");
        p.innerHTML = response;
    });
    //LOAD LIGHTS PART
    fetch('http://localhost/home-automation-project/consumer/buttons_lights.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let img = document.getElementById("lightsImage");
        let p   = document.getElementById("lightsParagraph");
        
        if (response == "true") {
            img.setAttribute("src", "./images/lightsOn.png");
            p.innerHTML = "ON";
        } else {
            img.setAttribute("src", "./images/lightsOff.png");
            p.innerHTML = "OFF";
        }
    });
    //LOAD WINDOW BLIND PART
    fetch('http://localhost/home-automation-project/consumer/buttons_window.php', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        let img = document.getElementById("blindsImage");
        
        if (response == "true") {
            img.setAttribute("src", "./images/blindsOpened.png");
        } else {
            img.setAttribute("src", "./images/blindsClosed.png");
        }
    });
    //LOAD TEMPERATURE PART
    fetch('http://localhost/home-automation-project/consumer/buttons_temperature.php', {
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
}

function onClickEmergency() {
    console.log("worksEmergency");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let img = document.getElementById("emergencyImage");
    let p   = document.getElementById("emergencyParagraph");
    fetch('http://localhost/home-automation-project/consumer/buttons_emergency.php', {
        method: 'POST',
        body: JSON.stringify({
            isEmergency: (img.getAttribute("src") == "./images/emergency.png" ? "false" : "true")
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        if (img.getAttribute("src") == "./images/emergency.png") {
            img.setAttribute("src", "./images/nonEmergency.png");
            p.innerHTML = "Emergency alert is <b>OFF</b>";
        } else {
            img.setAttribute("src", "./images/emergency.png");
            p.innerHTML = "Emergency alert is <b>ON</b>";
        }
    });
}

function onClickAc() {
    console.log("worksAc");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let img = document.getElementById("acGif");
    let p   = document.getElementById("acParagraph");
    fetch('http://localhost/home-automation-project/consumer/buttons_ac.php', {
        method: 'POST',
        body: JSON.stringify({
            isAcOn: (img.getAttribute("src") == "./images/workingFan.gif" ? "false" : "true")
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        if (img.getAttribute("src") == "./images/workingFan.gif") {
            img.setAttribute("src", "./images/stoppedFan.png");
            p.innerHTML = "Emergency alert is <b>OFF</b>";
        } else {
            img.setAttribute("src", "./images/workingFan.gif");
            p.innerHTML = "Emergency alert is <b>ON</b>";
        }
    });
}

function onClickLightsOn() {
    console.log("worksLightsOn");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let img = document.getElementById("lightsImage");
    let p   = document.getElementById("lightsParagraph");
    fetch('http://localhost/home-automation-project/consumer/buttons_lights.php', {
        method: 'POST',
        body: JSON.stringify({
            isLightsOn: (img.getAttribute("src") == "./images/lightsOn.png" ? "false" : "true")
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        if (img.getAttribute("src") == "./images/lightsOn.png") {
            img.setAttribute("src", "./images/lightsOff.png");
            p.innerHTML = "OFF";
        } else {
            img.setAttribute("src", "./images/lightsOn.png");
            p.innerHTML = "ON";
        }
    });
}

function onClickWindow() {
    console.log("worksWindow");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let img = document.getElementById("blindsImage");
    fetch('http://localhost/home-automation-project/consumer/buttons_window.php', {
        method: 'POST',
        body: JSON.stringify({
            isWindowBlindOn: (img.getAttribute("src") == "./images/blindsOpened.png" ? "false" : "true")
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        if (img.getAttribute("src") == "./images/blindsOpened.png") {
            img.setAttribute("src", "./images/blindsClosed.png");
        } else {
            img.setAttribute("src", "./images/blindsOpened.png");
        }
    });
}

function onClickTemperatureUp() {
    console.log("worksTemperature");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let p = document.getElementById("temperatureParagraph");
    fetch('http://localhost/home-automation-project/consumer/buttons_temperature.php', {
        method: 'POST',
        body: JSON.stringify({
            temperature: parseInt(p.innerHTML) + 1
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        p.innerHTML = parseInt(p.innerHTML) + 1;
    });
}

function onClickTemperatureDown() {
    console.log("worksTemperature");
    //change image of emergency too
    //<?php echo '<img src="./images/' . ($_SESSION['isEmergency'] ? "emergency" : "nonEmergency") . '.png" class="card-img-top" alt="..." height="235" style="object-fit: contain">' ?>
    let p = document.getElementById("temperatureParagraph");
    fetch('http://localhost/home-automation-project/consumer/buttons_temperature.php', {
        method: 'POST',
        body: JSON.stringify({
            temperature: parseInt(p.innerHTML) - 1
        }),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(response => {
        console.log(JSON.stringify(response));
        p.innerHTML = parseInt(p.innerHTML) - 1;
    });
}