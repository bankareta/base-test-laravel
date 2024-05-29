<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="https://www.floweradvisor.com.ph/favicon.ico">
    
    <!-- Site Properties -->
    <title>Homepage - Semantic</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/reset.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/site.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/container.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/grid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/image.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/menu.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/divider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/dropdown.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/segment.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/button.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/list.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/sidebar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/semantic-ui/components/transition.css') }}">
    
    <style type="text/css">
        
        .hidden.menu {
            display: none;
        }
        
        .masthead.segment {
            min-height: 700px;
            padding: 1em 0em;
        }
        .masthead .logo.item img {
            margin-right: 1em;
        }
        .masthead .ui.menu .ui.button {
            margin-left: 0.5em;
        }
        .masthead h1.ui.header {
            margin-top: 3em;
            margin-bottom: 0em;
            font-size: 4em;
            font-weight: normal;
        }
        .masthead h2 {
            font-size: 1.7em;
            font-weight: normal;
        }
        
        .ui.vertical.stripe {
            padding: 8em 0em;
        }
        .ui.vertical.stripe h3 {
            font-size: 2em;
        }
        .ui.vertical.stripe .button + h3,
        .ui.vertical.stripe p + h3 {
            margin-top: 3em;
        }
        .ui.vertical.stripe .floated.image {
            clear: both;
        }
        .ui.vertical.stripe p {
            font-size: 1.33em;
        }
        .ui.vertical.stripe .horizontal.divider {
            margin: 3em 0em;
        }
        
        .quote.stripe.segment {
            padding: 0em;
        }
        .quote.stripe.segment .grid .column {
            padding-top: 5em;
            padding-bottom: 5em;
        }
        
        .footer.segment {
            padding: 5em 0em;
        }
        
        .secondary.pointing.menu .toc.item {
            display: none;
        }
        
        @media only screen and (max-width: 700px) {
            .ui.fixed.menu {
                display: none !important;
            }
            .secondary.pointing.menu .item,
            .secondary.pointing.menu .menu {
                display: none;
            }
            .secondary.pointing.menu .toc.item {
                display: block;
            }
            .masthead.segment {
                min-height: 350px;
            }
            .masthead h1.ui.header {
                font-size: 2em;
                margin-top: 1.5em;
            }
            .masthead h2 {
                margin-top: 0.5em;
                font-size: 1.5em;
            }
        }
        
        
    </style>
    <script src="{{ asset('plugins/jQueryUI/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('plugins/semantic-ui/components/visibility.js') }}"></script>
    <script src="{{ asset('plugins/semantic-ui/components/sidebar.js') }}"></script>
    <script src="{{ asset('plugins/semantic-ui/components/transition.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.masthead')
            .visibility({
                once: false,
                onBottomPassed: function() {
                    $('.fixed.menu').transition('fade in');
                },
                onBottomPassedReverse: function() {
                    $('.fixed.menu').transition('fade out');
                }
            })
            ;
            
            // create sidebar and attach to menu open
            $('.ui.sidebar')
            .sidebar('attach events', '.toc.item')
            ;
            
        })
        ;
        function copyText(el) {
            var content = 'HALLOW10';
            navigator.clipboard.writeText(content).then(function() {
                var text = jQuery(el).html();
                jQuery(el).html(jQuery(el).data('message'));
                setTimeout(function() {
                    jQuery(el).html(text);
                }, 2000);
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
            });
        }
    </script>
