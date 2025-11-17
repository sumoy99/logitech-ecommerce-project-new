<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $meta_title }}</title>
<meta name="description" content="{{ $meta_desc }}">
<meta name="keywords" content="{{ $meta_keywords }}">
<meta name="author" content="Logitech">

<link rel="canonical" href="{{ url()->current() }}">

<meta property="og:type" content="website">
<meta property="og:title" content="{{ $meta_title }}">
<meta property="og:description" content="{{ $meta_desc}}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $image ?? asset('assets/backend/assets/img/placeholder.png') }}">
<meta property="og:site_name" content="Logitech">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $meta_title }}">
<meta name="twitter:description" content="{{ $meta_desc }}">
<meta name="twitter:image" content="{{ $image ?? asset('assets/backend/assets/img/placeholder.png') }}">
<meta name="publisher" content="Logitech">
<meta name="robots" content="{{ $robots ?? 'index, follow' }}">
<meta name="googlebot" content="{{ $googlebot ?? 'index, follow' }}">
<meta name="bingbot" content="{{ $bingbot ?? 'index, follow' }}">
