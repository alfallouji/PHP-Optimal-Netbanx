# PHP-Optimal-Netbanx

This is an OOP PHP Client for the Card payments Optimal Netbanx Restful service.


## Authors & contact


Al-Fallouji Bashar 
    - bashar@alfallouji.com

    
## Documentation and download


Latest version is available on github at :
    - http://github.com/alfallouji/PHP-Optimal-Netbanx


## License


This Code is released under the GNU LGPL

Please do not change the header of the file(s).

This library is free software; you can redistribute it and/or modify it 
under the terms of the GNU Lesser General Public License as published 
by the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This library is distributed in the hope that it will be useful, but 
WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
or FITNESS FOR A PARTICULAR PURPOSE.

See the GNU Lesser General Public License for more details.


## How to setup


You can use composer to use this library.

```
{
    "require": {
		"alfallouji/php_optimal_netbanx": "*"
    }
}
```

## How to start


This PHP client works with the Netbanx service (card payments). 

You will need an account with Optimal Payment in order to use this library.

You can create testing account here : https://developer.optimalpayments.com/en/


## Configuration


In order for you to use the NETBANX REST API, NETBANX must first set you up on their system and provide you with an API key. Your API key looks something like this:

 * Key ID – MerchantXYZ
 * Key Password – B-tst1-0-51ed39e4-312d02345d3f123120881dff9bb4020a89e8ac44cdfdcecd702151182fdc952272661d290ab2e5849e31bb03deede7
 * Account ID - 12345678

They are available from : https://developer.optimalpayments.com/en/my-account/

Please note that on the Optimal My Account page, the API key contains the Key ID and the Key Password. It has the following the format : 

 ``` API_KEY_ID:API_KEY_PASSWORD ```


## Sample


For an example, you can look at the tests/Functional folder.
