#!/bin/bash

folder_path="./docker/mysql"
container_name="vite-wordpress-db"
docker_command="docker exec -i $container_name sh -c"
dump_command="mysqldump --default-character-set=binary localdb -u root -proot"
output_file="./docker/mysql/initdb.sql"

if [ ! -d "$folder_path" ]; then
    mkdir -p "$folder_path"
fi

if [ -d "$folder_path" ]; then
    if $docker_command "$dump_command 2> /dev/null" > $output_file; then
        echo "Database export succeeded"
    else
        error_message=$($docker_command "$dump_command 2>&1")
        echo "Database export failed. Error message: $error_message"
    fi
else
    echo "$folder_path does not exist"
fi