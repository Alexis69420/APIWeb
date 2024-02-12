#!/bin/bash

if [ ! -d /tmp/postman ]
then
    mkdir -p /tmp/postman/
    cd /tmp/postman/
    echo "Postman non trouvé, téléchargement..."
    wget https://dl.pstmn.io/download/latest/linux64 -O postman.tar.gz
    tar zxvf postman.tar.gz
fi

/tmp/postman/Postman/Postman

