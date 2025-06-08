#! /bin/sh

cd "$(dirname $0)"

if [ ! -f ".env" ]; then
    cp .env.example .env
fi

if [ ! -f "../.env" ]; then
    cp ../.env.example ../.env
fi

if [ -f "postgress_data/.gitignore" ]; then
    rm postgress_data/.gitignore
fi

cd .. && docker compose up
