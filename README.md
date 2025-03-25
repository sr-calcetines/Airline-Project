#  🛫 Pepe's Airline 🛬

## :bulb:Project proposal

The project aims to develop a management system for an airline. This system will allow the comprehensive management of users, flights, reservations and destinations, with advanced functionalities such as secure authentication through JWT, automatic management of flights without available seats or that have exceeded the deadline.

### Requirements:

- Min **70%** of **test coverage**. 
- **Jira** should be used for **epic, user stories and tasks**.
- **ALL** functionality must exist in **API REST** and verified by Postman.
- On the **flight list sheet** with the **date organized** from closest to furthest but only those available on another screen are the **past flights**, including the **total seats** on the plane and the **seats still free**.
- In blade the **reserve button** to reserve and **cancel** when it is reserved.
- The **administrator cannot** make **reservations**.
***
### ☁️ Flights table 🗺️

This is the table for **Flights**. It should:

- Display all **flights** *(Blade and Json)*.
- Allow to **insert, modify or delete** a flight only for the admin *(Endpoints and blade)*.
- Let user watch the **show** of a flight *(Endpoints and Blade)*.
- The flight has a **date, a place of departure, an arrival place, an assigned plane and reserved seats.
- **Automatically change the status** of the available flight to "false" when the flight *runs out* of available seats or is out of date.

***
### ✈️ Planes table 🛩️

This is the table for **Planes**. It should:

- Display all **planes** *(Blade and Json)*.
- Allow to **insert, modify or delete** a plane only for the admin *(Endpoints and blade)*.
- Let user watch the **show** of plane *(Endpoints and Blade)*.
- Planes have a **name, and the maximum number of seats**
  
***
### 💺 PIVOT table (Reserve) 🧳

- **Create flight reservations** only if the **selected route exists** and if there are **seats available** and the **date** has not passed.
- You can only make **one reservation per flight** if you have booked it, you can only cancel it.
- If there is **no reservation**, the option to **reserve must appear**.
- Only a **User can reserve**, the **Guest can only view**.
- **Availability check** before confirming a reservation.

***
## 👁️ Project overview
| Role       | Available Views |
|------------|-----------------|
| Guest 🗣️   | <a href="https://github.com/user-attachments/assets/7487b342-f190-46bb-945a-d7d370250ea8"><img src="https://github.com/user-attachments/assets/7487b342-f190-46bb-945a-d7d370250ea8" width="80"></a> <a href="https://github.com/user-attachments/assets/1ec36da2-b04a-4356-99ea-21c00f9030b0"><img src="https://github.com/user-attachments/assets/1ec36da2-b04a-4356-99ea-21c00f9030b0" width="80"></a> <a href="https://github.com/user-attachments/assets/29e20242-cf2e-4cf8-bf96-55b8e3df28e6"><img src="https://github.com/user-attachments/assets/29e20242-cf2e-4cf8-bf96-55b8e3df28e6" width="80"></a> |
| User 👤    | <a href="https://github.com/user-attachments/assets/fdd2f2bb-100b-406c-b458-5163e0e4000a"><img src="https://github.com/user-attachments/assets/fdd2f2bb-100b-406c-b458-5163e0e4000a" width="80"></a> <a href="https://github.com/user-attachments/assets/52000c78-cbf1-4860-8880-6fef724de747"><img src="https://github.com/user-attachments/assets/52000c78-cbf1-4860-8880-6fef724de747" width="80"></a> <a href="https://github.com/user-attachments/assets/1a1dbfd7-a851-49e0-b6f8-611f2d74c2dd"><img src="https://github.com/user-attachments/assets/1a1dbfd7-a851-49e0-b6f8-611f2d74c2dd" width="80"></a> <a href="https://github.com/user-attachments/assets/18698570-f5a1-461a-a4ea-401d67620ffa"><img src="https://github.com/user-attachments/assets/18698570-f5a1-461a-a4ea-401d67620ffa" width="80"></a> |
| Admin 🛡️  | <a href="https://github.com/user-attachments/assets/afdd61c3-b161-4ce3-9e2d-52df39bac2b8"><img src="https://github.com/user-attachments/assets/afdd61c3-b161-4ce3-9e2d-52df39bac2b8" width="80"></a> <a href="https://github.com/user-attachments/assets/bbff95b5-d04b-4f74-8c67-ccbcc575ec46"><img src="https://github.com/user-attachments/assets/bbff95b5-d04b-4f74-8c67-ccbcc575ec46" width="80"></a> <a href="https://github.com/user-attachments/assets/ae39936a-b1a1-4369-9308-013903d48f7e"><img src="https://github.com/user-attachments/assets/ae39936a-b1a1-4369-9308-013903d48f7e" width="80"></a> <a href="https://github.com/user-attachments/assets/8281dbee-9431-4447-b949-d9e255635bef"><img src="https://github.com/user-attachments/assets/8281dbee-9431-4447-b949-d9e255635bef" width="80"></a> <a href="https://github.com/user-attachments/assets/cfba0c70-0c2e-4a22-8ff1-20e1474496be"><img src="https://github.com/user-attachments/assets/cfba0c70-0c2e-4a22-8ff1-20e1474496be" width="80"></a> <a href="https://github.com/user-attachments/assets/7b58e0ef-3a2d-4d37-a052-a7f02f39ba47"><img src="https://github.com/user-attachments/assets/7b58e0ef-3a2d-4d37-a052-a7f02f39ba47" width="80"></a> <a href="https://github.com/user-attachments/assets/89be2666-50ef-4602-b96b-feb203fda6a9"><img src="https://github.com/user-attachments/assets/89be2666-50ef-4602-b96b-feb203fda6a9" width="80"></a> <a href="https://github.com/user-attachments/assets/4f83e207-a297-4353-83ac-1b14f3e8e1e6"><img src="https://github.com/user-attachments/assets/4f83e207-a297-4353-83ac-1b14f3e8e1e6" width="80"></a> <a href="https://github.com/user-attachments/assets/84cefb0c-50c5-47bf-be16-7a8d6be24c99"><img src="https://github.com/user-attachments/assets/84cefb0c-50c5-47bf-be16-7a8d6be24c99" width="80"></a> |


