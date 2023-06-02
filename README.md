# Important Notes

Most of Alper's commits don't show up at contributes page.

# Home Automation System

This is a web-based home automation system that allows you to control your home appliances remotely. It includes a frontend and a backend, both written in Html, Css, Bootstrap, Chart.js AND PHP. The frontend is built using BootStrap, while the backend is built using PHP. And it doesn't include a database yet. We use keyValuePairs.txt instead of a database. Alper Kaya 20200808002, Meryem Ahıskalı 20200808054<br>

## Features

- Login system for everyone
- User-friendly interface for controlling home appliances
- Real-time updates for appliance status
- Dashboard for viewing overall home status

## Installation

1. Clone the repository to your htdocs folder or Copy the files to htdocs. You need XAMPP installed to install this project.
2. If you are using Linux, then give 777 permission to every file inside the folder and the folder: chmod 777 -R /opt/lampp/htdocs/[YOUR_FOLDER_NAME]

## Usage

- After you copied the files to your htdocs, which you can find at /opt/lampp/htdocs in Linux or C:/xampp/htdocs in Windows, you can access the webpage at localhost/[YOUR_FOLDER_NAME]

## Login Credentials

Consumer:<br>
meryemAhıskalı - 1234<br>
alperKaya - 5678<br>
johnDoe - 9898<br>
Producer:<br>
meryem - 1928<br>

## Details

Pages like Features, About, FAQs are consumer targeted pages.
Return to Root, Return to Producer, Return to Consumer buttons are made specifically for our teacher to navigate easier between consumer and producer.
**Consumer landing page buttons are really working but you have refresh the page after pressing once.**
We have used a txt file to mimic a database, we read and write updates to it.

## License

This home automation system project is licensed under the [MIT License](LICENSE).
