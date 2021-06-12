1.Create Customer (POST METHOD)
Example URL: 
http://127.0.0.1:8000/api/create

example raw data for create customer
{
    "cusName":"test",
    "cusEmail":"test@gamil.com",
    "cusPhoneNo":"+60123456789",
    "cusPassword":"aSD1234",
    "gender":"M"
}

2. find customer by phoneNumber (GET METHOD)
Example URL: 
http://127.0.0.1:8000/api/getByPhoneNo/+60123456780

3. find customer by email (GET METHOD)
Example URL: 
http://127.0.0.1:8000/api/getByEmail/test@gamil.com

4. list customer (GET METHOD)
Example URL: 
http://127.0.0.1:8000/api/getAll

5.update customer name with id (PUT METHOD)
Example URL:  
http://127.0.0.1:8000/api/updateName

example raw data for update customer
{
    "cusName":"testing2",
    "cusId":"C10001"
}

6.delete customer with id (Delete METHOD)
Example URL: 
http://127.0.0.1:8000/api/delete/C10001
7. hahah 3
