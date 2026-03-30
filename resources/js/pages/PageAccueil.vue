<script setup>
import MainLayout from '@/layouts/MainLayout.vue'
import { ref,onMounted,onUnmounted,computed } from 'vue'
import ArrowRight from '@/components/icons/ArrowRightIcon.vue'
import { Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { Swiper,SwiperSlide } from 'swiper/vue'
   import {Navigation } from 'swiper/modules'
   import 'swiper/css'
   import 'swiper/css/navigation'

const modules = [Navigation]

const swiperInstance = ref(null);

const onSwiper = (swiper) => {
  swiperInstance.value = swiper;
};

// Обнови функции кнопок
function prev() {
  swiperInstance.value?.slidePrev();
}

function next() {
  swiperInstance.value?.slideNext();
}

const services = [
  {
    title: 'Maintenance et gestion technique',
    description:
      'Nous pilotons la gestion technique de votre copropriété avec une vision à long terme, en anticipant les enjeux réglementaires.',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256"><path fill=#ffffff d="M240 208h-16v-72l2.34 2.34A8 8 0 0 0 237.66 127l-98.35-98.32a16 16 0 0 0-22.62 0L18.34 127a8 8 0 0 0 11.32 11.31L32 136v72H16a8 8 0 0 0 0 16h224a8 8 0 0 0 0-16M48 120l80-80l80 80v88h-48v-56a8 8 0 0 0-8-8h-48a8 8 0 0 0-8 8v56H48Zm96 88h-32v-48h32Z"/></svg>`,
    anchor: 'gestion-technique',
    link: '/services#gestion-technique'
  },
  {
    title: 'Gestion administrative',
    description:
      'Une administration transparente, sécurisée et adaptée à votre réalité pour des échanges fluides et réactifs.',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke=#ffffff stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.728 3H7.5a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h9a2.25 2.25 0 0 0 2.25-2.25V12M9.728 3C10.971 3 12 4.007 12 5.25V7.5a2.25 2.25 0 0 0 2.25 2.25h2.25A2.25 2.25 0 0 1 18.75 12M9.728 3c3.69 0 9.022 5.36 9.022 9"/></svg>`,
    anchor: 'gestion-administrative',
    link: '/services#gestion-administrative'
  },
  {
    title: 'Gestion financière',
    description:
      'Nous assurons une gestion financière rigoureuse et transparente pour garantir des comptes clairs, fiables et respectueux des délais.',
    icon: `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill=#ffffff d="M4 2H2v26a2 2 0 0 0 2 2h26v-2H4Z"/><path fill=#ffffff d="M30 9h-7v2h3.59L19 18.59l-4.29-4.3a1 1 0 0 0-1.42 0L6 21.59L7.41 23L14 16.41l4.29 4.3a1 1 0 0 0 1.42 0l8.29-8.3V16h2Z"/></svg>`,
    anchor: 'gestion-financiere',
    link: '/services#gestion-financiere',
  }
]

// const news = [
//   {
//     id: 1,
//     title: 'Assemblée générale annuelle',
//     excerpt: 'Retour sur les décisions clés et les points importants abordés lors de l’assemblée générale annuelle.',
//     content: 'Contenu complet de la nouvelle 1...',
//     image: '/images/page_accueil/news.jpg',
//     date: '15 Jan 2025',
//     slug: 'assemblee-generale-annuelle'
//   },
//   {
//     id: 2,
//     title: 'Travaux de rénovation',
//     excerpt: 'Des travaux importants ont été réalisés pour améliorer la sécurité et le confort de vos immeubles.',
//     content: 'Contenu complet de la nouvelle 2...',
//     image: '/images/page_accueil/news.jpg',
//     date: '10 Feb 2025',
//     slug: 'travaux-renovation'
//   },
//   {
//     id: 3,
//     title: 'Nouvelle équipe de gestion',
//     excerpt: 'Découvrez notre nouvelle équipe qui accompagnera vos copropriétés avec professionnalisme.',
//     content: 'Contenu complet de la nouvelle 3...',
//     image: '/images/page_accueil/news.jpg',
//     date: '05 Mar 2025',
//     slug: 'nouvelle-equipe'
//   },
//   {
//     id: 4,
//     title: 'Assemblée générale annuelle',
//     excerpt: 'Retour sur les décisions clés et les points importants abordés lors de l’assemblée générale annuelle.',
//     content: 'Contenu complet de la nouvelle 1...',
//     image: '/images/page_accueil/news.jpg',
//     date: '15 Jan 2025',
//     slug: 'assemblee-generale-annuelle'
//   },
//   {
//     id: 5,
//     title: 'Travaux de rénovation',
//     excerpt: 'Des travaux importants ont été réalisés pour améliorer la sécurité et le confort de vos immeubles.',
//     content: 'Contenu complet de la nouvelle 2...',
//     image: '/images/page_accueil/news.jpg',
//     date: '10 Feb 2025',
//     slug: 'travaux-renovation'
//   },
// ]
const props = defineProps({
        articles: {
            type: Array,
            default: () => [] 
        },
        topics: Array})

const faq=[
  {
    id:1,
    question:'Le syndic est-il obligatoire en Belgique ?',
    answer:'Oui. Toute copropriété comprenant plusieurs lots doit obligatoirement désigner un syndic, conformément à la loi belge.'
  },
  {
    id:2,
    question:'Pourquoi choisir un syndic professionnel ?',
    answer:'Un syndic professionnel garantit une gestion transparente, conforme à la législation et un suivi rigoureux des aspects administratifs, financiers et techniques.'
  },
  {
    id:3,
    question:'Est-il possible de changer facilement de syndic ?',
    answer:'Oui. Le changement se fait par vote lors de l’assemblée générale. Nous accompagnons entièrement la transition pour assurer une reprise sans stress.'
  },
  {
    id:4,
    question:'Comment sont gérées les charges de copropriété ?',
    answer:'Les charges sont réparties selon les quotes-parts définies et suivies avec une comptabilité claire et accessible aux copropriétaires.'
  },
]

// Actualités
const newsIndex = ref(0);

const cardWidth=500
const gap=20


const newsSlider = ref(null)
const progress = ref(0)

const onNewsScroll = () => {
  const slider = newsSlider.value;
  if (!slider) return;
  
  const scrollLeft = slider.scrollLeft;
  const scrollWidth = slider.scrollWidth - slider.clientWidth;
  
  progress.value = (scrollLeft / scrollWidth) * 100;
};

const mobileNews = computed(() => props.articles.slice(0,6))

//FAQ
const openIndex = ref(null)

function toggle(index) {
  openIndex.value = openIndex.value === index ? null : index
}

//Services
const servicesSlider = ref(null)
let servicesIndex = ref(0)

const onServicesScroll = () => {
  if (!servicesSlider.value) return

  const scrollLeft = servicesSlider.value.scrollLeft
  const width = servicesSlider.value.offsetWidth

  servicesIndex.value = Math.round(scrollLeft / width)
}

const backSection = ref('form') 
onMounted(() => {
    if (window.location.hash) {
        backSection.value = window.location.hash.replace('#', '')
    }
})
</script>

<template>
<MainLayout>
<div id="page_accueil">
   <!-- Hero Section -->
<section class="relative min-h-[700px] h-screen w-full overflow-hidden flex items-center">
   <div class='absolute inset-0 bg-[url("/images/page_accueil/bg-1.jpg")] bg-no-repeat bg-[position:100%_left] bg-[length:120%_120%] z-0'>
      <div class="absolute inset-0 bg-black/40"></div>
   </div>
   <div class="absolute left-[-60%] md:left-[-50%] 
      lg:left-[-35%]
      top-[55%] md:top-[54%] lg:top-[59%] 
      w-[160%] md:w-[120%] lg:w-[100%] 
      h-[100%] sm:h-[90%] md:h-[95%] lg:h-[85%]
      bg-white/80 rounded-full z-10
      -translate-y-1/2
      origin-center
      transition-all duration-700 ease-in-out">
   </div>
   <div class="relative z-20 w-full max-w-7xl mx-auto px-6 pt-25 md:pt-32 lg:pt-40">
      <div class="max-w-[650px]">
         <span class='inline-block text-xs border-2 border-[#205a8c] rounded-[33px] py-2 px-4 font-semibold'>
         VOTRE PARTENAIRE DE CONFIANCE
         </span>
         <h1 class='w-[70%] md:w-[85%] lg:w-[100%] text-[35px] md:text-[50px] lg:text-[60px] leading-tight mt-6 font-semibold  text-[#0D4677]'>
            Plus qu’un syndic,<br>
            votre partenaire au quotidien
         </h1>
         <div class="w-[150px] md:w-[170px] lg:w-[200px] h-[3px] bg-[#4c6e9a] my-10 rounded"></div>
         <div class="flex flex-col lg:flex-row gap-4 w-54 w-[240px] md:w-[280px] lg:w-auto">
            <Link :href="route('Contact', { subject: 'commande' }) + '#' + backSection" 
               class="inline-flex items-center gap-3
               px-4 lg:px-10 py-4 rounded-[33px]
               text-white font-semibold text-[16px]
               bg-[color:var(--accent)]
               shadow-[4px_4px_10px_rgba(0,0,0,0.25)]
               hover:bg-[#d94827]
               transition-all
               active:scale-[0.97]
               focus:outline-none
               touch-manipulation"
               >
               Demander une plaque
               <ArrowRight/>
            </Link>
            <Link
               :href="route('Contact') + '#' + backSection"
               class="inline-flex items-center gap-3 w-fit lg:w-auto
               px-6 lg:px-10 py-4 rounded-[33px]
               text-[color:var(--text-dark-blue)] border-2 border-[color:var(--text-dark-blue)] font-semibold text-[16px]
               shadow-[4px_4px_10px_rgba(0,0,0,0.25)]
               hover:text-[color:var(--accent)]
               border-[color:var(--accent)]
               transition-all
               active:scale-[0.97]
               focus:outline-none
               touch-manipulation"
               >
            Contactez-nous!
            </Link>
         </div>
      </div>
   </div>
</section>
<!-- Bloc de confiance modernisé et compact -->
<section class="relative flex flex-col items-center justify-center gap-3 py-8 px-6 lg:py-12 lg:px-12 text-center bg-white max-h-screen overflow-hidden">
   <!-- Badge SVG -->
   <div aria-hidden="true" class="relative mb-2 group flex-shrink-0">
      <svg xmlns="http://www.w3.org/2000/svg"
         viewBox="0 0 24 24"
         class="w-12 h-12 lg:w-14 lg:h-14 border-2 border-[#205a8c] rounded-lg transition-transform duration-500 group-hover:scale-110">
         <g fill="none" stroke="#205a8c" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
            <path d="M6 9a6 6 0 1 0 12 0A6 6 0 1 0 6 9"/>
            <path d="m12 15l3.4 5.89l1.598-3.233l3.598.232l-3.4-5.889M6.802 12l-3.4 5.89L7 17.657l1.598 3.232l3.4-5.889"/>
         </g>
      </svg>
      <div class="absolute -top-2 -right-2 w-4 h-4 rounded-full bg-[#205a8c] animate-bounce-slow"></div>
      <div class="absolute -bottom-2 -left-2 w-4 h-4 rounded-full bg-[#0d4677] animate-bounce-slow"></div>
   </div>
   <!-- Contenu flexible -->
   <div class="flex flex-col items-center flex-1 justify-center overflow-auto max-h-[80vh]">
      <h2 class="font-bold text-[22px] lg:text-[32px] text-[#0d4677] leading-tight mb-1">
          Plus de 30 ans d’expérience à Bruxelles
      </h2>
      <p class="text-[16px] lg:text-[18px] text-[#627a9a] max-w-[100%] leading-relaxed mt-1">
         Une expertise reconnue et une confiance bâtie au fil des années
      </p>
   </div>
</section>
<!-- à propos -->
<section class="bg-gradient-to-r from-[#F0F6FC] to-[#ffffff] py-16 lg:py-20">
   <div class="flex flex-col items-center justify-center text-center">
      <!-- Header -->
      <div class="flex flex-col items-center text-center mb-5 lg:mb-8">
         <h2 class="text-[12px] mb-[13px] text-[color:var(--text-orange)]">
            QUI SOMMES-NOUS
         </h2>
         <h3 class="text-[28px] lg:text-[40px] mb-[13px]">
            À propos
         </h3>
         <div class=" w-[100px] lg:w-[130px] h-[5px] bg-gradient-to-r from-[#F2522E] to-[#205A8C] rounded mt-[2px] lg:mt-[5px] mb-5 lg:mb-10"></div>
      </div>
      <!-- Image + Text -->
      <div class="flex flex-col lg:flex-row
         gap-10 lg:gap-20
         items-center justify-center
         mb-16 lg:mb-[100px]
         w-[90%]">
         <!-- Image -->
         <div class="w-full lg:w-[60%] h-[260px] lg:h-[450px]">
            <img
               src="/images/page_accueil/a_propos.png"
               alt="Image à propos"
               class="rounded-[20px] border border-[#0D4677]
               w-full h-full object-cover object-[center_30%]"
               >
         </div>
         <!-- Text block -->
         <div class="w-full lg:w-[40%]
            bg-gradient-to-b from-[rgb(32,90,140)] to-[rgb(32,90,140,0.8)]
            rounded-[20px]
            p-8 lg:p-10
            flex flex-col gap-6 lg:gap-8
            text-left">
            <h4 class="text-[22px] lg:text-[30px] text-white">
               L’essence d’Axeco
            </h4>
            <p class="text-[14px] lg:text-[16px] text-[color:rgb(255,255,255)] font-normal">
               Fort de 30 ans d'expertise, <strong class="text-white">Axeco</strong> accompagne les copropriétés bruxelloises avec une vision 
               engagée propre à ses valeurs : <strong class="text-white">allier éthique et transparence</strong>. 
               Notre équipe pluridisciplinaire met son savoir-faire technique, 
               juridique et financier au service d'une <strong class="text-white">gestion sur mesure</strong> axée
               sur la <strong class="text-white">collaboration</strong> pour <strong class="text-white">valoriser durablement</strong> votre patrimoine en <strong class="text-white">transformant 
               chaque défis en opportunité.</strong>
            </p>
            <Link :href="route('A_propos')"
               class="inline-flex items-center gap-3
               px-8 lg:px-10 py-3 lg:py-4
               rounded-[33px] w-fit
               text-white font-semibold text-[15px] lg:text-[16px]
               bg-[color:var(--accent)]
               shadow-[4px_4px_10px_rgba(0,0,0,0.25)]
               hover:bg-[#d94827]
               transition-all 
               active:scale-[0.97]
               focus:outline-none
               touch-manipulation">
               En savoir plus
               <ArrowRight/>
            </Link>
         </div>
      </div>
      <!-- Bottom CTA -->
      <div class="flex flex-col items-center justify-center text-center
         border border-dashed border-[#205A8C]
         bg-[#fbfbfb] rounded-[20px]
         w-[90%] lg:w-[70%]
         m-auto py-8 px-6">
         <p class="font-semibold text-[20px] lg:text-[26px] pb-6">
            Derrière nos services se trouve une équipe de spécialistes
         </p>
         <Link :href='route("Notre_equipe")'
            class="inline-flex items-center gap-3
            px-10 py-4 rounded-[33px]
            text-white font-semibold text-[16px]
            bg-[color:var(--accent)]
            shadow-[4px_4px_10px_rgba(0,0,0,0.25)]
            hover:bg-[#d94827]
            transition-all 
            active:scale-[0.97]
            focus:outline-none
            touch-manipulation">
            Découvrir l’équipe
            <ArrowRight/>
         </Link>
      </div>
   </div>
</section>
<!-- Services -->
<section class="py-16 lg:py-20">
   <!-- Header -->
   <div class="flex flex-col items-center text-center mb-10 lg:mb-13">
      <h2 class="text-[12px] mb-[13px] text-[color:var(--text-orange)]">
         CE QUE NOUS OFFRONS
      </h2>
      <h3 class="text-[28px] lg:text-[40px] mb-[13px] text-[color:var(--text-blue-dark)]">
         Nos Services
      </h3>
      <!-- Divider -->
      <div class=" w-[100px] lg:w-[130px] h-[5px] bg-gradient-to-r from-[#F2522E] to-[#205A8C] rounded mt-[2px] lg:mt-[5px] mb-5 lg:mb-10"></div>
      <p class="text-[14px] lg:text-[18px] text-[color:var(--text-blue-light)] max-w-[80%]">
         Des solutions complètes pour la gestion de vos copropriétés
      </p>
   </div>
   <!-- Mobile/Table -->
   <!-- Cards -->
   <div class="lg:hidden overflow-hidden">
   <div ref="servicesSlider" class="flex gap-6 max-w-[80%] overflow-x-auto scroll-smooth snap-x snap-mandatory  scrollbar-hide px-6 md:w-[60%] m-auto" @scroll="onServicesScroll">
      <a
         v-for="(service, index) in services"
         :key="index"
         :href="service.link"
         class="cursor-pointer snap-center snap-always shrink-0 w-[100%] md:w-[85%] block"
         >
         <div
            class="relative h-[100%] md:h-[100%] rounded-[24px] p-10
            border-2 border-[#c6e0fa]
            transition-all duration-300
            group-hover:-translate-y-2
            group-hover:shadow-[0px_15px_35px_rgba(16,43,64,0.25)]"
            style="
            background-image: linear-gradient(
            -42deg,
            #ffffff 43%,
            rgba(224,239,255,0.5) 100%
            );
            "
            >
            <!-- Icon -->
            <div
               class="w-[60px] h-[60px] rounded-[10px] mb-8
               flex items-center justify-center"
               style="
               background-image:
               linear-gradient(180deg, rgba(32,90,140,0.2), rgba(255,255,255,0.2)),
               linear-gradient(90deg, #205A8C, #205A8C);
               "
               v-html="service.icon"
               />
               <!-- Title -->
               <h3 class="text-[20px] font-semibold text-[#0d4677] mb-8">
                  {{ service.title }}
               </h3>
               <!-- Description -->
               <p class="text-[16px] text-[#627a9a] leading-relaxed">
                  {{ service.description }}
               </p>
            </div>
      </a>
      </div>
      <!-- Dots -->
      <div class="flex justify-center gap-2 mt-6">
         <span
            v-for="(dot, index) in services"
            :key="index"
            class="w-2.5 h-2.5 rounded-full transition-all"
            :class="servicesIndex === index
            ? 'bg-[#205A8C]'
            : 'bg-[#c6e0fa]'"
            ></span>
      </div>
   </div>
   <!-- Desktop -->
   <!-- Cards -->
   <div class="hidden lg:flex justify-center">
   <div class="grid gap-10 grid-cols-1 lg:grid-cols-3 lg:max-w-[95%] ">
      <a
         v-for="(service, index) in services"
         :key="index"
         :href="service.link"
         class="cursor-pointer group block"
         >
         <div
            class="relative h-[100%] rounded-[24px] p-10
            border-2 border-[#c6e0fa]
            transition-all duration-300
            group-hover:-translate-y-2
            group-hover:shadow-[0px_15px_35px_rgba(16,43,64,0.25)]"
            style="
            background-image: linear-gradient(
            -42deg,
            #ffffff 43%,
            rgba(224,239,255,0.5) 100%
            );
            "
            >
            <!-- Icon -->
            <div
               class="w-[60px] h-[60px] rounded-[10px] mb-8
               flex items-center justify-center"
               style="
               background-image:
               linear-gradient(180deg, rgba(32,90,140,0.2), rgba(255,255,255,0.2)),
               linear-gradient(90deg, #205A8C, #205A8C);
               "
               v-html="service.icon"
               />
               <!-- Title -->
               <h3 class="text-[22px] font-semibold text-[#0d4677] mb-8">
                  {{ service.title }}
               </h3>
               <!-- Description -->
               <p class="text-[18px] text-[#627a9a] leading-relaxed">
                  {{ service.description }}
               </p>
            </div>
      </a>
      </div>
   </div>
   <!-- Bottom Button -->
   <div class="flex justify-center mt-8">
      <Link
         :href="route('Services')"
         class="inline-flex items-center gap-3
         px-10 py-4 rounded-[33px]
         text-white font-semibold text-[16px]
         bg-[#0D4677]
         shadow-[4px_4px_10px_rgba(0,0,0,0.25)]
         hover:bg-[color:var(--accent)]
         transition-all
         active:scale-[0.97]
         focus:outline-none
         touch-manipulation"
         >
         Découvrir tous nos services
         <ArrowRight/>
      </Link>
   </div>
</section>
<!-- Actualités -->
<section class="py-16 lg:py-20 bg-[color:var(--bg-light-2)]">
   <!-- Header -->
   <div class="flex flex-col items-center text-center mb-5 lg:mb-8">
      <h2 class="text-[12px] mb-[13px] text-[color:var(--text-orange)]">RESTEZ INFORMÉS</h2>
      <h3 class="text-[28px] lg:text-[40px] mb-[13px]">Actualités</h3>
      <!-- Divider -->
      <div class=" w-[100px] lg:w-[130px] h-[5px] bg-gradient-to-r from-[#F2522E] to-[#205A8C] rounded mt-[2px] lg:mt-[5px] mb-5 lg:mb-10"></div>
   </div>
   <!-- Mobile/Tablette -->
   <div class="lg:hidden block relative max-w-[90%] md:max-w-[75%] mx-auto">
      <div
         ref="newsSlider"
         class="flex overflow-x-auto scroll-smooth snap-x snap-mandatory scrollbar-hide gap-6 px-3 items-start"
         @scroll="onNewsScroll"
         >
         <div
            v-for="(item, index) in mobileNews"
            :key="item.id"
            class="flex-shrink-0 w-full max-w-[85%] md:max-w-[70%] snap-start snap-always"
            >
            <a
               :href="`/actualites/article/${item.id}`"
               class="block rounded-lg overflow-hidden bg-white shadow-xs"
               >
               <!-- Image -->
               <div class="w-full aspect-[16/9] overflow-hidden">
                  <img
                     :src="item.image_url"
                     alt=""
                     class="w-full h-full object-cover"
                     />
               </div>
               <!-- Content -->
               <div class="py-6 px-4 flex flex-col justify-between h-[160px] md:h-[110px]">
                  <h3 class="text-[18px] font-semibold text-[#0d4677] mb-1 clamp-1">{{ item.title }}</h3>
                  <p class="text-gray-600 text-[14px] clamp-2">{{ item.description }}</p>
               </div>
            </a>
         </div>
      </div>
      <!-- Progress bar -->
      <div class="w-[90%] h-1 bg-[#c6e0fa] rounded overflow-hidden mx-auto mt-8 mb-10">
         <div
            class="h-full bg-[#f2522e] transition-all duration-300"
            :style="{
            width: progress + '%' 
            }"
            ></div>
      </div>
      <!-- Bottom Button -->
      <div class="flex justify-center">
       <Link :href="route('Actualites')"
            class="inline-flex items-center gap-3
            px-10 py-4 rounded-[33px]
            text-white font-semibold text-[16px]
            bg-[#0D4677]
            shadow-[4px_4px_10px_rgba(0,0,0,0.25)]
            hover:bg-[color:var(--accent)]
            transition-all 
            active:scale-[0.97]
            focus:outline-none
            touch-manipulation"        
            >
            Découvrir toutes les actualités
            <ArrowRight/>
         </Link>
      </div>
   </div>
   <!-- Desktop -->
 <div class="hidden lg:block relative max-w-[90%] mx-auto">
  <div class="absolute top-2 right-4 flex gap-4 z-20">
    <button aria-label="Actualité précédente" @click="prev" class="w-10 h-10 rounded-full bg-white shadow flex items-center justify-center cursor-pointer hover:bg-gray-100 transition disabled:opacity-50" disabled="!scrollLeft">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </button>
    <button aria-label="Actualité suivante" @click="next" class="w-10 h-10 rounded-full bg-white shadow flex items-center justify-center cursor-pointer hover:bg-gray-100 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
    </button>
  </div>

  <div class="pb-16 px-2">
    <Swiper
      :modules="modules"
      :slides-per-view="'auto'"
      :space-between="40"
      @swiper="onSwiper"
      class="flex items-center justify-start px-4"
    >
      <SwiperSlide
        v-for="item in props.articles"
        :key="item.id"
        class="!w-[450px] pb-10 px-2" 
      >
        <a :href="`/actualites/article/${item.id}`" class="block rounded-lg overflow-hidden shadow-md bg-white transition-shadow duration-500 ease-in-out hover:shadow-[0_10px_10px_rgba(16,43,64,0.25)]">
          <img :src="item.image_url" :alt="item.title" class="w-full h-[200px] object-cover" />
          <div class="py-4 px-6 h-auto">
            <h3 class="text-lg font-semibold text-[#0d4677] clamp-1 mb-2">{{ item.title }}</h3>
            <p class="text-gray-600 text-sm clamp-2">{{ item.description }}</p>
          </div>
        </a>
      </SwiperSlide>
    </Swiper>
  </div>
      <!-- Bottom Button -->
      <div class="flex justify-center">
         <Link :href="route('Actualites')"
            class="inline-flex items-center gap-3
            px-10 py-4 rounded-[33px]
            text-white font-semibold text-[16px]
            bg-[#0D4677]
            shadow-[4px_4px_10px_rgba(0,0,0,0.25)]
            hover:bg-[color:var(--accent)]
            transition-all
            active:scale-[0.97]
            focus:outline-none
            touch-manipulation"
            >
            Découvrir toutes les actualités
            <ArrowRight/>
         </Link>
      </div>
      </div>
</section>
<!-- Offre gratuite -->
<section class="bg-[color:var(--bg-light-2)] pb-20">
   <div class="bg-gradient-to-b from-[rgb(32,90,140)] to-[rgb(32,90,140,0.8)] rounded-[20px] max-w-[80%] mx-auto py-8 px-10 text-center text-white flex flex-col items-center gap-8 lg:gap-6 ">
      <div aria-hidden='true' class="flex gap-3 bg-[rgb(255,255,255,0.2)] rounded-full px-7 py-5 items-center">
         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024">
            <path fill="white" d="M1024 320.496c0-35.344-28.654-64-63.998-64H850.754c28.272-27.888 46.368-64.447 46.368-109.472c0-55.44-31.84-115.664-121.216-115.664c-117.6 0-215.84 125.216-262 195.408c-46.192-70.176-147.44-195.392-265.024-195.392c-89.376 0-121.216 60.224-121.216 115.664c0 45.008 18.592 81.584 47.44 109.472H64.002c-35.344 0-64 28.656-64 64V512.08h64.56v416.56c0 35.344 28.655 64 64 64h767.68c35.343 0 64-28.656 64-64V512.064h63.76V320.496zM775.906 95.376c39.568 0 57.216 16.625 57.216 51.665c0 71.088-79.344 109.439-153.968 109.439H570.818c45.471-67.536 125.504-161.104 205.088-161.104m-527.025.001c79.6 0 162.655 93.568 208.127 161.088H348.64c-74.624 0-156.976-39.344-156.976-110.432c0-35.024 17.648-50.656 57.217-50.656m711.12 352.687h-416V320.496h416zm-896-127.568h416v127.568h-416zm64.56 191.568h351.44v416.56h-351.44zm767.696 416.56H544.001v-416.56h352.256z" stroke-width="25.5" stroke="white"/>
         </svg>
         <h2 class="text-white text-[18px] lg:text-[20px]">OFFRE GRATUITE</h2>
      </div>
      <h3 class="text-[25px] lg:text-[30px]">Une offre gratuite, simplement</h3>
      <p class="text-[16px] lg:text-[18px]" >N’hésitez pas à remplir le formulaire pour recevoir rapidement et efficacement une offre gratuite. </p>
      <!-- Bottom Button -->
      <div class="flex justify-center">
         <a
            href="#"
            class="inline-flex items-center gap-3
            px-10 py-4 rounded-[33px]
            text-white font-semibold text-[16px]
            bg-[color:var(--accent)]
            shadow-[4px_4px_10px_rgba(0,0,0,0.25)]
            hover:bg-[#d94827]
            transition-all active:scale-[0.97]
            focus:outline-none
            touch-manipulation
            "
            >
            Demander une offre
            <ArrowRight/>
         </a>
      </div>
   </div>
</section>
<!-- FAQ -->
<section class="py-16 lg:py-20">
   <!-- Header -->
   <div class="flex flex-col items-center text-center mb-10 lg:mb-13">
      <h2 class="text-[12px] mb-[13px] text-[color:var(--text-orange)]">
         QUESTIONS FREQUÉNTES
      </h2>
      <h3 class="text-[28px] lg:text-[40px] mb-[13px] text-[color:var(--text-blue-dark)]">
         FAQ’s
      </h3>
      <!-- Divider -->
      <div class="w-[130px] h-[5px] bg-gradient-to-r from-[#F2522E] to-[#205A8C] rounded mt-[2px] lg:mt-[5px] mb-5 lg:mb-10"></div>
      <p class="text-[14px] lg:text-[18px] text-[color:var(--text-blue-light)] max-w-[80%] font-[var(--font-open-sans)]">
         Trouvez rapidement les réponses à vos questions.<br>
         Besoin de plus d'informations ? N'hésitez pas à nous contacter !
      </p>
   </div>
   <div v-for="(item,index) in faq" :key="item.id" class="w-[95%] max-w-[95%] md:w-[80%] max-w-[80%] lg:max-w-[60%] mx-auto mb-6 border-2 border-[#C6E0FA] rounded-[20px] p-6 bg-gradient-to-r from-white to-[#E0EFFF]/50">
      <button @click="toggle(index)" 
              :aria-expanded="openIndex === index ? 'true' : 'false'" 
              :aria-controls="`faq-${index}`" 
              class="w-full flex justify-between items-center  text-left cursor-pointer py-3 active:scale-[0.98] transition-transform">
         <h4 class=" text-[18px] lg:text-[20px] font-semibold text-[#0d4677] w-[90%] ">{{ item.question }}</h4>
         <!-- Arrow -->
         <svg
            aria-hidden="true"
            class="w-5 h-5 transition-transform duration-300"
            :class="openIndex === index ? 'rotate-180 stroke-[color:var(--accent)]' : ''"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
               d="M19 9l-7 7-7-7" />
         </svg>
      </button>
      <!-- Divider -->
      <div v-if="openIndex ===index" class="w-[98%] h-[1px] bg-[#D9D9D9] rounded mt-6 mb-4"></div>
      <!-- Answer -->
      <transition 
         enter-active-class="transition duration-300 ease-out"
         enter-from-class="opacity-0 max-h-0"
         enter-to-class="opacity-100 max-h-[200px]"
         leave-active-class="transition duration-200 ease-in"
         leave-from-class="opacity-100 max-h-[200px]"
         leave-to-class="opacity-0 max-h-0"
         >
         <p v-if="openIndex === index" :id="`faq-${index}`" class="text-[color:var(--text-blue-light)] text-[14px] lg:text-sm overflow-hidden">{{ item.answer }}</p>
      </transition>
   </div>
   <div class="flex flex-col items-center justify-center text-center border border-dashed border-[#205A8C] bg-[#FBFBFB] rounded-[20px] opacity-100 w-[95%] lg:w-[70%] px-6 m-auto py-10 mt-20">
      <p class="font-semibold text-[20px] lg:text-[26px] pb-8">Vous ne trouvez pas la réponse à votre question ?</p>
      <a href="#" 
         class="inline-flex items-center gap-3
         px-10 py-4 rounded-[33px]
         text-white font-semibold text-[16px]
         bg-[#0D4677]
         shadow-[4px_4px_10px_rgba(0,0,0,0.25)]
         hover:bg-[color:var(--accent)]
         transition-all
         active:scale-[0.97]
         focus:outline-none
         touch-manipulation"
         >
         Accéder à notre FAQ 
         <ArrowRight/>
      </a>
   </div>
</section>

</div>
</MainLayout>
</template>
<style scoped>

.scrollbar-hide::-webkit-scrollbar {
  display: none; 
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;    
}
</style> 