## General Description

This package is a simple coding task showcase.

It has a static exchange rates which are defined in the config/exchangerates.php, or it has an optional live feature that will use the exchangerate-api.com to get the latest live exchange rates.

## Technical requirements

- Tested to be working with php ^7.4

- Tested to be working with composer ^2.2

- You will need docker and docker-compose to run the project locally

## Installation Instructions

- Clone the repository

- Copy over the .env.example into a .env file and replace all the secrets

- Run ``` composer install ``` to get all the dependencies

- Run ``` docker-compose up -d ``` to run the docker services

- You can access the project on localhost:8080

## Live feature requirements

For the "Live" feature make sure you have access to a redis instance and a valid access key from exchangerate-api.com.
The ```REDIS_DEFAULT_TTL``` parameter will define the caching policy on the local side. This means that when fetching the live data the request will be cached and stored on the application side for the defined time. (since the free usage of exchangerate-api allows only up to 1500 requests per month and the rates change daily)

## Usage

Make a simple get request with the query parameters target, source and amount

Example {hostname}?amount=100&source=EUR&target=USD&live=false

[Demo preview](https://factset.dejanroshkovski.com?amount=100&source=EUR&target=USD&live=true)

Valid currency codes (for both _**target**_ and _**source**_):

```
EUR,AED,AFN,ALL,AMD,ANG,AOA,ARS,AUD,AWG,AZN,BAM,BBD,BDT,BGN,BHD,BIF,BMD,BND,BOB,BRL,BSD,BTN,BWP,BYN,BZD,CAD,CDF,CHF,CLP,CNY,COP,CRC,CUP,CVE,CZK,DJF,DKK,DOP,DZD,EGP,ERN,ETB,FJD,FKP,FOK,GBP,GEL,GGP,GHS,GIP,GMD,GNF,GTQ,GYD,HKD,HNL,HRK,HTG,HUF,IDR,ILS,IMP,INR,IQD,IRR,ISK,JEP,JMD,JOD,JPY,KES,KGS,KHR,KID,KMF,KRW,KWD,KYD,KZT,LAK,LBP,LKR,LRD,LSL,LYD,MAD,MDL,MGA,MKD,MMK,MNT,MOP,MRU,MUR,MVR,MWK,MXN,MYR,MZN,NAD,NGN,NIO,NOK,NPR,NZD,OMR,PAB,PEN,PGK,PHP,PKR,PLN,PYG,QAR,RON,RSD,RUB,RWF,SAR,SBD,SCR,SDG,SEK,SGD,SHP,SLL,SOS,SRD,SSP,STN,SYP,SZL,THB,TJS,TMT,TND,TOP,TRY,TTD,TVD,TWD,TZS,UAH,UGX,USD,UYU,UZS,VES,VND,VUV,WST,XAF,XCD,XDR,XOF,XPF,YER,ZAR,ZMW,ZWL
```

The _**amount**_ parameter has to be _numeric_.

The _**live**_ parameter is optional _boolean_.

Only limited static conversion possibilities are available

## List of external packages used

```
"bramus/router"
"guzzlehttp/guzzle"
"vlucas/phpdotenv"
"predis/predis"
```