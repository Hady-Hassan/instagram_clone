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
    <title>Login • Instagram</title>
  </head>

  <body>
    <section class="py-4" style="margin-top: 5rem">
      <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
          <div style="max-width: 420px">
          <form class="bg-white border py-4 px-5" method="POST" action="{{ route('login') }}">
          <div class="text-center mb-3">
                <img src="{{asset('/temp/assets/7a252de00b20.png')}}" alt="instagram" />

              </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

       
            @csrf

            <!-- Email Address -->
            <div class="form-floating mb-3">
                
                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                <label>Email</label>
            </div>

            <!-- Password -->
            <div class="form-floating mb-3">
                

                <x-input id="password" class="form-control"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                                <label>Password</label>
            </div>

            <!-- Remember Me -->

            <div class="mb-2">

            <x-button class="btn btn-primary fw-bold w-100 bg-gradient">
                    {{ __('Log in') }}
                </x-button>
            </div>
            <div class="block mb-3">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="mb-3">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" style="text-decoration: none" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif


            </div>
        </form>
        <div class="bg-white py-4 px-5 text-center border mt-4">
              <p class="m-0">
                Don't have an account? <a href="{{ route('register') }}">Sign up</a>
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