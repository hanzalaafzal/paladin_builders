<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Winner</title>
    <style media="screen">
    body {


      color: rgba(0, 0, 0, 0.6);
      font-family: "Roboto", sans-serif;
      font-size: 14px;
      line-height: 1.7em;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      }


      ::-moz-selection {
      background: #E84F89;
      }

      ::selection {

      }

      @keyframes confetti-slow {
        0% {
          transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
        }
        100% {
          transform: translate3d(25px, 105vh, 0) rotateX(360deg) rotateY(180deg);
        }
      }
      @keyframes confetti-medium {
        0% {
          transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
        }
        100% {
          transform: translate3d(100px, 105vh, 0) rotateX(100deg) rotateY(360deg);
        }
      }
      @keyframes confetti-fast {
        0% {
          transform: translate3d(0, 0, 0) rotateX(0) rotateY(0);
        }
        100% {
          transform: translate3d(-50px, 105vh, 0) rotateX(10deg) rotateY(250deg);
        }
      }
      .container {
        width: 100vw;
        height: 100vh;
        background: #ffffff;
        border: 1px solid white;
        display: fixed;
        top: 0px;
      }

      .confetti-container {
        perspective: 700px;
        position: absolute;
        overflow: hidden;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
      }

      .confetti {
        position: absolute;
        z-index: 1;
        top: -10px;
        border-radius: 0%;
      }
      .confetti--animation-slow {
        animation: confetti-slow 2.25s linear 1 forwards;
      }
      .confetti--animation-medium {
        animation: confetti-medium 1.75s linear 1 forwards;
      }
      .confetti--animation-fast {
        animation: confetti-fast 1.25s linear 1 forwards;
      }


      @-webkit-keyframes checkmark {
        0% {
          height: 0;
          width: 0;
          opacity: 1;
        }
        20% {
          height: 0;
          width: 37.5px;
          opacity: 1;
        }
        40% {
          height: 75px;
          width: 37.5px;
          opacity: 1;
        }
        100% {
          height: 75px;
          width: 37.5px;
          opacity: 1;
        }
      }
      @-moz-keyframes checkmark {
        0% {
          height: 0;
          width: 0;
          opacity: 1;
        }
        20% {
          height: 0;
          width: 37.5px;
          opacity: 1;
        }
        40% {
          height: 75px;
          width: 37.5px;
          opacity: 1;
        }
        100% {
          height: 75px;
          width: 37.5px;
          opacity: 1;
        }
      }
      @keyframes checkmark {
        0% {
          height: 0;
          width: 0;
          opacity: 1;
        }
        20% {
          height: 0;
          width: 37.5px;
          opacity: 1;
        }
        40% {
          height: 75px;
          width: 37.5px;
          opacity: 1;
        }
        100% {
          height: 75px;
          width: 37.5px;
          opacity: 1;
        }
      }
      .submit-btn {
        height: 45px;
        width: 200px;
        font-size: 15px;
        background-color: #00c09d;
        border: 1px solid #00ab8c;
        color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px 0 rgba(87, 71, 81, 0.2);
        cursor: pointer;
        transition: all 2s ease-out;
        transition: all 0.2s ease-out;
      }

      .submit-btn:hover {
        background-color: #2ca893;
        transition: all 0.2s ease-out;
      }

      .modal {
        top:200px;
      z-index: 1000;
      position: relative;
      background: #FFF;
      max-width: 530px;
      border-radius: 6px;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
      box-sizing: border-box;
      margin: 0 auto;
      padding: 40px 60px 0;
      overflow: hidden;
      transform-style: preserve-3d;
      perspective: 100;
      }
      .modal.toggled {
      -webkit-animation: flip 3s ease;
              animation: flip 3s ease;
      }

      .trophy {
      display: block;
      margin: 0 auto 40px;
      }

      h1 {
      display: block;
      margin: 0 0 20px;
      color: rgba(0, 0, 0, 0.8);
      font-size: 24px;
      font-weight: 400;
      text-align: center;
      }

      p {
      margin: 0 0 40px;
      padding: 0 60px;
      font-size: 18px;
      text-align: center;
      }

      button {
      outline: 0;
      background: linear-gradient(#5388C5, #2A78DD);
      width: 35%;
      border: 0;
      border-radius: 100px;
      box-shadow: 0 5px 10px rgba(42, 120, 221, 0.3);
      margin: 0 15px;
      padding: 15px;
      box-sizing: border-box;
      color: #FFF;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      }
      button:last-child {
      background: linear-gradient(#54CE42, #1FCD37);
      box-shadow: 0 5px 10px rgba(31, 205, 55, 0.3);
      }

      footer {
      background: #FFF;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.06);
      margin: 0 -60px;
      padding: 30px 0;
      text-align: center;
      }

      #myVideo {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 90%;
      min-height: 90%;
      z-index:-1;
      }
    </style>
  </head>
  <video autoplay muted loop id="myVideo">
    <source src="{{asset('event/vid.mp4')}}" type="video/mp4">
  </video>
  <body>

    <div class="js-container" style="width:100%;height:100%">
        <div class="modal">
          <img class="trophy" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/Screenshot_2015-10-11_21.43.12.png"/>
          <h1>Congratulations</h1>
          <p>You have won 2 Kanal Commercial Plot</p>
          <p>You have won the </p>

        </div>
    </div>
  </body>

  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

<script type="text/javascript">
var video = document.getElementById("myVideo");



// Pause and play the video, and change the button text
function myFunction() {
  if (video.paused) {
    video.play();
    btn.innerHTML = "Pause";
  } else {
    video.pause();
    btn.innerHTML = "Play";
  }
}
</script>

  <script type="text/javascript">
  // Based off of http://stackoverflow.com/questions/16322869/trying-to-create-a-confetti-effect-in-html5-how-do-i-get-a-different-fill-color
// and http://codepen.io/linrock/pen/Amdhr
// Based off of http://stackoverflow.com/questions/16322869/trying-to-create-a-confetti-effect-in-html5-how-do-i-get-a-different-fill-color
// and http://codepen.io/linrock/pen/Amdhr
const Confettiful = function (el) {
  this.el = el;
  this.containerEl = null;

  this.confettiFrequency = 3;
  this.confettiColors = ['#EF2964', '#00C09D', '#2D87B0', '#48485E', '#EFFF1D'];
  this.confettiAnimations = ['slow', 'medium', 'fast'];

  this._setupElements();
  this._renderConfetti();
};

Confettiful.prototype._setupElements = function () {
  const containerEl = document.createElement('div');
  const elPosition = this.el.style.position;

  if (elPosition !== 'relative' || elPosition !== 'absolute') {
    this.el.style.position = 'relative';
  }

  containerEl.classList.add('confetti-container');

  this.el.appendChild(containerEl);

  this.containerEl = containerEl;
};

Confettiful.prototype._renderConfetti = function () {
  this.confettiInterval = setInterval(() => {
    const confettiEl = document.createElement('div');
    const confettiSize = Math.floor(Math.random() * 3) + 7 + 'px';
    const confettiBackground = this.confettiColors[Math.floor(Math.random() * this.confettiColors.length)];
    const confettiLeft = Math.floor(Math.random() * this.el.offsetWidth) + 'px';
    const confettiAnimation = this.confettiAnimations[Math.floor(Math.random() * this.confettiAnimations.length)];

    confettiEl.classList.add('confetti', 'confetti--animation-' + confettiAnimation);
    confettiEl.style.left = confettiLeft;
    confettiEl.style.width = confettiSize;
    confettiEl.style.height = confettiSize;
    confettiEl.style.backgroundColor = confettiBackground;

    confettiEl.removeTimeout = setTimeout(function () {
      confettiEl.parentNode.removeChild(confettiEl);
    }, 3000);

    this.containerEl.appendChild(confettiEl);
  }, 25);
};

window.confettiful = new Confettiful(document.querySelector('.js-container'));
  </script>
</html>
