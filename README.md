# FastJobs

FastJobs is a PHP/MySQL web application for connecting clients with local workers. Clients can find nearby workers, filter workers by trade category, view profiles, message workers, and browse a media-based jobs feed. Workers can log in to a worker home page, receive conversations, and appear in client discovery results.

The project uses plain PHP views, a procedural front controller, PDO-based DAO classes, and MySQL/MariaDB SQL dumps for development and test databases.

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Prerequisites](#prerequisites)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Default Test Data](#default-test-data)
- [Running Tests](#running-tests)
- [Runtime Folders](#runtime-folders)
- [Configuration Notes](#configuration-notes)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)

## Features

- Client and worker registration.
- Login with PHP password hashing and verification.
- Separate client and worker home pages.
- Worker discovery by location.
- Worker/category search suggestions.
- Worker filtering by category.
- User profile pages.
- One-to-one conversations between clients and workers.
- Text, image, and video messages.
- Message inbox previews, unread counts, and incremental message loading.
- Job feed posts with uploaded image/video media.
- Feed filtering based on distance from the logged-in user.
- Category, inbox, message, media, post, review, user, and worker-category DAO layers.
- PHPUnit-style DAO tests backed by a separate `fastjobstest` database.

## Tech Stack

- PHP
- MySQL or MariaDB
- PDO
- HTML, CSS, and JavaScript
- jQuery/jQuery UI from CDN
- Bootstrap assets from CDN
- PHPUnit-style tests
- Google Maps Distance Matrix API calls for travel distance checks

## Project Structure

```text
.
+-- index.php                  # Redirects to the front controller
+-- composer.json              # Currently empty project metadata
+-- Controller
|   +-- index.php              # Main front controller/action router
+-- Daos                       # PDO data access classes
+-- business                   # Domain model and utility classes
+-- View                       # PHP pages/templates
+-- SQL
|   +-- fastjobs.sql           # Development database dump
|   +-- fastjobstest.sql       # Test database dump
+-- UnitTest                   # PHPUnit-style DAO tests
+-- defaultPic                 # Default profile image
+-- logo                       # Navigation and UI image assets
```

## Prerequisites

Install the following before running the app:

- PHP 8.x with these extensions enabled:
  - `pdo_mysql`
  - `curl`
  - `fileinfo` or equivalent upload/image metadata support
- MySQL or MariaDB running locally on port `3306`.
- A local PHP server, Apache, XAMPP, WAMP, MAMP, or similar.
- PHPUnit if you want to run the DAO tests.

The SQL dump was generated from MariaDB 10.4 and PHP 8.3, but the application should work on similar modern PHP/MySQL setups.

## Database Setup

The local DAO connection currently uses:

```text
host: localhost
username: root
password: empty string
database: fastjobs
```

Import the development database:

```bash
mysql -u root < SQL/fastjobs.sql
```

Import the test database:

```bash
mysql -u root < SQL/fastjobstest.sql
```

If your database user or password is different, update:

```text
Daos/Dao.php
```

Current code expects additional columns that are referenced by DAO methods:

```sql
ALTER TABLE users
  ADD COLUMN lastLogOut datetime NOT NULL DEFAULT current_timestamp();

ALTER TABLE post
  ADD COLUMN about varchar(535) NOT NULL DEFAULT '';
```

Add those columns if your imported dump does not already include them.

## Running the Application

From the repository root, you can use PHP's built-in server:

```bash
php -S localhost:8000
```

Then open:

```text
http://localhost:8000/
```

The root `index.php` redirects to:

```text
Controller/index.php
```

Useful direct URLs:

```text
http://localhost:8000/Controller/index.php?action=show_signup
http://localhost:8000/Controller/index.php?action=show_login
```

If you are using Apache/XAMPP/WAMP instead, place the repository in your web root and browse to the project folder. The app uses relative paths, so keep the directory structure intact.

## Default Test Data

The development database includes seeded users and categories.

Confirmed client login used by the test suite:

```text
email: carl@gmail.com
password: 123
role: client
```

Seed users include:

```text
carl@gmail.com  - client
jhon@gmail.com  - worker
paul@gmail.com  - client
jacob@gmail.com - worker
```

User roles are stored in the `users.userType` column:

```text
1 = client
2 = worker
```

The seeded category data includes:

```text
carpenter
```

## Running Tests

The tests in `UnitTest` extend `PHPUnit\Framework\TestCase` and expect the `fastjobstest` database to exist.

Install or make PHPUnit available, then run from the repository root. Depending on your PHPUnit setup, one of these commands may be appropriate:

```bash
phpunit UnitTest
```

or:

```bash
vendor/bin/phpunit UnitTest
```

Before running tests, import:

```bash
mysql -u root < SQL/fastjobstest.sql
```

The test files use relative `require` paths such as `..\Daos\Dao.php`, so they are written for a Windows-oriented local environment. If you run them from Linux/macOS, you may need to normalize path separators or run them from a compatible shell.

## Runtime Folders

The application writes or reads uploaded/runtime media from folders referenced by the controller and views. Some may not exist in a fresh clone, so create them before using uploads:

```text
feedMedia
messageImages
messageVideos
profilePics
profilePictures
tradesPeoplePictures
```

Make sure your web server process has write permission for upload folders.

## Configuration Notes

- `Daos/Dao.php` selects local database credentials when the host is `localhost`.
- The same file contains an alternate hosted database configuration path.
- The controller hard-codes the development database name as `fastjobs`.
- Tests use `fastjobstest`.
- `business/Miscellaneous.php` contains a Google Maps Distance Matrix API key used by `googleGetDistance`.
- Browser geolocation is used to store a client's latitude and longitude for location-based worker discovery.
- Uploaded message media is split by file type:

```text
messageImages = image messages
messageVideos = video messages
feedMedia = job feed post media
```

- Message type values:

```text
1 = text
2 = image
3 = video
4 = other file
```

- Feed media type values:

```text
1 = image
2 = video
```

## Troubleshooting

### Database connection fails

Check that MySQL/MariaDB is running on `localhost:3306`, that the `fastjobs` database exists, and that the credentials in `Daos/Dao.php` match your local setup.

### Login or profile pages fail after importing SQL

The code reads `users.lastLogOut`, and job feed code writes `post.about`. If those columns are missing from your imported database, run the `ALTER TABLE` statements in [Database Setup](#database-setup).

### Uploads fail

Create the runtime folders listed above and confirm the PHP/web server process can write to them. Also check your PHP `upload_max_filesize` and `post_max_size` settings for larger image/video uploads.

### Worker distance data is missing

Location-based features need browser geolocation, stored latitude/longitude values, cURL support, and a working Google Maps Distance Matrix API key. If the API request fails, distance values may be blank or fallback behavior may be used.

### PHPUnit is not found

`composer.json` is currently empty, so PHPUnit is not installed by this repository. Install PHPUnit globally or add it as a development dependency before running tests.

## Contributing

1. Create a feature branch.
2. Keep changes consistent with the current Controller/View/DAO structure.
3. Update the SQL scripts when database structure changes.
4. Run the relevant DAO tests against `fastjobstest`.
5. Include setup notes for any new runtime folders, API keys, or PHP extensions.

