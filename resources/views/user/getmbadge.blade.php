@extends('layouts.user')
@section('content')
<style>
    .mbadge-form label {
        color: #333333;
        display: inline;
    }

    .mbadge-form p {
        margin-bottom: 2px;
    }

    .heading-set i {
        margin-right: 10px;
        display: none;
    }

    h2.heading-set {
        font-size: 28px;
        font-weight: 600;
        color: #131517;
        margin-bottom: 40px;
        text-align: center;
    }


    form#findmbadge input {
        border: 0 !important;
        padding: 14px 15px;
    }

    form#findmbadge h4 {
        font-size: 18px;
        font-weight: 500;
        color: #595c5c;
        text-align: left;
        margin-bottom: 0 !important;
    }

    .mbadge-form button {
        background-color: #333;
        min-width: 140px;
        border-radius: 8px;
        color: #ffffff;
        margin-left: auto;
        margin-right: auto;
        margin-top: 30px;
        font-size: 19px;
        box-shadow: 3px 3px 14px #00000030;
        transition: .25s all ease-in-out;
    }

    .border-radius-10 {
        border-radius: 10px;
        overflow: hidden;
    }

    .mbadge-form button:hover,
    .mbadge-form button:focus,
    .mbadge-form button:active {
        background-color: #000;
        color: #ffffff;
    }

    .form-check {
        position: relative;
    }

    .form-check label {
        font-size: 14px;
    }

    footer {
        display: none;
    }

    .form-check input {
        position: absolute;
        top: 6px;
        left: 0;
        cursor: pointer;
    }

    .form-bg-set {
        background: url("{{ asset('public/images/project/form-bg.png') }}") no-repeat bottom center;
        background-size: cover;
    }

    .printdiv {
        padding: 1rem;
    }

    div#printdivcontent img {
        max-width: 320px;
        height: auto;
    }

    .MbadgeEmail {
        align-items: center;
        display: flex;
        height: calc(100vh - 120px);
        justify-content: center;
        width: 100%;
        max-width: 560px;
        margin: auto;
    }

    .modal-footer {
        border-top: 0 !Important;
    }

    .mbadge-form button {
        margin-top: 10px;
    }

    .get-badges h3 {
        font-size: 20px;
        text-align: left;
    }

    .badges-row {
        background: #fff;
        padding: 10px 20px;
        border-radius: 10px;
    }

    .badges-row li {
        margin: 10px 0;
    }


    @media screen and (max-width: 767px) {
        .MbadgeEmail {
            height: auto;
        }

        .mbadge-form {
            padding: 40px 15px;
        }
    }
</style>
    
<div class="container inner-pages-top">


    <div class="form-bg-set MbadgeEmail">
        <form id="findmbadge" class="mbadge-form" method="post">
            <h2 class="heading-set"><i class="fa fa-check-circle"></i> M-BADGE</h2>
            @csrf
            <h4 class="text-[18px] text-[#595C5C] font-medium mb-3">Please enter your Registered Email and Phone  address to
                get your M-Ticket</h4>
            <div class="modal-body">
                <div class="row mb-adj">
                    <input type="text" name="search" class="form-control" placeholder="Type email and phone for getting m-badge "
                        value="">
                        <span class="error-message" id="searchError" ></span>
                  <?php /*  <div class="text-center col-md-12 printdiv" id="mbadgeDiv">
                                <h5 class="d-flex" style="justify-content:space-between"></h5>
                                <div id="printdivcontent"></div>
                            </div>  
                    */ ?>
                </div>
                 <!-- Modal footer -->
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-main btn-full submit-btn">Submit</button>
                </div>
            </div>
            <div class="get-badges" id="getBadges" style="display:none" >
                <h3>Total Mbadge Found</h3>
                <div class="badges-row">
                    <ul>
                    <li>
                            <div class="details-mbadge">
                                <h4 class="d-flex justify-content-between align-items-center">test 
                                    <span>test@Ezzmyevent.co</span> 
                                    <a href="#_" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i>Download</a>
                                </h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>


           
        </form>
    </div>
</div>


@endsection

@section('script')

    <script>
        var landingpageurl = '{{ env("APP_URL") }}';
    </script>

    <script type="text/javascript">
        function PrintDiv() {
            var divContents = document.getElementById("printdivcontent").innerHTML;
            var printWindow = window.open('', '', 'height=500,width=500');
            printWindow.document.write('<html><head>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        $("#findmbadge").on("keypress", function(event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });

        $(document).on('click', '.submit-btn', function(e) {
            var form = $('#findmbadge')[0];
            var formData = new FormData(form);
            $('.lds-hourglass').show();

            $.ajax({
                type: 'POST',
                url: "{{ route('findmbadge') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('.lds-hourglass').hide();
                    //response = jQuery.parseJSON(response);
                    var type = response.type;
                    var data = response.data;
                    var message = response.message;

                    if ($.isEmptyObject(response.error)) {
                        if (type == 'success' && data != '') {
                            Swal.fire({
                                icon: 'success',
                                html: 'Click here to view M-badge <a href="'+data+'" style="text-decoration: underline;">Click Here</a>.',
                                showCloseButton: true,
                                focusConfirm: false,
                                confirmButtonText: 'Ok',
                                confirmButtonAriaLabel: 'Thumbs up, great!',
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                html: ' M-badge not found.',
                                showCloseButton: true,
                                focusConfirm: false,
                                confirmButtonText: 'Ok',
                                confirmButtonAriaLabel: 'Thumbs up, great!',
                            })
                        }
                    } else {
                        $.each(response.error, function(key, value) {
                            $('#searchError').text(value);
                        });
                    }
                }
            });

            e.preventDefault();
        });

        $(".closeErrModal").click(function() {
            $('#error_modal').modal('hide');
        });
    </script>
@endsection
