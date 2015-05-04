All API's are RESTFUL and mainly are showcased below

1. URL: /v1/api/login
    Method : POST
    POST FIELDS : {email, password}
   RESPONSE : API_KEY
   for User Authentication

2. URL: /user
   Method: POST
    POST FIELDS : {email, password, lname, fname}
   RESPONSE : API_KEY
   for Registration/Creation of User Field

3. URL: /v1/api/user/{id}
   Method: DELETE
   RESPONSE : 1
   for deletion of user

4. URL: /v1/api/item
    Method: POST
   RESPONSE: item json
   for creation of food items

5. URL: /v1/api/order
    Method: POST
   RESPONSE: Total price of order and its ID.
   Placing an Order

6. URL: /v1/api/order/{id}
   Method: DELETE
   RESPONSE: 1
   Soft Delete that order. (deleted_at will be updated)

7. URL: ./v1/api/order
   Method: GET
   RESPONSE: Order details
   for getting order details and delivery time or address