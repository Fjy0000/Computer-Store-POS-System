# Project Name : Computer Store POS System

- Contribution & Handle: Fong Jun Yi (Admin Side) , Ng Zheng Yi (Customer Side)

- Description:
The POS system is a solution designed for retail businesses to help them smoothly transition from physical stores to online stores. The system has a minimalist design and an easy-to-use user interface, allowing merchants to easily manage sales, inventory, and customer information. The system is able to generate sales reports, track inventory levels, and seamlessly manage inventory across multiple stores.

- Purpose:
The purpose of the POS system is to simplify user operation processes, optimize inventory management, and provide business owners with detailed data on sales and customer behavior, thereby improving operational efficiency and decision-making capabilities.

## Table of Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Run&Test](#runtest)

## Installation

Before configuration, make sure you have the following dependencies installed:

- **[Xampp](https://www.apachefriends.org/download.html)** (version 7.4.29 and above)
- **[Apache Netbeans](https://netbeans.apache.org/front/main/download/nb22/)** (version NetBeans-19 and above)

## Configuration

1. Setup Database:
- start xampp control panel.
- Click on the 'Start' buttons for Apache and MySQL services.
- Click on the 'Admin' buttons for MySQL.
- Go to the "Import" tab in the top menu.
- Click the "Choose File" button to select the .sql file (fyp_database.sql).
- Ensure the "Format" is set to SQL (this should be automatic).
- Click "Go" to start the import process.
- Setup Database Completed.

2. Setup Sendmail:
- Follow the link to setup : (https://youtu.be/TvaKz3wwvWY?si=hlbMqCK7PJvd12xy)
- Open administration > Select resetPassword.php > Search Line 30 > Enter "From: [your email address]"

3. Rename Download FileName:
- Make sure the file name is "Computer-Store-POS-System"

## Run&Test

Copy this link and run : http://localhost/Computer-Store-POS-System/administration/login_staff.php
