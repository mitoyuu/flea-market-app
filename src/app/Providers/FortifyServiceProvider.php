<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth; // ログインエラー表示させるために追記
use Illuminate\Validation\ValidationException; // ログインエラー表示させるために追記
use App\Http\Requests\LoginRequest; // ログインエラー表示させるために追記2
use Laravel\Fortify\Contracts\LoginResponse; // ログインエラー表示させるために追記2
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Http\Responses\LoginResponse as CustomLoginResponse;
use App\Http\Responses\RegisterResponse as CustomRegisterResponse;



class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);
        $this->app->singleton(RegisterResponse::class, CustomRegisterResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::loginView(function () {
            return view('auth.login');
        });

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

        return Limit::perMinute(10)->by($email . $request->ip());

        });

        $this->app->bind(FortifyLoginRequest::class, LoginRequest::class);

        // // 新規登録 ※Response クラスに引っ越し済み
        // Fortify::registerResponse(function () {
        //     // 登録直後は必ずプロフィール設定へ
        //     return redirect('/mypage/profile');
        // });

        // Fortify::loginResponse(function (Request $request) {

        //     $user = $request->user();

        //     // プロフィール未設定なら設定画面へ
        //     if (
        //         !$user->post_code ||
        //         !$user->address
        //     ) {
        //         return redirect('/mypage/profile');
        //     }

        //     // 設定済みなら商品一覧
        //     return redirect('/');
        // });

        // 2026/01/26 ログインエラー表示させるために下記追記
        // 訳：ログイン時のやり方は、これにして
        // Fortify::authenticateUsing(function (LoginRequest $request) {

        //     // ① ここでFormRequestのバリデーション実行
        //     $request->validated();

        //     $credentials = $request->only('email', 'password');


            // // 訳：このメールとパスワードでログイン試す
            // if (! Auth::attempt($credentials)) {
            //     // 訳：失敗したら、エラーとして画面に返す
            //     throw ValidationException::withMessages([
            //         'password' => 'ログイン情報が登録されていません',
            //     ]);
            // }

            // return Auth::user();
        }
}
