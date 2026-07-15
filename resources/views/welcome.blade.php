<x-public-layout>
    @php
    $locale = app()->getLocale();
    
    // Dynamic Logo Icon Resolution for homepage content fallbacks
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

    $logoUrl = null;
    if ($activeSubsidiary && $activeSubsidiary->icon_path) {
        $logoUrl = \Illuminate\Support\Facades\Storage::url($activeSubsidiary->icon_path);
    } elseif (!empty($globalSettings['global_icon'])) {
        $logoUrl = \Illuminate\Support\Facades\Storage::url($globalSettings['global_icon']);
    } else {
        $logoUrl = asset('assets/logos/bkj-group-logo-dark.svg');
    }
    @endphp

    {{-- 1. Hero Section --}}
    @php
        $heroTitle = $locale === 'en' && !empty($hero->title_en) ? $hero->title_en : ($locale === 'en' ? __('home.hero_title') : ($hero->title ?? 'Ekselensi Logistik & Maritim Indonesia'));
        $heroSubtitle = $locale === 'en' && !empty($hero->subtitle_en) ? $hero->subtitle_en : ($locale === 'en' ? __('home.hero_subtitle') : ($hero->subtitle ?? 'Mitra terpercaya untuk layanan bongkar muat dan logistik.'));
    @endphp
    <x-sections.hero 
        :title="$heroTitle"
        :subtitle="$heroSubtitle"
        :image="!empty($hero->background_image) ? Storage::url($hero->background_image) : ''"
        :primaryCta="$locale === 'en' ? 'Our Services' : 'Layanan Kami'"
        :primaryLink="route('services')"
        :secondaryCta="$locale === 'en' ? 'Contact Us' : 'Hubungi Kami'"
    />

    {{-- 2. Company Overview (Image Left, Text Right) --}}
    @php
        $description = $locale === 'en' && !empty($companyProfile['description_en']) ? $companyProfile['description_en'] : ($companyProfile['description'] ?? '');
        $vision = $locale === 'en' && !empty($companyProfile['vision_en']) ? $companyProfile['vision_en'] : ($companyProfile['vision'] ?? '');
        $mission = $locale === 'en' && !empty($companyProfile['mission_en']) ? $companyProfile['mission_en'] : ($companyProfile['mission'] ?? '');
    @endphp

    <section id="overview" class="py-24 bg-surface overflow-hidden">
        <x-layout.container>
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="w-full lg:w-1/2 relative h-[600px] flex items-center justify-center" data-scroll-fade-left>
                    <div class="absolute inset-0 bg-primary/5 rounded-2xl transform -rotate-3 scale-95 transition-transform duration-700 hover:rotate-0 hover:scale-100"></div>
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" alt="Overview BKJ Group" class="relative z-10 max-w-[70%] max-h-[70%] object-contain" loading="lazy" decoding="async" />
                    @else
                        <div class="relative z-10 w-[85%] h-[85%] bg-outline-variant/20 rounded-2xl shadow-ambient"></div>
                    @endif
                    <div class="absolute bottom-12 right-0 bg-white p-8 rounded-xl shadow-hover z-20 border border-outline-variant/20 backdrop-blur-sm">
                        <p class="text-display-lg font-display text-primary font-bold leading-none">10<span class="text-secondary">+</span></p>
                        <p class="text-label-md text-on-surface-variant uppercase tracking-widest mt-2">{{ __('home.years_of_trust') }}</p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2" data-scroll-fade-right>
                    <span class="text-label-md text-secondary tracking-widest uppercase">{{ $locale === 'en' ? 'About Us' : 'Tentang Kami' }}</span>
                    <h2 class="text-headline-lg font-display font-bold text-primary mt-4 mb-6 leading-tight">{{ $locale === 'en' ? 'Trusted Transport & Logistics Services' : 'Jasa Pengurusan Transportasi & Logistik Terpercaya' }}</h2>
                    <p class="text-body-lg text-on-surface-variant leading-relaxed mb-10 bg-surface-container-low p-6 rounded-lg">
                        {!! nl2br(e($description)) !!}
                    </p>
                    <a href="{{ route('about') }}" class="inline-flex items-center justify-center font-semibold rounded transition-all duration-300 border-2 border-primary text-primary hover:bg-primary hover:text-white active:scale-95 px-6 py-3 text-body-md">
                        {{ $locale === 'en' ? 'Learn More' : 'Pelajari Lebih Lanjut' }}
                    </a>
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- 3. Vision Mission (Editorial Style - Alternate Layout: Text Left, Block Right) --}}
    <section id="vision-mission" class="py-32 bg-primary text-white relative overflow-hidden" data-scroll-reveal>
        <div class="absolute -top-[20%] -right-[10%] w-[50%] h-[150%] bg-white/5 rotate-12 blur-3xl pointer-events-none"></div>
        <x-layout.container class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <div class="lg:col-span-7">
                <h3 class="text-label-md text-secondary-container tracking-widest uppercase mb-6">{{ $locale === 'en' ? 'Our Vision' : 'Visi Perusahaan' }}</h3>
                <blockquote class="text-headline-md font-display md:text-headline-lg font-semibold leading-snug text-white/90">
                    "{{ $vision }}"
                </blockquote>
            </div>
            <div class="lg:col-span-5 bg-white/5 backdrop-blur p-10 rounded-xl border border-white/10">
                <h3 class="text-headline-md font-display font-bold mb-8 text-white flex items-center gap-4">
                    <span class="w-12 h-12 rounded-full bg-secondary text-white flex items-center justify-center shrink-0">
                        <x-lucide-flag class="w-6 h-6" />
                    </span>
                    {{ $locale === 'en' ? 'Our Mission' : 'Misi Utama' }}
                </h3>
                <div class="text-body-md text-white/80 space-y-4 prose prose-invert">
                    {!! nl2br(e($mission)) !!}
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- 4. Core Values (Bento Box with Stagger) --}}
    <section id="core-values" class="py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div class="max-w-2xl">
                    <h2 class="text-headline-lg font-display font-bold text-primary">{{ $locale === 'en' ? 'Our Excellence' : 'Keunggulan Kami' }}</h2>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" data-scroll-stagger>
                
                {{-- Value 1 --}}
                <div class="bg-white rounded-xl p-8 border border-outline-variant/30 shadow-ambient flex flex-col group hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-14 h-14 bg-primary/5 text-primary rounded-full flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <x-lucide-shield-check class="w-7 h-7" />
                    </div>
                    <h3 class="text-headline-md font-display font-bold text-primary mb-3">{{ __('home.val_1_title') }}</h3>
                    <p class="text-body-md text-on-surface-variant flex-grow">{{ __('home.val_1_desc') }}</p>
                </div>
                
                {{-- Value 2 --}}
                <div class="bg-primary rounded-xl p-8 text-white border border-outline-variant/30 shadow-ambient flex flex-col group hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-14 h-14 bg-white/10 text-white rounded-full flex items-center justify-center mb-6 group-hover:bg-secondary transition-colors duration-300">
                        <x-lucide-hard-hat class="w-7 h-7" />
                    </div>
                    <h3 class="text-headline-md font-display font-bold text-white mb-3">{{ __('home.val_2_title') }}</h3>
                    <p class="text-body-md text-white/80 flex-grow">{{ __('home.val_2_desc') }}</p>
                </div>

                {{-- Value 3 --}}
                <div class="bg-white rounded-xl p-8 border border-outline-variant/30 shadow-ambient flex flex-col group hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-14 h-14 bg-primary/5 text-primary rounded-full flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <x-lucide-handshake class="w-7 h-7" />
                    </div>
                    <h3 class="text-headline-md font-display font-bold text-primary mb-3">{{ __('home.val_3_title') }}</h3>
                    <p class="text-body-md text-on-surface-variant flex-grow">{{ __('home.val_3_desc') }}</p>
                </div>

                {{-- Value 4 --}}
                <div class="bg-surface-container-low rounded-xl p-8 border border-outline-variant/30 shadow-ambient flex flex-col group hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-full flex items-center justify-center mb-6 group-hover:bg-secondary group-hover:text-white transition-colors duration-300">
                        <x-lucide-award class="w-7 h-7" />
                    </div>
                    <h3 class="text-headline-md font-display font-bold text-primary mb-3">{{ __('home.val_4_title') }}</h3>
                    <p class="text-body-md text-on-surface-variant flex-grow">{{ __('home.val_4_desc') }}</p>
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- 5. Statistics (Removed to match simple profile) --}}

    {{-- 6. Services (Hover Cards with Stagger) --}}
    <section id="services" class="py-24 bg-surface-container-lowest" data-scroll-reveal>
        <x-layout.container>
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-label-md text-secondary tracking-widest uppercase">{{ $locale === 'en' ? 'Our Services' : 'Layanan Kami' }}</span>
                <h2 class="text-headline-lg font-display font-bold text-primary mt-4">{{ $locale === 'en' ? 'Logistics & Maritime Ecosystem' : 'Solusi Ekosistem Logistik' }}</h2>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" data-scroll-stagger>
                @foreach($services as $service)
                    @php
                        $title = $locale === 'en' && !empty($service->title_en) ? $service->title_en : $service->title;
                        $shortDescription = $locale === 'en' && !empty($service->short_description_en) ? $service->short_description_en : $service->short_description;
                    @endphp
                    <div class="group relative bg-white rounded-xl overflow-hidden border border-outline-variant/30 shadow-ambient hover:shadow-hover hover:-translate-y-1 transition-all duration-300 flex flex-col h-[400px]">
                        <div class="absolute inset-0 bg-primary/5 group-hover:bg-transparent transition-colors z-0"></div>
                        <div class="relative z-10 p-8 flex flex-col h-full">
                            <div class="w-14 h-14 bg-primary/5 text-primary rounded-full flex items-center justify-center mb-8 transform group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all duration-300 overflow-hidden">
                                @if($service->image_path)
                                    <img src="{{ Storage::url($service->image_path) }}" alt="{{ $title }}" class="w-full h-full object-cover">
                                @else
                                    @svg('lucide-' . ($service->icon ?? 'package'), 'w-8 h-8')
                                @endif
                            </div>
                            <h3 class="text-headline-md font-display font-bold text-primary mb-4">{{ $title }}</h3>
                            <p class="text-body-md text-on-surface-variant line-clamp-3 mb-8 flex-grow">
                                {{ $shortDescription }}
                            </p>
                            <a href="{{ route('services') }}#service-{{ $service->slug }}" class="inline-flex items-center text-primary font-bold text-label-md uppercase tracking-wider group-hover:text-secondary transition-colors">
                                {{ __('home.explore') }} <x-lucide-arrow-right class="w-5 h-5 ml-2 transform group-hover:translate-x-2 transition-transform" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-layout.container>
    </section>

    {{-- 7. Why Choose Us (Alternate Layout: Text Left, Image Right) --}}
    <section id="why-choose-us" class="py-24 bg-primary text-white" data-scroll-reveal>
        <x-layout.container>
            <div class="flex flex-col-reverse lg:flex-row gap-16 items-center">
                <div class="w-full lg:w-1/2">
                    <h2 class="text-headline-lg font-display font-bold text-white mb-6">{{ $locale === 'en' ? 'Why Choose Us?' : 'Mengapa Memilih Kami?' }}</h2>
                    <p class="text-body-lg text-white/70 mb-12">
                        {{ $locale === 'en' ? 'Our commitment is to provide flawless service.' : 'Komitmen kami adalah memberikan layanan tanpa cela.' }}
                    </p>
                    
                    <div class="space-y-6" data-scroll-stagger>
                        <div class="flex gap-6 bg-white/5 p-6 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors duration-300">
                            <span class="w-12 h-12 flex items-center justify-center rounded-full bg-secondary text-white shrink-0">
                                <x-lucide-users class="w-6 h-6" />
                            </span>
                            <div>
                                <h3 class="text-headline-md font-display font-bold mb-2">{{ __('home.why_item_1_title') }}</h3>
                                <p class="text-body-md text-white/60">{{ __('home.why_item_1_desc') }}</p>
                            </div>
                        </div>
                        <div class="flex gap-6 bg-white/5 p-6 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors duration-300">
                            <span class="w-12 h-12 flex items-center justify-center rounded-full bg-secondary text-white shrink-0">
                                <x-lucide-clock class="w-6 h-6" />
                            </span>
                            <div>
                                <h3 class="text-headline-md font-display font-bold mb-2">{{ __('home.why_item_2_title') }}</h3>
                                <p class="text-body-md text-white/60">{{ __('home.why_item_2_desc') }}</p>
                            </div>
                        </div>
                        <div class="flex gap-6 bg-white/5 p-6 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors duration-300">
                            <span class="w-12 h-12 flex items-center justify-center rounded-full bg-secondary text-white shrink-0">
                                <x-lucide-shield-check class="w-6 h-6" />
                            </span>
                            <div>
                                <h3 class="text-headline-md font-display font-bold mb-2">{{ __('home.why_item_3_title') }}</h3>
                                <p class="text-body-md text-white/60">{{ __('home.why_item_3_desc') }}</p>
                            </div>
                        </div>
                        <div class="flex gap-6 bg-white/5 p-6 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors duration-300">
                            <span class="w-12 h-12 flex items-center justify-center rounded-full bg-secondary text-white shrink-0">
                                <x-lucide-heart-handshake class="w-6 h-6" />
                            </span>
                            <div>
                                <h3 class="text-headline-md font-display font-bold mb-2">{{ __('home.why_item_4_title') }}</h3>
                                <p class="text-body-md text-white/60">{{ __('home.why_item_4_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 relative h-[600px] flex items-center justify-center bg-primary/10 rounded-xl border border-white/10">
                    @if($logoUrl)
                        <img src="{{ $logoUrl }}" alt="BKJ Group Compliance Logo" class="relative z-10 max-w-[70%] max-h-[70%] object-contain opacity-40 hover:opacity-70 transition-opacity duration-300" loading="lazy" decoding="async">
                    @endif
                    <div class="absolute -left-8 top-1/2 -translate-y-1/2 bg-secondary text-white p-6 rounded-xl shadow-ambient hidden md:block z-20">
                        <x-lucide-shield-check class="w-10 h-10 mb-3" />
                        <p class="text-headline-md font-display font-bold">100%</p>
                        <p class="text-body-md text-white/90">{{ __('home.why_compliance') }}</p>
                    </div>
                </div>
            </div>
        </x-layout.container>
    </section>


    {{-- 7.5 Our Team (Hierarchical Organizational Structure) --}}
    <section id="our-team" class="py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-headline-lg font-display font-bold text-primary">{{ $locale === 'en' ? 'Organizational Structure' : 'Struktur Organisasi & Tim Ahli' }}</h2>
            </div>
            
              <div class="flex flex-col items-center w-full max-w-5xl mx-auto relative z-10" data-scroll-stagger>
                  
                  {{-- Level 1: Komisaris --}}
                  @php
                      $commissioner = $teamMembers->where('level', 'commissioner')->first();
                  @endphp
                  @if($commissioner)
                  <div class="relative flex flex-col items-center mb-12">
                      <div class="bg-gradient-to-b from-white to-surface-container-low rounded-2xl p-6 w-72 text-center border border-outline-variant/30 shadow-ambient flex flex-col items-center group hover:-translate-y-2 hover:shadow-hover hover:border-secondary/50 transition-all duration-500 relative z-20 overflow-hidden" data-scroll-zoom>
                          <div class="absolute inset-0 bg-gradient-to-tr from-secondary/5 via-transparent to-primary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                          
                          <div class="w-24 h-24 rounded-full bg-white mb-5 overflow-hidden relative border-4 border-surface shadow-sm group-hover:border-secondary/30 transition-colors duration-500 z-10">
                              @if($commissioner->image_path)
                                  <img src="{{ Storage::url($commissioner->image_path) }}" alt="{{ $commissioner->name }}" class="w-full h-full object-cover">
                              @else
                                  <div class="absolute inset-0 flex items-center justify-center text-primary group-hover:bg-gradient-to-br group-hover:from-secondary group-hover:to-primary group-hover:text-white transition-all duration-500">
                                      <x-lucide-user class="w-10 h-10" />
                                  </div>
                              @endif
                          </div>
                          <div class="relative z-10">
                              <h3 class="text-headline-sm font-display font-bold text-primary mb-1">{{ $commissioner->name }}</h3>
                              <div class="inline-block px-4 py-1 bg-primary/5 rounded-full mt-2 border border-primary/10">
                                  <p class="text-label-md text-secondary tracking-widest uppercase font-bold">{{ $locale === 'en' && !empty($commissioner->role_en) ? $commissioner->role_en : $commissioner->role }}</p>
                              </div>
                          </div>
                      </div>
                      <div class="w-px h-12 bg-gradient-to-b from-outline-variant/40 to-outline-variant absolute -bottom-12 left-1/2 transform -translate-x-1/2 z-0" data-scroll-reveal></div>
                  </div>
                  @endif
  
                  {{-- Level 2: Direktur --}}
                  @php
                      $director = $teamMembers->where('level', 'director')->first();
                  @endphp
                  @if($director)
                  <div class="relative flex flex-col items-center mb-12">
                      <div class="bg-gradient-to-b from-white to-surface-container-low rounded-2xl p-6 w-72 text-center border border-outline-variant/30 shadow-ambient flex flex-col items-center group hover:-translate-y-2 hover:shadow-hover hover:border-secondary/50 transition-all duration-500 relative z-20 overflow-hidden" data-scroll-zoom>
                          <div class="absolute inset-0 bg-gradient-to-tr from-secondary/5 via-transparent to-primary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                          
                          <div class="w-24 h-24 rounded-full bg-white mb-5 overflow-hidden relative border-4 border-surface shadow-sm group-hover:border-secondary/30 transition-colors duration-500 z-10">
                              @if($director->image_path)
                                  <img src="{{ Storage::url($director->image_path) }}" alt="{{ $director->name }}" class="w-full h-full object-cover">
                              @else
                                  <div class="absolute inset-0 flex items-center justify-center text-primary group-hover:bg-gradient-to-br group-hover:from-secondary group-hover:to-primary group-hover:text-white transition-all duration-500">
                                      <x-lucide-user class="w-10 h-10" />
                                  </div>
                              @endif
                          </div>
                          <div class="relative z-10">
                              <h3 class="text-headline-sm font-display font-bold text-primary mb-1">{{ $director->name }}</h3>
                              <div class="inline-block px-4 py-1 bg-primary/5 rounded-full mt-2 border border-primary/10">
                                  <p class="text-label-md text-secondary tracking-widest uppercase font-bold">{{ $locale === 'en' && !empty($director->role_en) ? $director->role_en : $director->role }}</p>
                              </div>
                          </div>
                      </div>
                      <div class="w-px h-12 bg-gradient-to-b from-outline-variant/40 to-outline-variant absolute -bottom-12 left-1/2 transform -translate-x-1/2 z-0"></div>
                  </div>
                  @endif
  
                  {{-- Level 3: Manager --}}
                  @php
                      $manager = $teamMembers->where('level', 'manager')->first();
                  @endphp
                  @if($manager)
                  <div class="relative flex flex-col items-center mb-16 w-full">
                      <div class="bg-gradient-to-b from-white to-surface-container-low rounded-xl p-6 w-72 text-center border border-outline-variant/30 shadow-ambient flex flex-col items-center group hover:-translate-y-1 hover:shadow-hover hover:border-secondary/50 transition-all duration-300 relative z-20 overflow-hidden" data-scroll-zoom>
                          <div class="absolute inset-0 bg-gradient-to-tr from-secondary/5 via-transparent to-primary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                          
                          <div class="w-24 h-24 rounded-full bg-white mb-5 overflow-hidden relative border-4 border-surface shadow-sm group-hover:border-secondary/30 transition-colors duration-500 z-10">
                              @if($manager->image_path)
                                  <img src="{{ Storage::url($manager->image_path) }}" alt="{{ $manager->name }}" class="w-full h-full object-cover">
                              @else
                                  <div class="absolute inset-0 flex items-center justify-center text-primary group-hover:bg-gradient-to-br group-hover:from-secondary group-hover:to-primary group-hover:text-white transition-all duration-500">
                                      <x-lucide-user class="w-10 h-10" />
                                  </div>
                              @endif
                          </div>
                          <div class="relative z-10">
                              <h3 class="text-headline-sm font-display font-bold text-primary mb-1">{{ $manager->name }}</h3>
                              <div class="inline-block px-4 py-1 bg-primary/5 rounded-full mt-2 border border-primary/10">
                                  <p class="text-label-md text-secondary tracking-widest uppercase font-bold">{{ $locale === 'en' && !empty($manager->role_en) ? $manager->role_en : $manager->role }}</p>
                              </div>
                          </div>
                      </div>
                      
                      <div class="w-px h-8 bg-outline-variant absolute -bottom-8 left-1/2 transform -translate-x-1/2 z-0" data-scroll-reveal></div>
                  </div>
                  @endif
  
                  {{-- Level 4: Operasional (Grid) --}}
                  @php
                      $operasionals = $teamMembers->where('level', 'operational');
                      $opCount = $operasionals->count();
                      $horizontalLineClass = '';
                      if ($opCount >= 4) {
                          $horizontalLineClass = 'left-[12.5%] right-[12.5%]';
                      } elseif ($opCount == 3) {
                          $horizontalLineClass = 'left-[12.5%] right-[37.5%]';
                      } elseif ($opCount == 2) {
                          $horizontalLineClass = 'left-[12.5%] right-[62.5%]';
                      }
                  @endphp
                  @if($operasionals->count() > 0)
                  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 w-full max-w-[90%] relative">
                      @if($opCount > 1)
                      {{-- Horizontal Branch Line (Connects first row operational cards) --}}
                      <div class="hidden md:block absolute -top-8 {{ $horizontalLineClass }} h-px bg-outline-variant z-0" data-scroll-reveal></div>
                      @endif

                      @foreach($operasionals as $member)
                          <div class="relative flex flex-col items-center">
                              @if($loop->index < 4)
                              {{-- Vertical Connecting Line Up (to horizontal branch) --}}
                              <div class="hidden md:block w-px h-8 bg-outline-variant absolute -top-8 left-1/2 transform -translate-x-1/2 z-0"></div>
                              @endif
                              
                              <div class="bg-gradient-to-b from-white to-surface-container-low rounded-lg p-5 w-full text-center border border-outline-variant/30 shadow-sm flex flex-col items-center group hover:-translate-y-1 hover:shadow-ambient hover:border-secondary/40 transition-all duration-300 relative z-20 overflow-hidden" data-scroll-zoom>
                                  <div class="absolute inset-0 bg-gradient-to-tr from-secondary/5 via-transparent to-primary/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                  
                                  <div class="w-16 h-16 rounded-full bg-white mb-4 overflow-hidden relative border-2 border-surface shadow-sm group-hover:border-secondary/30 transition-colors duration-500 z-10">
                                      @if($member->image_path)
                                          <img src="{{ Storage::url($member->image_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                                      @else
                                          <div class="absolute inset-0 flex items-center justify-center text-primary group-hover:bg-gradient-to-br group-hover:from-secondary group-hover:to-primary group-hover:text-white transition-all duration-500">
                                              <x-lucide-user class="w-6 h-6" />
                                          </div>
                                      @endif
                                  </div>
                                  <div class="relative z-10 w-full">
                                      <h3 class="text-body-md font-display font-bold text-primary mb-1 truncate" title="{{ $member->name }}">{{ $member->name }}</h3>
                                      <p class="text-[11px] text-secondary tracking-widest uppercase font-semibold">{{ $locale === 'en' && !empty($member->role_en) ? $member->role_en : $member->role }}</p>
                                  </div>
                              </div>
                          </div>
                      @endforeach
                  </div>
                  @endif
              </div>

              {{-- Struktur Koperasi TKBM BKJ --}}
              <div class="w-full max-w-4xl mx-auto mt-24" data-scroll-reveal>
                  <div class="text-center mb-12">
                      <h2 class="text-headline-lg font-display font-bold text-primary">{{ $locale === 'en' ? 'TKBM Cooperative Structure' : 'Struktur Koperasi Jasa TKBM BKJ' }}</h2>
                  </div>
                  <div class="bg-white p-8 md:p-12 rounded-3xl shadow-ambient border border-outline-variant/30">
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                          {{-- Pengawas --}}
                          <div>
                              <h3 class="text-label-md text-secondary tracking-widest uppercase mb-6 border-b border-outline-variant/10 pb-4">{{ $locale === 'en' ? 'Supervisors' : 'Pengawas' }}</h3>
                              <ul class="list-disc list-inside space-y-3 font-bold text-primary text-body-lg ml-2">
                                  @foreach($koperasiMembers->where('level', 'supervisor') as $member)
                                      <li>{{ $member->name }}</li>
                                  @endforeach
                              </ul>
                          </div>

                          {{-- Pengurus --}}
                          <div>
                              <h3 class="text-label-md text-secondary tracking-widest uppercase mb-6 border-b border-outline-variant/10 pb-4">{{ $locale === 'en' ? 'Management Board' : 'Pengurus' }}</h3>
                              <div class="space-y-6">
                                  @foreach($koperasiMembers->where('level', 'management') as $member)
                                  <div class="flex justify-between items-center {{ !$loop->last ? 'border-b border-outline-variant/10 pb-4' : 'pb-2' }}">
                                      <h4 class="font-bold text-primary text-lg">{{ $member->name }}</h4>
                                      <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-primary/5 text-primary uppercase">{{ $locale === 'en' && !empty($member->role_en) ? $member->role_en : $member->role }}</span>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

            </div>
        </x-layout.container>
    </section>

    {{-- 8. Subsidiaries (Split Layout) --}}
    <section id="subsidiaries" class="py-0" data-scroll-reveal>
        <div class="flex flex-col lg:flex-row">
            <div class="w-full lg:w-1/2 bg-surface p-12 lg:p-24 flex flex-col justify-center">
                <h2 class="text-headline-lg font-display font-bold text-primary mb-6">{{ $locale === 'en' ? 'Logistics Ecosystem Synergy' : 'Sinergi Ekosistem Logistik' }}</h2>
                <p class="text-body-lg text-on-surface-variant mb-12 max-w-lg">{{ $locale === 'en' ? 'BKJ Group is supported by strong subsidiaries.' : 'BKJ Group didukung oleh anak perusahaan yang kuat.' }}</p>
                <x-ui.button variant="secondary" href="{{ isset($subsidiariesList) && $subsidiariesList->count() > 0 ? route('subsidiaries.show', $subsidiariesList->first()->slug) : '#' }}" class="self-start">{{ $locale === 'en' ? 'View Ecosystem' : 'Lihat Ekosistem' }}</x-ui.button>
            </div>
            <div class="w-full lg:w-1/2 grid grid-cols-1 md:grid-cols-2" data-scroll-stagger>
                @php $count = isset($subsidiariesList) ? count($subsidiariesList) : 0; @endphp
                @foreach($subsidiariesList as $index => $sub)
                    @php 
                        $isLastOdd = ($count % 2 !== 0 && $index === $count - 1); 
                        // Assign some random icons based on index for variety
                        $icons = ['building-2', 'users-2', 'anchor', 'ship', 'truck'];
                        $icon = $icons[$index % count($icons)];
                    @endphp
                    <a href="{{ route('subsidiaries.show', $sub->slug) }}" class="block p-12 border border-outline-variant/20 hover:bg-primary hover:text-white transition-colors duration-500 group cursor-pointer {{ $isLastOdd ? 'md:col-span-2 bg-surface-container' : ($index % 2 == 0 ? 'bg-white' : 'bg-surface-container-low') }}">
                        @svg('lucide-' . $icon, 'w-12 h-12 text-primary group-hover:text-secondary mb-8 transition-colors')
                        <h3 class="text-headline-md font-display font-bold mb-4">{{ $locale === 'en' && !empty($sub->name_en) ? $sub->name_en : $sub->name }}</h3>
                        <p class="text-body-md text-on-surface-variant group-hover:text-white/80 line-clamp-3">{{ $locale === 'en' && !empty($sub->description_en) ? $sub->description_en : $sub->description }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 9. Clients Marquee --}}
    <section id="clients" class="py-16 bg-white border-y border-outline-variant/30 overflow-hidden">
        <p class="text-center text-on-surface-variant font-bold tracking-widest uppercase mb-10 text-label-md" data-scroll-reveal>{{ $locale === 'en' ? 'TRUSTED BY LEADING COMPANIES' : 'Klien & Mitra' }}</p>
        
        <div class="flex flex-col gap-6">
            @if($clients->count() > 0)
                {{-- Row 1: Moves Left --}}
                <div class="w-full overflow-hidden flex group">
                    <div class="flex gap-6 px-3 w-max animate-marquee-left group-hover:[animation-play-state:paused]">
                        @foreach($clients as $c)
                            <div class="w-48 h-20 bg-surface-container rounded-xl flex items-center justify-center border border-outline-variant/20 hover:bg-primary/5 transition-colors shrink-0 px-4">
                                <span class="text-on-surface-variant font-bold tracking-wider text-center text-sm truncate" title="{{ $c->name }}">{{ $c->name }}</span>
                            </div>
                        @endforeach
                        {{-- Repeat for seamless scrolling --}}
                        @foreach($clients as $c)
                            <div class="w-48 h-20 bg-surface-container rounded-xl flex items-center justify-center border border-outline-variant/20 hover:bg-primary/5 transition-colors shrink-0 px-4">
                                <span class="text-on-surface-variant font-bold tracking-wider text-center text-sm truncate" title="{{ $c->name }}">{{ $c->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Row 2: Moves Right --}}
                <div class="w-full overflow-hidden flex group">
                    <div class="flex gap-6 px-3 w-max animate-marquee-right group-hover:[animation-play-state:paused]">
                        @foreach($clients->reverse() as $c)
                            <div class="w-48 h-20 bg-surface-container rounded-xl flex items-center justify-center border border-outline-variant/20 hover:bg-primary/5 transition-colors shrink-0 px-4">
                                <span class="text-on-surface-variant font-bold tracking-wider text-center text-sm truncate" title="{{ $c->name }}">{{ $c->name }}</span>
                            </div>
                        @endforeach
                        {{-- Repeat for seamless scrolling --}}
                        @foreach($clients->reverse() as $c)
                            <div class="w-48 h-20 bg-surface-container rounded-xl flex items-center justify-center border border-outline-variant/20 hover:bg-primary/5 transition-colors shrink-0 px-4">
                                <span class="text-on-surface-variant font-bold tracking-wider text-center text-sm truncate" title="{{ $c->name }}">{{ $c->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-4 text-gray-400">
                    Belum ada klien terdaftar.
                </div>
            @endif
        </div>
    </section>

    {{-- 9.5 Testimonials --}}
    @php
        $testimonialsRaw = $globalSettings['client_testimonials'] ?? '';
        $testimonials = [];
        if($testimonialsRaw) {
            foreach(explode("\n", $testimonialsRaw) as $line) {
                if(trim($line)) {
                    $parts = explode('-', $line);
                    $testimonials[] = [
                        'text' => trim($parts[0] ?? ''),
                        'author' => trim($parts[1] ?? 'Client')
                    ];
                }
            }
        }
    @endphp
    @if(count($testimonials) > 0)
    <section id="testimonials" class="py-24 bg-white border-y border-outline-variant/30">
        <x-layout.container>
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-headline-lg font-display font-bold text-primary">{{ $locale === 'en' ? 'What They Say' : 'Apa Kata Mereka' }}</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8" data-scroll-stagger>
                @foreach($testimonials as $testi)
                    <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-sm relative group">
                        <x-lucide-quote class="w-12 h-12 text-primary/10 absolute top-6 right-6" />
                        <p class="text-body-lg text-on-surface-variant mb-6 italic">"{{ $testi['text'] }}"</p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg">
                                {{ substr($testi['author'], 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-body-md font-bold text-primary">{{ $testi['author'] }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-layout.container>
    </section>
    @endif

    {{-- 9.5 Gallery (Grid) --}}
    @if(isset($galleries) && $galleries->count() > 0)
    <section id="gallery" class="py-24 bg-surface-container-lowest" data-scroll-reveal>
        <x-layout.container>
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div>
                    <span class="text-label-md text-secondary tracking-widest uppercase">{{ $locale === 'en' ? 'Gallery' : 'Galeri' }}</span>
                    <h2 class="text-headline-lg font-display font-bold text-primary mt-4">{{ $locale === 'en' ? 'Moments & Activities' : 'Momen & Aktivitas' }}</h2>
                </div>
                <a href="{{ route('gallery') }}" class="text-primary font-bold text-label-md uppercase tracking-wider hover:text-secondary transition-colors inline-flex items-center">
                    {{ $locale === 'en' ? 'View All' : 'Lihat Semua' }} <x-lucide-arrow-right class="w-5 h-5 ml-2" />
                </a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6" data-scroll-stagger>
                @foreach($galleries as $item)
                    <div class="group relative rounded-2xl overflow-hidden aspect-[4/3] bg-surface-container cursor-pointer shadow-sm hover:shadow-hover transition-all duration-500">
                        @if(!empty($item->image_path))
                            <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" loading="lazy" decoding="async">
                        @else
                            <div class="w-full h-full bg-outline-variant/10"></div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                            <h3 class="text-white font-display font-bold text-lg line-clamp-1">{{ $locale === 'en' && !empty($item->title_en) ? $item->title_en : $item->title }}</h3>
                            @if($item->category || $item->category_en)
                                <span class="text-white/80 text-sm mt-1 block">{{ $locale === 'en' && !empty($item->category_en) ? $item->category_en : $item->category }}</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </x-layout.container>
    </section>
    @endif

    {{-- 10. Latest News (Editorial Grid) --}}
    <section id="news" class="py-24 bg-surface" data-scroll-reveal>
        <x-layout.container>
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div>
                    <h2 class="text-headline-lg font-display font-bold text-primary">{{ $locale === 'en' ? 'Insights & Updates' : 'Wawasan & Pembaruan' }}</h2>
                </div>
                <a href="{{ route('blog') }}" class="text-primary font-bold text-label-md uppercase tracking-wider hover:text-secondary transition-colors inline-flex items-center">
                    {{ $locale === 'en' ? 'View All News' : 'Lihat Semua Berita' }} <x-lucide-arrow-right class="w-5 h-5 ml-2" />
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8" data-scroll-stagger>
                @if(isset($blogs[0]))
                    {{-- Featured Article --}}
                    <div class="md:col-span-8 group cursor-pointer" onclick="window.location='{{ route('blog.show', $blogs[0]->slug) }}'">
                        <div class="relative h-[400px] rounded-2xl overflow-hidden mb-6 shadow-ambient">
                            @if(!empty($blogs[0]->thumbnail))
                                <x-ui.image src="{{ Storage::url($blogs[0]->thumbnail) }}" alt="{{ $blogs[0]->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" loading="lazy" decoding="async" />
                            @else
                                <div class="w-full h-full bg-outline-variant/10"></div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent"></div>
                            <div class="absolute bottom-8 left-8 right-8 text-white">
                                <span class="bg-secondary text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4 inline-block">News</span>
                                <h3 class="text-headline-md font-display font-bold line-clamp-2">{{ $locale === 'en' && !empty($blogs[0]->title_en) ? $blogs[0]->title_en : $blogs[0]->title }}</h3>
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="md:col-span-4 flex flex-col gap-8">
                    @foreach($blogs->skip(1)->take(2) as $blog)
                        <div class="group cursor-pointer flex gap-4" onclick="window.location='{{ route('blog.show', $blog->slug) }}'">
                            <div class="w-32 h-32 shrink-0 rounded-xl overflow-hidden shadow-sm">
                                @if(!empty($blog->thumbnail))
                                    <x-ui.image src="{{ Storage::url($blog->thumbnail) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async" />
                                @else
                                    <div class="w-full h-full bg-outline-variant/10"></div>
                                @endif
                            </div>
                            <div class="flex flex-col justify-center">
                                <h4 class="text-body-lg font-display font-bold text-primary mb-2 line-clamp-2 group-hover:text-secondary transition-colors">{{ $locale === 'en' && !empty($blog->title_en) ? $blog->title_en : $blog->title }}</h4>
                                <span class="text-label-md text-on-surface-variant">{{ $blog->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-layout.container>
    </section>

    {{-- 11. CTA Banner --}}
    <x-sections.cta-banner 
        :title="$locale === 'en' ? 'Ready to Optimize Your Logistics?' : 'Siap Mengoptimalkan Logistik Anda?'" 
        :description="$locale === 'en' ? 'Discuss your maritime operational needs with our expert team today.' : 'Diskusikan kebutuhan operasional maritim Anda bersama tim ahli kami hari ini.'"
        :buttonText="$locale === 'en' ? 'Start Consultation' : 'Mulai Konsultasi'"
        :buttonLink="route('contact')"
    />
</x-public-layout>
