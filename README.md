# Pre-requisites
- Docker

# Load environment variables
- Populate the `server/.env` file replacing the values where it makes sense with the `.env.example` file
- The `JWT_SECRET_KEY` can be any string; make sure it is populated

# Running Tests
- `docker exec website_img ./vendor/bin/phpunit -v`

# Running the stack
- `docker compose up`
- Visit http://localhost:8080/