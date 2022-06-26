# Dependency Installation
- `$ npm install`
- `$ composer install`
# Populate DB
- Run the `seed.sql` against your localhost DB
# Load environment variables
- Populate the `.env` file replacing the values where it makes sense with the `.env.example` file
- The `JWT_SECRET_KEY` can be any string; make sure it is populated
# Docker
- To get the PHP / Apache container up and running
  - `docker-compose up --build`
- To SSH into the PHP / Apache container
  - `docker exec -it website_img bash -l`
# Running the front end
- `$ npm run start` to get Vue frontend up (dev with hot-reload)
     - _`$ npm run build` for prod use_
- `localhost:8080` to view the running site
# Running Tests
- `./bin/test.sh`