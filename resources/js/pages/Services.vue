<script setup>
   import MainLayout from '@/layouts/MainLayout.vue'
   import ArrowRight from '@/components/icons/ArrowRightIcon.vue'
   import { ref, onMounted } from 'vue'
   import { Link, Head } from '@inertiajs/vue3'
   import { route } from 'ziggy-js'
   import { Swiper,SwiperSlide } from 'swiper/vue'
   import {Pagination } from 'swiper/modules'
   import 'swiper/css'
   import 'swiper/css/pagination'
   
   const modules = [Pagination];
 
   const props = defineProps({
      services: {
            type: Array,
            default: () => []
      },
      details: {
            type: Array,
            default: () => []
      }
   })
   const openDetailsIndex = ref(null)
   
   const valeurs = [
       {
           id:1,
           icon:`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-width="2" d="M12 13a4 4 0 1 0 0-8a4 4 0 0 0 0 8Zm-6 9v-3a6 6 0 1 1 12 0v3M13 5c.404-1.664 2.015-3 4-3c2.172 0 3.98 1.79 4 4c-.02 2.21-1.828 4-4 4h-1h1c3.288 0 6 2.686 6 6v2M11 5c-.404-1.664-2.015-3-4-3c-2.172 0-3.98 1.79-4 4c.02 2.21 1.828 4 4 4h1h-1c-3.288 0-6 2.686-6 6v2"/></svg>`,
           title:'Une équipe d\'experts',
           text:'Des collaborateurs chevronnés et passionnés.'
       },
       {
           id:2,
           icon:`<svg width="24" height="24" viewBox="0 0 37 34" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.5 24.8346L19.8333 28.168C20.1616 28.4963 20.5514 28.7567 20.9803 28.9344C21.4093 29.1121 21.869 29.2035 22.3333 29.2035C22.7976 29.2035 23.2574 29.1121 23.6863 28.9344C24.1153 28.7567 24.505 28.4963 24.8333 28.168C25.1616 27.8397 25.4221 27.4499 25.5997 27.021C25.7774 26.592 25.8689 26.1323 25.8689 25.668C25.8689 25.2037 25.7774 24.7439 25.5997 24.315C25.4221 23.886 25.1616 23.4963 24.8333 23.168" stroke="#0D4677" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><path d="M21.5002 19.8342L25.6669 24.0008C26.3299 24.6639 27.2292 25.0364 28.1669 25.0364C29.1046 25.0364 30.0038 24.6639 30.6669 24.0008C31.3299 23.3378 31.7024 22.4385 31.7024 21.5008C31.7024 20.5632 31.3299 19.6639 30.6669 19.0008L24.2002 12.5342C23.2627 11.5978 21.9919 11.0719 20.6669 11.0719C19.3419 11.0719 18.0711 11.5978 17.1335 12.5342L15.6669 14.0008C15.0038 14.6639 14.1046 15.0364 13.1669 15.0364C12.2292 15.0364 11.3299 14.6639 10.6669 14.0008C10.0038 13.3378 9.63135 12.4385 9.63135 11.5008C9.63135 10.5632 10.0038 9.66388 10.6669 9.00084L15.3502 4.31751C16.8706 2.80108 18.8534 1.83509 20.9846 1.57246C23.1159 1.30983 25.2738 1.76556 27.1169 2.86751L27.9002 3.33417C28.6099 3.76248 29.4536 3.91103 30.2669 3.75084L33.1669 3.16751" stroke="#0D4677" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><path d="M33.1667 1.50098L34.8333 19.8343H31.5M3.16667 1.50098L1.5 19.8343L12.3333 30.6676C12.9964 31.3307 13.8957 31.7032 14.8333 31.7032C15.771 31.7032 16.6703 31.3307 17.3333 30.6676C17.9964 30.0046 18.3689 29.1053 18.3689 28.1676C18.3689 27.23 17.9964 26.3307 17.3333 25.6676M3.16667 3.16764H16.5" stroke="#0D4677" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>`,
           title:'L\'humain d\'abord',
           text:'Une écoute active et une collaboration étroite avec chaque acteur de la résidence.'
       },
       {
           id:3,
           icon:`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.5 9a10 10 0 0 0-19 0M2 5v4h4m12 6h4v4M2.5 15a10 10 0 0 0 19 0"/></svg>`,
           title:'Une solution 360°',
           text:'Une gestion complète, flexible et parfaitement adaptée à vos spécificités.'
       },
       {
           id:4,
           icon:`<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill="currentColor" d="M14 16.59L11.41 14L10 15.41l4 4l8-8L20.59 10z"/><path fill="currentColor" d="m16 30l-6.176-3.293A10.98 10.98 0 0 1 4 17V4a2 2 0 0 1 2-2h20a2 2 0 0 1 2 2v13a10.98 10.98 0 0 1-5.824 9.707ZM6 4v13a8.99 8.99 0 0 0 4.766 7.942L16 27.733l5.234-2.79A8.99 8.99 0 0 0 26 17V4Z"/></svg>`,
           title:'Une éthique absolue',
           text:'La garantie d\'un accompagnement serein, intègre et transparent.'
       }
   ]
   
   const listRefs = ref({})
   
   const setRef = (el, index) => {
     if (el) listRefs.value[index] = el
   }
   
   const enter = (el) => {
     el.style.height = '0px'
     el.style.opacity = '0'
     el.style.transition = 'all 0.4s ease'
   
     requestAnimationFrame(() => {
       el.style.height = el.scrollHeight + 'px'
       el.style.opacity = '1'
     })
   }
   
   const leave = (el) => {
     el.style.height = el.scrollHeight + 'px'
     el.style.opacity = '1'
   
     requestAnimationFrame(() => {
       el.style.height = '0px'
       el.style.opacity = '0'
     })
   }
   const backSection = ref('form')
    onMounted(() => {
      if (window.location.hash) {
         backSection.value = window.location.hash.replace('#', '')
      }
   })
   
   const structuredData = JSON.stringify({
      "@context": "https://schema.org",
      "@type": "Service",
      "serviceType": "Syndic de copropriété",
      "provider": {
        "@type": "LocalBusiness",
        "name": "Axeco SRL",
        "streetAddress": "Chaussée de La Hulpe 150", 
        "addressLocality": "Bruxelles",
        "postalCode": "1170",
        "addressCountry": "BE"
      },
      "areaServed": {
        "@type": "City",
        "name": "Bruxelles"
      },
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Catalogue des Services Axeco",
        "itemListElement": [
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Maintenance et gestion technique",
              "description": "Nous pilotons la gestion technique de votre copropriété avec une vision à long terme, en anticipant les enjeux réglementaires."
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Gestion administrative",
              "description": "Une administration transparente, sécurisée et adaptée à votre réalité pour des échanges fluides et réactifs."
            }
          },
          {
            "@type": "Offer",
            "itemOffered": {
              "@type": "Service",
              "name": "Gestion financière",
              "description": "Nous assurons une gestion financière rigoureuse et transparente pour garantir des comptes clairs, fiables et respectueux des délais."
            }
          }
        ]
      }
    })
