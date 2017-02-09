These is the install file for the Quotation extension.

Extension page on mediawiki.org: https://www.mediawiki.org/wiki/Extension:Quotation
Latest version of the install file: https://gerrit.wikimedia.org/r/gitweb?p=mediawiki/extensions/Quotation.git;a=blob;f=INSTALL


== Requirements ==

Quotation requires:

(Not checked)

== Download ==

git clone https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Quotation.git

== Installation as MediaWiki extension ==

Once you have downloaded the code, place the ''Quotation'' directory within your MediaWiki
'extensions' directory. Then add the following code to your [[Manual:LocalSettings.php|LocalSettings.php]] file:

# Quotation
require_once( "$IP/extensions/Quotation/Quotation.php" );

== Installation as standalone library ==

