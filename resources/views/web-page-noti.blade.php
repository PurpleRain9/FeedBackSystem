<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('noti.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="main-container container">
        <div class="contentANDbutton card">
            <h3>
                Would it be satisfy for the services of Directorate of Investment and
            </h3>
            <h3>
                Company Administration on today?
            </h3>
            <div class="button_div">
                <div class="smile_div">

                    <form action="{{ route('feedback.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="feedback" id="good" value="1">
                        <button class="smile_btn" >
                            <i class="fa-regular fa-face-smile"></i>
                        </button>
                        <h4 class="text-center">Excellent</h4>
                    </form>
                    {{-- <form action="{{ route('feedback.create') }}" method="POST">
                        @csrf
                        <input type="show" name="feedback" id="good" value="1">
                        <button class="smile_btn" type="submit">
                            <i class="fa-regular fa-face-smile"></i>
                        </button>
                        <h4 class="text-center">Excellent</h4>
                    </from> --}}
                </div>
                <div class="normal_div">

                    <form action="{{ route('feedback.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="feedback" id="normal" value="2">
                        <button class="normal_btn">
                            <i class="fa-regular fa-face-meh"></i>
                        </button>
                        <h4 class="text-center">Normal</h4>
                    </form>
                </div>
                <div class="bad_div">
                    <form action="{{ route('feedback.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="feedback" id="bad" value="3">
                        <button class="bad_btn">
                            <i class="fa-regular fa-face-frown"></i>
                        </button>
                        <h4 class="text-center">Bad</h4>
                    </form>
                </div>
            </div>
            <div class="goToPrint d-flex justify-content-end">
                <a href="{{ route('feedback.datashwow') }}" class="btn btn-primary fw-bold py-2">View Report <i
                        class="fa-solid fa-caret-right"></i></a>
            </div>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const oneClick = document.querySelector('.smile_btn')
        oneClick.addEventListener('click', function() {
            Swal.fire({
                title: 'Sweet!',
                text: 'Modal with a custom image.',
                imageUrl: 'https://unsplash.it/400/200',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        })
        const twoClick = document.querySelector('.normal_btn')
        twoClick.addEventListener('click', function() {
            Swal.fire({
                title: 'Sweet!',
                text: 'Modal with a custom image.',
                imageUrl: 'https://unsplash.it/400/200',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        })
        const threeClick = document.querySelector('.bad_btn')
        threeClick.addEventListener('click', function() {
            Swal.fire({
                title: 'Sweet!',
                text: 'Modal with a custom image.',
                imageUrl: 'https://unsplash.it/400/200',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        })
    </script>
</body>

</html>
