#!/bin/bash

sql_file="./docker/mysql/initdb.sql"
container_name="vite-wordpress-db"
docker_command="docker exec -i $container_name sh -c"
import_command="mariadb -u root -proot localdb"

if [ -f "$sql_file" ]; then
    if $docker_command "$import_command" < "$sql_file"; then
        echo "Database import succeeded"
    else
        error_message=$($docker_command "$import_command" < "$sql_file")
        echo "Database import failed. Error message: $error_message"
    fi
else
    echo "$sql_file does not exist"
fi