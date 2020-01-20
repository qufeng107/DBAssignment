<!DOCTYPE html>
<html lang="en" class=" js no-touch">
<head>
  <title>AeroDestiny | When Flying is your Destiny</title>
  <?php
    include("PHP/headStyle.php")
  ?>
  <!-- =======================================================
    Theme Name: Tempo
    Theme URL: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->


<script>
//selects a random quote from the list and outputs it to the text box with id "randomQuote"
function changeText()
{
  var quotes = ['"To most people, the sky is the limit. To those who love aviation, the sky is home." <br> - Jerry Crawford',
  '"The highest art form of all is a human being in control of himself and his airplane in flight, urging the spirit of a machine to match his own." <br> - Richard Bach',
  '“The moment you doubt whether you can fly, you cease forever to be able to do it.” <br> - M. Barrie, Peter Pan',
  '“You haven’t seen a tree until you’ve seen its shadow from the sky.” <br> - Amelia Earhart',
  '“Flying is learning how to throw yours   elf at the ground and miss.” <br> - Douglas Adams',
  '“Aeronautics was neither an industry nor a science. It was a miracle.” <br> - Igor Sikorsky',
  '"Aviation is proof that given, the will, we have the capacity to achieve the impossible." <br> - Rickenbacker, Edward Vernon',
  '“The higher we soar, the smaller we appear to those who cannot fly.” <br> - Anon',
  '“There is no sport equal to that which aviators enjoy while being carried through the air on great white wings.” <br> - Wilbur Wright',
  '“When fears are grounded, dreams take flight”. <br> - Anon',
  '“If you were born without wings, do nothing to prevent them from growing.” <br> - Coco Chanel',
  '"The desire to reach for the sky runs deep in our human psyche." <br> - Cesar Pelli',
  '"My airplane is quiet, and for a moment still an alien, still a stranger to the ground, I am home." <br> - Richard Bach',
  '“I have often said that the lure of flying is the lure of beauty.” <br> - Amelia Earhart',
  '“The way I see it, you can either work for a living or you can fly airplanes. Me, I’d rather fly.” <br> - Len Morgan'];
  document.getElementById('randomQuote').innerHTML = quotes[Math.floor(Math.random() * quotes.length)];
}
</script>
<style>
.Center {
      width:200px;
      height:200px;
      position: relative;
      margin-left: 390px;
  }
</style>

</head>

