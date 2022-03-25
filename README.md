TCC Module
==============

Reports the TCC configuration on the client Mac.

Caveats
----
Starting with 10.14, Apple has restricted access to the TCC.db file used by this module. To use this module on 10.14 or newer, you must use a PPPC profile to allow full disk access for `/usr/bin/python` (not the recommended approach) or [code sign the tcc.py script](https://www.carlashley.com/media/pdfs/blogarchive.pdf) (Page 25 of the PDF).

[Rich Trouton also provides some instruction on code signing](https://derflounder.wordpress.com/2019/04/10/notarizing-automator-applications/#more-10229)


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
