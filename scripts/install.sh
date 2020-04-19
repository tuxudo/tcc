#!/bin/bash

# tcc controller
CTL="${BASEURL}index.php?/module/tcc/"

# Get the scripts in the proper directories
"${CURL[@]}" "${CTL}get_script/tcc" -o "${MUNKIPATH}preflight.d/tcc"

# Check exit status of curl
if [ $? = 0 ]; then
	# Make executable
	chmod a+x "${MUNKIPATH}preflight.d/tcc"

	# Set preference to include this file in the preflight check
	setreportpref "tcc" "${CACHEPATH}tcc.plist"

else
	echo "Failed to download all required components!"
	rm -f "${MUNKIPATH}preflight.d/tcc"

	# Signal that we had an error
	ERR=1
fi
