<div wire:loading.delay>
    <div class="loading-page">
        <div class="la-ball-spin-rotate la-dark la-3x">
            <div></div>
            <div></div>
        </div>
    </div>
</div>

@push('css')
    <style>
        .loading-page {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #d9d5d5b8;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 10000;
        }

        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
        .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
            background-color: #17a2b8;
        }

        .btn-info.focus,
        .btn-info:focus,
        .btn-info:hover,
        .badge-info {
            background-color: #17a2b8;
            border: #17a2b8;
        }

        .sidebar-photo {
            width: 110px !important;
            transform: rotate(-8deg);
            border: 10px solid transparent;
        }

        [class*=sidebar-dark] .brand-link {
            border-bottom: none;
        }


        /*!
     * Load Awesome v1.1.0 (http://github.danielcardoso.net/load-awesome/)
     * Copyright 2015 Daniel Cardoso <@DanielCardoso>
     * Licensed under MIT
     */

        .la-ball-spin-rotate,
        .la-ball-spin-rotate>div {
            position: relative;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .la-ball-spin-rotate {
            display: block;
            font-size: 0;
            color: #fff;
        }

        .la-ball-spin-rotate.la-dark {
            color: #333;
        }

        .la-ball-spin-rotate>div {
            display: inline-block;
            float: none;
            background-color: currentColor;
            border: 0 solid currentColor;
        }

        .la-ball-spin-rotate {
            width: 32px;
            height: 32px;
            -webkit-animation: ball-spin-rotate 2s infinite linear;
            -moz-animation: ball-spin-rotate 2s infinite linear;
            -o-animation: ball-spin-rotate 2s infinite linear;
            animation: ball-spin-rotate 2s infinite linear;
        }

        .la-ball-spin-rotate>div {
            position: absolute;
            top: 0;
            width: 60%;
            height: 60%;
            border-radius: 100%;
            -webkit-animation: ball-spin-bounce 2s infinite ease-in-out;
            -moz-animation: ball-spin-bounce 2s infinite ease-in-out;
            -o-animation: ball-spin-bounce 2s infinite ease-in-out;
            animation: ball-spin-bounce 2s infinite ease-in-out;
        }

        .la-ball-spin-rotate>div:last-child {
            top: auto;
            bottom: 0;
            -webkit-animation-delay: -1.0s;
            -moz-animation-delay: -1.0s;
            -o-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }

        .la-ball-spin-rotate.la-sm {
            width: 16px;
            height: 16px;
        }

        .la-ball-spin-rotate.la-2x {
            width: 64px;
            height: 64px;
        }

        .la-ball-spin-rotate.la-3x {
            width: 96px;
            height: 96px;
        }


        /*
      * Animations
      */

        @-webkit-keyframes ball-spin-rotate {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-moz-keyframes ball-spin-rotate {
            100% {
                -moz-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-o-keyframes ball-spin-rotate {
            100% {
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes ball-spin-rotate {
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-webkit-keyframes ball-spin-bounce {

            0%,
            100% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            50% {
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @-moz-keyframes ball-spin-bounce {

            0%,
            100% {
                -moz-transform: scale(0);
                transform: scale(0);
            }

            50% {
                -moz-transform: scale(1);
                transform: scale(1);
            }
        }

        @-o-keyframes ball-spin-bounce {

            0%,
            100% {
                -o-transform: scale(0);
                transform: scale(0);
            }

            50% {
                -o-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes ball-spin-bounce {

            0%,
            100% {
                -webkit-transform: scale(0);
                -moz-transform: scale(0);
                -o-transform: scale(0);
                transform: scale(0);
            }

            50% {
                -webkit-transform: scale(1);
                -moz-transform: scale(1);
                -o-transform: scale(1);
                transform: scale(1);
            }
        }

    </style>
@endpush
