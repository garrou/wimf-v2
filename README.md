# WIMF

## Local

```sh
php -S localhost:8080 -t public
```

## Docker

```sh
docker build -t wimf-v2 .
docker run --rm --name=wimf-v2 -d -p 8080:8080 wimf-v2 
```