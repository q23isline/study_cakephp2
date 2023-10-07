FROM node:10-buster

RUN mkdir /front
WORKDIR /front

COPY frontend/package.json /front/package.json
COPY frontend/package-lock.json /front/package-lock.json

RUN npm install

EXPOSE 8080
