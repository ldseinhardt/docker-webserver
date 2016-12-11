# Docker Webserver

![Version][version-image] [![License MIT][license-image]][license-url]

- PHP 5.6
- MySQL 5.7
- Apache 2
- Node 7
- Git
- Composer
- Bower
- Yarn

## Run

```bash
$ ./run
```

## List containers

```bash
$ docker ps -a
```

## Enter container with bash

```bash
$ docker exec -it [container_name] bash
```

## Create database

```bash
$ docker exec -it mysql bash
$ cd /db && mysql -u root -p

Enter password: 12345678

mysql> source agenda.sql
```

[license-image]: http://img.shields.io/badge/license-MIT-blue.svg?style=flat
[license-url]: LICENSE

[version-image]: https://img.shields.io/badge/version-0.1-brightgreen.svg?style=flat
