<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCRV Tech-Voc, Inc.</title>
    <link rel="stylesheet" href="{{ asset('new_logReg_assets/style.css') }}" />
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
                <div class="input-wrap">
                    <input
                      type="password"
                      name="password"
                      class="input-field"
                      autocomplete="off"
                      required
                    />
                    <label>Password</label>
                  </div>
                  
                  <div class="input-wrap">
                    <input
                      type="password"
                      name="password_confirmation"
                      class="input-field"
                      autocomplete="off"
                      required
                    />
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
                  <h2>Lorem, ipsum dolor.</h2>
                  <h2>Lorem ipsum dolor sit.</h2>
                  <h2>Lorem ipsum dolor sit amet.</h2>
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
  </body>
</html>