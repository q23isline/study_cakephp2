FROM node:10-buster

RUN mkdir -p {/front/vue,/front/webroot}

WORKDIR /front/vue

ENV NODE_ENV production

COPY frontend/package.json /front/vue/package.json
COPY frontend/package-lock.json /front/vue/package-lock.json

RUN npm install

COPY frontend/ /front/vue/

RUN npm run build

EXPOSE 8080
