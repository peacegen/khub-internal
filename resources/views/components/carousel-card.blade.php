
<div>
    <style>
        /* Container holding the image and the text */
        .container {
        position: relative;
        text-align: center;
        color: white;
        }

        /* Centered text */
        .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        }
    </style>
<div class="container">

    <img src={{ $background }}>
    <div class="centered">{{ $content }}</div>
</div>
</div>
