These is the install file for the Citation extension.

Extension page on mediawiki.org: https://www.mediawiki.org/wiki/Extension:Citation
Latest version of the install file: https://gerrit.wikimedia.org/r/gitweb?p=mediawiki/extensions/Citation.git;a=blob;f=INSTALL


== Requirements ==

Citation requires:

(Not checked)

== Download ==

git clone https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Citation.git

== Installation as MediaWiki extension ==

Once you have downloaded the code, place the ''Citation'' directory within your MediaWiki
'extensions' directory. Then add the following code to your [[Manual:LocalSettings.php|LocalSettings.php]] file:

# Citation
require_once( "$IP/extensions/Citation/Citation.php" );

== Installation as standalone library ==

