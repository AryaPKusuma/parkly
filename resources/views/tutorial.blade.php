@extends('layout.main')

@section('container')

<div class="container pt-4 pb-4">
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button
              data-mdb-collapse-init
              class="accordion-button"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#collapseOne"
              aria-expanded="true"
              aria-controls="collapseOne"
            >
              Baimana cara membuka parkir yang benar ?
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-mdb-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the first item's accordion body.</strong> It is hidden by default,
              until the collapse plugin adds the appropriate classes that we use to style each
              element. These classes control the overall appearance, as well as the showing and
              hiding via CSS transitions. You can modify any of this with custom CSS or
              overriding our default variables. It's also worth noting that just about any HTML
              can go within the <strong>.accordion-body</strong>, though the transition does
              limit overflow.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button
              data-mdb-collapse-init
              class="accordion-button collapsed"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#collapseTwo"
              aria-expanded="false"
              aria-controls="collapseTwo"
            >
              Accordion Item #2
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-mdb-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the second item's accordion body.</strong> It is hidden by
              default, until the collapse plugin adds the appropriate classes that we use to
              style each element. These classes control the overall appearance, as well as the
              showing and hiding via CSS transitions. You can modify any of this with custom CSS
              or overriding our default variables. It's also worth noting that just about any
              HTML can go within the <strong>.accordion-body</strong>, though the transition
              does limit overflow.
            </div>
          </div>
        </div>
        {{-- <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button
              data-mdb-collapse-init
              class="accordion-button collapsed"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#collapseThree"
              aria-expanded="false"
              aria-controls="collapseThree"
            >
              Accordion Item #3
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-mdb-parent="#accordionExample">
            <div class="accordion-body">
              <strong>This is the third item's accordion body.</strong> It is hidden by default,
              until the collapse plugin adds the appropriate classes that we use to style each
              element. These classes control the overall appearance, as well as the showing and
              hiding via CSS transitions. You can modify any of this with custom CSS or
              overriding our default variables. It's also worth noting that just about any HTML
              can go within the <strong>.accordion-body</strong>, though the transition does
              limit overflow.
            </div>
          </div>
        </div> --}}
    </div>
</div>

@endsection
