Here is the adapted README for your Laravel package, customized with your GitHub profile information:

---

# Laravel Nida

Unofficial Laravel package for fetching user information based on National ID Number made by [emilkitua](https://github.com/emilkitua/)

[![Releases](https://badgen.net/github/releases/emilkitua/laravel-nida)](https://github.com/emilkitua/laravel-nida/releases)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

## Installation

You can install the package via Composer:

```bash
composer require emilkitua/laravel-nida
```

## Usage

To fetch user information based on ID number, do this:

```php
use EmilKitua\Nida\Nida;

$nida = app(Nida::class);
$userDetail = $nida->loadUser('XXXXXXXXX');
print_r($userDetail);
```

The output will be similar to:

```php
[
    'Nin' => 'XXXXXX',
    'Firstname' => 'XXXXXX',
    'Middlename' => 'XXXXXX',
    'Surname' => 'XXXXXX',
    'Othernames' => 'XXXXXX',
    'Sex' => 'XXXXXX',
    'Dateofbirth' => 'XXXXXX',
    'Residentregion' => 'XXXXXX',
    'Residentdistrict' => 'XXXXXX',
    'Residentward' => 'XXXXXX',
    'Residentvillage' => 'XXXXXX',
    'Residentstreet' => 'XXXXXX',
    'Residentpostcode' => 'XXXXXX',
    'Permanentregion' => 'XXXXXX',
    'Permanentdistrict' => 'XXXXXX',
    'Permanentward' => 'XXXXXX',
    'Permanentvillage' => 'XXXXXX',
    'Permanentstreet' => 'XXXXXX',
    'Birthcountry' => 'XXXXXX',
    'Birthregion' => 'XXXXXX',
    'Birthdistrict' => 'XXXXXX',
    'Birthward' => 'XXXXXX',
    'Nationality' => 'XXXXXX',
    'Phonenumber' => 'XXXXXX',
    'Maritalstatus' => 'XXXXXX',
    'Occupation' => 'XXXXXX',
    'Primaryschooleducation' => 'XXXXXX',
    'Primaryschooldistrict' => 'XXXXXX',
    'Primaryschoolyear' => 'XXXXXX',
    'Photo' => 'XXXXXX',
    'Signature' => 'XXXXXX',
    'Nationalidnumber' => 'XXXXXX',
    'Lastname' => 'XXXXXX'
]
```

You can access user information by using keys and attributes just as shown below:

```php
echo $userDetail['Firstname']; // 'XXXXXX'
echo $userDetail->get('Middlename'); // 'XXXXXX'
echo $userDetail->Lastname; // 'XXXXXX'
```

## Image and Signature Support

National ID Photo and Signature are auto-converted into PHP image resources, and you can easily save them:

```php
imagepng($userDetail['Photo'], 'National_ID.png');
imagepng($userDetail['Signature'], 'Signature.png');
```

If you want the data to be in the same format as the API without any side-effect preprocessing, do this instead while loading the user:

```php
$userDetail = $nida->loadUser('xxxxxxxxxx', true);
print_r($userDetail);
```

## Give it a Star

Did you find this repository useful? Give it a star so more people can discover it!

## Issues

Facing any issues with the package? Raise an issue on the [GitHub repository](https://github.com/emilkitua/laravel-nida/issues) and I will look into fixing it as soon as possible.

## Contributions

Contributions are welcome! If there's anything you'd like to add, fork the repository and submit a pull request.

## Disclaimers

This is not an official package. Therefore, I am not responsible for any misinformation or misuse of the package of any kind!

## Credits

All the credits to [Kalebu](https://github.com/Kalebu/) for the python package that I replicated to create this