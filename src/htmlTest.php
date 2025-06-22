
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smart Job Matcher</title>
  <link rel="icon" type="image/x-icon" href="/reasources/baj_logo.svg">
  <link rel="stylesheet" href="/reasources/css/uikit.min.css" />
  <script src="/reasources/js/uikit.min.js"></script>
  <script src="/reasources/js/uikit-icons.min.js"></script>
  <script src="/reasources/js/uikit.js"></script>
</head>
<body>

    <div class="uk-margin" uk-margin>

        <div class="uk-inline">
            <!-- <a uk-icon="heart"></a> -->
            <a uk-icon="more"></a>
            <div uk-dropdown="mode: click; animation: slide-top; animate-out: true; duration: 500">
                <ul class="uk-nav uk-dropdown-nav">
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li><a href="#">Item</a></li>
                    <li class="uk-nav-header">Header</li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#">Item</a></li>
                </ul>
            </div>
        </div>

        <div class="uk-inline">
            <button class="uk-button uk-button-default" type="button">Reveal Top</button>
            <div uk-dropdown="animation: reveal-top; animate-out: true; duration: 700">
                <ul class="uk-nav uk-dropdown-nav">
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li><a href="#">Item</a></li>
                    <li class="uk-nav-header">Header</li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#">Item</a></li>
                </ul>
            </div>
        </div>

        <div class="uk-inline">
            <button class="uk-button uk-button-default" type="button">Slide Left</button>
            <div uk-dropdown="animation: slide-left; animate-out: true; duration: 700">
                <ul class="uk-nav uk-dropdown-nav">
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li><a href="#">Item</a></li>
                    <li class="uk-nav-header">Header</li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#">Item</a></li>
                </ul>
            </div>
        </div>

        <div class="uk-inline">
            <button class="uk-button uk-button-default" type="button">Reveal Left</button>
            <div uk-dropdown="animation: reveal-left; animate-out: true; duration: 700">
                <ul class="uk-nav uk-dropdown-nav">
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li><a href="#">Item</a></li>
                    <li class="uk-nav-header">Header</li>
                    <li><a href="#">Item</a></li>
                    <li><a href="#">Item</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#">Item</a></li>
                </ul>
            </div>
        </div>

    </div>
</body>