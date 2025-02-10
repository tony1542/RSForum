# Prepare node/npm
FROM node:16 AS node_base

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

EXPOSE 8080

CMD ["sh", "-c", "npm run start & tail -f /dev/null"]
#CMD ["npm", "run", "start"]