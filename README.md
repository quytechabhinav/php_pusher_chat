### Real-Time Chat Application with PHP using Pusher
This repository contains a simple real-time chat application using PHP and Pusher. The application allows users to send messages, which are then instantly broadcasted to all connected clients using Pusher's real-time capabilities.

## Prerequisites
PHP 8.0.30 </br>
Composer </br>
MySQL </br>
Pusher account (https://pusher.com/)
## Setup
# 1. Clone the repository
sh </br>
Copy code </br>
git clone https://github.com/quytechabhinav/php-pusher-chat.git </br>
cd php-pusher-chat </br>
# 2. Install dependencies
```sh 
Copy code 
composer install 
composer require pusher/pusher-php-server

# 3. Configure the database
```sh
CREATE DATABASE php_chat;
USE php_chat;
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

## 4. Configure environment variables
Create a .env file in the root directory of your project and add the following configuration variables:

env
Copy code
DB_HOST=localhost
DB_USERNAME=root
DB_PASSWORD=
DB_NAME=php_chat

PUSHER_APP_ID=1111111
PUSHER_APP_KEY=ww2222222
PUSHER_APP_SECRET=ddddddddddddddddd
PUSHER_APP_CLUSTER=ap2
# 5. Update Database Connection and Pusher Configuration
Ensure your database connection and Pusher configuration in the PHP files are using the environment variables from the .env file.

# 6. Serve the application
Place your project in your web server's root directory (e.g., htdocs for XAMPP) and navigate to:

arduino
Copy code
http://localhost/php_pusher_chat/
You can also access the table displaying the messages at:

arduino
Copy code
http://localhost/php_pusher_chat/table.php
# 7. Additional Configuration
Ensure your PHP installation has the necessary extensions enabled, such as pdo_mysql.

# 8. Start the web server
If you're using a local development server like XAMPP or MAMP, start the server and ensure it points to your project directory.

# 9. Testing
Open multiple browser windows or tabs and start chatting to see the real-time messaging feature in action.

# 10. Troubleshooting
If you encounter issues with the Pusher integration, ensure your credentials (PUSHER_APP_ID, PUSHER_APP_KEY, PUSHER_APP_SECRET, PUSHER_APP_CLUSTER) are correct.
Check database connectivity and ensure the messages table is correctly set up.
Ensure the .env file is correctly formatted and located in the project's root directory.
Contributing
If you'd like to contribute to this project, please fork the repository and use a feature branch. Pull requests are welcome.

# License
This project is licensed under the MIT License. See the LICENSE file for details.
