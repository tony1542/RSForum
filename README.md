# Load environment variables
- Populate the `server/.env` file replacing the values where it makes sense with the `.env.example` file
- The `JWT_SECRET_KEY` can be any string; make sure it is populated

# Running Tests
- `./bin/test.sh`

# Running the front end
- `$ npm run start` to get Vue frontend up (dev with hot-reload)
  - _`$ npm run build` for prod use_
- `localhost:8080` to view the running site

# To build the back-end (one or the other)
- **Docker instructions**
  - From project root: `$ docker-compose up`
- **Local instructions**
  - Dependency Installation
    - `$ npm install`
    - `$ composer install`
  - Populate DB
    - Run the `server/seed.sql` against your localhost DB (the container is brought up on port 3306 with all mysql defaults for login)