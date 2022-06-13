# FullTimeApi
[![PHP Unit Tests](https://github.com/jadgray/FullTimeApi/actions/workflows/phpunit.yml/badge.svg)](https://github.com/jadgray/FullTimeApi/actions/workflows/phpunit.yml)

A simple tool to help obtain fixture information from the FA Full-Time system. 

## Requirements
* PHP >= 7.2

## Installation
    composer require jadgray/full-time-api
    
#### Basic information needed for a request

To obtain information from the Full-Time system you will need a Season ID and Group ID, these can be obtained by visiting your desired division you'd like to access and extracting these from the URL.

e.g. **selectedSeason=1234** & **FixtureGroupKey=1_234**
    
#### Get a team list 

```php
    use Jadgray\FullTimeApi\Division;
    
    $teams = (new Division())->getTeams(1234, '1_234');
```
[Example output](https://github.com/jadgray/FullTimeApi/blob/main/tests/Divsion/TeamTest.php#L41-L55)

#### Get unformatted fixtures 

```php
    use Jadgray\FullTimeApi\Division;
    
    $fixtures = (new Division())->getFixtures(1234, '1_234');
```

[Example output](https://github.com/jadgray/FullTimeApi/blob/main/tests/DataFormatters/FixtureFormatterTest.php#L26-L66)

#### Get formatted fixtures 

```php
    use Jadgray\FullTimeApi\Division;
    
    $fixtures = (new Division())->getFormattedFixtures(1234, '1_234');
```
[Example output](https://github.com/jadgray/FullTimeApi/blob/main/tests/DataFormatters/FixtureFormatterTest.php#L71-L96)

#### Get unformatted results 

```php
    use Jadgray\FullTimeApi\Division;
    
    $results = (new Division())->getResults(1234, '1_234');
```
[Example output](https://github.com/jadgray/FullTimeApi/blob/main/tests/DataFormatters/ResultFormatterTest.php#L26-L35)

#### Get formatted results 

```php
    use Jadgray\FullTimeApi\Division;
    
    $results = (new Division())->getFormattedResults(1234, '1_234');
```
[Example output](https://github.com/jadgray/FullTimeApi/blob/main/tests/DataFormatters/ResultFormatterTest.php#L40-L89)
