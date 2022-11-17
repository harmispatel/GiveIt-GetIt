@extends('fronted.layout')

@section('title', 'Give It & Get It - Login Form')

@section('content')


    <body>

        {{-- @if (session()->has('msg'))
            <div class="alert alert-success msg reg">
                {{ session()->get('msg') }}
            </div>
        @endif --}}

        {{-- @if (session()->has('message'))
            <div class="alert alert-success message">
                {{ session()->get('message') }}
            </div>
        @endif --}}
        <div class="donation-info">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="donate-form">
                            <div class="form-title text-center">
                                <h3>Register</h3>
                            </div>
                            <hr>
                            <form action="{{ route('Regitser.insertdata') }}" id="regiter" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Your Username</label>
                                            <input type="text" name="username" id="username" class="form-control"
                                                value="{{ old('username') }}">
                                        </div>
                                        @if ($errors->has('username'))
                                            <p style="color:red">{{ $errors->first('username') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Your Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email') }}">
                                        </div>
                                        @if ($errors->has('email'))
                                            <p style="color:red">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="phone-number" class="form-label">Your Phone Number</label>
                                            <input type="number" class="form-control" id="number" name="number"
                                                value="{{ old('number') }}">
                                        </div>
                                        @if ($errors->has('number'))
                                            <p style="color:red">{{ $errors->first('number') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="note" class="form-label">Address</label>
                                            <textarea class="form-control" name="address" placeholder="Your Address" id="address" rows="5">{{ old('address') }}</textarea>
                                        </div>
                                        @if ($errors->has('address'))
                                            <p style="color:red">{{ $errors->first('address') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3 position-reletive">
                                            <label for="name" class="form-label">Password</label>
                                            <input type="password" class="form-control password" id="password"
                                                data-toggle="password" name="password" value="{{ old('password') }}">
                                            <i class="bi bi-eye-slash eye_ic" id="togglePassword"></i>
                                        </div>
                                        @if ($errors->has('password'))
                                            <p style="color:red">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3 position-reletive">
                                            <label for="email" class="form-label">Conform Password</label>
                                            <input type="password" class="form-control comform_password"
                                                id="comform_password" data-toggle="password" name="password_confirmation"
                                                value="{{ old('password_confirmation') }}">
                                            <i class="bi bi-eye-slash eye_ic" id="toggleCPassword"></i>
                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                            <p style="color:red">{{ $errors->first('password_confirmation') }}</p>
                                        @endif
                                    </div>


                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn donate-bt">Submit</button>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- <div class="donate-form">
                            <div class="form-title text-center">
                                <h3>Login</h3>
                            </div>
                            <hr>
                            <form action="{{ route('useget') }}" id="loginForm" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Your Email Address</label>
                                            <input type="email" class="form-control" id="email"
                                                value="{{ old('email') }}" name="email">
                                            @if ($errors->has('email'))
                                                <p class="alert text-danger">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3  position-relative">
                                            <label for="password" class="form-label">Your Password</label>
                                            <input type="password" class="form-control loginpassword" id="loginpassword"
                                                value="{{ old('password') }}" name="password">
                                            <i class="bi bi-eye-slash eye_ic" id="toggleloginPassword"></i>
                                            @if ($errors->has('password'))
                                                <p class="alert text-danger">{{ $errors->first('password') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-end mb-3">
                                        <a href="{{ route('forget.password.get') }}">Forgot your password?</a>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn donate-bt">Submit</button>
                                        </div>
                                        <hr>
                                        
                                        
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                        <div class="donate-form mt-4 ">
                            <div class="form-title text-center">
                                <h3>Login with Number</h3>
                            </div>
                            <hr>

                            <div class="alert alert-success" id="sentSuccess" style="display: none;"></div>
                            <div class="alert alert-success" id="successRegsiter" style="display: none;"></div>
                            <form action="{{ route('login') }}" onsubmit="onSignInSubmit();">
                                @csrf
                                <div id="hiddennumber">
                                    <label class="form-label">Phone Number:</label>

                                    <input type="text" id="phoneNumber" class="form-control number" value="+91"
                                        Placeholder="phone">

                                    <div id="recaptcha-container" class="mt-2"></div>
                                    <div class="text-center">
                                        <button type="submit" class="btn donate-bt sendOTP mt-2" id="sendOTP"> Send
                                            code</button>
                                    </div>
                                </div>
                                {{-- </form> --}}
                                {{-- <form> --}}
                                <div class="row" id="hiddenotp" style="display:none">
                                    <label class="form-label">OTP</label>
                                    <div class="d-flex justify-content-center" id="otp">
                                        <input type="text" class="form-control in" id="first"
                                            name="digit-1" data-next="digit-2" maxlength="1"  required=""/>
                                        <input type="text" class="form-control in" style="" id="second"
                                            name="digit-2" data-next="digit-3" data-previous="digit-1" maxlength="1"  required=""/>
                                        <input type="text" class="form-control in" style="" id="third"
                                            name="digit-3" data-next="digit-4" data-previous="digit-2" maxlength="1"  required=""/>
                                        <input type="text" class="form-control in"style="" id="fourth"
                                            name="digit-4" data-next="digit-5" data-previous="digit-3" maxlength="1"   required=""/>
                                        <input type="text" class="form-control in"style="" id="fifth"
                                            name="digit-5" data-next="digit-6 " data-previous="digit-4" maxlength="1"  required=""/>
                                        <input type="text" class="form-control in"style="" id="sixth"
                                            name="digit-6" data-next="digit-7" data-previous="digit-5" maxlength="1"  required=""/>
                                    </div>
                                    <input type="hidden" id="verificationCode" class="form-control out" placeholder="OTP"
                                        required="">
                                    <div class="text-center">
                                        <button type="button" class="btn donate-bt mt-2" id="verifyOTP"
                                            value={OTP}>Verify
                                            code</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <p>or sign up with:</p>
                                <div class="col-md-12">
                                    <a href="{{ url('auth/google') }}" class="btn google-btn social-btn"
                                        style="background-color: #DF4B3B; color:white">
                                        {{-- Login with Google --}}
                                        {{-- <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png"
                                                    style="margin-left: 3em;"> --}}
                                        <span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span>
                                    </a>
                                </div>

                                <div class="col-md-12 mt-2">
                                    <a href="{{ url('auth/facebook') }}" class="btn facebook-btn social-btn"
                                        style="background-color:#3C589C;  color:white">
                                        <span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div id="loader" style="display: block; background: rgb(255, 254, 254);">
            <div id="square">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div id="laoding_text">
                <span>Loading...</span>
            </div>
        </div>
        </div>
        </div>

    </body>

    </html>
@endsection
@section('js')
    <script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.13.0/firebase-app.js";
    import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.13.0/firebase-analytics.js";
    import { getAuth, RecaptchaVerifier,signInWithPhoneNumber } from "https://www.gstatic.com/firebasejs/9.13.0/firebase-auth.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries
    
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyCoxxP81VUDdQAszvj_tjRgjFyAdqM4Bw4",
        authDomain: "giveitgetit-58213.firebaseapp.com",
        projectId: "giveitgetit-58213",
        storageBucket: "giveitgetit-58213.appspot.com",
        messagingSenderId: "881723970671",
        appId: "1:881723970671:web:6d6305a3926e5d0225e99a",
        measurementId: "G-KWE64CYDM3"
    };
    
    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
    
    const auth = getAuth();
    // Turn off phone auth app verification.

    let recaptchakey ="";
    // firebase.initializeApp(firebaseConfig);
    window.recaptchaVerifier = new RecaptchaVerifier('recaptcha-container', {
        'size': 'normal',
        'callback': (response) => {
            console.log({response});
            recaptchakey = response;
            // reCAPTCHA solved, allow signInWithPhoneNumber.
            onSignInSubmit();
        }
    }, auth);
    
    window.recaptchaVerifier.render().then(function(widgetId) {
        grecaptcha.reset(widgetId);
    });


    document.getElementById("sendOTP").addEventListener("click",function () { 

        let phoneNumber = document.getElementById("phoneNumber").value
        let appVerifier = window.recaptchaVerifier;
        console.log({phoneNumber,appVerifier,recaptchaVerifier:window.recaptchaVerifier});
        signInWithPhoneNumber(auth, phoneNumber, appVerifier)
        .then((confirmationResult) => {
            console.log({confirmationResult});
          // SMS sent. Prompt user to type the code from the message, then sign the
          // user in with confirmationResult.confirm(code).
          window.confirmationResult = confirmationResult;
          // ...
    
          $("#sentSuccess").text("Message Sent Successfully.");
            $("#sentSuccess").show();
        }).catch((error) => {
            console.log({error});
          // Error; SMS not sent
          // ...
        });
     })

     $("#verifyOTP").click(function(){
         
         const code =  document.getElementById("verificationCode").value
         console.log('code....................>',code);
         confirmationResult.confirm(code).then((result) => {
             // User signed in successfully.
  console.log('sing inn----------->',result);

  console.log('result----------->',result.user.phoneNumber);
  const number = result.user.phoneNumber;
  console.log('heeeeeeeeee_________________>', number);
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// e.preventDefault();
  $.ajax({
                url:"{{ route('login.otp') }}",
                method: 'post',
                data: {
                    number: number,
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log(res);
                    if (res.status == 1) {

                        location.href = "{{route('welcome')}}";
                        
                        // window.location.href ="/editprofile";
                }

            }
        });
  
        toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true
                                }
                                toastr.success(response
                                    .message);

}).catch((error) => {
  // User couldn't sign in (bad verification code?)
  // ...
});
     })
    
    
</script>
    <script type="text/javascript">
    $(document).ready(function() {
  $('.in').on('input',function() {
    var allvals = $('.in').map(function() { 
        console.log("aa>>>>>>>>>>>",allvals);
        return this.value; 
        
        
    }).get().join('');
    $('.out').val( allvals );
    // console.log("aa>>>>>>>>>>>",allvals);

  });
});
        $(document).ready(function() {
            $(".sendOTP").click(function() {
                $("#hiddennumber").hide();
                $("#hiddenotp").show();
            });
        });
        document.addEventListener("DOMContentLoaded", function(event) {
   
   function OTPInput() {
       const editor = document.getElementById('first');
       editor.onpaste = pasteOTP;

       const inputs = document.querySelectorAll('#otp > *[id]');
       for (let i = 0; i < inputs.length; i++) { 
           inputs[i].addEventListener('input', function(event) { 
               if(!event.target.value || event.target.value == '' ){
                   if(event.target.previousSibling.previousSibling){
                       event.target.previousSibling.previousSibling.focus();    
                   }
               
               }else{ 
                   if(event.target.nextSibling.nextSibling){
                       event.target.nextSibling.nextSibling.focus();
                   }
               }               
           });             
       } 
   } 
   OTPInput(); 
});

function pasteOTP(event){
   event.preventDefault();
   let elm = event.target;
   let pasteVal = event.clipboardData.getData('text').split("");
   if(pasteVal.length > 0){
       while(elm){
           elm.value = pasteVal.shift();
           elm = elm.nextSibling.nextSibling;
       }
   }
}
        // function codeverify() {

        //     var code = $("#verificationCode").val();

        //     coderesult.confirm(code).then(function(result) {
        //         var user = result.user;
        //         console.log(user);

        //         $("#successRegsiter").text("you are register Successfully.");
        //         $("#successRegsiter").show();

        //     }).catch(function(error) {
        //         $("#error").text(error.message);
        //         $("#error").show();
        //     });
        // }


        //  Password show hide 
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });
        // Conform Password show hide
        const toggleCPassword = document.querySelector("#toggleCPassword");
        const comform_password = document.querySelector(".comform_password");

        toggleCPassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = comform_password.getAttribute("type") === "password" ? "text" : "password";
            comform_password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });
        const toggleloginPassword = document.querySelector("#toggleloginPassword");
        const loginpassword = document.querySelector(".loginpassword");

        toggleloginPassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = loginpassword.getAttribute("type") === "password" ? "text" : "password";
            loginpassword.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });
        // Alert Timeout
        @if (Session::has('msg'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('msg') }}");
        @endif
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif
        @if (Session::has('logout'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('logout') }}");
        @endif
        @if (Session::has('mistake'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('mistake') }}");
        @endif

        // Jquery Validation Login 
        $(document).ready(function() {
            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    email: {
                        required: "Email is Required",
                        email: "Please enter a Specify valid email address"
                    },
                    password: {
                        required: "Password is Required",
                        minlength: "Password must be 6 length"
                    }
                }
            });
            $("#regiter").validate({
                rules: {
                    username: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    number: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true
                    },
                    address: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    }

                },
                messages: {
                    username: {
                        required: "Name  is required",
                    },
                    email: {
                        required: "Email is required",
                        email: "Please enter a valid email address",
                    },
                    number: {
                        required: "Mobile No. is required",
                        minlength: "Mobile No. must be 10 digits",
                        maxlength: "Mobile No. must be 10 digits",
                        number: "Mobile No. is not valid"
                    },
                    address: {
                        required: "Address is required"
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password must be 6 length"
                    },
                    password_confirmation: {
                        required: "Password Confirmation is required",
                        minlength: "Password must be 6 length",
                        equalTo: "Password Confirmation does not match with Password"
                    }
                }
            });
        });
        // Jquery Validation Register
    </script>

@endsection
