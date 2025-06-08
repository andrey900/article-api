#! /bin/sh

printf "\n\nStarting entrypoint php-fpm...\n\n"
set -e

#if [ "${1#-}" != "$1" ]; then
#	set -- php "$@"
#fi

for f in /scripts/docker-entrypoint.d/*; do
	echo "---c"
    case "$f" in
        *.sh)     echo "$0: running $f"; "$f" ;;
        "/scripts/docker-entrypoint.d/*") ;;
        *)        echo "$0: ignoring $f" ;;
    esac
	echo "--- cv"
done

exec "$@"