<body>
  <!--HEADER START-->
  <?php
    include("PHP/header.php")
  ?>
  <!--HEADER END-->

  <!--BANNER START-->
  <div id="banner" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="jumbotron">
          <h1 class="small">Welcome To <span class="bold">AeroDestiny</span></h1>
          <p class="big">A Flight training School.</p>
          <li><a href="#service" class="btn btn-banner">Learn More<i class="fa fa-send"></i></a></li>
        </div>
      </div>
    </div>
  </div>
  <!--BANNER END-->

  <!--SERVICE START-->
  <div id="service" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="page-title text-center">
          <h1><i>"When flying is your destiny"</i></h1>
          <hr class="pg-titl-bdr-btm"></hr>
        </div>
        <div class="col-md-4">
          <div class="service-box">
            <div class="service-icon"><i class="fa fa-diamond"></i></div>
            <div class="service-text">
              <h3>PPL</h3>
              <p> <b> Private Pilot Licenses </b> <br> For clients wishing to fly aircraft up to 5.7 tonnes.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-box">
            <div class="service-icon"><i class="fa fa fa-diamond"></i></div>
            <div class="service-text">
              <h3>CPL</h3>
              <p> <b> Commercial Pilot Licenses </b> <br> For clients wishing to expand their aircraft expertise for commercial purposes.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-box">
            <div class="service-icon"><i class="fa fa-diamond"></i></div>
            <div class="service-text">
              <h3>MCPL</h3>
              <p> <b> Multi-Crew Pilot Licenses </b> <br> For clients wishing to fly a multi-engine aircraft in a co-pilot scenario.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 Center">
          <div class="service-box">
            <div class="service-icon"><i class="fa fa-diamond"></i></div>
            <div class="service-text">
              <h3>ATPL</h3>
              <p style="width:340px;height:400px"> <b> Airline Transport Pilot Licenses </b> <br> For clients wishing to operate transport aircraft on a large scale and wishing to become a flight instructor.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--SERVICE END-->

  <!--CTA2 START-->
  <div class="cta2">
    <div class="container">
      <div class="row white text-center">
        <i>
          <h3 class="wd75 fnt-24" onload="changeText();" id="randomQuote">
            <script> changeText(); </script>
          </h3>
        </i>
        <p class="cta-sub-title"></p>
        <a class="btn btn-default" onclick="changeText()")>Generate inspirational quote</a>
      </div>
    </div>
  </div>
  <!--CTA2 END-->

  <!--TEAM START-->
  <div id="about" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="page-title text-center">
          <h1>People who made this website</h1>
          <hr class="pg-titl-bdr-btm"></hr>
        </div>
        <div>
          <div class="col-md-6">
            <div class="team-info">
              <div class="img-sec">
                <img src="php/img/3.png" class="img-responsive">
              </div>
              <div class="fig-caption">
                <h3>Patryk Jakubek</h3>
                <p class="marb-20">Sr. UI Designer</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="team-info">
              <div class="img-sec">
                <img src="php/img/1.png" class="img-responsive">
              </div>
              <div class="fig-caption">
                <h3>Roman Brodskiy</h3>
                <p class="marb-20">Sr. Database Manager</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="team-info">
              <div class="img-sec">
                <img src="php/img/2.png" class="img-responsive">
              </div>
              <div class="fig-caption">
                <h3>Feng QU</h3>
                <p class="marb-20">UI Designer</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="team-info">
              <div class="img-sec">
                <img src="php/img/4.png" class="img-responsive">
              </div>
              <div class="fig-caption">
                <h3>Haonan Zeng</h3>
                <p class="marb-20">UI Designer</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="team-info">
              <div class="img-sec">
                <img src="php/img/6.png" class="img-responsive">
              </div>
              <div class="fig-caption">
                <h3>Gordon Petrie</h3>
                <p class="marb-20">Manual Designer</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="team-info">
              <div class="img-sec">
                <img src="php/img/5.png" class="img-responsive">
              </div>
              <div class="fig-caption">
                <h3>Adithya Menon</h3>
                <p class="marb-20">Sr. Streetlamp</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--TEAM END-->

  <!--CONTACT START-->
  <div id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="page-title text-center">
          <h1>Quick Contact</h1>
          <hr class="pg-titl-bdr-btm"></hr>
        </div>
        <div id="sendmessage">Your message has been sent. Thank you!</div>
        <div id="errormessage"></div>

        <div class="form-sec">
          <form action="" method="post" role="form" class="contactForm">
            <div class="col-md-4 form-group">
              <input type="text" name="name" class="form-control text-field-box" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
              <div class="validation"></div>
            </div>
            <div class="col-md-4 form-group">
              <input type="email" class="form-control text-field-box" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
              <div class="validation"></div>
            </div>
            <div class="col-md-4 form-group">
              <input type="text" class="form-control text-field-box" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
            <div class="col-md-12 form-group">
              <textarea class="form-control text-field-box" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
              <button class="button-medium" id="contact-submit" type="submit" name="contact" onclick="alert('Message Submitted! \nOne of the team will reply to you within 5 business days.')">Submit Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--CONTACT END-->

  <!--FOOTER START-->
  <?php
    readfile("PHP/footer.html")
  ?>
  <script src="PHP/js/jquery.min.js"></script>
  <script src="PHP/js/jquery.easing.min.js"></script>
  <script src="PHP/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="PHP/js/slick.min.js"></script>
  <script type="text/javascript" src="PHP/js/custom.js"></script>
  <script src="contactform/contactform.js"></script>

</body>

</html>
