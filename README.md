# Sprite Country

A labyrinthine gallery work in progress. The site uses CSV files as data storage to set up a series of 'trails'.

Each trail contains a series of images and texts, intended to be navigated sequentially rather than freely browsed.

The overall aims for the project are:

* to provide a customised gallery site that fits a very basic personal need
* offer a really simple way to browse text and images - one-click, on-rails navigation
* have some fun coding

## Setup

### Dependencies

* Sorry, this guide doesn't currently cover webserver setup, but you'll need Apache at the moment, to use the .htaccess file.
* [Install composer](https://www.hostinger.com/tutorials/how-to-install-composer) and run `composer install` from inside `httpdocs/.inc`
* Data files, as described below.

### Data

The site runs off CSV files for data, and needs image files if you're showing images, obviously.

CSV files:

* httpdocs/data/trails.csv
* httpdocs/data/trail_entries.csv

(Sample CSV files to come)

Image files for each trail should be stored in their own directory:

* httpdocs/data/img/<trail_code>
