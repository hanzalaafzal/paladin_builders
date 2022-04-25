<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ticket Purchase</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/main.css')}}">

  <style media="screen">


      img {
      max-width: 100%;
      height: auto;
      }

      .ticket {
      width: 400px;
      height: 775px;
      background-color: white;
      margin: 25px auto;
      position: relative;
      }

      .holes-top {
      height: 50px;
      width: 50px;
      background-color:#e9b8dc;
      border-radius: 50%;
      position: absolute;
      left: 50%;
      margin-left: -25px;
      top: -25px;
      }
      .holes-top:before, .holes-top:after {
      content: "";
      height: 50px;
      width: 50px;
      background-color: #e9b8dc;
      position: absolute;
      border-radius: 50%;
      }
      .holes-top:before {
      left: -200px;
      }
      .holes-top:after {
      left: 200px;
      }

      .holes-lower {
      position: relative;
      margin: 25px;
      border: 1px dashed #aaa;
      }
      .holes-lower:before, .holes-lower:after {
      content: "";
      height: 50px;
      width: 50px;
      background-color:#e9b8dc;
      position: absolute;
      border-radius: 50%;
      }
      .holes-lower:before {
      top: -25px;
      left: -50px;
      }
      .holes-lower:after {
      top: -25px;
      left: 350px;
      }

      .title {
      padding: 50px 25px 10px;
      }

      .cinema {
      color: #aaa;
      font-size: 22px;
      }

      .movie-title {
      font-size: 50px;
      }

      .info {
      padding: 15px 25px;
      }

      table {
      width: 100%;
      font-size: 18px;

      }
      table tr {

      }
      table th {
      text-align: left;
      }
      table th:nth-of-type(1) {
      width: 38%;
      }
      table th:nth-of-type(2) {
      width: 40%;
      }
      table th:nth-of-type(3) {
      width: 15%;
      }
      table td {
      width: 33%;
      font-size: 32px;
      }

      .bigger {
      font-size: 48px;
      }

      .serial {
      padding: 25px;
      }
      .serial table {
      border-collapse: collapse;
      margin: 0 auto;
      }
      .serial td {
      width: 3px;
      height: 50px;
      }

      .numbers td {
      font-size: 16px;
      text-align: center;
      }
  </style>
<!--===============================================================================================-->
</head>
<body style="background-color: #999999;">

	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('{{asset('frontend/images/bg-01.jpg')}}');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50" style="background-color:#e9b8dc">
        <!--
Inspired by: https://dribbble.com/shots/1166639-Movie-Ticket/attachments/152161
-->

        <div class="ticket" style="">
            	<div class="holes-top"></div>
            	<div class="title">
            		<p class="cinema">ODEON CINEMA PRESENTS</p>
            		<p class="movie-title">ONLY GOD FORGIVES</p>
            	</div>
            	<div class="poster">
            		<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/25240/only-god-forgives.jpg" alt="Movie: Only God Forgives" />
            	</div>
            	<div class="info">
            	<table>
            		<tr>
            			<th>SCREEN</th>
            			<th>ROW</th>
            			<th>SEAT</th>
            		</tr>
            		<tr>
            			<td class="bigger">18</td>
            			<td class="bigger">H</td>
            			<td class="bigger">24</td>
            		</tr>
            	</table>
            	<table>
            		<tr>
            			<th>PRICE</th>
            			<th>DATE</th>
            			<th>TIME</th>
            		</tr>
            		<tr>
            			<td>$12.00</td>
            			<td>1/13/17</td>
            			<td>19:30</td>
            		</tr>
            	</table>
            	</div>
            	<div class="holes-lower" style="margin:4px 0px 0px 23px"></div>

            </div>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="{{asset('frontend/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('frontend/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('frontend/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('frontend/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('frontend/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('frontend/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('frontend/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('frontend/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('frontend/js/main.js')}}"></script>

</body>
</html>
