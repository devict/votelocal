#!/bin/bash

mkdir backups
out=$(date +%Y%m%d-%s)-votelocal-backup.sql
docker-compose run --rm db mysqldump votelocal > backups/$out
