#!/bin/bash
docker exec -i vite-wp-db sh -c 'mysql -u root -proot localdb' < ./docker/mysql/initdb.sql