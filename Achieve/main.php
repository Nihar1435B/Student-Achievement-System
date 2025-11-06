        <!-- Checking Session -->
        <?php

        include "function.php";
        $action = "";
        session_start();
        if (!isset($_SESSION["user"])) {
            header("Location: signin.php", true, 303);
        } else {
            getParams();
            if ($action  == "sharepost"  &&  strlen($postcontent) > 0) {
                try {
                    $sql = "INSERT INTO `post`(`content`, `userid`) VALUES ('" . $postcontent . "',
                        '" . $userid . "')";
                    $conn->exec($sql);
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                header("Location: main.php", true, 303);
            }
            include "header.php";
        ?>
            <!-- Checking Session -->

            <div class="d-flex flex-md-row flex-column m-auto justify-content-around testsize h-100">

                <!-- Left Bar -->
                <div class="d-flex flex-column" style="width: 225px; font-size: 12px;">
                    <div style="border-radius: 0.8rem; width: 225px;" class="bgwhite ">
                        <div class="text-center">
                            <img class="d-flex" style="border-radius: 0.8rem 0.8rem 0 0;" src="img/headerphoto.jpg" width="100%" alt="">

                            <img style="width: 62px; height: 62px; margin-top: -28px; object-fit: cover;" src="img/logo.jpg" class="rounded-circle" />
                            <h6 class="mt-4 mb-0">Welcome, <?php echo $_SESSION["user"]["fname"]; ?>!</h6>
                            <a style="font-size: 12px; text-decoration: none;" href="#">Add a photo</a>
                        </div>
                        <hr />
                        <div>
                            <a href="#" class="d-flex justify-content-between">
                                <p style="font-size: 12px;" class="mx-2">Connections</p>
                                <p style="font-size: 12px;" class="mx-2">2</p>
                            </a>
                        </div>
                        <hr />
                        <div class="mb-3">
                            <h6 align="center">Calendar</h6>
                            <div id="calendar"></div>
                        </div>

                    </div>

                    
                </div>
                <!-- Left Bar -->

                <!-- Center Bar -->
                <div class="align-self-start  mx-3" style="width: 540px; border-radius: 0.8rem;">
                    <!-- Share Post -->
                    <div class="bgwhite mb-3" style="border-radius: 0.8rem;">
                        <div class="d-flex">
                            <img src="img/logo.jpg" class="rounded-circle m-3" style="width: 45px; height:45px;" />
                            <input type="submit" class="w-100 h-25 py-2 my-3 mx-1 bgwhite px-2" style="text-align: left; border-radius: 50px; border: 1px solid; font-size: 14px;" value="Ask your netwotk for advise" />
                        </div>
                        <div class="d-flex justify-content-around pb-2" style="font-size: 14px;">
                            <button class="d-flex p-0 border-0 bg-transparent" onclick="createpost(1);">
                                <svg fill="#378fe9" viewBox="1 0 25 25" style="width: 25px; height: 25px;">
                                    <path d="M19 4H5a3 3 0 00-3 3v10a3 3 0 003 3h14a3 3 0 003-3V7a3 3 0 00-3-3zm1 13a1 1 0 01-.29.71L16 14l-2 2-6-6-4 4V7a1 1 0 011-1h14a1 1 0 011 1zm-2-7a2 2 0 11-2-2 2 2 0 012 2z">
                                    </path>
                                </svg>
                                <p>Photo</p>
                            </button>
                            <button class="d-flex p-0 border-0 bg-transparent" onclick="createpost(1);">
                                <svg fill="#5f9b41" viewBox="1 0 25 25" style="width: 25px; height: 25px;">
                                    <path d="M19 4H5a3 3 0 00-3 3v10a3 3 0 003 3h14a3 3 0 003-3V7a3 3 0 00-3-3zm-9 12V8l6 4z">
                                    </path>
                                </svg>
                                <p>Video</p>
                            </button>
                            <button class="d-flex p-0 border-0 bg-transparent" onclick="createpost(1);">
                                <svg fill="#c37d16" viewBox="1 0 25 25" style="width: 25px; height: 25px;">
                                    <path d="M3 3v15a3 3 0 003 3h12a3 3 0 003-3V3zm13 1.75A1.25 1.25 0 1114.75 6 1.25 1.25 0 0116 4.75zm-8 0A1.25 1.25 0 116.75 6 1.25 1.25 0 018 4.75zM19 18a1 1 0 01-1 1H6a1 1 0 01-1-1V9h14zm-5.9-3a1 1 0 00-1-1H12a3.12 3.12 0 00-1 .2l-1-.2v-3h3.9v1H11v1.15a3.7 3.7 0 011.05-.15 1.89 1.89 0 012 1.78V15a1.92 1.92 0 01-1.84 2H12a1.88 1.88 0 01-2-1.75 1 1 0 010-.25h1a.89.89 0 001 1h.1a.94.94 0 001-.88z">
                                    </path>
                                </svg>
                                <p>Event</p>
                            </button>
                            <button class="d-flex p-0 border-0 bg-transparent" onclick="createpost(1);">
                                <svg fill="#e16745" viewBox="1 0 25 25" style="width: 25px; height: 25px;">
                                    <path d="M21 3v2H3V3zm-6 6h6V7h-6zm0 4h6v-2h-6zm0 4h6v-2h-6zM3 21h18v-2H3zM13 7H3v10h10z">
                                    </path>
                                </svg>
                                <p>Write Article</p>
                            </button>
                        </div>
                    </div>
                    <!-- Share Post -->
                    <?php

                    $stmt = $conn->prepare("SELECT * FROM `following` WHERE `userid` = " . $_SESSION["user"]["userid"]);
                    $stmt->execute();
                    if ($stmt->rowCount()  > 0) {
                        $sql =  "SELECT * FROM `post` WHERE `userid` IN( ";
                        foreach ($stmt->fetchAll() as $k => $v) {
                            if ($k + 1 == $stmt->rowCount()) {
                                $sql .= $v["followingid"] . ")";
                            } else {
                                $sql .=  $v["followingid"] . ", ";
                            }
                        }

                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        foreach ($stmt->fetchAll() as $k => $v) {
                            $stmt2 = $conn->prepare("SELECT * FROM `user` WHERE `id` = " . $v["userid"]);
                            $stmt2->execute();
                            foreach ($stmt2->fetchAll() as $k2 => $v2) {
                                $postfname = $v2["firstname"];
                                $postlname = $v2["lastname"];
                            }

                            echo '<div class="bgwhite w-100 mb-3" style="border-radius: 0.8rem;" >
                                  <div class="mt-3 d-flex">
                                      <img src="img/logo.jpg" class="rounded-circle m-3" style="width: 45px; height:45px;" />
                                      <div class="d-flex mt-3 m-0 flex-column">
                                          <h6 class="m-0">' . $postfname . ' ' . $postlname . '</h6>
                                          <span style="font-size: 12px;">Full Stack Dev</span>
                                      </div>
                                  </div>
                                  <div id="post"  class="px-3 pb-3" style="text-align: justify; overflow:auto;">' . $v["content"] . '</div>
                              </div>';
                        }
                    }
                    ?>
                </div>
                <!-- Center Bar -->

                <!-- Right Bar -->
                


                         

                    
                <!-- Right Bar -->
                </div>

            </body>

            <!-- SharePost Modal -->
            <div id="modal">
                <div id="win">
                    <form method="post" class="text-center">
                        <button id="close" onclick="createpost(0)">Cancel</button>
                        <input type="hidden" name="action" value="sharepost" />
                        <input type="hidden" name="userid" value="<?php echo $_SESSION["user"]["userid"] ?>" />
                        <textarea name="postcontent" class="h-100" style="height: 100vh;"></textarea>
                        <input type="submit" value="Share" class="my-2" />
                    </form>
                </div>
            </div>
            <!-- SharePost Modal -->

            <script>
                window.onload = function() {
                    let options = document.getElementById("options");
                    let search = document.getElementById('headersearch');
                    let id = 0;
                    let id2 = 0;

                    var startProductBarPos = -1;

                    window.onscroll = function() {
                        var bar = document.getElementById('sticky1');
                        var bar2 = document.getElementById('sticky2');
                        var test = bar.getBoundingClientRect();
                        if (startProductBarPos < 0) startProductBarPos = findPosY(bar);

                        if (pageYOffset > startProductBarPos - 60) {
                            bar.style.position = 'fixed';
                            bar.style.top = '50px';
                            bar2.style.position = 'fixed';
                            bar2.style.top = '50px';
                        } else {
                            bar.style.position = 'relative';
                            bar.style.top = '0px';
                            bar2.style.position = 'relative';
                            bar2.style.top = '0px';
                        }

                    };

                    function findPosY(obj) {
                        var curtop = 0;
                        if (typeof(obj.offsetParent) != 'undefined' && obj.offsetParent) {
                            while (obj.offsetParent) {
                                curtop += obj.offsetTop;
                                obj = obj.offsetParent;
                            }
                            curtop += obj.offsetTop;
                        } else if (obj.y)
                            curtop += obj.y;
                        return curtop;
                    }


                    search.addEventListener("keyup", event => {
                        options.innerHTML = "";

                        let formdata = new FormData();
                        formdata.append('text', search.value);

                        if (search.value != "") {
                            options.style.display = "flex";
                            $.ajax({
                                type: "POST",
                                url: "getusers.php",
                                data: formdata,
                                contentType: false,
                                processData: false,
                                dataType: 'json',
                                success: function(data) {
                                    for (let i in data) {
                                        let a = document.createElement('a');
                                        a.text = data[i]["firstname"] + " " + data[i]["lastname"];
                                        a.href = "user.php?userid=" + data[i]["id"];
                                        options.appendChild(a);
                                    }
                                }
                            })
                        } else {
                            options.style.display = "none";
                        }
                    });
                }

                $(() => {
                    $('.flexItem').hover(
                        function() {
                            $(this).addClass('overlay');
                            $(this).find('svg').css('fill', 'black');
                        },
                        function() {
                            $(this).removeClass('overlay');
                            $(this).find('svg').css('fill', '#00000099');
                            $(this).css();
                        }
                    );

                    function make_sticky(id) {
                        var e = $(id);
                        var w = $(window);
                        $('<div/>').insertBefore(id);
                        $('<div/>').hide().css('height', e.outerHeight()).insertAfter(id);
                        var n = e.next();
                        var p = e.prev();

                        function sticky_relocate() {
                            var window_top = w.scrollTop();
                            var div_top = p.offset().top;
                            if (window_top > div_top) {
                                e.addClass('sticky');
                                n.show();
                            } else {
                                e.removeClass('#sticky');
                                n.hide();
                            }
                        }
                        w.scroll(sticky_relocate);
                        sticky_relocate();
                    }

                    make_sticky("test1")
                })

                function createpost($flag = 0) {
                    document.querySelector("#modal").style.display = $flag ? "flex" : "none";
                }



                tinymce.init({
                    content_css: 'figure.image { width: 100%; }',
                    selector: 'textarea',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
                    toolbar_mode: 'floating image',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    file_picker_types: 'image',
                    image_dimensions: false,
                    body_class: 'myclass',
                    //  image_dimensions: false,
                    //  object_resizing: false,

                    file_picker_callback: (cb, value, meta) => {
                        const input = document.createElement('input');
                        input.setAttribute('type', 'file');
                        input.setAttribute('accept', 'image/*');

                        input.addEventListener('change', (e) => {
                            const file = e.target.files[0];
                            let formdata = new FormData();
                            formdata.append('image', file);
                            $(() => {
                                $.ajax({
                                    type: "POST",
                                    url: "sharepost.php",
                                    data: formdata,
                                    contentType: false,
                                    processData: false,
                                    dataType: 'json',
                                    success: function(data) {
                                        console.log("successfully compledted");
                                        console.log(file);

                                        const reader = new FileReader();
                                        reader.addEventListener('load', () => {
                                            const id = 'blobid' + (new Date()).getTime();
                                            const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                            const base64 = reader.result.split(',')[1];
                                            const blobInfo = blobCache.create(id, file, base64);
                                            console.log(blobInfo.blob());
                                            blobCache.add(blobInfo);
                                            cb(data["imagename"], {
                                                title: file.name
                                            });
                                        });
                                        reader.readAsDataURL(file);
                                        console.log(reader.result);
                                        console.log("reader.result");
                                    }
                                });
                            })


                        });
                        input.click();
                    },
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
                });
                session_destroy();

            </script>

            <script src="main.js"></script>
        <?php  } ?>