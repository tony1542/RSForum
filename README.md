[![Tests](https://github.com/tony1542/RSForumVue/actions/workflows/tests.yml/badge.svg)](https://github.com/tony1542/RSForumVue/actions/workflows/tests.yml)

# Pre-requisites

- Docker

# Load environment variables

- Populate the `server/.env` file replacing the values where it makes sense with the `.env.example` file
- The `JWT_SECRET_KEY` can be any string; make sure it is populated

# Running tests and generating coverage

- `docker exec backend ./vendor/bin/phpunit`

# Running the stack

- `docker compose up`
- Visit http://localhost:8080/