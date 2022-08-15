<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCRV Tech-Voc, Inc.</title>
    <link rel="stylesheet" href="{{ asset('new_logReg_assets/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

</head>
<body>
    <main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            <form action="{{ url('/reset_password/'.$user->email.'/'.$code) }}" method="POST" autocomplete="off" class="sign-in-form">
            {{ csrf_field() }}
              <div class="logo">
                <img src="{{ asset('new_logReg_assets/img/bcrv_logo.PNG') }}" alt="bcrv" />
                <h4>BCRV</h4>
              </div>

              <div class="heading">
                <h2>Reset your password <br> <code style="font-size: 20px;">{{ $user->email }}</code></h2>
              </div>

              <div class="actual-form">
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

                <input type="submit" name="signin" value="Change" class="sign-btn" />
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
                  {{-- <h2>Lorem, ipsum dolor.</h2>
                  <h2>Lorem ipsum dolor sit.</h2>
                  <h2>Lorem ipsum dolor sit amet.</h2> --}}
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript file -->

    <script src="{{ asset('new_logReg_assets/app.js') }}"></script>
    
    <script>
        const showPassNew = document.getElementById('btn-show-password-new');
        showPassNew.addEventListener('click',function(){
          const field = document.getElementsByClassName('password-field')[0]
          const type  = field.getAttribute("type") == "text" ? "password" : "text";
          const icon_class = type=="text" ? "fa-solid fa-eye" : "fa-solid fa-eye-slash"
          document.getElementById('password-icon-new').setAttribute("class", icon_class);
          field.setAttribute("type", type)
        })
        const showPassConfirm = document.getElementById('btn-show-password-confirm');
        showPassConfirm.addEventListener('click',function(){
          const field = document.getElementsByClassName('password-field')[1]
          const type  = field.getAttribute("type") == "text" ? "password" : "text";
          const icon_class = type=="text" ? "fa-solid fa-eye" : "fa-solid fa-eye-slash"
          document.getElementById('password-icon-confirm').setAttribute("class", icon_class);
          field.setAttribute("type", type)
        })
        
    </script>
  </body>
</html>