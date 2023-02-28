<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="photography">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/" type="image/x-icon">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.72.0">
    <title>Mobile Photographer</title>

    <link rel="canonical" href="https://v5.getbootstrap.com/docs/5.0/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <style>
        ::-webkit-scrollbar {
            width: 5px;
        }


        ::-webkit-scrollbar-thumb {
            background-color: red;
        }

        ::-webkit-scrollbar-track {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            display: flex;
            /* letter-spacing: .1rem; */

            text-decoration: none;
            font-family: 'Oswald', sans-serif;
            font-variant: small-caps;
            /* border: 1px solid; */
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            /* Behind the navbar */
            padding: 48px 0 0;
            /* Height of navbar */
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollable contents if viewport is shorter than content. */
        }

        .dropdownmenu {
            max-height: 15rem;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .dropdown-items:hover {
            background-color: black !important;
        }

        .allheading {
            font-family: 'Comfortaa', cursive;
        }

        .grow {
            animation: grow-ani .5s;
        }

        @keyframes grow-ani {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        body {
            position: relative;
            overflow-x: hidden;
        }

        body::after {
            content: "";
            min-height: 100vh;
            width: 100vw;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            opacity: .1;
            background-image: url('https://images.pexels.com/photos/6177645/pexels-photo-6177645.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260');
            background-position: center;
            background-repeat: repeat;
            background-size: fill;
            position: absolute;
            z-index: -1;
        }
    </style>

</head>

<body>

    <script>
        if (window.screen.width < 350) {
            location.replace("<?= base_url() ?>maincontroller/err");
        }
    </script>