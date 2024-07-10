@extends('layout.main')

@section('container')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
    <div class="container bg-blue px-4 py-5 ">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
          <div class="col-10 col-sm-8 col-lg-6">
            <img
              src="image/parkir.webp"
              class="d-block mx-lg-auto img-fluid"
              alt="Bootstrap Themes"
              width="700"
              height="500"
              loading="lazy"
            />
          </div>
          <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3">PARKLY</h1>
            <p class="lead">
              layanan parkir online yang memungkinkan pengguna untuk membuka lahan parkir sendiri.
            </p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
              <a class="btn btn-primary" href="/parkir">Cari Parkir</a>
            </div>
          </div>
        </div>
      </div>
      <div class="b-example-divider"></div>
      <section class="bg-lightX py-5X py-xl-8X bsb-body">
        <div class="container">
          <div class="row gy-5 gy-lg-0 gx-lg-8 align-items-center">
            <div class="col-12 col-lg-5">
              <h3 class="fs-6 text-secondary mb-2 mb-xl-3">TUJUAN KAMI</h3>
              <h2 class="display-5 mb-3 mb-xl-4">
                Memberikan kemudahan dalam sistem parkir
              </h2>
              <p class="mb-4 mb-xl-5">
                Parkly menyediakan solusi mudah membuka lahan parkir
              </p>
            </div>
            <div class="col-12 col-lg-7">
              <div class="row gy-4">
                <div class="col-12 col-sm-6">
                  <div
                    class="card border-0 border-bottom border-primary shadow-sm"
                  >
                    <div class="card-body text-center p-4 p-xxl-5">
                      <i
                        class="fa-regular fa-handshake fa-2xl pb-5"
                        style="color: #0062ff"
                      ></i>
                      <h4 class="mb-4">Mebuka Parkiran</h4>
                      <p class="mb-4 text-secondary">
                        Anda dapat membagikan lahan parkir anda dengan orang lain.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div
                    class="card border-0 border-bottom border-primary shadow-sm"
                  >
                    <div class="card-body text-center p-4 p-xxl-5">
                      <i
                        class="fa-solid fa-info fa-2xl pb-5"
                        style="color: #2977ff"
                      ></i>
                      <h4 class="mb-4">Managemen parkiran</h4>
                      <p class="mb-4 text-secondary">
                        anda dapat memantau siapa saja yang parkir ditempat anda
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div
                    class="card border-0 border-bottom border-primary shadow-sm"
                  >
                    <div class="card-body text-center p-4 p-xxl-5">
                      <i
                        class="fa-solid fa-qrcode fa-2xl pb-5"
                        style="color: #005eff"
                      ></i>
                      <h4 class="mb-4">Cek Tempat</h4>
                      <p class="mb-4 text-secondary">
                        user dapat mengecek ketersediaan tempat parkir tersebut.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div
                    class="card border-0 border-bottom border-primary shadow-sm"
                  >
                    <div class="card-body text-center p-4 p-xxl-5">
                      <i
                        class="fa-solid fa-shield-halved fa-2xl pb-5"
                        style="color: #0084ff"
                      ></i>
                      <h4 class="mb-4">Keamanan</h4>
                      <p class="mb-4 text-secondary">
                        suatu layanan unggulan kami yang dimana user tidak perlu
                        khawatir terhadap kendaraannya.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


@endsection
