<div style="display:flex; align-items: center">
  <h1 style="position:relative; top: -6px" >Epic movie quotes Laravel API</h1>
</div>

---

This is the epic movie quotes API, which is responsible for authenticating users, creating, editing, and deleting users, quotes, movies and all backend jobs on the website.

#

### Table of Contents

-   [Prerequisites](#prerequisites)
-   [Tech Stack](#tech-stack)
-   [Getting Started](#getting-started)
-   [Migrations](#migration)
-   [Development](#development)

#

### Prerequisites

-   *PHP@7.2 and up*
-   _MYSQL@8 and up_
-   _composer@2 and up_

#

### Tech Stack

-   [Laravel@6.x](https://laravel.com/docs/6.x) - back-end framework

#

### Getting Started

1\. First of all you need to clone repository from github:

```sh
git clone https://github.com/datomaluta/epic-movie-quotes-back.git
```

2\. Next step requires you to run _composer install_ in order to install all the dependencies.

```sh
composer install
```

4\. Now we need to set our env file. Go to the root of your project and execute this command.

```sh
cp .env.example .env
```

And now you should provide **.env** file all the necessary environment variables:

#

**MYSQL:**

> DB_CONNECTION=mysql

> DB_HOST=127.0.0.1

> DB_PORT=3306

> DB_DATABASE=**\***

> DB_USERNAME=**\***

> DB_PASSWORD=**\***

in order to cache environment variables.

4\. Now execute in the root of you project following:

```sh
  php artisan key:generate
```

Which generates auth key.

##### Now, you should be good to go!

#

### Migration

if you've completed getting started section, then migrating database if fairly simple process, just execute:

```sh
php artisan migrate
```

#

### Development

You can run Laravel's built-in development server by executing:

```sh
  php artisan serve
```
