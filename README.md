<p align="center">
<img src="https://img.shields.io/badge/-PHP-777BB4?style=for-the-badge&logo=PHP&logoColor=777BB4&labelColor=282828">
<img src="https://img.shields.io/badge/-Laravel-FF2D20?style=for-the-badge&logo=Laravel&logoColor=FF2D20&labelColor=282828">
<img src="https://img.shields.io/badge/-MySQL-4479A1?style=for-the-badge&logo=MySQL&logoColor=4479A1&labelColor=282828">
<img src="https://img.shields.io/badge/-Docker-2496ED?style=for-the-badge&logo=Docker&logoColor=2496ED&labelColor=282828">
<img src="https://img.shields.io/badge/-ubuntu-E95420?style=for-the-badge&logo=ubuntu&logoColor=E95420&labelColor=282828">
</p>

----------------

### Local Brand X Gmbh: Import huge csv file challenge

----------------

----------------

### Description:
Hello there, I'm Navid Mansouri. Before installing the app, I wanted to note some of my thoughts. 
First of all I liked this challenge, found it interesting and had lots of fun doing it, So thank you for giving me the chance to do it.

There are some key points to notice for importing huge files in databases. In my opinion the first challenge would be uploading huge files. I think in a real work task scenario we should have another service(rather than our import service) to handle the upload process.
I mean before that user tries to import the file, the Frontend app can make a request to our upload service and upload the file there and receive the file address in response and then send this address to the import service to use for importing its data.  
I believe this approach will help the performance of our import service and saves its resources for handling other requests. We can have our specific configurations in the upload server(request timeouts for example). 
The second point tha we need to point out regards reading the file. We can't read the whole file at once because it may over occupy our Ram and even crash our app. So we need to read a part of the file(1000 rows for example) and do our process on it and then take care of the next part.
The other issue that we need to consider would be inserting data to database. I'm using jobs and queues and batch insert for importing data form csv file to database. 
My approach for handling invalid data is ignoring rows with invalid data and keep importing rows with valid data and at the end, I'll log the errors with details in an import_failed channel. We can report these errors to our user, so he/she can fix them and try importing them again.

If it was a real project I would use an authentication system for my APIs(JWT for example) and also use an authorization system to authorise user permissions and accesses(Laravel Policies for example). 
I implemented some e2e tests for APIs and a unit test for testing the import process.

----------------

### :arrow_down: Installation guide

1. Enter the following commands in your terminal:

