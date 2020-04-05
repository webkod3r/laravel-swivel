#!/bin/sh

EXTRAS=`php -r "echo dirname(realpath('$0'));"`
PROJECT=$EXTRAS/..

# Hooks
cp $EXTRAS/git-hooks/pre-commit $PROJECT/.git/hooks/pre-commit
chmod +x $PROJECT/.git/hooks/pre-commit
