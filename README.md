# Login website
This is a basic website consisting of only a login page to demonstrate how websites interact with database. The database consists of a single table called "users", with three columns:
```
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
```

For the end user, the only pages that they see are the register.php and login.php pages. authenticate.php and db.php are additional files needed to interact with the database. api.php is the additional file needed to provide API.

`login_website` folder and `login_website_API_consumer` folder must be placed in `C:\xampp\htdocs` (assuming you install XAMPP in the default location).

- Login website repo: https://github.com/Random0617/login_website
- Login website API consumer repo: https://github.com/Random0617/login_website_API_consumer