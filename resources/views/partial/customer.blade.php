@extends('layout.main')

@section('container')

<section style="background-color: #eee;">

    <div class="container py-5 z-depth-1">

        <div class="card">
            <section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">
          
              <style>
                .map-container {
                  height: 200px;
                  position: relative;
                }
          
                .map-container iframe {
                  left: 0;
                  top: 0;
                  height: 100%;
                  width: 100%;
                  position: absolute;
                }
              </style>
          
              <!--Google map-->
              <div id="map-container-google-1" class="z-depth-1 map-container mb-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.569832710677!2d112.64659807486352!3d-7.175619992829254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd8003eae3b5885%3A0xe591511ea76dac1d!2sUniversitas%20Internasional%20Semen%20Indonesia!5e0!3m2!1sen!2sus!4v1687409212911!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
              <!--Google Maps-->
          
              <!--Grid row-->
              <div class="row">
          
                <!--Grid column-->
                <div class="col-lg-5 col-md-12 mb-0 mb-md-0">
          
                  <h3 class="font-weight-bold">Hubungi Kami</h3>
          
                  <p class="text-muted">
                    Kami sangat senang mendengar dari Anda! Silakan tinggalkan pesan atau pertanyaan apa pun yang Anda miliki. 
                    Tim kami akan segera merespons Anda.

                  </p>
                  <p class="text-muted">
                    Terima kasih atas dukungan dan minat Anda pada layanan kami. 
                    Kami berkomitmen untuk memberikan pengalaman terbaik kepada pelanggan kami.
                  </p>
          
                  <p><span class="font-weight-bold mr-2">Email : </span><a href="">parkly.dennar@gmail.com</a></p>
                  <p><span class="font-weight-bold mr-2">Phone : </span><a href="">+62 8893 3345 2349</a></p>
          
                </div>
                <!--Grid column-->
          
                <!--Grid column-->
                <div class="col-lg-7 col-md-12 mb-4 mb-md-0 py-3">
          
                  <!--Grid row-->
                  <div class="row">

                <form method="POST" action="{{ route('contact-us.store') }}">
                  @csrf
                    <div class="md-form md-outline mb-0">
                      <input type="text" id="name" name="name" class="form-control">
                      <label for="name">name</label>
                    </div>
            
                  </div>

                    <div class="md-form md-outline mt-3">
                      <input type="email" id="email" name="email" class="form-control">
                      <label for="email">E-mail</label>
                    </div>
            
                    <div class="md-form md-outline mt-3">
                      <input type="text" id="subject" name="subject" class="form-control">
                      <label for="subject">Subject</label>
                    </div>
            
                    <div class="md-form md-outline mt-3">
                      <textarea id="message" class="md-textarea form-control" name="message" rows="3"></textarea>
                      <label for="message">How we can help?</label>
                    </div>
                    
                    <div class="mt-3">
                      <button type="submit" class="btn btn-info btn-sm ml-0">Submit<i class="far fa-paper-plane ml-2"></i></button>
                    </div>

                </form>
                </div>
          
              </div>
            </section>
        </div>
      </div>

</section>

@endsection