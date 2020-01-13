<h1>Activate your account!</h1>
<p>Hi {{ $user->name }}</p>
<p></p>
<a href="{{ url('/admin/activate-account/' . $user->token) }}">Click to activate your account.</a>
