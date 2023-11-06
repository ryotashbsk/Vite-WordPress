#!/bin/bash
docker exec -it vite-wp-db sh -c 'mysqldump --default-character-set=binary localdb -u root -proot 2> /dev/null' > ./docker/mysql/initdb.sql