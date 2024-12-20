<!doctype html>
<html lang="zxx">

@include('layout.head')

<body>
    <!--::header part start::-->
    @include('layout.header')
    <!-- Header part end-->


    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Tracking Order</h2>
                            <p>Home <span>-</span> Tracking Order</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================login_part Area =================-->
    <section class="login_part padding_top">
        <div class="container">
            <div class="row align-items-center">
{{-- POst start--}}
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Welcome Back ! <br>
                                Post Blog now</h3>
               <form class="row contact_form" action="{{ route('posts.store') }}" method="POST" novalidate="novalidate" enctype="multipart/form-data">
    @csrf
    <div class="col-md-12 form-group p_star">
        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
    </div>
    <div class="col-md-12 form-group p_star">
        <input type="text" class="form-control" id="Content" name="Content" placeholder="Content" required>
    </div>
    <div class="col-md-12 form-group p_star">
        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
    </div>
    <button type="submit" class="btn_3">
        Post
    </button>
</form>

                                
{{-- post end --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================login_part end =================-->

    <!--::footer_part start::-->
    @include('layout.footer')
    <!--::footer_part end::-->
@include('layout.script')
</body>

</html>