# Kuttit Bot

**Kuttit Bot** is a Telegram Bot URL shortner with php.

*Contributions and bug reports are welcome.*

## Table of Contents
* [Introduce Features](#intoduce-features)
* [Requirements](#requirements)
* [Setup](#setup)
* [Usage](#usage)

## Introduce Features
Here is a brief introduction to bot's features.
### Users
//user gif
### SuperAdmin
//superadmin gif
### Admins
//admin gif

## Requirements
* PHP   v7.1
* MySQL v5.7

*Tip: I use phpmyadmin to manage database.*

## Setup
1. Clone this repository.
2. Make a new Database and use `database-structure.sql` file to generate the tables.
3. Make a new Telegram bot with [BotFather](https://t.me/botfather) and copy your bot API Key.
4. Register in [Kutt Website](https://kutt.it) and copy your API key.
5. In Telegram, Use [User info bot](https://t.me/userinfobot) to get your telegram ID.
6. Edit `config.php` file
//config.png
    * Complete Database Section with your information
    * Compelete API Section with `Step 3 &4` Information (API Key).
    * Complete Admin Section with `Step 5` Information (Telegram ID).
    * Save `config.php` file.
 7. Uploade whole project folder to your server / host.
 8. Set Telegram Webhook with this format:
 `https://api.telegram.org/bot<TOKEN>/setwebhook?url=path/to/project/kutt.php`
*Tip: You must open this url in your browser.*
## Usage
| Command | Description |
| --- | --- |
| `/start` | Start the bot |
| `/admin` | Show SuperAdmin or Admins panel |

## ToDo List
- [ ] Add User Keyboard to change language & change user table in database
- [ ] Add User change language system
- [ ] And more... 