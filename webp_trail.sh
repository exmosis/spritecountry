#!/bin/bash

TRAIL=$1

WEBP_DIR="webp"

# Check if directory exists
cd httpdocs/data/img
if [ ! -d "$TRAIL" ]; then
	echo Directory does not exist in httpdocs/data/img
	exit 1
fi

cd $TRAIL

# Create the webp directory if it doesn't exist
mkdir -p $WEBP_DIR

# Convert images
for jpg in *.jpg; do
	cwebp $jpg -hint photo -q 80 -o $WEBP_DIR/$jpg.webp
done


cd -

# cwebp httpdocs/data/img/abzu/abzu-1.jpg -hint photo -q 80 -o httpdocs/data/img/abzu/webp/abzu-1.webp

