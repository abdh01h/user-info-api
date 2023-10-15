# Local Deployment Guide for this project 

This guide will help you deploy this Laravel project locally on your machine.

## Prerequisites

Before you begin, ensure you have the following:

- [Composer](https://getcomposer.org/) installed.
- [PHP](https://www.php.net/) 7.3 or higher.
- [MySQL](https://www.mysql.com/) or any other supported database.

## Installation

1. Clone the repository:

```bash
git clone https://github.com/abdh01h/user-info-api
```
2. Navigate to the project directory:

```bash
cd your-laravel-project
```
 
3. Install project dependencies using Composer:

```bash
composer install
```
 
4. Create a copy of the .env.example file and save it as .env:

```bash
cp .env.example .env
```
 
5. Generate an application key:

```bash
php artisan key:generate
```
 
6. Configure your .env file with your database settings:
 
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
 
7. Run database migrations to create the database tables:
 
```bash
php artisan migrate
```
 
8. Seed the database with initial data (if applicable):
 
```bash
php artisan db:seed
```

## Running the Application

1. Start the development server:

```bash
php artisan serve --port 8000
```

## Additional Configuration

- If you need to configure additional services such as caching, queues, or mail, refer to the `.env` file for relevant settings.
- Don't forget to customize your `.env` file with appropriate settings for services like email and cache.
 
 
 
# User Info API Documentation

Welcome to the User Info API, which provides endpoints for user registration, login, and user profile management.

## Base URL

The base URL for the API is: `https://your-api-domain.com`

## Authentication

To access the endpoints of this API, you need to set the following headers in your HTTP requests:

- `Accept`: `application/json`
- `Authorization`: `Bearer [YourAccessTokenHere]`

## Endpoints

### 1. Register User

- Method: `POST`
- API URL: `/register`

Register a new user.

**Request Format:**

- Method: POST
- Headers:
  - `Accept`: `application/json`
- Body (form-data):
  - `name` (string, required, max 255 characters): The user's name.
  - `email` (string, required, valid email address, max 255 characters): The user's email address.
  - `password` (string, required, min 8 characters, max 255 characters): The user's password.
  - `password_confirmation` (string, required, max 255 characters): Confirm the password.

**Response Format (Success):**

- Status Code: 200 OK
- JSON Response:
```json
{
    "success": true,
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "johndoe@example.com",
        "created_at": "2023-10-15T12:34:56Z",
        "updated_at": "2023-10-15T12:34:56Z"
    },
    "accessToken": "your-access-token"
}
```

**Possible Error Responses:**

- Status Code: 422 Unprocessable Entity
- JSON Response:

```json
{
  "email": {
    "The email has already been taken."
  },
  "password": {
    "The password confirmation does not match."
  }
}
```

### 2. User Login

- Method: `POST`
- API URL: `/login`

Log in an existing user.

**Request Format:**

- Method: POST
- Headers:
  - `Accept`: `application/json`
- Body (form-data):
  - `email` (string, required, valid email address, max 255 characters): The user's email address.
  - `password` (string, required, max 255 characters): The user's password.

**Response Format (Success):**

- Status Code: 200 OK
- JSON Response:
```json
{
    "success": true,
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "johndoe@example.com",
        "created_at": "2023-10-15T12:34:56Z",
        "updated_at": "2023-10-15T12:34:56Z"
    },
    "accessToken": "your-access-token"
}
```

**Possible Error Responses:**

- Status Code: 422 Unprocessable Entity
- JSON Response:

```json
{
    "success": false,
    "message": "Invalid login details"
}
```
###  3. User Logout

- Method: `POST`
- API URL: `/logout`

Log out the authenticated user.

**Request Format:**

- Method: POST
- Headers:
  - `Accept`: `application/json`
  - `Authorization`: `Bearer your-access-token`

**Response Format (Success):**

- Status Code: 200 OK
- JSON Response:
```json
{
    "success": true
}
```

**Possible Error Responses:**

- Status Code: 401 Unauthorized
- JSON Response:

```json
{
    "success": false,
}
```

### 4. Get All Users

- Method: `GET`
- API URL: `/api/user-list`

Get a list of all users.

**Request Format:**

- Method: GET
- Headers:
  - `Accept`: `application/json`
  - `Authorization`: `Bearer your-access-token`

**Response Format (Success):**

- Status Code: 200 OK
- Response:

```json
{
    "success": true,
    "userList": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "name": "Max",
                "email": "max@max.com",
                "dob": "1995-10-10",
                "created_at": "2023-10-15T16:30:50.000000Z",
                "updated_at": "2023-10-15T16:30:50.000000Z"
            }
        ],
        "first_page_url": "http://localhost:8010/api/user-list?page=1",
        "from": 1,
        "last_page": 501,
        "last_page_url": "http://localhost:8010/api/user-list?page=501",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8010/api/user-list?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://localhost:8010/api/user-list?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://localhost:8010/api/user-list?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://localhost:8010/api/user-list?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://localhost:8010/api/user-list?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://localhost:8010/api/user-list?page=6",
                "label": "6",
                "active": false
            },
            {
                "url": "http://localhost:8010/api/user-list?page=7",
                "label": "7",
                "active": false
            },
            {
                "url": "http://localhost:8010/api/user-list?page=8",
                "label": "8",
                "active": false
            },
            {
                "url": "http://localhost:8010/api/user-list?page=9",
                "label": "9",
                "active": false
            },
            {
                "url": "http://localhost:8010/api/user-list?page=10",
                "label": "10",
                "active": false
            },
            {
                "url": null,
                "label": "...",
                "active": false
            },
            {
                "url": "http://localhost:8010/api/user-list?page=500",
                "label": "500",
                "active": false
            },
            {
                "url": "http://localhost:8010/api/user-list?page=501",
                "label": "501",
                "active": false
            },
            {
                "url": "http://localhost:8010/api/user-list?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": "http://localhost:8010/api/user-list?page=2",
        "path": "http://localhost:8010/api/user-list",
        "per_page": 1,
        "prev_page_url": null,
        "to": 1,
        "total": 501
    }
}
```

**Possible Error Responses:**

- Status Code: 401 Unauthorized
- Response:

```json
{
  "message": "Unauthorized"
}
```
### 5. Get User by ID

- Method: `GET`
- API URL: `/api/user-details/user-id`

Get user details by user ID.

**Request Format:**

- Method: GET
- Headers:
  - `Accept`: `application/json`
  - `Authorization`: `Bearer your-access-token`

**Response Format (Success):**

- Status Code: 200 OK
- Response:

```json
{
    "success": true,
    "userDetails": [
        {
            "id": 1,
            "name": "Max",
            "email": "max@max.com",
            "dob": "1995-10-10",
            "created_at": "2023-10-15T16:30:50.000000Z",
            "updated_at": "2023-10-15T16:30:50.000000Z"
        }
    ]
}

```

**Possible Error Responses:**

- Status Code: 401 Unauthorized
- Response:

```json
{
  "message": "Unauthorized"
}
```

**Other Possible Error Responses:**

- Status Code: 404 page not found

### 6. Add New User

- Method: `POST`
- API  URL: `/api/create-user`

Add a new user.

**Request Format:**

- Method: GET
- Headers:
  - `Accept`: `application/json`
  - `Authorization`: `Bearer your-access-token`
- Body (form-data):
  - `name` (string, required, max 255 characters): The user's name.
  - `email` (string, required, valid email address, max 255 characters): The user's email address.
  - `dob` (date, required): The user's date of birth. 
  
**Response Format (Success):**

- Status Code: 200 OK
- Response:

```json
{
    "success": true,
    "userCreated": {
        "name": "Max",
        "email": "max@max.com",
        "dob": "1995-10-10",
        "updated_at": "2023-10-15T16:30:50.000000Z",
        "created_at": "2023-10-15T16:30:50.000000Z",
        "id": 1
    }
}
```

**Possible Error Responses:**

- Status Code: 401 Unauthorized
- Response:

```json
{
  "message": "Unauthorized"
}
```
