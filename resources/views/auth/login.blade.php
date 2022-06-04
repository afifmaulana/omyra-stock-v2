<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <title>Omyra Stock System</title>
</head>

<body style="background-color: rgba(7, 103, 199, 0.349)">
    <div class="mt-3">
        <div class="container-omyra">
            <div class="row mb-4">
                <div class="shadow shadow-lg">

                    <div class="row justify-content-center w-100" style="position: absolute; top: 15px;">
                        <div class="mr-2 pt-5">
                            <img src="{{ asset('images/logo.png') }}" alt="m-omyra" width="150" height="50">
                        </div>
                        {{-- <div class="text-active-pink font-weight-500 font-size-19"><b>Omyra</b></div> --}}
                    </div>
                </div>
            </div>

            <div class="mb-4 pt-5 text-center">
                <div class="font-size-24 pt-5 font-weight-700">Masuk</div>
            </div>

            <div class="d-none d-md-block">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center">
                            <form action="{{ route('login.submit') }}" method="POST" class="mb-4">
                                @csrf
                                <div class="form-group">
                                    <label class="font-weight-500" for="email">Email</label>
                                    <input type="text"
                                        class="form-control bg-input-auth font-size-16 form-omyra @error('email') is-invalid @enderror"
                                        name="email" id="email" placeholder="Masukkan Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <label class="font-weight-500" for="password">Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" id="show_hide_password"
                                        class="form-control bg-input-auth font-size-16 form-omyra border-right-none @error('password') is-invalid @enderror"
                                        name="password" placeholder="*********">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-input-auth border-span">
                                            {{-- <img src="{{ asset('images/icon/hide-password.png') }}" alt=""> --}}
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </span>
                                    </div>
                                </div>
                                <button class="btn btn-omyra btn-pink text-white btn-block" type="submit">Masuk
                                    Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-block d-md-none">
                <form action="{{ route('login.submit') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-500" for="email">Email</label>
                        <input type="text"
                            class="form-control bg-input-auth font-size-16 form-omyra @error('email') is-invalid @enderror"
                            name="email" id="email" placeholder="Masukkan Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <label class="font-weight-500" for="password">Password</label>
                    <div class="input-group mb-3">
                        <input type="password" id="show_hide_password"
                            class="form-control bg-input-auth font-size-16 form-omyra border-right-none @error('password') is-invalid @enderror"
                            name="password" placeholder="*********">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-input-auth border-span">
                                <img src="{{ asset('images/icon/hide-password.png') }}" alt="">
                            </span>
                        </div>
                    </div>
                    <button class="btn btn-omyra btn-pink text-white btn-block" type="submit">Masuk Sekarang</button>
                </form>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
        integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ=="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    {{-- <script src="https://use.fontawesome.com/b9bdbd120a.js"></script> --}}
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });
        });
    </script>

</body>

</html>
