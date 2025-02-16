[![Tests](https://github.com/tony1542/RSForumVue/actions/workflows/tests.yml/badge.svg)](https://github.com/tony1542/RSForumVue/actions/workflows/tests.yml)
![Coverage Badge](https://img.shields.io/badge/Coverage-43.80%25-red.svg)

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

# Legal
Created using intellectual property belonging to Jagex Limited under the terms of [Jagex's Fan Content Policy](https://legal.jagex.com/docs/policies/fan-content-policy?form=MG0AV3). This content is not endorsed by or affiliated with Jagex.