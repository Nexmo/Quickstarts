#!/bin/bash
echo -e "Publishing Quickstarts...\n"
NOW=$(date +"%m-%d-%Y")
if ! php ./build.php -e production -p Quickstarts -b _publish; then
    echo -e "Build Failed\n"
    exit 1
fi
echo -e "Cloning pages...\n"

git clone --quiet --branch=gh-pages git@github.com:Nexmo/Quickstarts.git gh-pages > /dev/null
cd gh-pages
git rm -rf .
cp -Rf ../_publish/* ./
git add -f .
git commit -m "Automated build from source: $NOW"
git push -fq origin gh-pages > /dev/null