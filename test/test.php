<?php
/**
 * Created by PhpStorm
 * User: hejinlong
 * Date: 2020/11/26
 * Time: 1:45 PM
 */

require '../vendor/autoload.php';
$mapper = new JsonMapper();

$json = '{"name":"Sheldon Cooper","address":{"street":"2311 N. Los Robles Avenue","city":"Pasadena"}}';

class Contact
{
    public $name;

    /**
     * @var Address
     */
    public $address;
}

class Address
{
    public $street;
    public $city;

    public function getGeoCoords()
    {
        return array(
            'lat' => "1111",
            'lon' => "2222"
        );
    }
}

$json = json_decode($json);
$mapper = new JsonMapper();
$contact = $mapper->map($json, new Contact());
$coords = $contact->address->getGeoCoords();

echo $contact->name . ' lives at coordinates ' . $coords['lat'] . ',' . $coords['lon'] . "\n";
