# PayWhirlAPI
ProcessWire module wrapper for PayWhirl API

## System requirements
* PHP 5.6.4 or greater

## General information
This module enables you to access a PayWhirl account to send/retrieve data to/from a ProcessWire website.

## First steps
* Visit (https://api.paywhirl.com/) and read the documentation. 
* Log into PayWhirl, go to 'Developers' and create a new API Key and API Secret. 
* Make a note of the App key and the App secret.

## Installation
* Download the zip file into your site/modules folder then expand the zip file. 
* Next, login to ProcessWire > go to Modules > click "Refresh". You should see a note that a new module was found. Install the PayWhirlAPI module. 
* Configure the module with your App key and App secret

## Usage
Read the PayWhirl API documentation!

An example template for logging in from ProcessWire:
```
<?php namespace ProcessWire;

use PayWhirl;

$payWhirl = $modules->get('PayWhirlAPI')->login();
```

To get an array of the currently logged-in user's subscriptions:
```
$data = array('keyword' => $user->email);
$userSubs = $payWhirl->getSubscriptions($payWhirl->getCustomers($data)[0]->id);
```

## Important
At the time of creating this module, API access to PayWhirl is limited to paid PayWhirl accounts! Should you get the message "*Invalid Authorization. Your account does not have access to the PayWhirl API.*" you're probably on the free PayWhirl plan. You'll need to upgrade or ask PayWhirl management.



