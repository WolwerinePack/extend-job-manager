#!/bin/sh
# echo $@
# exit

TARGET_FILE=$0
cd `dirname $TARGET_FILE`
# LOC_DIR=`pwd`
PHYS_DIR=`pwd -P`
cd $PHYS_DIR

if command -v /usr/local/bin/php >/dev/null 2>&1; then
    /usr/local/bin/php -f script.php -- $@
else
    php -f script.php -- $@
fi