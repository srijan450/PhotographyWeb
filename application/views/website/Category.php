<main class="col-md-9 ml-sm-auto col-lg-10 p-md-4 gallery">

    <?php
    foreach ($data as $row) {

    ?>

        <div class="image">
            <img src="<?= $row['path'] ?>" class="card-img-top openDialog" alt="<?= $row['title'] ?>" accesskey="<?= $row['order'] ?>" data-category="<?= $row['category'] ?>">

        </div>
    <?php
    }

    ?>

    <style>
        .gallery {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            place-items: center;
            grid-row-gap: 40px;
            grid-column-gap: 40px;
            margin: 20px 0px 20px 0px;
        }

        .image {
            width: 19rem;
            height: 400px;
            overflow-y: hidden;
            background-image: linear-gradient(360deg, #fff, #55595c);
            box-shadow: 2px 2px 20px black;
        }

        .image img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .hoverin {
            animation: image-hover 500ms linear forwards;
        }



        @keyframes image-hover {
            from {
                transform: scale(1)
            }

            to {
                transform: scale(.9)
            }
        }

        .hoverout {
            /* animation: name duration timing-function delay iteration-count direction fill-mode; */
            animation: img-hover-out 500ms linear 2s both;
        }

        @keyframes img-hover-out {
            from {
                transform: scale(.9)
            }

            to {
                transform: scale(1)
            }
        }

        @media only screen and (max-width: 600px) {
            .gallery {
                grid-template-columns: 1fr;
            }

            .image {
                width: 100%;
            }
        }
    </style>
    <script>
        let active = false;

        $('img').mouseenter(function(e) {
            if (!active) {
                e.target.setAttribute('class', "hoverin")
                // e.target.removeAttribute('class', "hoverout")
                setTimeout(() => {
                    e.target.setAttribute('class', "hoverout")
                }, 500);
                setTimeout(() => {
                    active = false;
                }, 2000);
                console.log(active)
            }
        });
    </script>



    <script>
        const data = {
            category: '',
            title: '',
            order: '',
            path: ''
        };
        $('.openDialog').click(function(e) {
            e.preventDefault();
            let src = e.target.src;
            data.category = e.target.getAttribute('data-category');
            data.title = e.target.alt;
            data.order = e.target.accessKey;
            data.path = src;

            document.getElementById('download').href = document.getElementById('dwnurl').value + '?file=' + src + '&name=' + e.target.alt;
            document.getElementById('imgset').src = src;
            document.getElementById('imglinkset').href = src;
            document.getElementById('staticBackdropLabel').innerHTML = e.target.alt;
            $('#staticBackdrop').modal("show");

        });

        $(document).ready(function() {
            document.getElementById("download").onclick = () => {
                $('#staticBackdrop').modal("hide");
            }
        });
    </script>


</main>
</div>
</div>


<input type="hidden" id="dwnurl" value="<?= base_url() ?>secondary/downloadfile" />
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title allheading text-capitalize" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-img">
                <a href="#" id="imglinkset" target="_blank ">
                    <img src="#" class="card-img-top" id="imgset" alt="#">
                    <input type="hidden" value="#" id="orderpos" />
                </a>

            </div>


            <?php if (isset($_SESSION['adminonline'])) { ?>
                <div class="modal-footer justify-content-evenly">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="<?= base_url() ?>secondary/downloadfile?file=" id="download" class="btn btn-primary">Download</a>
                    <button class="btn btn-warning" id="editit" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Edit</button>
                    <button type="button" class="btn btn-danger" id="dltbtn">Delete</button>
                </div>

            <?php } else { ?>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="<?= base_url() ?>secondary/downloadfile?file=" id="download" class="btn btn-primary">Download</a>
                </div>

            <?php } ?>

        </div>

    </div>
</div>
<!-- mod - 2 -->
<?php if (isset($_SESSION['adminonline'])) { ?>
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <h3 class="text-center text-dark mt-0">Edit</h3> -->
                    <form id="submit" method="POST">
                        <!-- <p class="text-center" id="form-err">&nbsp;</p> -->

                        <div class="form-floating mb-4 ">
                            <input type="text" id="category" name="category" class="form-control" placeholder="Category">
                            <label for="category">Category <i class="fa fa-tag" aria-hidden="true"></i></label>

                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" id="title" name="title" class="form-control" placeholder="Title">
                            <label for="title">Title <i class="fa fa-edit" aria-hidden="true"></i></label>
                        </div>


                        <div class="form-floating mb-4">
                            <input type="number" id="orderby" name="order" class="form-control" placeholder="position/order (optional)">
                            <label for="orderby">Title <i class="fa fa-sort" aria-hidden="true"></i></label>
                        </div>


                        <div class="input-group justify-content-around">

                            <input type="submit" class="form-control btn btn-primary" value="Change">

                        </div>

                        <input type="hidden" id="url" value="<?= base_url() ?>Secondary/editUploaded" />
                        <input type="hidden" id="url2" value="<?= base_url() ?>Secondary/deleteUploaded" />
                    </form>
                </div>
                <div class="modal-footer" id="closebtn">
                    <button class="form-control btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const CATE = document.getElementById('category');
        const TITLE = document.getElementById('title');
        const ORDER = document.getElementById('orderby');

        document.getElementById('editit').onclick = () => {
            // console.log(data)
            CATE.value = data.category;
            TITLE.value = data.title;
            ORDER.value = data.order;
        }

        function getval(str) {
            return document.getElementById(str).value;
        }
        $('#submit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: getval('url'),
                beforeSend: function() {
                    $('#closebtn').hide(500);
                },
                data: {
                    category: getval('category'),
                    title: getval('title'),
                    order: getval('orderby'),
                    path: data.path
                },
                success: function(response) {
                    $('#closebtn').show(500);
                    $('#exampleModalToggle2').modal("hide");
                }
            });

        });
    </script>

    <script>
        document.getElementById('dltbtn').onclick = () => {
            $.post(document.getElementById('url2').value, {
                    patha: data.path
                },
                function(data, textStatus, jqXHR) {
                    $('#staticBackdrop').modal("hide");
                    location.reload();
                },

            );
        }
    </script>

<?php } ?>


<style>
    #modal-img {
        max-height: 70vh;
        background-image: linear-gradient(#fff, #55595c, #fff);
    }

    #modal-img img {
        max-height: 70vh;
        /* width: 100%; */
        object-fit: scale-down;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>