# ltw-project-g26
![Logo](logo-default-176x45.png)

Project description for the 2020 edition of the Web Languages and Technologies course.

* [Objective](#Objective)
* [Usage](#Usage)
* [Elements](#Elements)
* [Credentials](#Credentials)
* [Libraries](#Libraries)
* [Features](#Features)

## OBJECTIVE

Create a website where users can list rescue pets for adoption and/or offer them a forever home . To create this application, students should:

Create a sqlite database where information about users and pets is stored.
Create documents using HTML and CSS that represent the web pages of the application.
Use PHP to generate those web pages after retrieving/changing data from the database.
Use Javascript to enhance the user experience (for example using Ajax).


## USAGE
*SQLite implementation:* 
* sqlite3 store.db < database.sql
* php -S localhost:4000

---

### REQUIREMENTS

*The minimum expected requirements are the following:*

####  All users should be able to (users can simultaneously be looking for a pet, or have a pet for a adoption):
  * Register a new account.
  * Login and logout.
  * Edit their profile (username and password at least).

#### Users that found a pet and are looking for someone to adopt it should be able to:
  * Add information about the pet. Including name (if any), species (e.g., dog, cat), size, color, photos, location, …
  * Manage previous postings.
  * List any questions, inquiries, and adoption proposals.
  * Accept or refuse adoption proposals.
#### Users looking for a pet should be able to:
  * Search for a pet using several search criteria.
  * Add pets to a favourites list.
  * Ask questions about a pet listed for adoption.
  * Propose to adopt a pet and list previous proposals.

*Extra requirements:*
  * Animal shelters should also be able to register as users.
  * Shelters have a dedicated page with all dogs available for adoption.
  * Users can be collaborators of a certain shelter and have permission to edit information about the shelter and any pets for adoption.
  * Create a more robust workflow for pet adoption.
  * Pets can be in several states (being prepared for adoption, prepared, proposal accepted, delivered, …).
  * Think about how pets can move from one state to another (maybe using a state diagram).
  * Users that adopt a pet should be able to still post photos of that animal after the adoption.
  * Users should receive a notification anytime something important happens (e.g., a new pet matching a saved query, a new adoption proposal, …).
  * Develop a REST API that allows bots or other apps to use the website.

---
### Elements:
 - Tiago Filipe Lima Rocha (201406679) 

### Credentials (username/password (role))
- Create a user using the register page
- Login to account to access all site functionalitites
- manel@feup.pt / 123123 (user)
- maria@feup.pt / 123123 (user)

### Libraries:
- Swiper Slider (https://swiperjs.com/)
- Owl Carousel (https://owlcarousel2.github.io/OwlCarousel2/)
- Google maps Javascript API (https://developers.google.com/maps)


### Features:
 - Security
    - XSS: yes
    - CSRF: yes
    - SQL using prepare/execute: yes
    - Passwords: SHA2 hash (password_hash PHP)
    - Data Validation: regex, php, html
 - Technologies
    - Separated logic/database/presentation: yes
    - Semantic HTML tags: yes
    - Responsive CSS: yes (Desktop, Laptop, Tablet, Smartphone)
    - Javascript: yes
    - Ajax: yes
    - REST API: yes (using ES6 FETCH API)
    - Cross Browser: yes (extra feature - Chrome, Safari, Edge, Opera, < IE8)
    - SEO: yes (extra feature)
    - Fast Performance: yes (extra feature) 
    - MySQL support: yes (extra feature)
    - SQLite support: yes
 - Usability:
    - Error/success messages: yes
    - Forms don't lose data on error: yes
    - PHP pagination: yes
    - Filters results by animal type: yes
    - User control panel: yes 
    - User panel has profile info: yes
    - User panel has put for adoption form: yes
    - User panel has edit profile form: yes (ajax), 
    - User Panel has message section: yes (displays incoming message, and allows for message response)
    - User Panel has adoption request section: yes (displays requests, and allows for request response)
    - User Panel has register lost pet: yes (extra feature)
    - Edit user Profile: yes
    - Put new pet for adoption: yes (pet has a lot of information put in by the user - image, description, weight, age, etc)
    - Ask pet for adoption with message text: yes
    - Respond to adoption request: yes
    - Automatic results update on adoption: yes (only shows non-adopted pets)
    - Ask pet for adoption: yes
    - Respond to adoption request: yes
    - Search for pet with filters (age group, type, breed, gender): yes
    - Lost and found section: yes (onclick event on a pet listed here fires a mailto: to the person who posted the entry)
    - Send message to pet owner: yes
    - Respond to messages: yes
    - Add to favorites: yes
  - Testing:
    - Black box testing: yes
    - Backend testing: yes
    - Ad-hoc testing: yes
    - Alpha testing: yes
    - Browser compatibility testing: yes
    - Performance testing: yes 