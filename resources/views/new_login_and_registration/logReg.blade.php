<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BCRV Tech-Voc, Inc.</title>
    <link rel="stylesheet" href="{{ asset('new_logReg_assets/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  </head>
  <body>
    <main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            <form action="{{ url('/login') }}" method="POST" autocomplete="off" class="sign-in-form">
            {{ csrf_field() }}
              <div class="logo">
                <img src="{{ asset('new_logReg_assets/img/bcrv_logo.PNG') }}" alt="bcrv" />
                <h4>BCRV</h4>
              </div>

              <div class="heading">
                <h2>Welcome Back</h2>
                <h6>Not registred yet?</h6>
                <a href="#" class="toggle">Sign up</a>
              </div>

              @if(count($errors) > 0)
              @foreach($errors->all() as $error)
              <div class="heading">
                  <h6 class="alert alert-danger">
                      <li style="color: red; list-style: none; text-align: center;">{{ $error }}</li>
                  </h6> 
              </div>
              @endforeach
              @endif
              @if(session('error'))
              <div class="heading">
                <h6 class="alert alert-danger" role="alert" style="color: red; text-align: center;">
                  {{ session('error') }}
                </h6>     
              </div>
              @endif
              @if(session('success'))
              <div class="heading">
                  <h6 class="alert alert-success" role="alert" style="color: green; text-align: center;">
                      {{ session('success') }}
                  </h6>            
              </div>
              @endif

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="email"
                    name="email"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Email</label>
                </div>

                <div class="input-wrap input-icons">

                  <input
                    type="password"
                    name="password"
                    class="input-field password-field"
                    autocomplete="off"
                    required
                  />
                  <label>Password</label>
                  
                  <button type="button" class="icon" id="btn-show-password">
                    <i class="fa-solid fa-eye" id="password-icon"></i>
                
                  </button>
                </div>

                <input type="submit" name="signin" value="Sign In" class="sign-btn" />

                <p class="text" style="color:black; font-size:1em">
                  <a href="{{ url('/forgot_password') }}">Forgot Password</a>
                </p>
              </div>
            </form>

            <form action="{{ url('/register') }}" method="POST" enctype="multipart/form-data" class="sign-up-form">
            {{ csrf_field() }}
              <div class="logo">
                <img src="{{ asset('new_logReg_assets/img/bcrv_logo.PNG') }}" alt="easyclass" />
                <h4>BCRV</h4>
              </div>

              <div class="heading">
                <h2>Get Started</h2>
                <h6>Already have an account?</h6>
                <a href="#" class="toggle">Sign in</a>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                  <input
                    type="text"
                    name="first_name"
                    class="input-field active"
                    placeholder="Lastname, Firstname MI, Suffix"
                  />
                  <label>Complete Name</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="email"
                    name="email"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label>Email</label>
                </div>

                <div class="input-wrap">

                  <select
                    name="education_level"
                    class="input-field"
                    required
                  >
                    <option> </option>
                    <option value="High School"> High School Graduate </option>
                    <option value="College"> College Graduate </option>
                    <option value="College Undergrad"> College Undergrad </option>
                    <option value="ALS"> ALS </option>
                  </select>
                  <label>Education Level</label>
                </div>

                <div class="input-wrap input-icons">
                  <input
                    type="password"
                    name="password"
                    class="input-field password-field"
                    autocomplete="off"
                    required
                  />
                  <button type="button" class="icon" id="btn-show-password-new">
                    <i class="fa-solid fa-eye" id="password-icon-new"></i>
                
                  </button>
                  <label>Password</label>
                </div>
                
                <div class="input-wrap input-icons">
                  <input
                    type="password"
                    name="password_confirmation"
                    class="input-field password-field"
                    autocomplete="off"
                    required
                  />
                  <button type="button" class="icon" id="btn-show-password-confirm">
                    <i class="fa-solid fa-eye" id="password-icon-confirm"></i>
                
                  </button>
                  <label>Confirm Password</label>
                </div>

                <input type="submit" name="signup" value="Sign Up" class="sign-btn" />

                <p class="text">
                  By signing up, I agree to the
                  <a href="#">Terms of Services</a> and
                  <a href="#">Privacy Policy</a>
                </p>
              </div>
            </form>
          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img src="{{ asset('new_logReg_assets/img/image1.svg') }}" class="image img-1 show" style="height: 300px;"/>
              <img src="{{ asset('new_logReg_assets/img/image2.svg') }}" class="image img-2" style="height: 300px;"/>
              <img src="{{ asset('new_logReg_assets/img/image3.svg') }}" class="image img-3" style="height: 300px;"/>
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  {{-- <h2>Lorem, ipsum dolor.</h2> --}}
                  {{-- <h2>Lorem ipsum dolor sit.</h2>
                  <h2>Lorem ipsum dolor sit amet.</h2> --}}
                </div>
              </div>

              {{-- <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript file -->

    <script src="{{ asset('new_logReg_assets/app.js') }}"></script>
    <script>
        const showPass = document.getElementById('btn-show-password');
        showPass.addEventListener('click',function(){
          const field = document.getElementsByClassName('password-field')[0]
        
          const type  = field.getAttribute("type") == "text" ? "password" : "text";
          const icon_class = type=="text" ? "fa-solid fa-eye" : "fa-solid fa-eye-slash"

          document.getElementById('password-icon').setAttribute("class", icon_class);
          field.setAttribute("type", type)

        })
        const showPassNew = document.getElementById('btn-show-password-new');
        showPassNew.addEventListener('click',function(){
          const field = document.getElementsByClassName('password-field')[1]
        
          const type  = field.getAttribute("type") == "text" ? "password" : "text";
          const icon_class = type=="text" ? "fa-solid fa-eye" : "fa-solid fa-eye-slash"

          document.getElementById('password-icon-new').setAttribute("class", icon_class);
          field.setAttribute("type", type)

        })
        const showPassConfirm = document.getElementById('btn-show-password-confirm');
        showPassConfirm.addEventListener('click',function(){
          const field = document.getElementsByClassName('password-field')[2]
        
          const type  = field.getAttribute("type") == "text" ? "password" : "text";
          const icon_class = type=="text" ? "fa-solid fa-eye" : "fa-solid fa-eye-slash"

          document.getElementById('password-icon-confirm').setAttribute("class", icon_class);
          field.setAttribute("type", type)

        })

    </script>
  </body>
</html>
