<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<title>eMading</title>
<!--
Snapshot Template
http://www.templatemo.com/tm-493-snapshot

Zoom Slider
https://vegas.jaysalvat.com/

Caption Hover Effects
http://tympanus.net/codrops/2013/06/18/caption-hover-effects/
-->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
  	<link rel="stylesheet" href="css/component.css">
	
    <link rel="stylesheet" href="css/owl.theme.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/vegas.min.css">
	<link rel="stylesheet" href="css/style.css">

	<!-- Google web font  -->
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300' rel='stylesheet' type='text/css'>
	
</head>
<body id="top" data-spy="scroll" data-offset="50" data-target=".navbar-collapse">


<!-- Preloader section -->

<div class="preloader">
     <div class="sk-spinner sk-spinner-pulse"></div>
</div>


<!-- Navigation section  -->

  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">

      <div class="navbar-header">
        <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon icon-bar"></span>
          <span class="icon icon-bar"></span>
          <span class="icon icon-bar"></span>
        </button>
        <a href="#top">
            <img src="images/logo1.png" alt="Logo" class="responsive-logo">
        </a>        
      </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            @guest
              <li><a href="#top" class="smoothScroll"><span>Home</span></a></li>
              <li><a href="#about" class="smoothScroll"><span>About</span></a></li>
              <li><a href="#gallery" class="smoothScroll"><span>Feature</span></a></li>
            @else
              <li><a href="#top" class="smoothScroll"><span>Home</span></a></li>
              <li><a href="#about" class="smoothScroll"><span>About</span></a></li>
              <li><a href="#gallery" class="smoothScroll"><span>Feature</span></a></li>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" class="smoothScroll" href="#about" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hello, 
                      {{ Auth::user()->username }}
                  </a>
              </li>
                <li><a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    >Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </li>
            @endguest
          </ul>
       </div>

    </div>
  </div>


<!-- Home section -->

<section id="home">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">

      <div class="col-md-offset-1 col-md-10 col-sm-12 wow fadeInUp" data-wow-delay="0.3s">
        <h1 class="wow fadeInUp" data-wow-delay="0.6s">Welcome to e-Mading!</h1>
        <p class="wow fadeInUp" data-wow-delay="0.9s">Discover, share and celebrate limitless creativity. eMading is an innovative platform where everyone can add unique works they have created and explore various amazing works from the creative community, eMading provides a space to share inspiration and get feedback. <br> Come on, be creative and collaborate on eMading!</p>
        <a href="{{route('login')}}" class="smoothScroll btn btn-success btn-lg wow fadeInUp" data-wow-delay="1.2s">Start!</a>
      </div>

    </div>
  </div>
</section>


<!-- About section -->

<section id="about">
  <div class="container">
    <div class="row">

      <div class="col-md-9 col-sm-8 wow fadeInUp" data-wow-delay="0.2s">
        <div class="about-thumb">
          <h1>Background</h1>
          <p>eMading or electronic Mading, aims to accommodate the work of students at SMK Negeri 11 Malang
            which will be displayed online and can be accessed not only by residents in the school area and
            parents, but with a wider network. As well as providing convenience for students
            the process of collecting the results of his work. There is no need to meet physically with the teacher
            responsible with advertising, saving costs and time efficiency.</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-4 wow fadeInUp about-img" data-wow-delay="0.6s">
        <img src="images/about-img.jpg" class="img-responsive img-circle" alt="About">
      </div>

      <div class="clearfix"></div>

    </div>
  </div>
</section>


<!-- Gallery section -->

<section id="gallery">
  <div class="container">
    <div class="row">

      <div class="col-md-offset-2 col-md-8 col-sm-12 wow fadeInUp" data-wow-delay="0.3s">
        <div class="section-title">
          <h1>Main Features</h1>
        </div>
      </div>

      <ul class="grid cs-style-4">
        <li class="col-md-6 col-sm-6">
          <figure>
            <div><img src="images/gallery-img1.jpg" alt="image 1"></div>
            <figcaption>
              <h1>Add Art</h1>
              <small>Users can upload and display their work, be it information/news, creative videos,
                poetry and posters.</small>
              <a href="{{route('login')}}">Lets Try</a>
            </figcaption>
          </figure>
        </li>

        <li class="col-md-6 col-sm-6">
          <figure>
            <div><img src="images/gallery-img2.jpg" alt="image 2"></div>
            <figcaption>
              <h1>Art Gallery</h1>
              <small>Provides an attractive gallery view to explore works from other users.</small>
              <a href="{{route('login')}}">Lets Try</a>
            </figcaption>
          </figure>
        </li>

        <li class="col-md-6 col-sm-6">
          <figure>
            <div><img src="images/gallery-img3.jpg" alt="image 3"></div>
            <figcaption>
              <h1>Art Category</h1>
              <small>Makes it easy for users to search and group works by categories, such as information/news, creative videos,
                poetry and posters.</small>
              <a href="{{route('login')}}">Lets Try</a>
            </figcaption>
          </figure>
        </li>

        <li class="col-md-6 col-sm-6">
          <figure>
            <div><img src="images/gallery-img4.jpg" alt="image 4"></div>
            <figcaption>
              <h1>Comments and Feedback</h1>
              <small>Users can provide comments and suggestions on uploaded works, creating interaction and discussion.</small>
              <a href="{{route('login')}}">Lets Try</a>
            </figcaption>
          </figure>
        </li>
      </ul>

    </div>
  </div>
</section>


<!-- Footer section -->

<footer>
    <br><br><br><br>
	<div class="container">
    
		<div class="row">

			<div class="col-md-12 col-sm-12">
            
                <ul class="social-icon"> 
                    <li><a href="#" class="fa fa-facebook wow fadeInUp" data-wow-delay="0.2s"></a></li>
                    <li><a href="#" class="fa fa-twitter wow fadeInUp" data-wow-delay="0.4s"></a></li>
                    <li><a href="#" class="fa fa-linkedin wow fadeInUp" data-wow-delay="0.6s"></a></li>
                    <li><a href="#" class="fa fa-instagram wow fadeInUp" data-wow-delay="0.8s"></a></li>
                    <li><a href="#" class="fa fa-google-plus wow fadeInUp" data-wow-delay="1.0s"></a></li>
                </ul>

				<p class="wow fadeInUp"  data-wow-delay="1s" >Created by @Erwinson S. Siboro | 
                XII RPL 1</p>
                
			</div>
			
		</div>
        
	</div>
</footer>

<!-- Back top -->
<a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>

<!-- Javascript  -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/vegas.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/toucheffects.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>