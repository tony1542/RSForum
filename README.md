# Pre-requisites
- Docker

# Load environment variables
- Populate the `server/.env` file replacing the values where it makes sense with the `.env.example` file
- The `JWT_SECRET_KEY` can be any string; make sure it is populated

# Running Tests
- `./bin/test.sh`

# Running the front end (requires Node 16.x)
- `$ npm run start` to get Vue frontend up (dev with hot-reload)
  - _`$ npm run build` for prod use_
- `localhost:8080` to view the running site

# To build and run the back-end
  - `$ docker-compose up`
