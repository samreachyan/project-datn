## Môi trường cần thiết
- Liên hệ [Facebook](fb.me/SownBanana) nếu gặp bất cứ lỗi nào :D
- **Laravel 8.17.2**
- XAMPP (khuyên dùng :D)
- **Internet**: dùng cho dịch vụ reCaptcha v3 và Drive Của Google. Nếu có chậm/lỗi phần đăng nhập _(mấy hôm nay google hay trục trặc)_, comment code ở `app\Http\Controllers\Application\AccountController.php` dòng `151` đặt `$disableCaptcha = true` để disable **reCaptcha**.

## Cấu hình file `.env`

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
    **Chú ý**

    - Domain đang chạy phải giống với domain *_APP_CALLBACK_URL mới có thể dùng được OAuth.
    - Có thể tự tạo OAuth và sửa các thông tin dưới đây.

    ---
       - Facebook 

        FACEBOOK_APP_ID = 431362884691933
        FACEBOOK_APP_SECRET = 605093749703e62024a8485ced5fa200
        FACEBOOK_APP_CALLBACK_URL = http://localhost:8000/callback/facebook
       
       - Google

        GOOGLE_APP_ID = 781710882056-u94tvuhd3pd2i7sk5hucj4fj5cg9q01q.apps.googleusercontent.com
        GOOGLE_APP_SECRET = e6uQZiDvRzXrgWc0l6gD-m2s
        GOOGLE_APP_CALLBACK_URL = http://localhost:8000/callback/google

       - Github

        GITHUB_APP_ID = 399b355ec5ff8bb9f68e
        GITHUB_APP_SECRET = cc6bf8c71aee1b9577ea0f90729d9b698854d6bf
        GITHUB_APP_CALLBACK_URL = http://vinacourse.local/callback/github
        

## **Server**

-   Khuyên dùng XAMPP cấu hình Virtual Host theo [Hướng dẫn](https://kipalog.com/posts/Cau-hinh-Virtual-Host-trong-XAMPP). (Chạy localhost có thể không load được resourse)
-   Có thể chạy PHP built-in server *(Load trang siêu chậm vì không lưu cache)* bằng lệnh:
    ```console
    ~$ php artisan serve
    ```

## **Initial Command**

- Cài các package cần thiết:
```console
    ~$ composer update
```
- Migrate database *(tạo cơ sở dữ liệu)*:
```console
    ~$ php artisan migrate
```
- Khởi tạo dữ liệu ban đầu: 
```console
    ~$ php artisan db:seed
```
    Sinh ra 3 tài khoản có username và password là:
        - admin - admin
        - teacher - teacher
        - student -student
- Khởi tạo Queue - **Giữ terminal này luôn chạy** *(gửi email và thông báo)*:
```console
    ~$ php artisan queue:work
```
---
**Lưu ý**

-  Giữ Queue luôn chạy cùng server *(Điều quan trọng phải nhắc lại 2 lần :D)*
---
- Link thư mục lưu trữ đến public:
```console
    ~$ php artisan storage:link
```