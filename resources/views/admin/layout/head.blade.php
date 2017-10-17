<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
 <!-- Favicon-->
    <link rel="icon" href="{{ asset('images/payatas.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{asset('bootstrap-daterangepicker-master/daterangepicker.css')}}" />

    <link href="{{asset('bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

    <link href="{{asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('css/themes/theme-blue-grey.css')}}" rel="stylesheet" />
    
    <style>
        .btn-space{
            margin-right:5px;
        }
        .imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;

}
img.avatar {
    width: 40%;
    border-radius: 50%;
}
label{
  size:16px;
}
@font-face {
   font-family: 'Material Icons';
   font-style: normal;
   font-weight: 400;
   src: url(iconfont/MaterialIcons-Regular.eot); /* For IE6-8 */
   src: local('Material Icons'),
        local('MaterialIcons-Regular'),
        url({{asset('iconfont/MaterialIcons-Regular.woff2')}}) format('woff2'),
        url({{asset('iconfont/MaterialIcons-Regular.woff')}}) format('woff'),
        url({{asset('iconfont/MaterialIcons-Regular.woff2')}}) format('truetype');
}

.material-icons {
  font-family: 'Material Icons';
  font-weight: normal;
  font-style: normal;
  font-size: 24px;  /* Preferred icon size */
  display: inline-block;
  line-height: 1;
  text-transform: none;
  letter-spacing: normal;
  word-wrap: normal;
  white-space: nowrap;
  direction: ltr;

  /* Support for all WebKit browsers. */
  -webkit-font-smoothing: antialiased;
  /* Support for Safari and Chrome. */
  text-rendering: optimizeLegibility;

  /* Support for Firefox. */
  -moz-osx-font-smoothing: grayscale;

  /* Support for IE. */
  font-feature-settings: 'liga';
}
@media print {  
       page {
            size: 13in 8.5in;
                    
            margin: .1in, .1in, .1in, .1in;
        }
        canvas{
              transform: scale(1);
        }
        /*body{
          transform: scale(1);
        }*/
        table{
        page-break-after: always;
        page-break-inside: avoid;
        break-inside: avoid;
       }
        


}
</style>