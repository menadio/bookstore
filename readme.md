# Bookstore RESTFUL API
## Overview
Bookstore is an API only application built with Laravel 5.6. The API application allows all users retrieve the list of books and it's average rating, allows only authenticated users to add a new book, update a book record, delete a book record and rate a book. 

## HTTP API Request
API request can be made just by sending HTTPS using any of the following RESTFUL verbs according to the desired action
* `POST`
* `GET`
* `PUT`
* `DELETE`

## Available API Endpoints
### Registering a user
User accounts can be created by calling this API endpoint
```
http://BookstoreApiApp-env.ia24dtqpia.eu-west-2.elasticbeanstalk.com/api/register
```
**Method**  `POST`

**Status**  `200`

**Required fields**
- `name`          The user's name
- `email`         The user's unqiue email
- `password`      Password
- `c_password`    Confirm password

**Example of expected response**
```
{
    "success": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijc3YjY3ZmJiM2E0NmMyODBhYjViZWZkNzk2ZGI2NmQwNTk3NDM1MmI5Yzk1NDIyNzllZTlmMGJjNmUzZDM2NzkxMjY4MjFmM2E2YTAzYTg4In0.eyJhdWQiOiIxIiwianRpIjoiNzdiNjdmYmIzYTQ2YzI4MGFiNWJlZmQ3OTZkYjY2ZDA1OTc0MzUyYjljOTU0MjI3OWVlOWYwYmM2ZTNkMzY3OTEyNjgyMWYzYTZhMDNhODgiLCJpYXQiOjE1MzgwMTM0NDMsIm5iZiI6MTUzODAxMzQ0MywiZXhwIjoxNTY5NTQ5NDQzLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.mllUpAiAizZXPV5zNW8zxa0ZxVA3fbtlVJFZrxHEwye2IxTWxZKowBRkruaLOYXId2-PVa3-VmCd3Al...",
        "name": "mena"
    }
}
```

### Retrieving a list of all books
The list of all books stored can be retrieved by calling this API endpoint
```
http://BookstoreApiApp-env.ia24dtqpia.eu-west-2.elasticbeanstalk.com/api/books
```
**Method**  `GET`

**Status**  `200`

**Example of expected response**
```
{
    "data": [
        {
            "id": 1,
            "title": "Dicta animi alias omnis modi.",
            "author": "Cesar Beahan",
            "user": {
                "id": 1,
                "name": "Marshall Rempel",
                "email": "zgusikowski@medhurst.info",
                "created_at": "2018-09-24 17:21:15",
                "updated_at": "2018-09-24 17:21:15"
            },
            "rated": 4,
            "ratings": [
                {
                    "id": 1,
                    "user_id": 1,
                    "book_id": 1,
                    "rating": 4,
                    "created_at": "2018-09-24 17:21:11",
                    "updated_at": "2018-09-24 17:21:11"
                }
            ]
        },
        {
            "id": 2,
            "title": "Facere esse doloribus reprehenderit debitis maiores voluptatem nihil.",
            "author": "Omer Fahey",
            "user": {
                "id": 1,
                "name": "Marshall Rempel",
                "email": "zgusikowski@medhurst.info",
                "created_at": "2018-09-24 17:21:15",
                "updated_at": "2018-09-24 17:21:15"
            },
            "rated": 3,
            "ratings": [
                {
                    "id": 2,
                    "user_id": 1,
                    "book_id": 2,
                    "rating": 5,
                    "created_at": "2018-09-24 17:21:11",
                    "updated_at": "2018-09-24 17:21:11"
                }
            ]
        }
    ]
}
```

### Retrieve a book record
Get a book record by calling the API endpoint
```
http://BookstoreApiApp-env.ia24dtqpia.eu-west-2.elasticbeanstalk.com/api/books/id
```
**Method**  `GET`

**Status**  `200`

**Example of expected response**
```
{
    "data": {
        "id": 4,
        "title": "Things Fall Apart",
        "author": "Chinua Achebe",
        "user": {
            "id": 2,
            "name": "mena",
            "email": "mena@test.com",
            "created_at": "2018-09-27 01:57:23",
            "updated_at": "2018-09-27 01:57:23"
        },
        "rated": 4,
        "ratings": [
            {
                "id": 5,
                "user_id": 2,
                "book_id": 4,
                "rating": 4,
                "created_at": "2018-09-27 03:53:35",
                "updated_at": "2018-09-27 03:53:35"
            }
        ]
    }
}
```

