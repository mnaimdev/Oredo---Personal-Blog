<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FacebookLoginController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GithubLoginController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\GuestRegisterController;
use App\Http\Controllers\GuestPassResetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Frontend
Route::get('/', [FrontendController::class, 'welcome'])->name('welcome');
Route::get('/category/post/{category_id}', [FrontendController::class, 'category_post'])->name('category.post');
Route::get('/author/post/{author_id}', [FrontendController::class, 'author_post'])->name('author.post');
Route::get('/author/list/', [FrontendController::class, 'author_list'])->name('author.list');
Route::get('/post/details/{slug}', [FrontendController::class, 'post_details'])->name('post.details');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');

Route::post('/subscribe/store', [FrontendController::class, 'subscribe_store'])->name('subscribe.store');
Route::post('/contact/store', [FrontendController::class, 'contact_store'])->name('contact.store');

// Guest
Route::get('/guest/register', [GuestRegisterController::class, 'guest_register'])->name('guest.register');
Route::post('/guest/register/store', [GuestRegisterController::class, 'guest_register_store'])->name('guest.register.store');

Route::get('/guest/login', [GuestRegisterController::class, 'guest_login'])->name('guest.login');
Route::post('/guest/login/request', [GuestRegisterController::class, 'guest_login_request'])->name('guest.login.req');
Route::get('/guest/logout', [GuestRegisterController::class, 'guest_logout'])->name('guest.logout');
Route::get('/guest/profile', [GuestRegisterController::class, 'guest_profile'])->name('guest.profile');
Route::post('/guest/profile/update', [GuestRegisterController::class, 'guest_profile_update'])->name('guest.profile.update');

// Github Login
Route::get('/github/redirect', [GithubLoginController::class, 'redirect_provider'])->name('github.login');
Route::get('/github/callback', [GithubLoginController::class, 'provider_to_application']);

// Facebook Login
Route::get('/facebook/redirect', [FacebookLoginController::class, 'redirect_provider'])->name('facebook.login');
Route::post('/facebook/callback', [FacebookLoginController::class, 'provider_to_application']);

// Google Login
Route::get('/google/redirect', [GoogleLoginController::class, 'redirect_provider'])->name('google.login');
Route::get('/google/callback', [GoogleLoginController::class, 'provider_to_application']);

// Guest Password Reset
Route::get('/guest/pass/reset/req', [GuestPassResetController::class, 'guest_pass_reset_req'])->name('guest.pass.reset.req');
Route::post('/guest/pass/reset/req/send', [GuestPassResetController::class, 'guest_pass_reset_req_send'])->name('guest.pass.reset.req.send');

Route::get('/guest/pass/reset/req/form/{token}', [GuestPassResetController::class, 'guest_pass_reset_req_form'])->name('guest.pass.reset.req.form');
Route::post('/guest/pass/reset/', [GuestPassResetController::class, 'guest_pass_reset'])->name('guest.pass.reset');

// Guest Mail Verify
Route::get('/verify/mail/confirm/{token}', [GuestRegisterController::class, 'verify_mail_confirm'])->name('verify.mail.confirm');
Route::get('/mail/verify/req', [GuestRegisterController::class, 'mail_verify_req'])->name('mail.verify.req');
Route::post('/mail/verify/again', [GuestRegisterController::class, 'mail_verify_again'])->name('mail.verify.again');

// User
Route::get('/users', [UserController::class, 'users'])->name('user');
Route::get('/user/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete');
Route::get('/edit/profile', [UserController::class, 'edit_profile'])->name('edit.profile');
Route::post('/update/profile', [UserController::class, 'update_profile'])->name('update.profile');
Route::post('/update/photo', [UserController::class, 'update_photo'])->name('update.photo');
Route::post('/users/delete/check', [UserController::class, 'delete_check'])->name('delete.check');


// Trash
Route::get('/trash', [UserController::class, 'trash'])->name('trash');
Route::get('/trash/delete/{user_id}', [UserController::class, 'trash_delete'])->name('trash.delete');
Route::get('/trash/restore/{user_id}', [UserController::class, 'trash_restore'])->name('trash.restore');
Route::post('/user/all', [UserController::class, 'user_all'])->name('user.all');

// Category
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');
Route::get('/category/delete/{category_id}', [CategoryController::class, 'category_delete'])->name('category.delete');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');
Route::post('/category/update', [CategoryController::class, 'category_update'])->name('category.update');

// Tag
Route::get('/tag', [TagController::class, 'tag'])->name('tag');
Route::post('/tag/store', [TagController::class, 'tag_store'])->name('tag.store');

// Role Management
Route::get('/role', [RoleController::class, 'role'])->name('role');
Route::post('/permission/store', [RoleController::class, 'permission_store'])->name('permission.store');
Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store');
Route::post('/assign/role', [RoleController::class, 'assign_role'])->name('assign.role');
Route::get('/delete/user/role/{user_id}', [RoleController::class, 'delete_user_role'])->name('delete.user.role');
Route::get('/edit/user/role/{user_id}', [RoleController::class, 'edit_user_role'])->name('edit.user.role');
Route::post('/edit/permission', [RoleController::class, 'edit_permission'])->name('edit.permission');

// Post
Route::get('/add/post', [PostController::class, 'add_post'])->name('add.post');
Route::post('/post/store', [PostController::class, 'post_store'])->name('post.store');
Route::get('/show/post', [PostController::class, 'show_post'])->name('show.post');
Route::get('/post/view/{post_id}', [PostController::class, 'post_view'])->name('post.view');
Route::get('/post/delete/{post_id}', [PostController::class, 'post_delete'])->name('post.delete');
Route::get('/post/edit/{post_id}', [PostController::class, 'post_edit'])->name('post.edit');
Route::post('/post/edit/store', [PostController::class, 'post_edit_store'])->name('post.edit.store');


// Subscribe
Route::get('/message/list', [SubscribeController::class, 'message_list'])->name('message.list');
Route::get('/subscription/list', [SubscribeController::class, 'subscription_list'])->name('subscription.list');

// Comments
Route::post('/comment/store', [CommentController::class, 'comment_store'])->name('comment.store');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
