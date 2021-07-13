## Installation Document
- Contact [Facebook](https://fb.me/yan.samreach) for installation but try to read guide first.
- Email: samreachyan@gmail.com
- Open repos on [GITHUB](https://github.com/samreachyan/project-datn) 
- **Laravel 8**
- XAMPP (Recommandation)
- If you're on Ubuntu, require (MySql Server, Apache2, Composer 2, install library `vendor` of laravel `compose install`)
- **Internet**: dùng cho dịch vụ reCaptcha v3 và Drive Của Google. Using reCaptcha v3 and Google API. If it's slow or error something, let's check on  `app\Http\Controllers\Application\AccountController.php` link `151` change `$disableCaptcha = true` to disable this feature (**reCaptcha**).

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
        FACEBOOK_APP_CALLBACK_URL=http://vinacourse.com:8000/callback/facebook


       - Google

        GOOGLE_APP_ID=1024311172558-7leink819rgrqhnie3af96v39aum4n8e.apps.googleusercontent.com
        GOOGLE_APP_SECRET=zj4UowfHrki1hWn5PWgTh1hR
        GOOGLE_APP_CALLBACK_URL=http://127.0.0.1:8000/callback/google

       - Github

        GITHUB_APP_ID=...
        GITHUB_APP_SECRET=...
        GITHUB_APP_CALLBACK_URL=http://localhost:8000/callback/github

       - Google Drive Setup
  
        FILESYSTEM_CLOUD=google
        GOOGLE_DRIVE_CLIENT_ID=781710882056-u94tvuhd3pd2i7sk5hucj4fj5cg9q01q.apps.googleusercontent.com
        GOOGLE_DRIVE_CLIENT_SECRET=e6uQZiDvRzXrgWc0l6gD-m2s
        GOOGLE_DRIVE_REFRESH_TOKEN=1//0478Db2aog3x-CgYIARAAGAQSNwF-L9Ir7FuVkG1r5Cvh1zbWLBN3Rvg7GGh7-VYJt3UF_RQBbfhem399W_4T0zh4IK_JNCC2NZE
        GOOGLE_DRIVE_FOLDER_ID=1L3MDJgwZzcSwxgCH7q2k-qZHVl8Su5VM

        
        
    - Google Drive API (Get Token of OAuth2.0) checkout this document: [Viblo](https://viblo.asia/p/thao-thac-voi-google-drive-api-gGJ59O4xZX2) or [Github](https://github.com/ivanvermeyen/laravel-google-drive-demo) read how to setup token and root folder on Google drive.
## **Server**

-   Recommand setup running in VirtualHost guide by this [post](https://kipalog.com/posts/Cau-hinh-Virtual-Host-trong-XAMPP). 

-   Start server
    ```console
    ~$ php artisan serve
    ```

## **Initial Command**

- Install all package (download libraries):
```console
    ~$ composer update
```
- Migrate database:
```console
    ~$ php artisan migrate
```
- Seed database:
```console
    ~$ php artisan db:seed
```
    Auto create 3 accounts username and password :
        - username: admin , password: admin
        - username: teacher , password: teacher
        - usernmae: student , password: student
- Start queue service for windows on XAMPP if you're ubuntu don't need:
```console
    ~$ php artisan queue:work
```
---
**Note**

-  Run Queue while running server `php artisan serve` 
---
- Link public storage to public folder (Mean if you clone project doesn't link public folder yet). So you must link this first.
```console
    ~$ php artisan storage:link
```

## Report documents
I add some important documents for you to learn and research this project work including Final report, slide, template, usecases image (astah file). Checkout: Report_documents.zip

## LICENSES

- Licenses for Open Source Development
- You may use free licenses solely for developing non-commercial open source projects.

## Good luck ❤️
