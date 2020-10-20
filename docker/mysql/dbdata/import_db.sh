#!/bin/bash
mysql -e "CREATE DATABASE IF NOT EXISTS miichi_crm;"

mysql -uroot miichi_crm < miichi_laravel.sql
