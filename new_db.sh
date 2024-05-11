#!/usr/bin/env bash
psql -U wlefebvre <<EOF 
DROP DATABASE IF EXISTS gatherly_db;
CREATE DATABASE gatherly_db;
EOF
psql -d gatherly_db -f postgres/create_db.sql;