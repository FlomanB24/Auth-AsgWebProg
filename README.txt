Nama: Gabriel Rolly davinsi
NIM: 2440071582

Guide Instalasi Project

1. Instal laravel: composer create-project laravel/laravel nama-project
2. Membuat view (resources -> view)
	- membuat layouts.main dan menambahkan @yield
	- membuat page berdasarkan kebutuhan dengan blade.php dan menambahkan di setiap halaman @extends, @section... @endsection
	- design halaman (css, uiverse.io)
	- halaman yang dibuat adalah halaman admin, general, login dan register
3. Membuat route (routes -> web) untuk login, register, general dan admin
4. Membuat controller untuk mengatur jalannya route ketika login, register dan masuk ke page general dan admin baik menggunakan email dan password atau menggunakan media sosial. Media sosial yang digunakan adalah akun google dan github
5. Controller yang dibuat yakni: authcontroller (bertugas juga sebagai controller untuk login), registercontroller, githubcontroller, dan googlecontroller.
6. Agar bisa menggunakan media sosial gmail dan github untuk loggin maka saya menggunakan library yang disediakan oleh laravel yakni socialite. 
7. Agar fungsi tersebut bisa berjalan maka yang harus dilakukan adalah menginstal fitur tersbeut di dalam project laravel dengan perintah sebagai berikut: composer require laravel/socialite
8. Selanjutnya, harus mengintegrasikan google dan github dengan project yang dibuat dengan menggunakan client-id, client-secret, dan client-redirect. 
9. Baik client-id, client-secret, dan client-redirect ditambahkan ke dalam file .env pada project laravel dengan format:
	*Google:
		GOOGLE_CLIENT_ID
		GOOGLE_CLIENT_SECRET
		GOOGLE_CLIENT_REDIRECT

	*Github:
		GITHUB_CLIENT_ID
		GITHUB_CLIENT_SECRET
		GITHUB_CLIENT_REDIRECT

10. Setelah menambahkan client-id, client-secret, dan client-redirec pada file .env, tahap selanjutnya adalah mengintegrasikan dengan project dengan cara
memasukannya di dalam variabel aray yang dibuat pada service.php yang ada folder config (di bawah folder app dan boostrap) dengan format: 
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_CLIENT_REDIRECT')
    ],

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => env('GITHUB_CLIENT_REDIRECT')
    ]
12. Agar fungsi tersebut bisa berjalan maka harus ditambahkan juga route dan controllernya:
	*Route:
		Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google-login');
		Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google-callback');

		Route::get('/auth/github', [GithubController::class, 'redirectToGithub'])->name('github-login');
		Route::get('/auth/github/callback', [GithubController::class, 'handleGithubCallback'])->name('github-callback');

	*Googlecontroller dan Githubcontroller (function pada route harus dibuat pada controller google dan githubu yakni):
		'redirectToGoogle', 'handleGoogleCallback', 'redirectToGithub', 'handleGithubCallback'.
13. 'redirectToGoogle', 'redirectToGithub'untuk mengarahkan user setalah klik tombol sign in dengan media sosial diarahkan ke pilihan untuk masuk dengan media sosial tersebut.
14. 'handleGoogleCallback', 'handleGithubCallback' function ini berfungsi untuk menambahkan user ke dalam database ketika login dengan media sosial dan sekaligus masuk ke halaman tertentu di dalam aplikasi. 
14. Berikutnya adalah membuat authentikasi dan authorization: fungsi ini dibuat untuk menjaga aplikasi dari penggunaan yang salah sehingga tidak semua pengguna dapat mengakses dengan salah.
15. Selain itu untuk membatasi akses bagi setiap pengguna, misalkan pada halaman mana user dapat mengaksesnya dan pada halaman apa hanya admin yang boleh mengaksesnya.
16. Role ini dibuat dengan menggunakan fungsi middleware. 
17. Oleh karena itu tahap selanjutnya adalah membuat middlware checkauth dan checkuserlogin. Dengan perintah: php artisan make:middleware nama-middleware
18. middleware checkauth untuk membatas penggunaan halaman antara user umum dan admin. middleware checkuserlogin untuk mengatur agar yang berhak untuk mengaskses halaman hanyalah user yang telah melakukan login dan register.
19. Fungsi middleware ini nantinya ditambahkan pada setiap route yang ada pada routes->web:
	Route::get('/general', function () {
    		return view('general');
	})->name('general')->middleware([CheckUserLogin::class]);

	Route::get('/admin', function () {
  	  return view('admin');
	})->name('admin')->middleware([CheckUserLogin::class])->middleware([CheckAuth::class]);
`	
20. untuk bisa mendapatkan clientid dan clientserver serta membuat client-redirect
	untuk Google bisa dengan mengakses: console.developer.google.com
	caranya:
		1) membuka console.developer.google.com
		2) create project
		3) klik project yang sudah dibuat
		4) create OAuth consent screen 
			- masukan app name
			- user support email
			- email address (developer contact information
			- save and continue untuk semua tahap
		5) create credential
			- choose application type
			- masukan nama aplikasi 
			- tambahkan URLs (http://localhost:8000) karena menggunakan artisan.	
			- tambahkan URLs untukredirect/callback
			- klik create
			- muncul popup clientid dan clientsecret
			- copy dan masukan ke file .env

	Github:
		1. Masuk ke dalam akun github anda
		2. Pilih setting pada menu dropdown 
		3. Klik menu <>Developer settings
		4. Pilih OAuth Apps
		5. Klik New OAuth App
		6. Masukan application name, homepage url, dan authorization callback url
		7. Register application
		8. Github akan mengeluarkan clientid dan clientsecret.

	