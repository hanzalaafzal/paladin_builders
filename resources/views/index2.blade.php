<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="LUCKYDRAW TICKET">
    <meta name="description" content="Risala Angro Farm Luckydraw ticket">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>Risala Angro Farm - Ticket Purchase</title>
    <link rel="stylesheet" href="{{asset('new/style.css')}}" media="screen">
<link rel="stylesheet" href="{{asset('new/Home.css')}}" media="screen">

    <meta name="generator" content="Risala Angro Farms - Ticket Purchase">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">


    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": ""
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Home">
    <meta property="og:type" content="website">
  </head>
  <body data-home-page="Home.html" data-home-page-title="Home" class="u-body u-xl-mode">
    <section class="u-align-center u-clearfix u-grey-90 u-section-1" id="carousel_ed6d">
      <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-shape u-shape-svg u-text-custom-color-2 u-shape-1">
          <svg class="u-svg-link" preserveAspectRatio="none" viewBox="0 0 160 160" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-a0bf"></use></svg>
          <svg class="u-svg-content" viewBox="0 0 160 160" x="0px" y="0px" id="svg-a0bf" style="enable-background:new 0 0 160 160;"><path d="M80,30c27.6,0,50,22.4,50,50s-22.4,50-50,50s-50-22.4-50-50S52.4,30,80,30 M80,0C35.8,0,0,35.8,0,80s35.8,80,80,80
	s80-35.8,80-80S124.2,0,80,0L80,0z"></path></svg>
        </div>
        <div class="u-shape u-shape-svg u-text-custom-color-2 u-shape-2">
          <svg class="u-svg-link" preserveAspectRatio="none" viewBox="0 0 160 160" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-e858"></use></svg>
          <svg class="u-svg-content" viewBox="0 0 160 160" x="0px" y="0px" id="svg-e858" style="enable-background:new 0 0 160 160;"><path d="M80,30c27.6,0,50,22.4,50,50s-22.4,50-50,50s-50-22.4-50-50S52.4,30,80,30 M80,0C35.8,0,0,35.8,0,80s35.8,80,80,80
	s80-35.8,80-80S124.2,0,80,0L80,0z"></path></svg>
        </div>
        <div class="u-image u-image-circle u-image-1" data-image-width="150" data-image-height="97"></div>
        <div class="u-custom-color-3 u-shape u-shape-circle u-shape-3"></div>
        <img class="u-image u-image-2" src="{{asset('new/images/logo1.png')}}" data-image-width="1018" data-image-height="1096">
        <img class="u-image u-image-round u-radius-10 u-image-3" src="{{asset('new/images/Skype_Picture_2022_04_28T15_14_25_438Z.jpeg')}}" alt="" data-image-width="1280" data-image-height="1261">
        <div class="u-align-left u-container-style u-group u-radius-12 u-shape-round u-white u-group-1" style="z-index:99999">
          <div class="u-container-layout u-container-layout-1">
            <h2 class="u-text u-text-body-color u-text-default u-text-1" style="font-weight:900">GET LUCKYDRAW TICKET</h2>

            <div class="u-form u-form-1">
              @if(session('fail'))
              <h5 style="color:red">{{session('fail')}}</h5>
              @endif
              <form class="u-clearfix u-form-spacing-10 u-form-vertical u-inner-form" method="post" action="{{route('order')}}" name="form-1" style="padding: 10px;" enctype="multipart/form-data">
                @csrf
                <div class="u-form-group u-form-name">
                  <label for="name-a736" class="u-label">Full Name</label>
                  <input type="text" placeholder="Enter Your Full Name" value="{{old('name')}}" id="name-a736" name="name" class="u-custom-color-1 u-input u-input-rectangle u-radius-12" required="">
                  @error('name')
                  <small style="color:red">{{$message}}</small>
                  @enderror
                </div>

                <div class="u-form-group">
                  <label for="email-a736" class="u-label">CNIC</label>
                  <input type="text" placeholder="XXXXX-XXXXXXX-X" id="email-a736" value="{{old('cnic')}}" name="cnic" class="u-custom-color-1 u-input u-input-rectangle u-radius-12" required pattern="^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$" autocomplete="off">
                  @error('cnic')
                  <small style="color:red">{{$message}}</small>
                  @enderror
                </div>
                <div class="u-form-group u-form-group-3">
                  <label for="text-ff4f" class="u-label">Mobile#</label>
                  <input type="text" placeholder="03XXXXXXXXX" id="text-ff4f" name="number" value="{{old('number')}}" class="u-custom-color-1 u-input u-input-rectangle u-radius-12" pattern="^((\+92)|(0092))-{0,1}\d{3}-{0,1}\d{7}$|^\d{11}$|^\d{4}-\d{7}$" required autocomplete="off">
                  @error('number')
                  <small style="color:red">{{$message}}</small>
                  @enderror
                </div>
                <div class="u-form-group u-form-select u-form-group-4">
                  <label for="select-9224" class="u-label">Network Operator</label>
                  <div class="u-form-select-wrapper">
                    <select id="select-9224" name="network" class="u-custom-color-1 u-input u-input-rectangle u-radius-12" required>
                      <option value="">Select Network Operator</option>
                      <option value="Ufone">Ufone</option>
                      <option value="Jazz">Jazz</option>
                      <option value="Warid">Warid</option>
                      <option value="Telenor">Telenor</option>
                      <option value="Zong">Zong</option>
                    </select>
                    @error('network')
                    <small style="color:red">{{$message}}</small>
                    @enderror
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1" class="u-caret"><path fill="currentColor" d="M4 8L0 4h8z"></path></svg>
                  </div>
                </div>
                <div class="u-form-group u-form-radiobutton u-form-group-5">
                  <label for="select-9224" class="u-label">How many tickets you want to purchase ?</label>
                  <select id="select-9224" name="quantity" class="u-custom-color-1 u-input u-input-rectangle u-radius-12" required>

                    <option value="1">1 -/ 1000 Rs</option>
                    <option value="2">2 -/ 2000 Rs</option>
                    <option value="3">3 -/ 3000 Rs</option>
                    <option value="4">4 -/ 4000 Rs</option>
                    <option value="5">5 -/ 5000 Rs</option>
                  </select>
                  @error('quantity')
                  <small style="color:red">{{$message}}</small>
                  @enderror
                </div>
                <div class="u-form-group u-form-radiobutton u-form-group-5">
                  <div class="u-form-radio-button-wrapper">
                    <input type="radio" name="paymentMethod" checked value="IBFT" required>
                    <label class="u-label" for="radiobutton" >IBFT (Direct Bank Transfer)</label>
                    <br>
                    <!-- <input type="radio" name="paymentMethod" value="Online" required disabled>
                    <label class="u-label" for="radiobutton">Online Payment (coming Soon)</label>
                    <br> -->
                  </div>
                  @error('quantity')
                  <small style="color:red">{{$message}}</small>
                  @enderror
                </div>
                <div class="u-form-group u-form-radiobutton u-form-group-5">
                  <div class="u-form-radio-button-wrapper">
                    <input type="file" name="receipt" required id="receipt" required>
                    <label class="u-label">Upload Receipt (IBFT Only)</label>
                    <br>
                    @error('receipt')
                    <small style="color:red">{{$message}}</small>
                    @enderror
                  </div>
                </div>
                <div class="u-form-group u-form-radiobutton u-form-group-5" style="color:green">
                  <label for="select-9224" class="u-label">Bank Details:</label>
                  <br>
                    <small>PALADIN MANAGEMENT SERVICES </small>
                    <br>
                    <small>ACC # 0131-1006695272</small>
                    <br>
                    <small>IBAN# PK70ALFH0131001006695272</small>
                </div>
                <div class="u-form-agree u-form-group u-form-group-6">
                  <input type="checkbox" id="agree-78d0" name="agree" class="u-agree-checkbox" required="">
                  <label for="agree-78d0" class="u-label">I accept the <a href="#">Terms of Service</a>
                  </label>
                </div>
                <div class="u-align-left u-form-group u-form-submit">

                  <input class="u-active-black u-border-none u-btn u-btn-round u-btn-submit u-button-style u-custom-color-2 u-hover-custom-color-3 u-radius-12 u-btn-1" type="submit" value="Submit" class="u-form-control-hidden">
                </div>
                <div class="u-form-send-message u-form-send-success"> Thank you! Your message has been sent. </div>
                <div class="u-form-send-error u-form-send-message"> Unable to send your message. Please fix errors then try again. </div>
                <input type="hidden" value="" name="recaptchaResponse">
              </form>
            </div>
          </div>
        </div>
        <div class="fr-view u-clearfix u-rich-text u-text u-text-2">
          <p>
            <span style="font-size: 1.875rem; font-weight: 700;">WIN</span>
            <span style="font-size: 1.875rem;">&nbsp;</span>
            <span class="u-text-custom-color-5" style="font-size: 2.5rem;">4 KANAL</span>
            <span style="font-size: 1.875rem; font-weight: 700;">PLOT IN JUST Rs.1000</span>
          </p>
        </div>
      </div>
    </section>
  </body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script class="u-script" type="text/javascript" src="{{asset('new/js.js')}}" defer=""></script> -->
<script type="text/javascript">
$('input[type=radio][name=paymentMethod]').change(function() {
  if (this.value == 'IBFT') {
      $('#receipt').attr('required','');
  }
  else  {
      $('#receipt').removeAttr('required');
  }
});
</script>
