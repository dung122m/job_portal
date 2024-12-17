<style>

    .tracking-in-expand {
        -webkit-animation: tracking-in-expand 1.5s cubic-bezier(0.215, 0.61, 0.355, 1.000) both;
        animation: tracking-in-expand 1.5s cubic-bezier(0.215, 0.61, 0.355, 1.000) both;
    }
    .text-pop-up-top {
        animation: text-pop-up-top 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
    }

    @keyframes tracking-in-expand {
        0% {
            letter-spacing: -0.5em;
            opacity: 0;
        }
        40% {
            opacity: 0.6;
        }
        100% {
            opacity: 1;
        }
    }

    @keyframes text-pop-up-top {
        0% {
            transform: translateY(0);
            transform-origin: 50% 50%;
            text-shadow: none;
        }
        100% {
            transform: translateY(-50px);
            transform-origin: 50% 50%;
            text-shadow: 0 1px 0 #ccc, 0 2px 0 #ccc, 0 3px 0 #ccc, 0 4px 0 #ccc, 0 5px 0 #ccc, 0 6px 0 #ccc, 0 7px 0 #ccc, 0 8px 0 #ccc, 0 9px 0 #ccc, 0 50px 30px rgba(0, 0, 0, 0.3);
        }
    }
</style>



<section class="section-0 lazy d-flex align-items-center position-relative" id="banner">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1>Find your dream job</h1>
                <p >Thousands of jobs available.</p>
                <div class="banner-btn mt-5">
                    <a href="{{route('job.index')}}" class="btn btn-primary mb-4 mb-sm-0">Explore Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Background Images as <img> Tags -->
    <div class="image-container">
        <img class="bg-image-style active" src="{{ asset('assets/images/banner4.jpg') }}" alt="Banner 1">
        <img class="bg-image-style active" src="{{ asset('assets/images/banner-1.jpg') }}" alt="Banner  2">
        <img class="bg-image-style active" src="{{ asset('assets/images/banner-2.jpg') }}" alt="Banner  3">
        <img class="bg-image-style" src="{{ asset('assets/images/banner5.jpg') }}" alt="Banner 4">
        <img class="bg-image-style" src="{{ asset('assets/images/banner6.jpg') }}" alt="Banner 5">
        <img class="bg-image-style" src="{{ asset('assets/images/banner3.jpg') }}" alt="Banner 6">
    </div>
</section>
