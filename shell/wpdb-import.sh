#!/bin/bash
sql_file="./docker/mysql/initdb.sql"
container_name="vite-wp-db"

if [ -f "$sql_file" ]; then
    docker exec -i $container_name sh -c 'mariadb -u root -proot localdb' < "$sql_file"
    echo "Executed SQL file"
else
    echo "$sql_file does not exist"
fi