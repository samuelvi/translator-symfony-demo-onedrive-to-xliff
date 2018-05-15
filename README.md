Spreadsheet Translator Symfony Demo Application - Use Case
======================================================================================

Introduction
------------

Lightweight Symfony Demo Application for the Spreadsheet Translator functionallity.
 The demo brings a command that takes a Microsoft One Drive spreadhseet file and creates a translation file per locale in Xliff format.


Installation
------------

composer create-project atico/translator-symfony-demo-onedrive-to-xliff

This will install the demo application into your computer

The source demo spreadsheet file is located at https://onedrive.live.com/embed?resid=AF6B7F4DC4426D56!114&authkey=%21AOntrGclPCi6zdA&em=2&cid=af6b7f4dc4426d56




Instructions for sharing the One Drive file in readonly mode
------------------------------------------------------------

Open your spreadsheet file in One Drive.

Go to Open => Share 

Click on the embed link

Click on the generate button

A screen with a Code for Insert|Javascript will appear

The given textarea will contain an iframe element, copy the value for AUTHKEY

From the address bar copy the values for RESID and CID


Manually build the following url replacing the corresponding values:

https://onedrive.live.com/embed?resid=RESID&authkey=AUTHKEY&em=2&cid=CID



Running the demo
---------

type in you terminal: bin/console atico:demo:translator --sheet-name=common

This command will generate the translation files that will be stored into app/translations folder.

The generated files will be:

```
  app
  |
  └───Resources
     │
     └──translations
         │  demo_common.es_ES.php   
         │  demo_common.en_GB.php
         │  demo_common.it_IT.php

```      
                              
demo_common.it_IT.yml will contain:

```php
  <?php
  return array (
    'homepage_title' => 'Traduttore di fogli di calcolo',
    'homepage_subtitle' => 'Traduttore per pagine Web con fogli di calcolo',
  );
```

Related
------------

Symfony Bundle:
- <a href="https://github.com/samuelvi/spreadsheet-translator-symfony-bundle">Symfony Bundle</a>

Symfony Demos:

- <a href="https://github.com/samuelvi/translator-symfony-demo-local-file-to-php">Symfony Demo. Takes a local file and creates translation files per locale in php format</a>
- <a href="https://github.com/samuelvi/translator-symfony-demo-google-to-yml">Symfony Demo. Takes a google drive spreadsheet and creates translation files per locale in yml format</a>
- <a href="https://github.com/samuelvi/translator-symfony-demo-onedrive-to-xliff">Symfony Demo. Takes a microsoft one drive spreadsheet and creates translation files per locale in xliff format</a>



Notes
-----


composer.json will include the following Spreadsheet Translator dependencies:
```
  "atico/spreadsheet-translator-core": "^1.0",
  "atico/spreadsheet-translator-symfony-bundle": "^1.0",
  "atico/spreadsheet-translator-provider-onedrive": "^1.0",
  "atico/spreadsheet-translator-reader-xlsx": "^1.0",
  "atico/spreadsheet-translator-exporter-xliff": "^1.0",
```



Requirements
------------

  * PHP >=5.5.9
  * Symfony ~2.3|~3.0


Contributing
------------

We welcome contributions to this project, including pull requests and issues (and discussions on existing issues).

If you'd like to contribute code but aren't sure what, the issues list is a good place to start. If you're a first-time code contributor, you may find Github's guide to <a href="https://guides.github.com/activities/forking/">forking projects</a> helpful.

All contributors (whether contributing code, involved in issue discussions, or involved in any other way) must abide by our code of conduct.


License
-------

Spreadsheet Translator Symfony Bundle is licensed under the MIT License. See the LICENSE file for full details.

