@extends("navbarmodel.navbar")
@section("title", "")
@section("content")

<section class="showcase-area" id="showcase">
	<div class="showcase-container">
		<h6 class="main-title" id="home">AEMTechnology School Center</h6>
		<p style="font-size:40px;color:black;font-weight:bold">Où la technologie rencontre l’excellence.</p>
		<a href="#exploration" class="btn btn-primary">EXPLORER</a>
	</div>
</section>
<header>

	<div class="container">
		<nav class="flex items-centre justify-between">
			<div class="left flex justfiy-right">
				<!--
                <div class="logo"> <img src="{{asset ('logo.png')}}" width="50px" alt="logo"> </div>
                <div> <a href="#">Dashboard</a> <a href="#">About</a> <a href="#">Services</a> <a href="#">Blog</a></li>
                    <a href="#">More</a>
                </div>
            </div>
            <div class="right"> <button class="btn btn-primary">Contact</button> </div>
        </nav>
    </div>
-->


<h7 id="about"></h7>
				<div class="hero flex items-centre justify-between">
					<div class="left flex-1 justify-center">
						<img src="{{asset('img/batimentsco.jpeg')}}" />
					</div>
					<div class="right flex-1">
						<h6>AEMTechnology School Center</h6>
						<h1>
							Nous sommes</br>
							<span>Une ecole de technologie et de TIC</span>
						</h1>
						<p>

						</p>
						<div><button class="btn btn-secondary">Lire plus...</button></div>


					</div>
				</div>
</header>
<section id="exploration"></section>
<!-- Start Menu -->
<div class="menu-box">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="heading-title text-center">
					<h2>Nos Formations</h2>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="special-menu text-center">
					<div class="button-group filter-button-group">
						<button class="active" data-filter="*">Tout</button>
						<button data-filter=".drinks">LICENCE</button>
						<button data-filter=".lunch">MASTER</button>

					</div>
				</div>
			</div>
		</div>

		<div class="row special-list">
			<div class="col-lg-4 col-md-6 special-grid drinks">
				<div class="gallery-single fix">
					<img src="{{asset('img/adminres1.jpg')}}" class="img-fluid" alt="Image" style="height: 15rem;">
					<div class="why-text">
						<h4>ADMINISTRATION RESEAUX</br>
							Debouchés</br>
							- Administrateur reseaux</br>
							- Administrateur des systemes informatiques
						</h4>
						<p></p>
						<h5> </br>


						</h5>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 special-grid drinks">
				<div class="gallery-single fix">
					<img src="{{asset('img/bigdata.jpeg')}}" class="img-fluid" alt="Image" style="height: 15rem;">
					<div class="why-text">
						<h4>BIG DATA</br>
							Debouchés</br>
							- Data Scientist</br>
							- Data Scientist
						</h4>
						<p></p>
						<h5></h5>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 special-grid drinks">
				<div class="gallery-single fix">
					<img src="{{asset('img/graphisme.jpeg')}}" class="img-fluid" alt="Image" style="height: 15rem;">
					<div class="why-text">
						<h4>GRAPHISME</br>
							Debouchés</br>
							- Graphiste</br>
							- Expert graphiste
						</h4>
						<p></p>
						<h5> </h5>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 special-grid lunch">
				<div class="gallery-single fix">
					<img src="{{asset('img/webdesign.jpeg')}}" class="img-fluid" alt="Image" style="height: 15rem;">
					<div class="why-text">
						<h4>UI DESIGN</br>
							Debouchés</br>
							- Expert WEB designer</br>

						</h4>
						<p></p>
						<h5> </h5>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 special-grid lunch">
				<div class="gallery-single fix">
					<img src="{{asset('img/cyber.jpeg')}}" class="img-fluid" alt="Image"
						style="height: 15rem;width: 30rem;">
					<div class="why-text">
						<h4>CYBERSÉCURITÉ</br>
							Debouchés</br>
							- Analyste Gestion des Vulnérabilités</br>
							- Consultant en Cybersécurité
						</h4>
						<p></p>
						<h5></h5>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 special-grid lunch">
				<div class="gallery-single fix">
					<img src="{{asset('img/devos.jpeg')}}" class="img-fluid" alt="Image"
						style="height: 15rem; width: 30rem;">
					<div class="why-text">
						<h4>DEVS OS</br>
							Debouchés</br>
							- Développeur Front End</br>
							- Ingénieur Logiciel
						</h4>
						<p></p>
						<h5> </h5>
					</div>
				</div>
			</div>



		</div>
	</div>
</div>
<!-- End Menu -->
<!-- bloc administratif-->


<div class="menu-box">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="heading-title text-center">
					<h2>Le Pesonnel Administratif</h2>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="image-container">
	<div>
		<img src="{{asset('img/femmedg.jpeg')}}" alt="Image 1" class="circle-img" id="img1">
		<p class="status">DG</br>
			Directrice Générale
		</p>
	</div>
	<div>
		<img src="{{asset('img/femmesecretaire.jpeg')}}" alt="Image 2" class="circle-img" id="img2">
		<p class="status">SECRETAIRE</p>
	</div>
	<div>
		<img src="{{asset('img/da.jpg')}}" alt="Image 3" class="circle-img" id="img3">
		<p class="status">DA</br>
			Directeur Accademique
		</p>
	</div>
