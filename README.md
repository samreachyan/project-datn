## Installation Document
- Contact [Facebook](https://fb.me/yan.samreach) for installation but try to read guide first.
- Email: samreachyan@gmail.com
- Open repos on [GITHUB](https://github.com/samreachyan/project-datn) 
- **Laravel 8**
- XAMPP (Recommandation)
- If you're on Ubuntu, require (MySql Server, Apache2, Composer 2, install library `vendor` of laravel `compose install`)
- **Internet**: Using reCaptcha v3 and Google API. If it's slow or error something, let's check on  `app\Http\Controllers\Application\AccountController.php` link `151` change `$disableCaptcha = true` to disable this feature (**reCaptcha**).

## Setup environment for laravel on `.env`

  - **APP_URL**= `$domain/ip-khi-chay`
  - **Database**:
        
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=course
        DB_USERNAME=root
        DB_PASSWORD=

  - **OAuth** :
    ---
    **Note for that**

    - Socialite Login, you need to configure with `APP_CALLBACK_URL` with your domain name or locally domain name. 
  
    ---
       - Facebook 

        FACEBOOK_APP_ID=....
        FACEBOOK_APP_SECRET=...
        FACEBOOK_APP_CALLBACK_URL=http://localhost:8000/callback/facebook


       - Google

        GOOGLE_APP_ID=...
        GOOGLE_APP_SECRET=...
        GOOGLE_APP_CALLBACK_URL=http://127.0.0.1:8000/callback/google

       - Github

        GITHUB_APP_ID=...
        GITHUB_APP_SECRET=...
        GITHUB_APP_CALLBACK_URL=http://localhost:8000/callback/github

       - Google Drive Setup
  
        FILESYSTEM_CLOUD=google
        GOOGLE_DRIVE_CLIENT_ID=..
        GOOGLE_DRIVE_CLIENT_SECRET=...
        GOOGLE_DRIVE_REFRESH_TOKEN=...
        GOOGLE_DRIVE_FOLDER_ID=..

        
    - Google Drive API (Get Token of OAuth2.0) checkout this document: [Viblo](https://viblo.asia/p/thao-thac-voi-google-drive-api-gGJ59O4xZX2) or [Github](https://github.com/ivanvermeyen/laravel-google-drive-demo) read how to setup token and root folder on Google drive.
## **Server**

-   Recommand setup running in VirtualHost guide by this [post](https://kipalog.com/posts/Cau-hinh-Virtual-Host-trong-XAMPP). 

-   Start server
    ```console
    php artisan serve
    ```

## **Initial Command**

- Install all package (download libraries):
```console
composer update
```
- Migrate database:
```console
php artisan migrate
```
- Seed database:
```console
php artisan db:seed
```

- Auto create 3 accounts username and password:
```
    - username: admin , password: admin
    - username: teacher , password: teacher
    - usernmae: student , password: student
```
- Start queue service for windows on XAMPP if you're ubuntu don't need:
```console
php artisan queue:work
```
---
**Note**

-  Run Queue while running server `php artisan serve` 
---
- Link public storage to public folder (Mean if you clone project doesn't link public folder yet). So you must link this first.
```console
php artisan storage:link
```

## Report documents
I add some important documents for you to learn and research this project work including Final report, slide, template, usecases image (astah file). Checkout: Report_documents.zip

## Preview project
- Home Page
![Web](https://user-images.githubusercontent.com/32268364/125422632-ce147cea-e664-4829-8454-441607c5374f.png)

- Course Screen
![ViewCourse1](https://user-images.githubusercontent.com/32268364/125422726-7a774e7d-14bc-427d-8236-c5b8f9983f68.png)

- Teacher Screen
![Teacher1](https://user-images.githubusercontent.com/32268364/125422773-29f618c9-e0f2-43c2-a18c-d09f3aa6cb39.png)

- Student Screen
![NewNotification](https://user-images.githubusercontent.com/32268364/125422827-b94dc992-4000-4fa9-bd32-1727aad629e3.png)

- Admin Screen
![adminKhoaHoc](https://user-images.githubusercontent.com/32268364/125422884-8c758851-e0e1-4c63-b759-6b6f5e376336.png)
![adminKhoaHocDetail](https://user-images.githubusercontent.com/32268364/125422906-bbfd3e6d-f893-4175-a282-5a9b82946fef.png)

- API 
![API Login](https://user-images.githubusercontent.com/32268364/125422950-8e42fc76-a94c-45f8-b9eb-a81222aeedb8.png)


## LICENSES

- Licenses for Open Source Development
- You may use free licenses solely for developing non-commercial open source projects.

## Good luck ❤️
