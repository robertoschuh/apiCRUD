
## API Documentation
#### TESTED with POSTMAN
#### Laravel functional tests TDD (just for login and register, we could do more tests for delete and get users etc..)

###### Endpoint URL:http://masquebits.com

#### Title: Register a new user.

###### URL
	/api/v1/auth/register

###### Method: POST

###### Data Params
	
	Example
	{
		forename:chuiquito [string, required],
		surname:delacalzada  [string, required],
		email:chiquito@otro.com  [string, required],
		password:melon2000  [string, required]
		
	}

#### Success Response:
	 Example:
	 Code: 201
	 Content: 
	 {"status":true,"message":"User created successfully","data":{"id":"7cd32bf8-5560-11e8-9d53-080027f0d6cc","forename":"chuiquito","surname":"delacalzada","email":"chiquito@otro.com","updated_at":"2018-05-11 21:15:53","created_at":"2018-05-11 21:15:53"}}


###### Error Response:
 	Example:
 	Code:401
 	Content:{"error":"User already exists"}

 	Or

 	Code:200
 	Content:[{"email":["The email must be a valid email address."]}]

 	NOTE:(we could add more validation errors for the other attributes)

 ###### Sample Call 	
 
 Example:
	{
		forename:chuiquito,
		surname:delacalzada,
		email:chiquito@otro.com,
		password:melon2000
	}


#### Title: Login.

###### URL
	/api/v1/auth/login

###### Method: POST

###### Data Params
######	
	Example
	{
		email:chuiquito [string, required],
		password:delacalzada  [string, required]
	
	}


######

###### Success Response:
	Example:
	Code: 200
	Content: {"token":"sdsadasderererzxz.ZMGQ2Y2MiLCJpc3MiOiJodHRwOi8vYXBpLnRlc"}

###### Error Response:
 	Example:
 	Code:422
 	Content:["invalid_email_or_password"]

 
 ###### Sample Call 	
 ###### Example:
  	POST /api/v1/auth/login
	content-type: application/x-www-form-urlencoded

 ###### BODY:
	{
		email:chuiquito,
		password:delacalzada
	
	}


#### Title: Get Auth User.

###### URL
	api/v1/user?token=<token>

###### Method: GET

###### URL Params 
	token=<string> [required]
	example:token=asdsaddfsdasdasdsdfsdfsfsaddasd
		

###### Success Response:
	Example:
	Code: 200
	Content: 
	{
	    "result": {
	        "id": "bdbe6f82-551b-11e8-b91a-080027f0d6cc",
	        "forename": "2131313",
	        "surname": "adsadadadad",
	        "email": "robbyschuh2@gmail.com",
	        "created_at": "2018-05-11 13:03:47",
	        "updated_at": "2018-05-11 13:06:42"
	    }
	}

###### Error Response:
 	Example:
 	Code:403
 	Content:["token_invalid"]

 	

 ###### Sample Call 	
  	Example
	http://masquebits.com/api/v1/user?token=eyJ0eXAiOiJKV1QiLCJhbG


#### Title: Update user.
	NOTE:This endpoint only update non empty attributes

###### URL
	api/v1/users/<uuid>?token=<token>

###### Method: PUT

###### URL Params 

	uuid==<string>[required]
	token=<string>[required]
	example:bdbe6f82-551b-11e8-b91a-080027f0d6cc?token=asdsaddfsdasdasdsdfsdfsfsaddasd
		

###### Data Params
	
	Example
	{
		forename:Julia [string, optional],
		surname:Julia [string, optional]
	}

	Example2
	{
		
		email:chiquito@otro.com  [string, optional],
		password:newPassword  [string, optional]
		
	}
	Example3
	{
		forename:Julia [string],
		surname:Ramirez  [string],
		email:newemail@otro.com  [string],
		password:newpassword  [string]
		
	}

###### Success Response:
	Example:
	Code: 200
	Content: {"message": "User updated"}

###### Error Response:
 	Example:
 	Code:404
 	Content:{
	    "data": {
	        "message": "Resource not found",
	        "status_code": 404
	    }
	}


###### Sample Call 	
  Example:
	PUT /api/v1/users/bdbe6f82-551b-11e8-b91a-080027f0sd6cc
	content-type: application/x-www-form-urlencoded
	token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ

	body:
	{
		forename=new name,
		description=example update
	}


#### Title: Delete a User.

###### URL
	api/v1/users/<uuid>?token=<token>

###### Method: DELETE

###### URL Params 
	uuid=<string>[required]
	token=<string>[required]
	example:token=asdasdasdad?asdsaddfsdasdasdsdfsdfsfsaddasd
		


###### Success Response:
	Example:
	Code: 200
	Content: 
	{
    	"message": "User deleted"
	}

###### Error Response:
 	Example:
 	Code:404
 	Content:{
	    "data": {
	        "message": "Resource not found",
	        "status_code": 404
	    }
	}

 	
###### Sample Call 	
	Example:
	http://masquebits.com/api/v1/users/4f8ab3d8-55c8-11e8-aacc-080027f0d6cc?token=eyJ0eXAiOiJKV1QiLCJhbGciOi
