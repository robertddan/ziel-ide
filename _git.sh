#!/bin/bash

#git init

#git config --global user.email "danrobert445@gmail.com"
#git config --global user.name "Robert-Dan"

git add .
git status

read -p "Enter your commit message: " message
git commit -m "${message:='default value'}"

git remote add origin ssh://robertddan@ssh.github.com:443/robertddan/ziel-ide.git
git push origin master

#git pull origin master