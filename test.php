mcamara laravel localization => to change lang

request->validate([
'email' => [ 'required', 'email', Rule::unique('admins', 'email'), Rule::unique('customers', 'email') ]
]);

<a href="javascript:void(0)" 
    onclick="if(confirm('Do You Want To Logout')){document.getElementById('form-logout').submit()} return false;"
    class="auth-button signup"> {{ __('words.logout') }} </a>


عايزين نعمل صفحة الادمن يدخل فيها رسالة تتبعت اشعار لمستخدمين بيحددهم هوا