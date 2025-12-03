
@extends('layouts.app')
@section('title')
@section('container')
@include('miuser.alertas.sweetalert')
@include('miuser.form.changePassword')

@include('miuser.form.cargar_imagen')

   



<script>
    function togglePassword(id) {
        var passwordField = document.getElementById(id);
        var eyeIcon = document.getElementById('eye-icon-' + id);
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>


@endsection