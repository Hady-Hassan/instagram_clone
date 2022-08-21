<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{asset('/temp/stylesheet.css')}}" />
    <link
      rel="icon"
      type="image/x-icon"
      href="/assets/icons8-instagram-color-32.png"
    />
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SignUp • Instagram</title>
  </head>
  <body>
    <section class="py-4">
      <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
          <div style="max-width: 420px">
          <form method="POST" class="bg-white border py-4 px-5"  action="{{ route('register') }}">
          <div class="text-center mb-3">
                <img src="{{asset('/temp/assets/7a252de00b20.png')}}" alt="instagram" />
                <p class="text-muted fw-bold">
                  Sign up to see photos and videos from your friends.
                </p>
              </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        
            @csrf

            <!-- Name -->
            <div class="form-floating mb-3">

                <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus />
                <label>Full Name</label>

            </div>

            <!-- Email Address -->
            <div class="form-floating mb-3">
               
                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
                <label>Email</label>
            </div>
            <div class="form-floating mb-3">
               
               <input id="username" class="form-control" type="username" name="username" :value="old('username')" required />
               <label>Username</label>
           </div>

            <div class="form-floating mb-3">
               
               <input id="phone" class="form-control" type="phone" name="phone" :value="old('phone')" required />
               <label>Mobile Number</label>
           </div>
            <!-- Password -->
            <div class="form-floating mb-3">
            

                <input id="password" class="form-control"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                                <label>password</label>

            </div>

            <!-- Confirm Password -->
            <div class="form-floating mb-3">
                <input id="password_confirmation" class="form-control"
                                type="password"
                                name="password_confirmation" required />
                                <label>confirm password</label>
            </div>

            <div class="mb-2">
            <button class="btn btn-primary fw-bold w-100 bg-gradient"
                          href="#"
                          type="submit">
                    {{ __('Sign up') }}
                </button>
            </div>

            <div class="small text-center">
                By signing up, you agree to our Terms , Data Policy and Cookies
                Policy.
              </div>
        </form>

            <div class="bg-white py-4 px-5 text-center border mt-4">
              <p class="m-0">
              Have an account?<a href="{{ route('login') }}">Log In</a>
              </p>
            </div>
            </div> 
        </div>
      </div>
    </section>

   <!-- Footer -->
   <div class="container">
      <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-muted">Meta</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-muted">About</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-muted">Blog</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-muted">Jobs</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-muted">API</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-muted">Privacy</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-muted">Terms</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-muted">Top Accounts</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-muted">Hashtags</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-muted">Location</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-muted">Instagram Lite</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-muted"
              >Contact Uploading & Non-Users</a
            >
          </li>
        </ul>
        <p class="text-center text-muted">&copy; 2022 Instagram from Meta</p>
      </footer>
    </div>
    <!-- Footer -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
      integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
      integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
