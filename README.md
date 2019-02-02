# Quotation

## Scope

This is an extension that adds basic features for quotes in quotations, to facilitate continuous verification of the validity of those statements, and to check their reuse in wikitext on a wiki running the Mediawiki software.

The project is on-going, and as such will be extremely unstable &ndash; it might even trigger a meltdown of your computer. :)

## Identification

The _head_ of the extension is targeted at an old version of the server software, not the current _head_ of [Mediawiki](https://www.mediawiki.org/wiki/Download). There are no attempts to make the extension compatible with new versions. The versions can be downloaded from Wikimedias git repository, or from GitHub.

Naming of this extension has changed from Quote to Ctation, and is not consistent.

### Markup

All sequences that replaces something is encapsulated in square brackets. Any single character in brackets is replaced within word, same count of word separators pluss one (or word counts) in brackets is replaced within string, and same count of sentence terminators pluss one in brackets is replaced within string. In addition the special forms exists

- [․] (brackets around U+2024, ONE DOT LEADER) – several characters within a single word is replaced
- [‥] (brackets around U+2025, TWO DOT LEADER) – several words within a constituent is replaced
- […] (brackets around U+2026, HORIZONTAL ELLIPSIS) – several constituents over a sentence is replaced

This gives the following examples, given the following source text

  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.

To quote a short fragment, and change a single character, a quote could be `[C]onsectetur adipisicing elit`. It will only be truty if a single character is changed, that is the first character "c" in "consectetur", and it is of a similar character class.

To quote a short fragment, and change several characters, a quote could be `[CON]sectetur adipisicing elit`. It will only be truty if the same number of characters are changed, that is the first characters "con" in "consectetur", and they are pairwise of similar character classes.

To quote a short fragment, and change two words, a quote could be `Lorem [dolor ipsum] sit amet`. When a word separator is found, then the pairwise character class match is relaxed. It will only be truty if the count of word space boundraries are the same.

To quote a short fragment, and remove a word, a quote could be `consectetur [․] elit`. It will only be truty if the characters removed does not span a word boudrary.

To quote a short fragment, and remove several words, a quote could be `Lorem [‥] sit amet`. It will only be truty if the characters removed does not span a constituent boudrary.

To quote a short fragment, and remove a constituent, a quote could be `Lorem ipsum dolor sit amet, […] sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.`. It will only be truty if the characters removed does not span a sentence boudrary.

## Referenced documents

Core documents

* Extension page on mediawiki.org: https://www.mediawiki.org/wiki/Extension:Quotation
* Latest version of the readme file: https://gerrit.wikimedia.org/r/gitweb?p=mediawiki/extensions/Quotation.git;a=blob;f=README


