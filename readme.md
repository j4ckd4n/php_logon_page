# Very basic and potentially buggy PHP logon page

This repo contains a very basic PHP logon page with very _robust_ (joking) session and authorization handling.

# Technical details

Everything is hosted locally on a docker container. The [`dockerfile`](/dockerfile) pulls the `php:apache` image to host the website on port 80.

The [`docker-compose.yaml`](/docker-compose.yaml) builds the docker container and launches it. It also associates appropriate ports for access outside of the container and creates a volume where the database files could be dropped or manually investigated.

The database chosen in this scenario was SQLite3. Why? 🤷

Logon errors such as invalid passwords or missing information is made visible to the user when they click `Register` or `Login`.

Used [Bootstrap 5](https://getbootstrap.com/) for CSS elements. This made the login and registration forms _presentable_.

Attempted to utilize jQuery, however, didn't need it.

## Files
[`register.php`](/src/register.php): Displays the registration page.

[`index.php`](/src/index.php): Displays the login page.

[`validate.php`](/src/validate.php):
- Handles input validation from `register.php` and `index.php`.
- Adds a user account in the database if request is validated from `register.php`.
- Creates session information for authorization.

[`database.php`](/src/database.php): Handles simple SQLite3 database interactions.

[`home.php`](/src/home.php): Page that requires authorization. If the `authorized` sesion variable is set, access to this page is allowed. Otherwise, it redirects you back to `index.php`.

# Screenshots

## Logon Page
![Logon Page](/images/image.png)

If you managed to enter bad credentials, you get this:

![Bad bad bad](/images/image-3.png)

## Registration Page
![Registration Page](/images/image-1.png)

## Very Intense and Detailed Home Page
Once logged in, you get redirected to `home.php`.
>
![Detailed Home Page](/images/image-2.png)

---
# This is it.
> Thank you for coming to my Ted Talk 🙇