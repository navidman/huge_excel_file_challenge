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

### :arrow_down: Installation guide

Enter the following commands in your terminal:

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

You can see the database from [127.0.0.1:5000](http://127.0.0.1:5000) link.
- Username: root
- Password: password

----------------

### :book: List of APIs

You can use the following command to view the list of APIs:

```shell
make route
```
----------------

### :heavy_check_mark: Other commands

Complete list of commands to use when running the program:

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
