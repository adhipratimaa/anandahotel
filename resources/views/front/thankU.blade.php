@extends('layouts.front')
@section('content')
<?php
session()->forget('thankyou');
?>
<div>Thank you</div>
@endsection