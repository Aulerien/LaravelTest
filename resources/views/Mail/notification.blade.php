<?php
/**
 * Created by PhpStorm.
 * User: Aulerien
 * Date: 06/11/2018
 * Time: 10:22
 */ ?>

        <!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>

<style>
    .police1
    {
        font-size:15px;
        font-family: Andale Mono, monospace;
    }
</style>

<body>
<div style="text-align:center">

    <h2 style="color:#ec407a ">Message envoyer avec LARAVEL depuis JTEK-SOLUTIONS</h2>
</div>
<span class="police1">  Ceci est un e-mail de test, merci d'apporter vos modifications. <br/></span>
<br/>

Mail du correspondant : {{ $name }}<br/>


<br/>
Message :

{{ $content }}

<br/><br/><br/>


</body>
</html>
