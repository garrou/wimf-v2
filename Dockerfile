FROM node

WORKDIR /app

COPY package.json .

RUN npm i

COPY . .

EXPOSE 8080

CMD npm run build & npm run start