</script>
<template>
<MainLayout>
   <Head>
      <title>Nos Services | Syndic de Copropriété à Bruxelles - Axeco</title>
      <meta name="description" content="Gestion technique, administrative et financière de votre copropriété à Bruxelles. Expertise, transparence et solutions 360° pour votre immeuble." />
      <link rel="canonical" href="https://axeco.be/services" />

      <meta property="og:title" content="Services de Syndic Professionnel à Bruxelles | Axeco" />
      <meta property="og:description" content="Découvrez nos pôles d'expertise : gestion technique, financière et administrative." />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="https://axeco.be/services" />
      <component :is="'script'" type="application/ld+json"> {{ structuredData }}</component>
   </Head>
   <div id="services" role="main">
      <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-white text-[#0D4677] px-4 py-2 rounded z-50">Aller au contenu principal</a>
      <!-- Hero Section -->
      <section id="main-content" class="hero relative min-h-[700px] h-screen w-full flex items-center overflow-hidden" style="background: linear-gradient(180deg, rgba(232,243,255,0.8) 0%, rgba(255,255,255,0.5) 100%)">
         <div aria-hidden='true' class="hidden md:flex absolute left-15 top-50 w-[150px] h-[150px] border-3 border-[#F2522E] rotate-22 rounded-[33px] opacity-20"></div>
         <div aria-hidden='true' class="hidden md:flex absolute left-170 top-140 w-[100px] h-[100px] border-3 border-[#2E7EED] -rotate-54 rounded-[33px] opacity-20"></div>
         <div class="px-6 flex md:flex-col justify-center lg:flex-row relative z-20 w-full max-w-7xl mx-auto pt-25 md:pt-40 lg:pt-40 h-[100%]">
            <div class="flex flex-col gap-6 justify-center text-center lg:text-start items-center lg:items-start">
               <div class='flex gap-4 border-2 border-[#205a8c] rounded-[33px] py-2 px-4 items-center w-fit bg-white'>
                  <div class="bg-[#0d4677] rounded-[33px] w-[27px] h-[27px] flex items-center justify-center">
                     <svg aria-hidden='true' xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 25 24">
                        <path fill="white" d="M9.063 18.045c-.046-1.131-.794-2.194-1.803-3.18a7.5 7.5 0 1 1 10.48 0c-1.041 1.017-1.805 2.117-1.805 3.29v1.595a2.25 2.25 0 0 1-2.25 2.25h-2.373a2.25 2.25 0 0 1-2.25-2.25zM6.5 9.5a5.98 5.98 0 0 0 1.808 4.293c.741.724 1.512 1.633 1.933 2.707h4.518c.421-1.074 1.192-1.984 1.933-2.707A6 6 0 1 0 6.5 9.5m4.063 8.713v1.537c0 .414.335.75.75.75h2.372a.75.75 0 0 0 .75-.75V18h-3.873v.017a4 4 0 0 1 0 .196M1.75 9.5a.75.75 0 0 1 .75-.75h1a.75.75 0 0 1 0 1.5h-1a.75.75 0 0 1-.75-.75m2.465-5.65a.75.75 0 1 0-.75 1.3l.866.5a.75.75 0 1 0 .75-1.3zM3.19 14.875a.75.75 0 0 1 .275-1.024l.866-.5a.75.75 0 0 1 .75 1.298l-.866.5a.75.75 0 0 1-1.025-.274M21.5 8.75a.75.75 0 0 0 0 1.5h1a.75.75 0 0 0 0-1.5zm-1.855 4.875a.75.75 0 0 1 1.025-.274l.866.5a.75.75 0 1 1-.75 1.298l-.866-.5a.75.75 0 0 1-.275-1.024m.275-9.275a.75.75 0 0 0 .75 1.3l.866-.5a.75.75 0 1 0-.75-1.3z"/>
                     </svg>
                  </div>
                  <span class='inline-block text-sm py-2 px-2 lg:px-4 font-semibold'>SOLUTIONS PROFESSIONNELLES</span>
               </div>
               <h1 class='text-[35px] md:text-[50px] lg:text-[60px] leading-tight mt-6 font-semibold  text-[#0D4677]'>Nos services</h1>
               <p class="text-[16px] lg:text-[18px] text-[#4c6e9a] max-w-[90%] lg:max-w-[50%] leading-relaxed mt-1 mb-6">Des solutions complètes et personnalisées pour la gestion de votre copropriété</p>
               <div class="flex flex-col items-center mt-2 lg:flex-row gap-4 w-[280px] md:w-[280px] lg:w-auto">
                  <Link :href="route('Contact', { subject: 'demande' }) + '#' + backSection" class="inline-flex items-center gap-3 px-10 py-4 rounded-[33px] text-white font-semibold text-[16px] bg-[color:var(--accent)] shadow-[4px_4px_10px_rgba(0,0,0,0.25)] hover:bg-[#d94827] transition-all active:scale-[0.97] focus-visible:ring-2 focus-visible:ring-[#F2522E] focus-visible:ring-offset-2 touch-manipulation">
                     Demander une offre <ArrowRight/>
                  </Link>
                  <Link :href="route('Contact') + '#' + backSection" class="inline-flex items-center gap-3 w-55 lg:w-auto px-10 py-4 rounded-[33px] text-[color:var(--text-dark-blue)] border-2 border-[color:var(--text-dark-blue)] font-semibold text-[16px] shadow-[4px_4px_10px_rgba(0,0,0,0.25)] hover:text-[color:var(--accent)] border-[color:var(--accent)] transition-all active:scale-[0.97] focus-visible:ring-2 focus-visible:ring-[#F2522E] focus-visible:ring-offset-2 touch-manipulation">
                     Contactez-nous!
                  </Link>
               </div>
            </div>
            <div class="relative hidden md:flex items-center justify-center mx-auto w-full max-w-[60%] mt-10 lg:max-w-[600px]  lg:w-[45vw] lg:mt-0">
               <img src="/images/services/hero-office.webp" loading="lazy" class="relative z-0 w-[75%] rotate-6 rounded-[20px] border-6 border-[#B9D6FE] shadow-xl object-cover" alt="" aria-hidden="true"/>
               <img src="/images/services/hero-analysis.webp" loading="lazy"
                  class="absolute top-[10%] left-[5%] w-[40%] -rotate-8 z-10 rounded-[20px] border-6 border-[#B9D6FE] shadow-lg object-cover" alt="" aria-hidden="true"/>
               <img src="/images/services/hero-building.webp" loading="lazy" class="absolute bottom-[5%] right-[5%] w-[45%] h-[30%] rotate-8 z-10 rounded-[20px] border-6 border-[#B9D6FE] shadow-lg object-cover" alt="" aria-hidden="true"/>
            </div>
         </div>
      </section>
<!-- Bloc de confiance -->
      <section class="bloc_confiance relative flex flex-col items-center justify-center gap-3 py-8 px-6 lg:py-12 lg:px-12 text-center bg-white max-h-screen overflow-hidden">
         <!-- Contenu flexible -->
         <div class="flex flex-col items-center flex-1 justify-center overflow-auto max-h-[80vh]">
            <h2 class="font-bold text-[22px] lg:text-[32px] text-[#0d4677] leading-tight mb-1">Axeco : gérer votre copropriété à 360° <br class="hidden lg:block" />avec proximité et sérénité </h2>
            <p class="text-[16px] lg:text-[18px] text-[#4c6e9a] max-w-[80%] leading-relaxed mt-1">Notre vision transversale repose sur l'interconnexion de nos pôles administratif, technique et financier. Grâce à <strong class="text-[#205a8c]">une rigueur absolue</strong> et à une <strong class="text-[#205a8c]">culture orientée solutions</strong>, nous <strong class="text-[#205a8c]">transformons vos défis administratifs</strong> en leviers de valorisation durable de votre patrimoine.</p>
            <!-- Pôles d'expertise -->
            <div class="flex flex-wrap justify-center gap-6 mt-4">
               <!-- Administratif -->
               <div class="relative flex flex-col items-center group transition-transform duration-500 hover:-translate-y-1">
                  <!-- Orange glow -->
                  <div class="absolute inset-0 rounded-full bg-[#f2522e]/20 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                  <div class="relative w-14 h-14 lg:w-16 lg:h-16 bg-gradient-to-br from-[#205a8c] to-[#0d4677] rounded-full flex items-center justify-center text-white font-bold text-xl lg:text-2xl shadow-lg transition-all duration-500 group-hover:from-[#f2522e] group-hover:to-[#d94328]"> A </div>
                  <span class="mt-1 text-[#0d4677] font-semibold transition-colors duration-300 group-hover:text-[#f2522e]">Administratif</span>
               </div>
               <!-- Technique -->
               <div class="relative flex flex-col items-center group transition-transform duration-500 hover:-translate-y-1">
                  <div class="absolute inset-0 rounded-full bg-[#f2522e]/20 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                  <div class="relative w-14 h-14 lg:w-16 lg:h-16 bg-gradient-to-br from-[#205a8c] to-[#0d4677] rounded-full flex items-center justify-center text-white font-bold text-xl lg:text-2xl shadow-lg transition-all duration-500 group-hover:from-[#f2522e] group-hover:to-[#d94328]"> T </div>
                  <span class="mt-1 text-[#0d4677] font-semibold transition-colors duration-300 group-hover:text-[#f2522e]">Technique </span>
               </div>
               <!-- Financier -->
               <div class="relative flex flex-col items-center group transition-transform duration-500 hover:-translate-y-1">
                  <div class="absolute inset-0 rounded-full bg-[#f2522e]/20 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                  <div class="relative w-14 h-14 lg:w-16 lg:h-16 bg-gradient-to-br from-[#205a8c] to-[#0d4677] rounded-full flex items-center justify-center text-white font-bold text-xl lg:text-2xl shadow-lg transition-all duration-500 group-hover:from-[#f2522e] group-hover:to-[#d94328]"> F </div>
                  <span class="mt-1 text-[#0d4677] font-semibold transition-colors duration-300 group-hover:text-[#f2522e]"> Financier </span>
               </div>
            </div>
            <p class="mt-3 italic text-[#4c6e9a] text-[16px] lg:text-[18px]"> "Une approche transversale pour une gestion complète"</p>
         </div>
      </section>
      <section class="services py-8 lg:py-20" aria-labelledby="services-title" style="background-image: linear-gradient(to bottom, #FFFFFF 0%, #F0F6FC 50%, #FFFFFF 100%);">
         <h2 id="services-title" class="sr-only">Liste complète des services</h2>
         <div class="max-w-7xl mx-auto px-6">
            <div v-for="(service, index) in props.services" :key="index" class="mb-18 lg:mb-28">
               <div 
                  :id="service.anchor"
                  :class="[
                  'section-anchor mb-10 flex border-1 rounded-[33px] w-fit py-2 px-5',
                  index % 2 !== 0 
                  ? 'lg:justify-end' 
                  : 'lg:justify-start'
                  ]"
                  :style="{ color: service.accentColor, background: service.bgColor, borderColor: service.accentColor}"
                  >
                  <span class="text-sm uppercase tracking-widest font-semibold text-[#0D4677]/60" :style="{ color: service.accentColor}">Service {{ index + 1 }}</span>
               </div>
               <div class="flex flex-col lg:flex-row gap-10 lg:gap-20">
                  <div class="w-full lg:w-1/2">
                     <div class="bg-white rounded-[28px] shadow-xl overflow-hidden">
                        <img :src="service.image_url" :alt="service.title" class="w-full h-[320px] object-cover"/>
                        <div class="p-6 md:p-8">
                           <h3 class="text-[26px] md:text-[30px] font-semibold text-[#0D4677]"> {{ service.title }}</h3>
                        </div>
                     </div>
                  </div>
                  <div class=" rich-editor w-full lg:w-1/2 flex flex-col justify-start">
                     <p v-html="service.content"></p>
                        <button
                           :id="'service-button-' + index"
                           type="button"
                           v-if="service.details"
                           @click="openDetailsIndex = openDetailsIndex === index ? null : index"
                           :aria-expanded="openDetailsIndex === index"
                           :aria-controls="'service-details-' + index"
                           :aria-labelledby="'service-button-' + index"
                           class="group cursor-pointer text-[#0d4677] text-[18px] font-bold flex items-center gap-2 mb-2 focus-visible:ring-2 focus-visible:ring-[#F2522E]focus-visible:ring-offset-2"
                        >
                           <span class='text-[18px] font-bold'>{{ openDetailsIndex === index ? '−' : '+' }}</span> 
                           Détails
                        </button>
                        <transition name="accordion" @enter="enter" @leave="leave">
                           <ul 
                              v-if="openDetailsIndex === index && service.details"
                              class="list-disc ml-6 text-[#4c6e9a] space-y-1 text-[16px]"
                              :id="'service-details-' + index"
                              role="region"
                              >
                              <li v-for="(item, i) in service.details" :key="i">{{ item.content }}</li>
                           </ul>
                        </transition>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="valeurs">
         <div class="flex flex-col items-center text-center px-6 lg:pb-20 lg:px-12 mb-10 lg:mb-13">
            <h2 class="text-[28px] lg:text-[40px] mb-[13px] font-bold text-[color:var(--text-blue-dark)]">Pourquoi choisir AXECO?</h2>
            <!-- Divider -->
            <div class=" w-[100px] lg:w-[130px] h-[5px] bg-gradient-to-r from-[#F2522E] to-[#205A8C] rounded mt-[2px] lg:mt-[5px] mb-5 lg:mb-10"></div>
            <!-- Desktop -->
            <div class="hidden lg:flex justify-center">
               <div class="grid gap-10 grid-cols-1 lg:grid-cols-4 lg:max-w-[95%] ">
                  <div v-for="(valeur, index) in valeurs" :key="index" class="group block">
                     <div class="relative h-[100%] rounded-[24px] p-5 border-2 border-[#c6e0fa] bg-white transition-all duration-300 group-hover:-translate-y-2 group-hover:shadow-[0px_15px_35px_rgba(16,43,64,0.25)]">
                        <!-- Icon -->
                        <div class="w-[60px] h-[60px] rounded-full mb-8 mx-auto flex items-center justify-center bg-[rgb(143,155,191,0.3)]" v-html="valeur.icon" />
                           <!-- Title -->
                           <h3 class="text-[22px] font-semibold text-[#0d4677] mb-8">  {{ valeur.title }} </h3>
                           <!-- Description -->
                           <p class="text-[18px] text-[#4c6e9a] leading-relaxed">{{ valeur.text }}</p>
                        </div>
                     </div>
               </div>
            </div>
         </div>
         <div class="lg:hidden px-4 pb-16">
            <Swiper
               :spaceBetween="30"
               :slides-per-view="1"
               :breakpoints="{
               640: {
               slidesPerView: 1,
               spaceBetween: 20
               },
               768: {
               slidesPerView: 2,
               spaceBetween: 20
               },
               }"
               :pagination="{
               clickable: true,
               }"
               :modules="modules"
               class="mySwiper"
               aria-label="Liste des valeurs Axeco"
               >
               <SwiperSlide
                  v-for="(valeur, index) in valeurs"
                  :key="index"
                  class="flex m-auto"
                  role="group"
                  :aria-label="`Valeur ${index + 1} sur ${valeurs.length}`"
                  >
                  <div class="flex flex-col w-full min-h-[260px] rounded-[20px] p-6 border border-[#c6e0fa] bg-white" >
                     <!-- Icon -->
                     <div class="w-[50px] h-[50px] rounded-full mb-5 mx-auto flex items-center justify-center bg-[rgb(143,155,191,0.2)]" v-html="valeur.icon"></div>
                     <!-- Title -->
                     <h4 class="text-[18px] font-semibold text-[#0d4677] text-center mb-3">{{ valeur.title }}</h4>
                     <!-- Description -->
                     <p class="text-[15px] text-[#4c6e9a] text-center leading-relaxed flex-grow"> {{ valeur.text }}  </p>
                  </div>
               </SwiperSlide>
            </Swiper>
         </div>
      </section>
      <section class='chargement'>
         <div class="bg-gradient-to-b py-10 from-[rgb(32,90,140)] to-[rgb(32,90,140,0.8)] max-w-[100%] mx-auto px-10 text-center text-white flex flex-col items-center gap-8 lg:gap-6 ">
            <h2 class="text-[25px] lg:text-[30px] font-bold">Prêt à améliorer la gestion de votre copropriété ?</h2>
            <p class="text-[16px] lg:text-[18px]" >Contactez-nous dès aujourd'hui pour une consultation gratuite et découvrez comment nos services peuvent transformer la gestion de votre bien. </p>
            <!-- Bottom Button -->
            <div class="flex justify-center">
               <div class="flex flex-col items-center mt-2 md:flex-row justify-center lg:flex-row gap-4 w-[280px] md:w-auto lg:w-auto">
                  <a href="tel:+3228972008" aria-label="Appeler +32 2 897 20 08" class="inline-flex items-center gap-3 w-fit lg:w-auto px-10 py-4 rounded-[33px] text-[color:var(--text-dark-blue)] border-2 border-[color:var(--text-dark-blue)] font-semibold text-[16px] shadow-[4px_4px_10px_rgba(0,0,0,0.25)] hover:text-[color:var(--accent)] border-[color:var(--accent)] transition-all active:scale-[0.97] focus-visible:ring-2 focus-visible:ring-[#F2522E] focus-visible:ring-offset-2 touch-manipulation"> Appelez-nous</a>
                  <Link :href="route('Contact') + '#' + backSection" class="inline-flex items-center gap-3 w-fit lg:w-auto px-10 py-4 rounded-[33px] text-white font-semibold text-[16px] bg-[color:var(--accent)] shadow-[4px_4px_10px_rgba(0,0,0,0.25)] hover:bg-[#d94827] transition-all active:scale-[0.97] focus-visible:ring-2 focus-visible:ring-[#F2522E] focus-visible:ring-offset-2 touch-manipulation">
                     Contactez-nous!<ArrowRight/>
                  </Link>
               </div>
            </div>
         </div>
      </section>
</div>
</MainLayout>
</template>
<style>
   .section-anchor {
   scroll-margin-top: 210px;
   }
   .accordion-enter-active,
   .accordion-leave-active {
   transition: all 0.4s ease;
   }
   .accordion-enter-from,
   .accordion-leave-to {
   opacity: 0;
   transform: translateY(-10px);
   }
   .accordion-enter-to,
   .accordion-leave-from {
   opacity: 1;
   transform: translateY(0);
   }
   .swiper{
   width:90%;
   margin-bottom:2rem;
   }
   .swiper-pagination-bullet{
   border:solid 3px #0d4677;
   background-color:white;
   }
   .swiper-pagination-bullet-active{
   background-color:#0d4677
   }
</style>