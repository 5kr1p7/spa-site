<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="//unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,500,700,900|Material+Icons' rel="stylesheet">

        <title>Laravel</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif !important;
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
    <div id="app">
    	<v-app>
            <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
					<toolbar-component :user="{{ json_encode($auth_user) }}"></toolbar-component>
                @endif

        	    <v-content>
                    <v-container fluid>
                	    <div class="content">
        	        	  <router-view></router-view>
                	    </div>
                	</v-container>
                </v-content>
                <v-footer app height="auto">
                    <v-layout justify-center row wrap>
                	    <v-flex primary lighten-2 py-3 text-xs-center white--text xs12>
                	        <strong>Laravel</strong>
                		</v-flex>
                	</v-layout>
                </v-footer>
            </div>
        </v-app>
    </div>
        <script src="{{ mix('js/app.js') }}">
        <script src="//cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
    </body>
</html>
