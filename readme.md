# Introduction

Can be used to convert a set of name strings into `Name` classes, which store the following fields:

- title - required
- first_name - optional
- initial - optional
- last_name - required

If a required field is missing, an exception is thrown. There is also support for strings with more than one name, such as 
"Mr and Mrs Smith".

## Usage

Install the dependencies with
 
```
composer install
```
 
To output the fields for each name found in `examples.csv`, use:

```
php main.php
```

## Tests

Install phpunit with `composer install --dev`.

Run the tests with `vendor/bin/phpunit`, e.g.:

```
$ vendor/bin/phpunit --testdox       
PHPUnit 9.2.5 by Sebastian Bergmann and contributors.

Parser (Tests\Parser)
 ✔ Parse name with data set 0
 ✔ Parse name with data set 1
 ✔ Parse name with data set 2
 ✔ Parse name with data set 3
 ✔ Parse name throws exception if title missing
 ✔ Parse name throws exception if last name missing
 ✔ Parse homeowner with data set 0
 ✔ Parse homeowner with data set 1
 ✔ Parse homeowner with data set 2
 ✔ Parse homeowner throws exception if too many names

Time: 00:00.007, Memory: 6.00 MB

OK (10 tests, 10 assertions)
```