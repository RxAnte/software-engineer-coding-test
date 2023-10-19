#!/bin/sh

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)";
DOCKER_DIR=$(dirname "${SCRIPT_DIR}");
PROJ_DIR=$(dirname "${DOCKER_DIR}");
WEB_DIR="${PROJ_DIR}/web";
NEXT_DIR="${WEB_DIR}/.next";

docker run --rm \
    --entrypoint "" \
    --name web-provision \
    -v "${WEB_DIR}:/app" \
    -w /app \
    node:18.18.2 sh -c "yarn install";

if [ ! -d "${NEXT_DIR}" ]; then
    echo "Running local next build...";

    docker run -it --rm \
        --entrypoint "" \
        --name web-provision \
        -v "${WEB_DIR}:/app" \
        -w /app \
        node:18.18.2 sh -c "yarn build";
else
    echo 'Local next build already exists. If the web container fails to run, ./dev docker container web-node "yarn build"';
fi
