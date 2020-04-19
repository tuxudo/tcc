TCC Module
==============

Reports the TCC configuration on the client Mac.

Caveats
----
Starting with 10.14, Apple has restricted access to the TCC.db file used by this module. To use this module on 10.14 or newer, you must use a PPPC profile to allow full disk access for `/usr/bin/python` (not the recommended approach) or [code sign the tcc.py script](https://carlashley.com/2018/09/23/code-signing-scripts-for-pppc-whitelisting/)


Table Schema
----

* dbpath - VARCHAR(255) - Path of TCC.db entry is from
* service - VARCHAR(255) - Service name
* client - VARCHAR(255) - Bundle ID of client
* client_type - integer - Client type
* allowed - boolean - If access is allowed
* prompt_count - INT(11) - Count of times prompted for access
* indirect_object_identifier - VARCHAR(255) - Paired client ID
* last_modified - big int - Timestamp of last modification of entry
