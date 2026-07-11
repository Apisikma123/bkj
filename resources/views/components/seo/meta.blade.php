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
    $siteName = 'BKJ Group Indonesia';
    $defaultTitle = 'PT Bintang Kepri Jaya (BKJ Group) - Solusi Logistik & Maritim';
    $defaultDesc = 'Perusahaan penyedia jasa bongkar muat dan logistik terkemuka di Kepulauan Riau dengan standar operasional internasional.';
    $defaultImage = asset('assets/images/og-image.jpg'); // Fallback OG image
    
    // Resolve Final Values
    $finalTitle = $title ? "$title | $siteName" : $defaultTitle;
    $finalDesc = $description ?? $defaultDesc;
    $finalImage = $image ?? $defaultImage;
    $finalUrl = $url ?? url()->current();
@endphp

{{-- Standard SEO Tags --}}
<title>{{ $finalTitle }}</title>
<meta name="description" content="{{ $finalDesc }}">
<link rel="canonical" href="{{ $finalUrl }}">

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
    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => url('/') . '#organization',
                'name' => 'PT Bintang Kepri Jaya (BKJ Group)',
                'url' => url('/'),
                'logo' => asset('assets/logos/bkj-group-logo-dark.svg'),
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'telephone' => '+62-123-4567-8900',
                    'contactType' => 'customer service'
                ]
            ],
            [
                '@type' => 'LocalBusiness',
                '@id' => url('/') . '#localbusiness',
                'name' => 'PT Bintang Kepri Jaya',
                'image' => $finalImage,
                'url' => url('/'),
                'telephone' => '+62-123-4567-8900',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'Batam',
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
