
API documentation
http://api.test

Title
	Register a new user.

URL
	/api/v1/auth/register

Method: POST

Data Params

	Example
	{
		forename:chuiquito,
		surname:delacalzada,
		email:chiquito@otro.com,
		password:melon2000
		
	}


Success Response:
	Example:
	Code: 201
	Content: {"status":true,"message":"User created successfully","data":{"id":"7cd32bf8-5560-11e8-9d53-080027f0d6cc","forename":"chuiquito","surname":"delacalzada","email":"chiquito@otro.com","updated_at":"2018-05-11 21:15:53","created_at":"2018-05-11 21:15:53"}}

Error Response:
 	Example:
 	Code:401
 	Content:{"error":"User already exists"}

 	Or

 	Code:200
 	Content:[{"email":["The email must be a valid email address."]}]

 	NOTE:(we could add more validation errors for the other attributes)

  Sample Call 	