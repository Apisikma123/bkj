@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'url' => null,
    'type' => 'website',
    'breadcrumbs' => []
])

@php
    // Default Settings (Ideally fetched from database Settings/SeoMeta models)
    $siteName = 'BKJ Group';
    $defaultTitle = 'BKJ Group - Solusi Logistik & Maritim Terintegrasi';
    $defaultDesc = 'Perusahaan penyedia jasa logistik, keagenan kapal, dan bongkar muat terkemuka di Kepulauan Riau dengan standar operasional internasional.';
    $defaultImage = asset('assets/images/og-image.jpg'); // Fallback OG image
    
    // Resolve Final Values
    $finalTitle = $title ? "$title | $siteName" : $defaultTitle;
    $finalDesc = $description ?? $defaultDesc;
    $finalImage = $image ?? $defaultImage;
    $finalUrl = $url ?? url()->current();

    // Dynamic Favicon Resolution based on active company (subsidiary)
    $activeSubsidiary = null;
    if (isset($subsidiary) && $subsidiary instanceof \App\Models\Subsidiary) {
        $activeSubsidiary = $subsidiary;
    } else {
        $route = request()->route();
        if ($route && $route->getName() === 'subsidiaries.show') {
            $slug = $route->parameter('slug');
            $activeSubsidiary = \App\Models\Subsidiary::where('slug', $slug)->first();
        }
    }

    // Default fallback
    $faviconUrl = asset('favicon.ico');

    // Use dynamically uploaded favicon from admin panel if available
    if ($activeSubsidiary && $activeSubsidiary->favicon_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($activeSubsidiary->favicon_path)) {
        $faviconUrl = asset(\Illuminate\Support\Facades\Storage::url($activeSubsidiary->favicon_path));
    } elseif (!empty($globalSettings['global_favicon']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($globalSettings['global_favicon'])) {
        $faviconUrl = asset(\Illuminate\Support\Facades\Storage::url($globalSettings['global_favicon']));
    }

    $faviconType = 'image/x-icon';
    if (\Illuminate\Support\Str::endsWith($faviconUrl, '.svg')) {
        $faviconType = 'image/svg+xml';
    } elseif (\Illuminate\Support\Str::endsWith($faviconUrl, '.png')) {
        $faviconType = 'image/png';
    } elseif (\Illuminate\Support\Str::endsWith($faviconUrl, '.webp')) {
        $faviconType = 'image/webp';
    } elseif (\Illuminate\Support\Str::endsWith($faviconUrl, '.gif')) {
        $faviconType = 'image/gif';
    } elseif (\Illuminate\Support\Str::endsWith($faviconUrl, '.jpg') || \Illuminate\Support\Str::endsWith($faviconUrl, '.jpeg')) {
        $faviconType = 'image/jpeg';
    }
@endphp

{{-- Standard SEO Tags --}}
<title>{{ $finalTitle }}</title>
<meta name="description" content="{{ $finalDesc }}">
<link rel="canonical" href="{{ $finalUrl }}">
<link rel="icon" type="{{ $faviconType }}" href="{{ $faviconUrl }}" sizes="192x192">
<link rel="apple-touch-icon" href="{{ $faviconUrl }}">
{{-- Fallback standard favicon for strict crawlers --}}
<link rel="icon" type="image/x-icon" href="{{ url('/favicon.ico') }}">
{{-- OpenGraph Tags --}}
<meta property="og:title" content="{{ $finalTitle }}">
<meta property="og:description" content="{{ $finalDesc }}">
<meta property="og:image" content="{{ $finalImage }}">
<meta property="og:url" content="{{ $finalUrl }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">

{{-- Twitter Cards --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $finalTitle }}">
<meta name="twitter:description" content="{{ $finalDesc }}">
<meta name="twitter:image" content="{{ $finalImage }}">

{{-- JSON-LD Organization & LocalBusiness Schema --}}
@php
    // Dynamically resolve contact information from settings
    $schemaPhone = str_replace(["\r\n", "\r", "\n"], ', ', $globalSettings['contact_phone1'] ?? '+62852 6439 6766');
    $schemaAddress = $globalSettings['contact_address'] ?? 'Ruko Mega Legenda II Blok B2 No 03, Batam Center - Kota Batam';

    // Dynamically format LocalBusiness name & Logo
    $businessName = 'PT Batam Kepri Jaya';
    $schemaLogo = asset('favicon.ico'); // Fallback if no logo is uploaded
    
    if ($activeSubsidiary) {
        $businessName = $activeSubsidiary->name;
        if ($activeSubsidiary->icon_path) {
            $schemaLogo = asset(\Illuminate\Support\Facades\Storage::url($activeSubsidiary->icon_path));
        }
    }
    
    // If no active subsidiary icon is found, fallback to global icon
    if ($schemaLogo === asset('favicon.ico') && !empty($globalSettings['global_icon'])) {
        $schemaLogo = asset(\Illuminate\Support\Facades\Storage::url($globalSettings['global_icon']));
    }

    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'WebSite',
                '@id' => url('/') . '#website',
                'name' => 'BKJ Group',
                'alternateName' => ['Batam Kepri Jaya', 'BKJ Group Indonesia'],
                'url' => url('/')
            ],
            [
                '@type' => 'Organization',
                '@id' => url('/') . '#organization',
                'name' => 'BKJ Group',
                'url' => url('/'),
                'logo' => $schemaLogo,
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'telephone' => $schemaPhone,
                    'contactType' => 'customer service'
                ]
            ],
            [
                '@type' => 'LocalBusiness',
                '@id' => url('/') . '#localbusiness',
                'name' => $businessName,
                'image' => $finalImage,
                'url' => $finalUrl,
                'telephone' => $schemaPhone,
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $schemaAddress,
                    'addressLocality' => 'Batam',
                    'addressRegion' => 'Kepulauan Riau',
                    'postalCode' => '29400',
                    'addressCountry' => 'ID'
                ],
                'priceRange' => '$$'
            ]
        ]
    ];

    if (count($breadcrumbs) > 0) {
        $itemList = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Beranda',
                'item' => url('/')
            ]
        ];

        foreach ($breadcrumbs as $index => $crumb) {
            $itemList[] = [
                '@type' => 'ListItem',
                'position' => $index + 2,
                'name' => $crumb['name'],
                'item' => $crumb['url']
            ];
        }

        $schema['@graph'][] = [
            '@type' => 'BreadcrumbList',
            'itemListElement' => $itemList
        ];
    }
@endphp

<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
