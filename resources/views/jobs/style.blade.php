<style>
    .badge:hover {
        cursor: pointer;
    }

    .btn {
        border-radius: 3px;
        padding: 0.5rem 0.8rem;
    }

    .body-content {
        padding-top: 0px;
    }

    .body-wrap {
        min-height: auto;
    }

    .loading-wrap {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 99999;
        background-color: rgb(255, 255, 255);
        display: none
    }

    .loading-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .title-banner {
        font-size: 20px;
        font-weight: bold
    }

    .carousel-caption {
        font-size: 20px;
        font-weight: bold;
        border-radius: 5px;
        background-color: rgba(0, 0, 0, 0.6);
        padding: 0.5rem;
    }

    .caption-2 {
        padding: 1rem 0.5rem;
    }

    /* media screen phone */
    @media screen and (max-width: 576px) {
        .title-banner {
            font-size: 11px;
        }

        .carousel-caption {
            font-size: 11px;
        }
    }
</style>
