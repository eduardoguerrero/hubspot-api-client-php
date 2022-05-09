## Hubspot API client PHP

## What is HubSpot?

HubSpot’s CRM platform has all the tools and integrations you need for marketing, sales, content management, and customer service. Each product in the platform is powerful alone, but the real magic happens when you use them together.

## Installing

```bash
composer require hubspot/api-client
```
---
## Contacts

### Get all contacts

```php
use HubSpot\Http\Client;
use HubSpot\Resources\Contact;

$client = new Client(['baseUrl' => 'https://api.hubapi.com', 'apikey' => 'XXXX-XXXX']);
$contact = new Contact($client);
// Control what is returned via the properties query param.
$queryParams = [
     'limit' => 2,         // The maximum number of results to display per page.
     'archived' => false,  // Whether to return only results that have been archived.
];
$response = $contact->getAll($queryParams);
$data = $response->getData();
```

## Get contact by id

```php
use HubSpot\Http\Client;
use HubSpot\Resources\Contact;

$client = new Client(['baseUrl' => 'https://api.hubapi.com', 'apikey' => 'XXXX-XXXX']);
$contact = new Contact($client);
$queryParams = [
     'archived' => false, // Whether to return only results that have been archived.
];
$customerId = 142290864;
$response = $contact->getById($customerId, $queryParams);
$data = $response->getData();
```

## Get contact by property

```php
use HubSpot\Http\Client;
use HubSpot\Resources\Contact;

$client = new Client(['baseUrl' => 'https://api.hubapi.com', 'apikey' => 'XXXX-XXXX']);
$contact = new Contact($client);
$options = [
   'body' => [
       'filterGroups' => [
           [
              'filters' => [
                 [
                   'value' => 'escobarguerrero@gmail.com',
                   'propertyName' => 'email',
                   'operator' => 'EQ'
                 ]
              ]
           ]
       ]
  ]
];
$response = $contact->getByProperty($options);
$data = $response->getData();
```

#### Create contact

```php
use HubSpot\Http\Client;
use HubSpot\Resources\Contact;

$client = new Client(['baseUrl' => 'https://api.hubapi.com', 'apikey' => 'XXXX-XXXX']);
$contact = new Contact($client);
$properties = [
      'body' => [
         'properties' => [
             'company' => 'Biglytics',
             'email' => 'bcooper@biglytics.net',
             'firstname' => 'Bryan',
             'lastname' => 'Cooper',
             'phone' => '(877) 929-0687',
             'website' => 'biglytics.net'
         ]
     ]
];
$response = $contact->create($properties);
```
---

## Deals

#### Get all deals

```php
use HubSpot\Http\Client;
use HubSpot\Resources\Deal;

$client = new Client(['baseUrl' => 'https://api.hubapi.com', 'apikey' => 'XXXX-XXXX']);
$deal = new Deal($client);
// Control what is returned via the properties query param.
$queryParams = [
     'limit' => 2,         // The maximum number of results to display per page.
     'archived' => false,  // Whether to return only results that have been archived.
];
$response = $deal->getAll($queryParams);
$data = $response->getData()
```

#### Get deal by id

```php
use HubSpot\Http\Client;
use HubSpot\Resources\Deal;

$client = new Client(['baseUrl' => 'https://api.hubapi.com', 'apikey' => 'XXXX-XXXX']);
$deal = new Deal($client);
$queryParams = [
     'archived' => false, // Whether to return only results that have been archived.
];
$dealId = 1919254657;
$response = $deal->getById($dealId, $queryParams);
$data = $response->getData()
```

#### Create deal

```php
use HubSpot\Http\Client;
use HubSpot\Resources\Deal;

$client = new Client(['baseUrl' => 'https://api.hubapi.com', 'apikey' => 'XXXX-XXXX']);
$deal = new Deal($client);
$properties = [
      'body' => [
         'properties' => [
             'amount'=> '599.00',
             'closedate'=> '2019-12-07T16:50:06.678Z',
             'dealname'=> 'Custom data integrations',
             'hubspot_owner_id'=> '45097310',
             'pipeline'=> 'Pipeline test'
         ]
      ]
];
$response = $deal->create($properties);
$data = $response->getData()
```

#### Update deal

```php
use HubSpot\Http\Client;
use HubSpot\Resources\Deal;

$client = new Client(['baseUrl' => 'https://api.hubapi.com', 'apikey' => 'XXXX-XXXX']);
$deal = new Deal($client);
// Properties to update
$properties = [
      'body' => [
             'properties' => [
             'amount' => '699.00',
             'closedate' => '2021-04-01T16:50:06.678Z',
             'dealname' => 'Test custom data integrations',
             'hubspot_owner_id' => '45097310',
             'pipeline' => 'Pipeline test'
         ]
      ]
];
$dealId = 5026209383;
$response = $deal->updateById($dealId, $properties);
$data = $response->getData()
```

#### Associate a deal with another object

```php
use HubSpot\Http\Client;
use HubSpot\Resources\Deal;

const ASSOCIATION_DEAL_TO_CONTACT = 'contacts';
const ASSOCIATION_TYPE_DEAL_TO_CONTACT = 'deal_to_contact';
$client = new Client(['baseUrl' => 'https://api.hubapi.com', 'apikey' => 'XXXX-XXXX']);
$deal = new Deal($client);
$associate = new AssociateDeal();
$associate
    ->setDealId($dealId)
    ->setToObjectType(self::ASSOCIATION_DEAL_TO_CONTACT)
    ->setToObjectId($toObjectId)
    ->setAssociationType(self::ASSOCIATION_TYPE_DEAL_TO_CONTACT);
$data = $deal->associateWithObject($associate);
```

#### Change deal status

```php
use HubSpot\Http\Client;
use HubSpot\Resources\Deal;

$client = new Client(['baseUrl' => 'https://api.hubapi.com', 'apikey' => 'XXXX-XXXX']);
$deal = new Deal($client);
$dealStatus = new DealStatus();
$dealStatus
    ->setLastModifiedDate(date("Y-m-d"))
    ->setDealStage('stage')
    ->setOrderStatus('order_status'),
    ->setFulfillmentStatus('new');
$dealId = 5026209383;
$properties = [
    'body' => [
        'properties' => [
            'dealstage' => $dealStatus->getDealStage(),
            'order_status' => $dealStatus->getOrderStatus(),
            'unific_fulfillment_status'=> $dealStatus->getFulfillmentStatus(),
            'hs_lastmodifieddate' => $dealStatus->getLastModifiedDate()
        ]
    ]
];
$data = $deal->updateById($dealId, $properties);
```

---

## Runt tests

```bash
./vendor/phpunit/phpunit/phpunit tests/
```


Feel free to fork it or do whatever you want with it.


License: https://creativecommons.org/licenses/by/3.0/
