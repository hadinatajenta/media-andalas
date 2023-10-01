@component('mail::message')
# Selamat datang, {{ $user->name }}

Anda telah ditambahkan sebagai author baru di website kami.
Berikut adalah informasi akun anda:
    Email : {{ $user->email }}
    Password : {{ $user->password }}

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
