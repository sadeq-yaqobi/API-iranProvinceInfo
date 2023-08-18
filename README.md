# Iran Province and City API

This API endpoint allows you to retrieve, create, update, and delete city information for provinces in Iran.

## Authentication

To access this API, you need to provide a valid JWT token in the request header. Use the  [token generation page](https://siteyar.net)  to create a JWT token for authorization.

### Token Generation Page:

1. Enter valid email address in the provided field and click the "Generate Token" button.
2. The PHP script in the background validates the input, checks if the user exists, and generates a JWT token.
3. The generated token is displayed in the textarea.

💡 **Tip:** Access is limited to GET method requests; other methods are accessible for administrators.


## Endpoints

### GET /cities

Retrieve a list of cities for a specific province by this structure.

#### request:

- **URL:** `https://siteyar.net/api/v1//cities?province_id={province_id}`
- **Method:** GET
- **Parameters:**
  - `province_id` (required): ID of the province for which you want to retrieve cities.
  - `page`: Page number for pagination.
  - `pagesize`: Number of cities per page.
  - `fields`: Comma-separated list of fields to include in the response.
  - `orderby`: Field by which the cities should be ordered.
- Headers:
    - Key: Authorization
    - Value: Bearer [Your JWT Token]
### POST /cities

Create a new city.

#### request:

- **URL:** `/cities`
- **Method:** POST
- **Authorization:** Required
- **Request Body:**
  - JSON object representing the new city's data.
  
### PUT /cities

Update a city's name.

#### request:

- **URL:** `/cities`
- **Method:** PUT
- **Authorization:** Required
- **Request Body:**
  - JSON object containing `city_id` and `name` fields.

### DELETE /cities

Delete a city.

#### request:

- **URL:** `/cities?city_id={city_id}`
- **Method:** DELETE
- **Authorization:** Required
- **Parameters:**
  - `city_id` (required): ID of the city to be deleted.

## Responses

- Successful responses will have appropriate status codes (e.g., 200 OK, 201 Created).
- Error responses will include a relevant status code along with an error message.

## Usage Examples

### Retrieve Cities
#### **request syntax**:

- **URL:** `https://siteyar.net/api/v1/cities/?province_id=26&page=1&pagesize=3&fields=name,id,province_id&orderby=name%20asc`
- **Method:** GET
- **Parameters:** :  `province_id`: 26, `page`: 1, `pagesize`: 3, `fields`: name,id,province_id, `orderby`: name asc
- Headers:
    - Key: Authorization
    - Value: Bearer [Your JWT Token]
### Response Structure

```json
{
    "http_status": 200,
    "http_message": "OK",
    "data": [
        {
            "name": "ازنا",
            "id": "371",
            "province_id": "26"
        },
        {
            "name": "الشتر",
            "id": "374",
            "province_id": "26"
        },
        {
            "name": "اليگودرز",
            "id": "370",
            "province_id": "26"
        }
    ]
}
```
## Cache Utility Class

The [CacheUtility](https://github.com/sadeq-yaqobi/API-iranProvinceInfo/blob/main/App/Utilities/CacheUtility.php) class provides functionality for caching API responses to improve performance and reduce server load.

### Methods

- `init()`: Initializes cache file address and enables caching for GET requests.
- `cache_exists()`: Checks if a valid cached API response exists.
- `start()`: Starts buffering and serves a cached copy if available.
- `end()`: Caches captured output and sends it to the browser.
- `flush()`: Deletes cached files in the cache directory.

### Cache Configuration

- Cache is enabled when `CACHE_ENABLED` is set to true.
- Expiration time: 1 hour (`EXPIRE_TIME = 3600 seconds`).

### Usage Examples

To use caching:

1. Import the `CacheUtility` class.
2. Use `CacheUtility::start()` before generating API responses.
3. Call `CacheUtility::end()` after generating responses to save them.
4. Optionally, use `CacheUtility::flush()` to clear cached files.
## Contributing

Feel free to contribute to this project by submitting pull requests or reporting issues.

## License

This project is licensed under the MIT  License - see the [LICENSE](https://choosealicense.com/licenses/mit/) file for details.

## Contact

For questions or feedback, please contact .