***
### Project Diagrams (BBDD)

![BBDD Diagram](https://github.com/user-attachments/assets/9d7a6b76-b274-4939-b884-a30f12cbe410)


***
## :scroll: Installation

1.) **Clone** this repository:
```
https://github.com/sr-calcetines/Airline-Project.git
```

***
2.) Install **Composer** and **NPM**
```
composer install
```
```
npm install
```

***
3.) **Create** a *.env* file copying everything inside the existing file *.env.example* and **modify** the following **lines**:
* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=airline
* DB_USERNAME=root
* DB_PASSWORD=

***
4.) Create a **database** in **MySQL**

***
5.) Now go to the **VSC terminal** and put the following commands:
```
php artisan migrate:fresh 
php artisan migrate:fresh --seed
```
This command will **generate** all the **tables**.

***
6.) Open another terminal in **VSC** and put the following command
```
npm run dev
```

***
7.) Open **another terminal** and **run** the **server** with this command:
```
php artisan serve
```
You'll see an **url** that is going to take you to a website.

>[!IMPORTANT]
>Be sure that your running npm and the server in **DIFFERENT** terminals, **DON'T** close these two terminals and **DON'T** use other commands in these two terminals.

***
### :floppy_disk: Installation requirements
Before you start to read how to install the project you'll need these requirements:
>[!NOTE]
>If you can't install xampp, look for any other local server that supports **MySQL** and **PHP**
***

:black_circle: **XAMPP**

:black_circle: Install **Composer**

:black_circle: Install **NPM** in **Node.js**

:black_circle: **Xdebug** (for the tests coverage)

:black_circle: **Postman**

***
## :mag_right:Documentation

### Endpoints
***
#### 🗺️ Flights table
✏️ Create (POST)
`http://127.0.0.1:8000/api/flights/store`

📖 Read (GET)
`http://127.0.0.1:8000/api/flights`

💱 Update (PUT)
`http://127.0.0.1:8000/api/flights/update/{id}`

❌ Destroy (DELETE)
`http://127.0.0.1:8000/api/flights/destroy/{id}`