</div>
<!--end bloc administratif -->

<!-- moments forts-->
<div class="menu-box">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="heading-title text-center">
					<h2>Moments Forts</h2>

				</div>
			</div>
		</div>
	</div>
</div>
<ul class="slides">
	<input type="radio" name="radio-btn" id="img-1" checked />
	<li class="slide-container">
		<div class="slide">
			<img src="{{asset('img/sortieuniv.webp')}}" />
		</div>
		<div class="nav">
			<label for="img-6" class="prev">&#x2039;</label>
			<label for="img-2" class="next">&#x203a;</label>
		</div>
	</li>

	<input type="radio" name="radio-btn" id="img-2" />
	<li class="slide-container">
		<div class="slide">
			<img src="{{asset('img/sortieuniv2.jpg')}}" />
		</div>
		<div class="nav">
			<label for="img-1" class="prev">&#x2039;</label>
			<label for="img-3" class="next">&#x203a;</label>
		</div>
	</li>

	<input type="radio" name="radio-btn" id="img-3" />
	<li class="slide-container">
		<div class="slide">
			<img src="{{asset('img/fete1.jpg')}}" />
		</div>
		<div class="nav">
			<label for="img-2" class="prev">&#x2039;</label>
			<label for="img-4" class="next">&#x203a;</label>
		</div>
	</li>

	<input type="radio" name="radio-btn" id="img-4" />
	<li class="slide-container">
		<div class="slide">
			<img src="{{asset('img/fete2.jpg')}}" />
		</div>
		<div class="nav">
			<label for="img-3" class="prev">&#x2039;</label>
			<label for="img-5" class="next">&#x203a;</label>
		</div>
	</li>

	<input type="radio" name="radio-btn" id="img-5" />
	<li class="slide-container">
		<div class="slide">
			<img src="{{asset('img/etudens.jpg')}}" />
		</div>
		<div class="nav">
			<label for="img-4" class="prev">&#x2039;</label>
			<label for="img-6" class="next">&#x203a;</label>
		</div>
	</li>

	<input type="radio" name="radio-btn" id="img-6" />
	<li class="slide-container">
		<div class="slide">
			<img src="{{asset('img/diplomeuniv.jpeg')}}" />
		</div>
		<div class="nav">
			<label for="img-5" class="prev">&#x2039;</label>
			<label for="img-1" class="next">&#x203a;</label>
		</div>
	</li>

	<li class="nav-dots">
		<label for="img-1" class="nav-dot" id="img-dot-1"></label>
		<label for="img-2" class="nav-dot" id="img-dot-2"></label>
		<label for="img-3" class="nav-dot" id="img-dot-3"></label>
		<label for="img-4" class="nav-dot" id="img-dot-4"></label>
		<label for="img-5" class="nav-dot" id="img-dot-5"></label>
		<label for="img-6" class="nav-dot" id="img-dot-6"></label>
	</li>
</ul>
<!-- end moments forts-->

<!-- @contact-->

<div class="menu-box">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="heading-title text-center">
					<h2>Nous contacter</h2>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- end contact-->



<!-- ALL JS FILES -->
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<!-- ALL PLUGINS -->
<script src="{{asset('js/jquery.superslides.min.js')}}"></script>
<script src="{{asset('js/images-loded.min.js')}}"></script>
<script src="{{asset('js/isotope.min.js')}}"></script>
<script src="{{asset('js/baguetteBox.min.js')}}"></script>
<script src="{{asset('js/form-validator.min.js')}}"></script>
<script src="{{asset('js/contact-form-script.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script>

</script>
<style>
	.showcase-area {
		height: 60vh;
		background: linear-gradient(rgba(240, 240, 240, 0.144),
			rgba(255, 255, 255, 0.336)),
		url("{{ asset('img/batimentsco.jpeg') }}");
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
	}
</style>
<script>
	window.addEventListener('scroll', function() {
		var img1 = document.getElementById('img1');
		var img2 = document.getElementById('img2');
		var img3 = document.getElementById('img3');

		var rect1 = img1.getBoundingClientRect();
		var rect2 = img2.getBoundingClientRect();
		var rect3 = img3.getBoundingClientRect();

		if(rect1.top <= window.innerHeight || document.documentElement.clientHeight) {
			anime({
				targets: img1,
				scale: [0, 1],
				duration: 2000,
				easing: 'easeInOutQuad'
			});
		}
		if(rect2.top <= window.innerHeight || document.documentElement.clientHeight) {
			anime({
				targets: img2,
				scale: [0, 1],
				duration: 2000,
				easing: 'easeInOutQuad'
			});
		}
		if(rect3.top <= window.innerHeight || document.documentElement.clientHeight) {
			anime({
				targets: img3,
				scale: [0, 1],
				duration: 2000,
				easing: 'easeInOutQuad'
			});
		}
	});
</script>



@endsection