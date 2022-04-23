<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript">
      function closethisasap(){
        document.forms["form1"].submit();
      }
    </script>
  </head>

  <body onload="closethisasap();">
    <form name="form1" action="https://ipguat.apps.net.pk/Ecommerce/api/Transaction/PostTransaction" method="POST" enctype="application/x-www-form-urlencoded">
      <input name="MERCHANT_ID" value="{{$data['MERCHANT_ID']}}" hidden="true">
      <input name="MERCHANT_NAME" value="{{$data['MERCHANT_NAME']}}" hidden="true">
      <input name="TOKEN" value="{{$data['TOKEN']}}" hidden="true">
      <input name="PROCCODE" value="{{$data['PROCCODE']}}" hidden="true">
      <input name="TXNAMT" value="{{$data['TXNAMT']}}" hidden="true">
      <input name="CUSTOMER_MOBILE_NO" value="{{$data['CUSTOMER_MOBILE_NO']}}" hidden="true">
      <input name="CUSTOMER_EMAIL_ADDRESS" value="{{$data['CUSTOMER_EMAIL_ADDRESS']}}" hidden="true">
      <input name="SIGNATURE" value="{{$data['SIGNATURE']}}" hidden="true">
      <input name="VERSION" value="{{$data['VERSION']}}" hidden="true">
      <input name="TXNDESC" value="{{$data['TXNDESC']}}" hidden="true">
      <input name="SUCCESS_URL" value="{{$data['SUCCESS_URL']}}" hidden="true">
      <input name="FAILURE_URL" value="{{$data['FAILURE_URL']}}" hidden="true">
      <input name="BASKET_ID" value="{{$data['BASKET_ID']}}" hidden="true">
      <input name="ORDER_DATE" value="{{$data['ORDER_DATE']}}" hidden="true">
      <input name="CHECKOUT_URL" value="{{$data['CHECKOUT_URL']}}" hidden="true">

    </form>
  </body>
</html>
