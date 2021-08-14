#!/bin/bash
set -e

exec /usr/bin/supervisord --nodaemon -c /docker/conf/supervisord.conf