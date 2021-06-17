## Môi trường cần thiết
- Liên hệ [Facebook](fb.me/yan.samreach) nếu gặp bất cứ lỗi nào :D
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

        FACEBOOK_APP_ID=821354998716469
        FACEBOOK_APP_SECRET=42e8d3c44f7c806244e1d74fa2600c25
        FACEBOOK_APP_CALLBACK_URL=http://vinacourse.com:8000/callback/facebook

       - Google

        GOOGLE_APP_ID=1024311172558-7leink819rgrqhnie3af96v39aum4n8e.apps.googleusercontent.com
        GOOGLE_APP_SECRET=zj4UowfHrki1hWn5PWgTh1hR
        GOOGLE_APP_CALLBACK_URL=http://127.0.0.1:8000/callback/google

       - Github

        GITHUB_APP_ID=8ce4ad9f77d7b4844d88
        GITHUB_APP_SECRET=cadb9e1557480d810b8d7816806ad5a7c68d5b9e
        GITHUB_APP_CALLBACK_URL=http://localhost:8000/callback/github
        
        

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
        - student - student
- Khởi tạo Queue - **Giữ terminal này luôn chạy** *(gửi email và thông báo)* nếu trên ubuntu thì không cần:
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
