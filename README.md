Task 1
Develop an end-point that satisfy the following
Requirement
Fields:
Note: Bold Fields are required and the phone number field
should also be validated against phone number format.
Responses:
Example successful Response for a POST request should be as following:
{ "id": 1, "first_name": "Ali", "last_name": "Gamal", "country_code":
"EG", "phone_number": "01001234567", "gender": "male", "birthdate":
"1988-03-29" }
Failing should be formatted as following:
{ "errors": { "first_name": [ { "error": "blank" } ], "last_name": [ { "error":
"blank" } ], "country_code":[ { "error": "inclusion" } ], "phone_number":
[ { "error": "blank" }, { "error": "not_a_number" }, { "error":
"not_exist" }, { "error": "invalid" }, { "error": "taken" }, { "error":
"too_short", "count": 10 }, { "error": "too_long", "count": 15 } ], "gender":
[ { "error": "inclusion" } ], "birthdate": [ { "error": "blank" },
{ "error": "in_the_future" } ], "avatar": [ { "error": "blank" }, { "error":
"invalid_content_type" } ], "email": [{ "error": "taken" }, { "error":
"invalid" } ] } }
Note: HTTP status code is 201 if new user else the suitable http status code
should be returned.


Task 2
Create a new end-point to accept password and phone number and
return unique auth-token along with the response upon success.

Task 3
Based on Task1 and 2, Develop an end-point that accepts following fields in POST
request:
1. phone_number *
2. auth-token *
3. status *
Response:
1. Successful response should create a status object linked to the user object
2. Failing request can be either unauthorized request or bad request based on
auth-token/phone number combinatio

REQUIREMENTS -laravel "^7.0" -php "^7.2.5"

Installation:
   -run: git clone {put the github link here without braces}
   -run: composer install
   -run: php artisan key:generate
   -run: php artisan migrate
   -run: php artisan passport:install
   -run: php artisan serve
   
   test with Postman or swagger(http://127.0.0.1:8000/api/docs).

Postman Documentation
  https://documenter.getpostman.com/view/5537066/T1Dtfbft