</head>
<body>
    <div class="ui large top fixed hidden menu">
        <div class="ui container">
            <a class="active item">Home</a>
            <a class="item">Work</a>
            <a class="item" href="https://www.floweradvisor.com.ph/flowersphilippines" target="_blank">Company PH</a>
            <a class="item">Careers</a>
            <div class="right menu">
                @if ($login)
                    <div class="item">
                        <a class="ui button" href="{{ url('dashboard') }}">Admin Panel</a>
                    </div>
                    <div class="item">
                        <a class="ui primary button" href="{{ route('logout') }}">Log Out</a>
                    </div>
                @else
                    <div class="item">
                        <a class="ui button" href="{{ route('login') }}">Log in</a>
                    </div>
                    <div class="item">
                        <a class="ui primary button" href="{{ route('register') }}">Sign Up</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Sidebar Menu -->
    <div class="ui vertical inverted sidebar menu">
        <a class="active item">Home</a>
        <a class="item">Work</a>
        <a class="item" href="https://www.floweradvisor.com.ph/flowersphilippines" target="_blank">Company PH</a>
        <a class="item">Careers</a>
        @if ($login)
            <a class="item" href="{{ url('dashboard') }}">Admin Panel</a>
            <a class="item" href="{{ route('logout') }}">Log Out</a>
        @else
            <a class="item" href="{{ route('login') }}">Login</a>
            <a class="item" href="{{ route('register') }}">Signup</a>
        @endif
        <a class="item" href="{{ route('login') }}">Login</a>
        <a class="item" href="{{ route('register') }}">Signup</a>
    </div>
    
    
    <!-- Page Contents -->
    <div class="pusher">
        <div class="ui inverted vertical masthead center aligned segment">
            
            <div class="ui container">
                <div class="ui large secondary inverted pointing menu">
                    <a class="toc item">
                        <i class="sidebar icon"></i>
                    </a>
                    <a class="active item">Home</a>
                    <a class="item">Work</a>
                    <a class="item" href="https://www.floweradvisor.com.ph/flowersphilippines" target="_blank">Company PH</a>
                    <a class="item">Careers</a>
                    <div class="right item">
                        @if ($login)
                            <a class="ui inverted button" href="{{ url('dashboard') }}">Admin Panel</a>
                            <a class="ui inverted button" href="{{ route('logout') }}">Log Out</a>
                        @else
                            <a class="ui inverted button" href="{{ route('login') }}">Log in</a>
                            <a class="ui inverted button" href="{{ route('register') }}">Sign Up</a>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="ui text container">
                <h1 class="ui inverted header">
                    <a onclick="copyText(this)"><i class="copy icon"></i></a> {{ config('app.name') }}
                </h1>
                <h2>Do whatever you want when you want to.</h2>
                <a href="https://itunes.apple.com/us/app/online-florist-floweradvisor/id1185232807" target="_blank">
                    <i class="huge apple icon"></i>
                </a>
            </div>
            
        </div>
        <div class="ui vertical stripe quote segment">
            <div class="ui equal width stackable internally celled grid">
                <div class="center aligned row">
                    <div class="column">
                        <h3>"What a Company"</h3>
                        <p>That is what they all say about us</p>
                    </div>
                    <div class="column">
                        <h3>"I shouldn't have gone with their competitor."</h3>
                        <p>That is what they all say about us</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="ui vertical stripe segment">
            <div class="ui text container">
                <h3 class="ui header">Breaking The Grid, Grabs Your Attention</h3>
                <p>Instead of focusing on content creation and hard work, we have learned how to master the art of doing nothing by providing massive amounts of whitespace and generic content that can seem massive, monolithic and worth your attention.</p>
                <a class="ui large button">Read More</a>
                <h4 class="ui horizontal header divider">
                    <a href="#">Case Studies</a>
                </h4>
                <h3 class="ui header">Did We Tell You About Our Bananas?</h3>
                <p>Yes I know you probably disregarded the earlier boasts as non-sequitur filler content, but its really true. It took years of gene splicing and combinatory DNA research, but our bananas can really dance.</p>
                <a class="ui large button">I'm Still Quite Interested</a>
            </div>
        </div>
        
        
        <div class="ui inverted vertical footer segment">
            <div class="ui container">
                <div class="ui stackable inverted divided equal height stackable grid">
                    <div class="three wide column">
                        <h4 class="ui inverted header">About</h4>
                        <div class="ui inverted link list">
                            <a href="#" class="item">Sitemap</a>
                            <a href="#" class="item">Contact Us</a>
                            <a href="#" class="item">Religious Ceremonies</a>
                            <a href="#" class="item">Gazebo Plans</a>
                        </div>
                    </div>
                    <div class="three wide column">
                        <h4 class="ui inverted header">Services</h4>
                        <div class="ui inverted link list">
                            <a href="#" class="item">Banana Pre-Order</a>
                            <a href="#" class="item">DNA FAQ</a>
                            <a href="#" class="item">How To Access</a>
                            <a href="#" class="item">Favorite X-Men</a>
                        </div>
                    </div>
                    <div class="seven wide column">
                        <h4 class="ui inverted header">Copyright © 2024</h4>
                        <p>
                            <a href="https://www.floweradvisor.com.ph" target="_blank" rel="noopener noreferrer">
                                <img src="https://aldmic.com/images/flower-advisor-logo.png" class="image" style="width:16em">
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
