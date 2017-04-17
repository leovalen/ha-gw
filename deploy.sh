#!/bin/bash

ERRORSTRING="Error. Please make sure you've indicated correct parameters"
if [ $# -eq 0 ]
    then
        echo $ERRORSTRING;
elif [ $1 == "staging" ]
    then
        if [[ -z $2 ]]
            then
                echo "Running dry-run"
                /opt/local/bin/rsync --dry-run -az --force --delete --chown=pi:pi --exclude=".*" -e "ssh -p22" ./ pi@hagw1.stallen.xyz:/home/pi/ha-gw
        elif [ $2 == "go" ]
            then
                echo "Running actual deploy"
                /opt/local/bin/rsync -az --force --delete  --chown=pi:pi --exclude=".*" ./ pi@hagw1.stallen.xyz:/home/pi/ha-gw
        else
            echo $ERRORSTRING;
        fi
elif [ $1 == "production" ]
    then
        if [[ -z $2 ]]
            then
                echo "Running dry-run"
                /opt/local/bin/rsync --dry-run -az --force --delete --chown=pi:pi --exclude=".*" -e "ssh -p22" ./ pi@hagw1.stallen.xyz:/home/pi/ha-gw
        elif [ $2 == "go" ]
            then
                echo "Running actual deploy"
                /opt/local/bin/rsync -az --force --delete  --chown=pi:pi --exclude=".*" ./ pi@hagw1.stallen.xyz:/home/pi/ha-gw
        else
            echo $ERRORSTRING;
        fi
fi