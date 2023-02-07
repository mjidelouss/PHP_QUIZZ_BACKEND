#!/bin/sh

echo "ENTER MESSAGE"
read MESSAGE

git add .
git status
git commit -m "$MESSAGE"
git push origin main
