@extends('head')

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-3 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user register-form" action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text"
                                               name="first_name"
                                               class="form-control form-control-user"
                                               id="exampleFirstName"
                                               placeholder="First Name"
                                               >
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text"
                                               name="last_name"
                                               class="form-control form-control-user"
                                               id="exampleLastName"
                                               placeholder="Last Name"
                                               >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email"
                                           name="email"
                                           class="form-control form-control-user"
                                           id="exampleInputEmail"
                                           placeholder="Email Address"
                                           >
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password"
                                               name="password"
                                               class="form-control form-control-user"
                                               id="exampleInputPassword"
                                               placeholder="Password"
                                               >
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password"
                                               name="password_confirmation"
                                               class="form-control form-control-user"
                                               id="exampleRepeatPassword"
                                               placeholder="Repeat Password"
                                               >
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        document.querySelector('.register-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const firstName = document.getElementById('exampleFirstName').value;
            const lastName = document.getElementById('exampleLastName').value;
            const email = document.getElementById('exampleInputEmail').value;
            const password = document.getElementById('exampleInputPassword').value;
            const confirmPassword = document.getElementById('exampleRepeatPassword').value;
            let valid = true;

            if (!firstName) {
                alert("First name is required.");
                valid = false;
            }

            if (!lastName) {
                alert("Last name is required.");
                valid = false;
            }

            if (!email || !/\S+@\S+\.\S+/.test(email)) {
                alert("Please enter a valid email.");
                valid = false;
            }

            if (password.length < 8) {
                alert("Password must be at least 8 characters.");
                valid = false;
            } else if (password !== confirmPassword) {
                alert("Passwords do not match.");
                valid = false;
            }

            if (valid) {
                this.submit();
            }
        });
    </script>

  @extends('footer')