```shell
git clone https://github.com/navidman/huge_excel_file_challenge.git
```
```shell
cd huge_excel_file_challenge
```
```shell
make up
```
```shell
make migrate
```
You can visit the app from [127.0.0.1:9000](http://127.0.0.1:9000) link.
Please check the APIs on postman.

You can visit the database from [127.0.0.1:5000](http://127.0.0.1:5000) link.
- Username: root
- Password: password


2. If you don't wish to use docker it's alright(I highly recommend using the first approach considering better user experience). Just clone the project or unzip the compressed file provided by email and follow these instructions:
```shell
cp .env.example .env
```

Please make a database for the app and edit the database configurations in your .env based on your MySQL configs.

```shell
composer install
```
```shell
php artisan migrate
```
```shell
php artisan key:generate
```
```shell
php artisan optimize
```
```shell
php artisan serve
```
```shell
php artisan queue:work
```



----------------

### :book: List of APIs

You can use the following command to view the list of APIs:

```shell
make route
```
And here is the list of APIs:
### 1. api/employee POST
```json
parameters:
    {
        "file":    "csv or txt file"
    }

response:
    {
        "Your file is importing. The rows have errors will logged on import_failed channel!"
    }
```

### 2. api/employee GET
```json
Response:
    {
    "data": [
        {
            "id": 6,
            "employee_id": 198429,
            "username": "sibumgarner",
            "name_prefix": "Mrs.",
            "first_name": "Serafina",
            "middle_initial": "I",
            "last_name": "Bumgarner",
            "gender": "F",
            "email": "serafina.bumgarner@exxonmobil.com",
            "date_of_birth": "1982-09-21",
            "time_of_birth": "01:53:14",
            "age_in_years": 34.87,
            "date_of_joining": "2008-02-01",
            "age_in_company": 9.49,
            "phone_no": "212-376-9125",
            "place_name": "Clymer",
            "country": "Chautauqua",
            "city": "Clymer",
            "zip": "14724",
            "region": "Northeast",
            "created_at": "2023-09-20T06:55:19.000000Z",
            "updated_at": "2023-09-20T06:55:19.000000Z"
        },
        {
            "id": 7,
            "employee_id": 178566,
            "username": "jmrojo",
            "name_prefix": "Mrs.",
            "first_name": "Juliette",
            "middle_initial": "M",
            "last_name": "Rojo",
            "gender": "F",
            "email": "juliette.rojo@yahoo.co.uk",
            "date_of_birth": "1967-05-08",
            "time_of_birth": "18:03:23",
            "age_in_years": 50.26,
            "date_of_joining": "2011-06-04",
            "age_in_company": 6.15,
            "phone_no": "215-254-9594",
            "place_name": "Glenside",
            "country": "Montgomery",
            "city": "Glenside",
            "zip": "19038",
            "region": "Northeast",
            "created_at": "2023-09-20T06:55:19.000000Z",
            "updated_at": "2023-09-20T06:55:19.000000Z"
        },
        {
            "id": 8,
            "employee_id": 647173,
            "username": "mfkrawczyk",
            "name_prefix": "Mr.",
            "first_name": "Milan",
            "middle_initial": "F",
            "last_name": "Krawczyk",
            "gender": "M",
            "email": "milan.krawczyk@hotmail.com",
            "date_of_birth": "1980-04-04",
            "time_of_birth": "07:07:22",
            "age_in_years": 37.34,
            "date_of_joining": "2012-01-19",
            "age_in_company": 5.53,
            "phone_no": "240-748-4111",
            "place_name": "Gibson Island",
            "country": "Anne Arundel",
            "city": "Gibson Island",
            "zip": "21056",
            "region": "South",
            "created_at": "2023-09-20T06:55:19.000000Z",
            "updated_at": "2023-09-20T06:55:19.000000Z"
        },
    ],
        "links": {
            "self": "link-value",
            "first": "http://127.0.0.1:9000/api/employee?page=1",
            "last": "http://127.0.0.1:9000/api/employee?page=349",
            "prev": null,
            "next": "http://127.0.0.1:9000/api/employee?page=2"
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 349,
            "links": [
                {
                    "url": null,
                    "label": "&laquo; Previous",
                    "active": false
                },
                {
                    "url": "http://127.0.0.1:9000/api/employee?page=1",
                    "label": "1",
                    "active": true
                },
                {
                    "url": "http://127.0.0.1:9000/api/employee?page=2",
                    "label": "2",
                    "active": false
                },
                {
                    "url": "http://127.0.0.1:9000/api/employee?page=2",
                    "label": "Next &raquo;",
                    "active": false
                }
        ],
        "path": "http://127.0.0.1:9000/api/employee",
        "per_page": 20,
        "to": 20,
        "total": 6965
        }
    }
```

### 3. api/employee/{id} Get
```json
Response:
    {
        "data": {
            "id": 6,
            "employee_id": 198429,
            "username": "sibumgarner",
            "name_prefix": "Mrs.",
            "first_name": "Serafina",
            "middle_initial": "I",
            "last_name": "Bumgarner",
            "gender": "F",
            "email": "serafina.bumgarner@exxonmobil.com",
            "date_of_birth": "1982-09-21",
            "time_of_birth": "01:53:14",
            "age_in_years": 34.87,
            "date_of_joining": "2008-02-01",
            "age_in_company": 9.49,
            "phone_no": "212-376-9125",
            "place_name": "Clymer",
            "country": "Chautauqua",
            "city": "Clymer",
            "zip": "14724",
            "region": "Northeast",
            "created_at": "2023-09-20T06:55:19.000000Z",
            "updated_at": "2023-09-20T06:55:19.000000Z"
        }
    }
```

### 8. api/employee/{id}  DELETE
```json
Response:
{
    "The employee successfully deleted!"
}
```
----------------

### :heavy_check_mark: Other commands

The complete list of commands to use when running the app:

| Command      | Description                                                 |
|--------------|-------------------------------------------------------------|
| make up      | Create and start containers                                 |
| make down    | Stop and remove resources                                   |
| make build   | Build or rebuild services                                   |
| make test    | Run `php artisan test` command on `arvancloud` container    |
| make migrate | Run `php artisan migrate` command on `arvancloud` container |
| make seed    | Run `php artisan test` command on `arvancloud` container    |
| make mysql   | Go to `mysql` container's `bash`                            |
| make redis   | Go to `redis` container's `bash`                            |
| make env     | Show `.env` file from `arvancloud` container                |
| make route   | Show `route list` from `arvancloud` container               |

----------------

### :man_technologist: Author

- [Github](https://github.com/navidman)
- [linkedin](https://www.linkedin.com/in/navidman)
