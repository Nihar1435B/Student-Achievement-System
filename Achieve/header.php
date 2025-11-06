  <?php
    if (!isset($_SESSION["user"])) {
        session_start();
    }
    ?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" type="text/css" href="design.css?<?php echo time(); ?>" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
      <script src="https://cdn.tiny.cloud/1/ofenk273ve97sdy9grj211n8ao8r7cjfsys79h0o3jdh2po0/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


      <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

      <style>
          #myInput {
              box-sizing: border-box;
              background-image: url('searchicon.png');
              font-size: 16px;
              border: none;
              border-bottom: 1px solid #ddd;
          }
      </style>


  </head>


  <body class="backcolor">
      <div>
          <header class="sticky-top w-100">
              <nav class="navbar-expand-md navbar-light bg-nav">
                  <div class="testsize m-auto">
                      <div class="d-flex flex-md-row flex-column align-items-center  col-xl-12 col-12 m-auto justify-content-around">

                          <div class="d-flex align-items-center order-md-0 order-1">
                              <!--#region headersearch  -->
                              <a href="#">
                                  <img class="logoheight rounded" src="img/logo.jpg" alt="Linkedin Logo" />
                              </a>
                              <div class="headersearc">
                                  <div class="d-flex h-100">
                                      <li-icon class="my-auto  pe-1">
                                          <svg class="marginleft">
                                              <path d="M14.56 12.44L11.3 9.18a5.51 5.51 0 10-2.12 2.12l3.26 3.26a1.5 1.5 0 102.12-2.12zM3 6.5A3.5 3.5 0 116.5 10 3.5 3.5 0 013 5z">
                                              </path>
                                          </svg>
                                      </li-icon>
                                      <div class="h-100 w-100">
                                          <input id="headersearch" class="h-100 w-100 bg-transparent border-0 px-2" type="text" placeholder="Search.." id="myInput">
                                          <div id="options" style="display: none; flex-direction: column;">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!--#endregion -->
                          </div>

                          <div class="d-flex align-items-center test  " style="font-size: 14px;">
                              <!--#region headermenu  -->
                              <div class="flexItem text-center">
                                  <p class="m-0">
                                      <svg>
                                          <path d="M23 9v2h-2v7a3 3 0 01-3 3h-4v-6h-4v6H6a3 3 0 01-3-3v-7H1V9l11-7 5 3.18V2h3v5.09z">
                                          </path>
                                      </svg>
                                  </p>
                                  <a class="active pt-1" aria-current="page" href="#">Home</a>
                              </div>
                                    
                          
                             
                              <div class="flexItem text-center" style="border-right: 1px  solid; padding-right:  1em; margin-right: 10px;">
                                  <p class="m-0">
                                      <svg fill="green">
                                          <path d="M23 9v2h-2v7a3 3 0 01-3 3h-4v-6h-4v6H6a3 3 0 01-3-3v-7H1V9l11-7 5 3.18V2h3v5.09z">
                                          </path>
                                      </svg>
                                  </p>
                                  <a class="active pt-1" href="user.php?userid=<?php echo $_SESSION["user"]["userid"] ?>">Me</a>
                              </div>
                              <div class="text-center" style="max-width: 105px;">
                                  <a aria-current="page" href="signin.php">Log Out</a>
                              </div>
                              <!-- endregion -->
                          </div>
                      </div>
              </nav>
          </header>

          <main style="background-color: #f3f2ef;;" class="pt-3">


              <script>

              </script>