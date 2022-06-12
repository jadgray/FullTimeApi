# FullTimeApi

A simple tool to help obtain fixture information from the FA Full-Time system. 

## Requirements
* PHP >= 7.2

## Installation
    composer require jadgray/full-time-api
    
#### Get a team list 

```php
    use Jadgray\FullTimeApi\Division;
    
    $teams = (new Division())->getTeams(1234, '1_234');
```

#### Get unformatted fixtures 

```php
    use Jadgray\FullTimeApi\Division;
    
    $teams = (new Division())->getFixtures(1234, '1_234');
```

#### Get formatted fixtures 

```php
    use Jadgray\FullTimeApi\Division;
    
    $teams = (new Division())->getFormattedFixtures(1234, '1_234');
```

#### Get unformatted results 

```php
    use Jadgray\FullTimeApi\Division;
    
    $teams = (new Division())->getResults(1234, '1_234');
```

#### Get formatted results 

```php
    use Jadgray\FullTimeApi\Division;
    
    $teams = (new Division())->getFormattedResults(1234, '1_234');
```