### Authenticating a user
Only authenticated users can add or create a new book record. Users are authenticated by calling the API endpoint
```
http://BookstoreApiApp-env.ia24dtqpia.eu-west-2.elasticbeanstalk.com/api/login
```
**Method**  `POST`

**Status**  `200`

**Required fields**
- `email`
- `password`

**Example of expected response**
```
{
    "success": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjE2NTAwMzRjN2MwNDdiMzZlMjI3NzE0ZmIxMTVmNDNhMjIwMDFkYjA2OGY1OWE5NDBmNmRjZjA5Y2I4NWQxYTRmM2Y1MmNhZTIzNzE3NzczIn0.eyJhdWQiOiIxIiwianRpIjoiMTY1MDAzNGM3YzA0N2IzNmUyMjc3MTRmYjExNWY0M2EyMjAwMWRiMDY4ZjU5YTk0MGY2ZGNmMDljYjg1ZDFhNGYzZjUyY2FlMjM"
    }
}
```

### Creating or Adding new book record
Authenticated users can add a new book by calling the API endpoint
```
http://BookstoreApiApp-env.ia24dtqpia.eu-west-2.elasticbeanstalk.com/api/books
```
**Method**  `POST`

**Status**  `201`


**Required fields**
- `user_id`
- `title`
- `author`

**Example of expected response**
```
{
    "data": {
        "id": 3,
        "title": "Things Fall Apart",
        "author": "Chinua Achebe",
        "user": {
            "id": 2,
            "name": "mena",
            "email": "mena@test.com",
            "created_at": "2018-09-27 01:57:23",
            "updated_at": "2018-09-27 01:57:23"
        },
        "rated": null,
        "ratings": []
    }
}
```
### Updating a book record
Authenticated users can only update books belonging to them. A book can be updated by calling the API endpoint
```
http://BookstoreApiApp-env.ia24dtqpia.eu-west-2.elasticbeanstalk.com/api/books/id
```
id here referes to the book's id which will be an integer.
**Method**  `PUT`

**Status**  `200`

**Example of expected response**
```
{
    "data": {
        "id": 3,
        "title": "Things Fall Apart",
        "author": "Chief Chinua Achebe",
        "user": {
            "id": 2,
            "name": "mena",
            "email": "mena@test.com",
            "created_at": "2018-09-27 01:57:23",
            "updated_at": "2018-09-27 01:57:23"
        },
        "rated": null,
        "ratings": []
    }
}
```

### Deleting a book record
Authenticated users can only delete a book belonging to them. A book can be deleted by calling the API endpoint
```
http://BookstoreApiApp-env.ia24dtqpia.eu-west-2.elasticbeanstalk.com/api/books/id
```
**Method**  `DELETE`

**Status**  `204`

### Rating a book record
Authenticated users can rate any book by calling the API endpoint
```
http://BookstoreApiApp-env.ia24dtqpia.eu-west-2.elasticbeanstalk.com/api/books/id/rating
```
**Method**  `POST`

**Status**  `201`

**Example of expected response**
```
{
    "user_id": 2,
    "book_id": 4,
    "rating": "4",
    "updated_at": "2018-09-27 03:53:35",
    "created_at": "2018-09-27 03:53:35",
    "id": 5
}
```
## HTTP Response Codes
Each HTTP response will be returned with one of the following status codes
- `200` Request was successful
- `201` Create request was successful
- `204` Successful request with no content returned
- `401` Unauthorized request
- `404` Resource was not found
- `500` Internal Server Error

## Field Reference
These fields are returned in the HTTP response samples
- `id`    Unique identifier
- `user_id`   Unique identifier of a user
- `book_id`   Unique identifier of a book
- `name`  User name
- `email` Unique user's email address
- `title` Title of a book
- `author` Author of a book
- `rating` Integer value given to a book by a user
- `created_at` Time a record was created
- `updated_at`  Time a record was updated

## Test
Running `vendor/bin/phpunit` or `phpunit` runs a quick API functionality test. It runs each function defined inside the `test/Feature/BookAPITest.php` file.