👁️ Show (GET)
`http://127.0.0.1:8000/api/flights/show/{id}`
***
#### ✈️ Planes table
✏️ Create (POST)
`http://127.0.0.1:8000/api/planes/store`

📖 Read (GET)
`http://127.0.0.1:8000/api/planes`

💱 Update (PUT)
`http://127.0.0.1:8000/api/planes/update/{id}`

❌ Destroy (DELETE)
`http://127.0.0.1:8000/api/planes/destroy/{id}`

👁️ Show (GET)
`http://127.0.0.1:8000/api/planes/show{id}`

***
#### 🧳Uses Table
📝 User Register (POST)
`http://127.0.0.1:8000/api/auth/register`

✅ User Login (POST)
`http://127.0.0.1:8000/api/auth/login`

❌ User Logout (POST)
`http://127.0.0.1:8000/api/auth/logout`

🔄 User Refresh (POST)
`http://127.0.0.1:8000/api/auth/refresh`

🧑 User Me (POST)
`http://127.0.0.1:8000/api/auth/me`

***
## :white_check_mark: Tests

> [!IMPORTANT]
> It's important to test the project so we can check if it works correctly and to do that use this command in the **VSC** terminal:

```
php artisan test --coverage
```
![Feature test](https://github.com/user-attachments/assets/06121d77-fe04-4aac-bb44-a269bb1d4ba1)


***
### Coverage

To see the **coverage** you can use this command at the **VSC** terminal:
```
php artisan test --coverage-html=coverage-report
```
> [!IMPORTANT]
> Everytime that you do **new tests** you need to put the command above in the **VSC** terminal, so it can **update** your coverage.
This will add a **folder** called *coverage-report*, go to the folder, go to the *index.html*, and then **open with live server**. After that you should see this page:

![coverage-report](https://github.com/user-attachments/assets/ef2fedc1-9d14-47d4-8905-95a5e9363d37)


***
## Languages and tools
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='PHP' src='https://img.shields.io/badge/PHP-100000?style=for-the-badge&logo=PHP&logoColor=white&labelColor=896696&color=896696'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='html5' src='https://img.shields.io/badge/html-100000?style=for-the-badge&logo=html5&logoColor=white&labelColor=FF8400&color=FF8400'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='css3' src='https://img.shields.io/badge/css-100000?style=for-the-badge&logo=css3&logoColor=white&labelColor=079FB0&color=079FB0'/></a>
<a href='https://laravel.com' target="_blank"><img alt='Laravel' src='https://camo.githubusercontent.com/e410fca6849c63adce18d5744836c71a5772b86384130c28c9369df68921e7c0/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f6c61726176656c2d3130303030303f7374796c653d666f722d7468652d6261646765266c6f676f3d6c61726176656c266c6f676f436f6c6f723d464646464646266c6162656c436f6c6f723d36363041304126636f6c6f723d363630413041'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='mysql' src='https://img.shields.io/badge/mysql-100000?style=for-the-badge&logo=mysql&logoColor=white&labelColor=1C662F&color=1C662F'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='git' src='https://img.shields.io/badge/git-100000?style=for-the-badge&logo=git&logoColor=white&labelColor=FF0000&color=FF0000'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='github' src='https://img.shields.io/badge/github-100000?style=for-the-badge&logo=github&logoColor=white&labelColor=000000&color=000000'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='canva' src='https://img.shields.io/badge/canva-100000?style=for-the-badge&logo=canva&logoColor=white&labelColor=A700FB&color=A700FB'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='xampp' src='https://img.shields.io/badge/xampp-100000?style=for-the-badge&logo=xampp&logoColor=white&labelColor=FF8800&color=FF8800'/></a>
<a href='https://github.com/shivamkapasia0' target="_blank"><img alt='postman' src='https://img.shields.io/badge/postman-100000?style=for-the-badge&logo=postman&logoColor=white&labelColor=FF0000&color=FF0000'/></a>

***
## 👩‍💻 About me  
DAW graduate, im a developer enhancing my skills through a bootcamp focused on frontend, backend, and AWS.
- [José Ignacio Gavilán Sánchez](https://github.com/sr-calcetines)
  

