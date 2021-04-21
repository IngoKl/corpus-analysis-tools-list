# corpus-analysis-tools-list

![corpus-analysis.com](https://github.com/IngoKl/corpus-analysis-tools-list/blob/master/img/corpus-analysis.com.png)

This repository contains the code behind the list at [corpus-analysis.com](https://corpus-analysis.com). 

The site is written in old-school PHP and definitely not an example of great software engineering. That being said, you're more than welcome to optimize the code!

The **architecture** is a bit odd: 
The actual data is stored in a Google Sheets sheet. This sheet, which effectively works as a multiuser backend, is then being downloaded as a CSV file and processed.

If you want to **run your own version**, you simply need to change and rename `config.default.php` to `config.php`. Also, make sure to remove the analytics code and change the copyright/impressum.

If you want to run this on **NGINX** (i.e. the .htaccess won't work), remember to add a rewrite rule such as `rewrite ^/tag/([^/]*)$ /index.php?tag=$1 last;`.

## Credit

GDPR-compliant cookie consent is implemented using the fantastic [*Coockie Consent*](https://github.com/orestbida/cookieconsent) by Orest Bida.
