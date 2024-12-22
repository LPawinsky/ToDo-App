# To-Do List App
## Prerequisites

Make sure you have the following tools installed:

- Docker
- Docker Compose

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/LPawinsky/todoapp.git
    cd todoapp
    ```

2. Build and start the Docker containers:

    ```bash
    docker-compose up -d --build
    ```

3. After the containers have been built, run the following commands to set up the application:

    ```bash
    docker exec todoapp-php-1 cp .env.example .env
    docker exec todoapp-php-1 composer install
    docker exec todoapp-php-1 npm install
    docker exec todoapp-php-1 npm run build
    docker exec todoapp-php-1 php artisan key:generate
    docker exec todoapp-php-1 php artisan migrate
    ```

### Access the Application

- The To-Do List App available at [http://localhost](http://localhost).
- The mail service at [http://localhost:8025](http://localhost:8025) (MailPit).
