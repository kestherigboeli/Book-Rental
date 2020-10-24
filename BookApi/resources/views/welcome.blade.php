<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>



    {{--tunde--}}
        <!-- <div class="panel panel-default">
                <div class="panel-heading p-3 mb-3" role="tab" id="heading1">
                  <h3 class="panel-title">
                    <a
                      class="collapsed"
                      role="button"
                      title
                      data-toggle="collapse"
                      data-parent="#accordion"
                      href="#collapse1"
                      aria-expanded="true"
                      aria-controls="collapse1"
                    >What session do you run and what is your timetable?</a>
                  </h3>
                </div>
                <div
                  id="collapse1"
                  class="panel-collapse collapse"
                  role="tabpanel"
                  data-parent="#accordion"
                  aria-labelledby="heading1"
                >
                  <div class="panel-body px-3 mb-4">
                    <ul>
                      <li>We run a number of different session types to cater for all needs, levels of fitness and training goals.</li>
                      <li>Our main session is our bootcamp of the day (BOD) program which is our constantly varied fun and functional fitness program that includes strength, cardio and core training.</li>
                      <li>We also offer our focused strength-training classes called Build & Burn as well as our high intensity cardio and core sessions called MetCon.</li>
                      <li>Our session times vary according to which studio you visit, but each of our studios timetables can be viewed HERE</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-heading p-3 mb-3" role="tab" id="heading1">
                  <h3 class="panel-title">
                    <a
                      class="collapsed"
                      role="button"
                      title
                      data-toggle="collapse"
                      data-parent="#accordion"
                      href="#collapse2"
                      aria-expanded="true"
                      aria-controls="collapse2"
                    >What does my membership include?</a>
                  </h3>
                </div>
                <div
                  id="collapse1"
                  class="panel-collapse collapse"
                  role="tabpanel"
                  data-parent="#accordion"
                  aria-labelledby="heading2"
                >
                  <div class="panel-body px-3 mb-4">
                    <ul>
                      <li>As a TFE member you will have unlimited access to all 50+ sessions that we offer each week. You can book as many session as you like but we recommend around 2-3 sessions per week for best results.</li>
                      <li>Depending on your membership category you will also have access to TFE digital, our online fitness program</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-heading p-3 mb-3" role="tab" id="heading1">
                  <h3 class="panel-title">
                    <a
                      class="collapsed"
                      role="button"
                      title
                      data-toggle="collapse"
                      data-parent="#accordion"
                      href="#collapse3"
                      aria-expanded="true"
                      aria-controls="collapse3"
                    >What is TFE digital?</a>
                  </h3>
                </div>
                <div
                  id="collapse1"
                  class="panel-collapse collapse"
                  role="tabpanel"
                  data-parent="#accordion"
                  aria-labelledby="heading3"
                >
                  <div class="panel-body px-3 mb-4">
                    <ul>
                      <li>TFE digital brings the studio to you at home. It's like having a studio at your finger tips! The TFE digital platform offers:</li>
                    </ul>
                    <ol>
                      <li>Access to our vault of pre-recorded, home based, Bootcamps, MetCons and Build & Burn sessions (over 200 to choose from)</li>
                      <li>Access to book on for virtual Zoom bootcamps, taken by one of our team of Coaches</li>
                      <li>Hundreds of recipes, cook books and nutrition support to help ensure that your diet and nutrition is on line and helping you to achieve your goals.</li>
                    </ol>
                  </div>
                </div>
              </div>-->
    </body>
</html>
