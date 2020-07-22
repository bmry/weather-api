# WeatherAPITask
Installation:
* Run `composer install`
* Then `cd weather-api`
* Run `php -S 127.0.0.1:8000 -t public`

View SwaggerHub Api Documentation: Run `http://localhost:8000/api`

# Testing

You can test API Using SwaggerHub Documentation or use Postman

### Sample Api Call:

> `http://localhost:8000/api/temperatures?countryCode=US` - Get Temperature by country Code
> `http://localhost:8000/api/temperatures?cityName=Londonn` - Get Temperature by City
