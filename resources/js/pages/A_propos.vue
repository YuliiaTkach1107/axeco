<script setup>
   import MainLayout from '@/layouts/MainLayout.vue'
   import { Link, Head } from '@inertiajs/vue3'
   import { ref,onMounted } from 'vue'
   import { route } from 'ziggy-js'
   import ArrowRight from '@/components/icons/ArrowRightIcon.vue'
   import { Swiper,SwiperSlide } from 'swiper/vue'
   import {Pagination } from 'swiper/modules'
   import 'swiper/css'
   import 'swiper/css/pagination'

   const modules = [Pagination];

    const valeurs = [
    {
        title: 'Proximité',
        icon: `<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><path fill="currentColor" d="M9 13.75c-2.34 0-7 1.17-7 3.5V19h14v-1.75c0-2.33-4.66-3.5-7-3.5M4.34 17c.84-.58 2.87-1.25 4.66-1.25s3.82.67 4.66 1.25zM9 12c1.93 0 3.5-1.57 3.5-3.5S10.93 5 9 5S5.5 6.57 5.5 8.5S7.07 12 9 12m0-5c.83 0 1.5.67 1.5 1.5S9.83 10 9 10s-1.5-.67-1.5-1.5S8.17 7 9 7m7.04 6.81c1.16.84 1.96 1.96 1.96 3.44V19h4v-1.75c0-2.02-3.5-3.17-5.96-3.44M15 12c1.93 0 3.5-1.57 3.5-3.5S16.93 5 15 5c-.54 0-1.04.13-1.5.35c.63.89 1 1.98 1 3.15s-.37 2.26-1 3.15c.46.22.96.35 1.5.35"/></svg>`,
    },
    {
        title: 'Efficacité',
        icon: `<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 32 32"><path fill="currentColor" d="M14 16.59L11.41 14L10 15.41l4 4l8-8L20.59 10z"/><path fill="currentColor" d="m16 30l-6.176-3.293A10.98 10.98 0 0 1 4 17V4a2 2 0 0 1 2-2h20a2 2 0 0 1 2 2v13a10.98 10.98 0 0 1-5.824 9.707ZM6 4v13a8.99 8.99 0 0 0 4.766 7.942L16 27.733l5.234-2.79A8.99 8.99 0 0 0 26 17V4Z"/></svg>`,
    },
    {
        title: 'Rigueur',
        icon: `<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M3 13c3.6-8 14.4-8 18 0"/><path fill="currentColor" d="M12 17a3 3 0 1 1 0-6a3 3 0 0 1 0 6"/></g></svg>`,
        },
    ]

    const backSection = ref('form')
    onMounted(() => {
      if (window.location.hash) {
         backSection.value = window.location.hash.replace('#', '')
      }
   })
</script>
<template>
<MainLayout>
    <Head>
      <title>À propos d'Axeco | Syndic de Copropriété à Bruxelles</title>
      <meta name="description" content="Découvrez Axeco, votre syndic professionnel à Bruxelles depuis 30 ans. Éthique, transparence et expertise pour la gestion de votre immeuble." />

      <meta property="og:url" content="https://axeco.be/a-propos" />
      <meta property="og:title" content="À propos d'Axeco - Expertise Immobilière" />
      <meta property="og:type" content="website" />
      <link rel="canonical" href="https://axeco.be/a-propos" />
   </Head>
   <div id="à_propos" role="main">
   <section class="hero relative min-h-[700px] h-screen w-full flex items-center overflow-hidden" style="background: linear-gradient(180deg, rgba(232,243,255,0.8) 0%, rgba(255,255,255,0.5) 100%)">
      <div aria-hidden='true' class="hidden md:flex absolute left-15 top-50 w-[150px] h-[150px] border-3 border-[#F2522E] rotate-22 rounded-[33px] opacity-20"></div>
      <div aria-hidden='true' class="hidden md:flex absolute left-170 top-140 w-[100px] h-[100px] border-3 border-[#2E7EED] -rotate-54 rounded-[33px] opacity-20"></div>
      <div class="px-6 flex md:flex-col justify-center lg:grid grid-cols-2 relative z-20 w-full max-w-7xl mx-auto pt-25 md:pt-40 lg:pt-40 h-[100%]">
         <div class="flex flex-col gap-6 justify-center text-center lg:text-start items-center lg:items-start">
            <div class='flex gap-4 border-2 border-[#205a8c] rounded-[33px] py-2 px-4 items-center w-fit bg-white'>
               <div class="bg-[#0d4677] rounded-[33px] w-[27px] h-[27px] flex items-center justify-center">
                  <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 25 24">
                     <path fill="white" d="M9.063 18.045c-.046-1.131-.794-2.194-1.803-3.18a7.5 7.5 0 1 1 10.48 0c-1.041 1.017-1.805 2.117-1.805 3.29v1.595a2.25 2.25 0 0 1-2.25 2.25h-2.373a2.25 2.25 0 0 1-2.25-2.25zM6.5 9.5a5.98 5.98 0 0 0 1.808 4.293c.741.724 1.512 1.633 1.933 2.707h4.518c.421-1.074 1.192-1.984 1.933-2.707A6 6 0 1 0 6.5 9.5m4.063 8.713v1.537c0 .414.335.75.75.75h2.372a.75.75 0 0 0 .75-.75V18h-3.873v.017a4 4 0 0 1 0 .196M1.75 9.5a.75.75 0 0 1 .75-.75h1a.75.75 0 0 1 0 1.5h-1a.75.75 0 0 1-.75-.75m2.465-5.65a.75.75 0 1 0-.75 1.3l.866.5a.75.75 0 1 0 .75-1.3zM3.19 14.875a.75.75 0 0 1 .275-1.024l.866-.5a.75.75 0 0 1 .75 1.298l-.866.5a.75.75 0 0 1-1.025-.274M21.5 8.75a.75.75 0 0 0 0 1.5h1a.75.75 0 0 0 0-1.5zm-1.855 4.875a.75.75 0 0 1 1.025-.274l.866.5a.75.75 0 1 1-.75 1.298l-.866-.5a.75.75 0 0 1-.275-1.024m.275-9.275a.75.75 0 0 0 .75 1.3l.866-.5a.75.75 0 1 0-.75-1.3z"/>
                  </svg>
               </div>
               <span class='inline-block text-sm py-2 px-2 lg:px-4 font-semibold'>EXPERTISE IMMOBILIÈRE DEPUIS 30 ANS</span>
            </div>
            <h1 class='text-[35px] md:text-[50px] lg:text-[60px] leading-tight mt-6 font-semibold  text-[#0D4677]'>À propos</h1>
            <p class="text-[16px] lg:text-[18px] text-[#4c6e9a] max-w-[90%] lg:max-w-[80%] leading-relaxed mt-1 mb-6">Nous bâtissons des solutions à 360°, aussi complètes que sur mesure, pour garantir une gestion durable et harmonieuse de votre patrimoine.</p>
            <div class="flex flex-col items-center mt-2 lg:flex-row gap-4 w-[280px] md:w-[280px] lg:w-auto">
               <Link :href="route('Contact', { subject: 'demande' }) + '#' + backSection" class="inline-flex items-center gap-3 px-10 py-4 rounded-[33px] text-white font-semibold text-[16px] bg-[color:var(--accent)] shadow-[4px_4px_10px_rgba(0,0,0,0.25)] hover:bg-[#d94827] transition-all active:scale-[0.97] focus-visible:ring-2 focus-visible:ring-[#F2522E] focus-visible:ring-offset-2 touch-manipulation">
                    Demander une offre <ArrowRight/>
               </Link>
               <Link :href="route('Contact') + '#' + backSection" class="inline-flex items-center gap-3 w-55 lg:w-auto px-10 py-4 rounded-[33px] text-[color:var(--text-dark-blue)] border-2 border-[color:var(--text-dark-blue)] font-semibold text-[16px] shadow-[4px_4px_10px_rgba(0,0,0,0.25)] hover:text-[color:var(--accent)] border-[color:var(--accent)] transition-all active:scale-[0.97] focus-visible:ring-2 focus-visible:ring-[#F2522E] focus-visible:ring-offset-2 touch-manipulation">
                    Contactez-nous!
               </Link>
            </div>
         </div>
         <div class="relative hidden md:flex items-center justify-center my-auto h-[400px] w-[90%] items-center justify-center mx-auto  lg:flex items-center justify-center my-auto h-[70vh]">
            <img src="/images/à_propos/à-propos.jpg" loading="lazy" class="w-full h-full rounded-[20px] border-6 border-[#B9D6FE] shadow-xl object-cover object-top" alt="Notre expertise" />
         </div>
      </div>
   </section>
   <section class='heritage relative flex flex-col items-center justify-center gap-3 py-16 lg:py-20 px-6 lg:px-12 text-center bg-white overflow-hidden'>
      <div class="flex flex-col items-center text-center mb-5 lg:mb-8">
         <h2 class="text-[12px] mb-[13px] text-[color:var(--text-orange)]"> NOTRE HÉRITAGE & EXPERTISE </h2>
         <h3 class="text-[28px] lg:text-[40px] mb-[13px]"> Un héritage de rigueur et de transparence</h3>
         <div class=" w-[100px] lg:w-[130px] h-[5px] bg-gradient-to-r from-[#F2522E] to-[#205A8C] rounded mt-[2px] lg:mt-[5px] mb-5 lg:mb-10"></div>
      </div>
      <div class="max-w-4xl md:max-w-2xl lg:max-w-4xl  mx-auto px-6 text-start text-[#0d4677] space-y-6">
         <p class="text-lg leading-relaxed">Fort d’un héritage de presque 30 ans, Axeco SRL est un professionnel par excellence des services à l’immobilier résidentiel avec une vision résolument engagée au travers de valeurs qui lui sont propres alliant éthique et transparence.</p>
         <p class="text-lg leading-relaxed">Elle associe la proximité, l’efficacité et la rigueur. L’organisation de services propose une réponse idéale pour la gestion de copropriétés : une gestion de proximité, à laquelle les copropriétaires sont justement attachés.</p>
         <p class="text-lg leading-relaxed">Elle apporte le soutien comptable, juridique et technique désormais indispensable pour gérer des matières de plus en plus complexes au travers d’une équipe pluridisciplinaire constituée de collaborateurs agréés.</p>
         <p class="mb-4 lg:mb-0 text-lg leading-relaxed">En effet, Axeco SRL réunit une équipe de professionnels composée principalement d'agents immobiliers agréés par l’Institut Professionnel des Agents Immobiliers (IPI).</p>
      </div>
      <div class='hidden md:flex justify-center items-center gap-20 md:gap-10 lg:gap-20 mt-5 lg:mt-8 w-full max-w-4xl mx-auto flex-wrap'>
         <article v-for="(value, index) in valeurs" :key="index" class="flex flex-col items-center justify-center relative h-[100%] md:h-[100%] rounded-[24px] px-12 py-8 border-2 border-[#c6e0fa] transition-all duration-300 hover:-translate-y-2 hover:shadow-[0px_15px_35px_rgba(16,43,64,0.25)]" style="background-image: linear-gradient(-42deg, #ffffff 43%, rgba(224,239,255,0.5) 100%);">
             <div class='mb-4' v-html="value.icon"></div>
            <h4>{{ value.title }}</h4>
         </article>
      </div>
      <div class="md:hidden w-full px-4 overflow-hidden relative">
         <Swiper
            :modules="modules"
            aria-label="Notre Héritage"
            :slides-per-view="1.2"  :centered-slides="true" :space-between="20"
            :pagination="{ clickable: true }"
            class="mySwiper !pb-12" 
            >
            <SwiperSlide v-for="(value, index) in valeurs" :key="index">
               <div class="flex flex-col items-center justify-center mx-auto w-full max-w-[290px] min-h-[260px] rounded-[24px] px-6 py-8 border-2 border-[#c6e0fa] shadow-sm bg-white"  style="background-image: linear-gradient(-42deg, #ffffff 43%, rgba(224,239,255,0.5) 100%);">
                  <div class='mb-4' v-html="value.icon"></div>
                  <h4 class="text-xl font-semibold text-[#0d4677]">{{ value.title }}</h4>
               </div>
            </SwiperSlide>
         </Swiper>
      </div>
   </section>
   <section class='portefeuille py-0 md:py-20 px-6 lg:px-12' style="background-image: linear-gradient(to bottom,#FFFFFF 0%, #F0F6FC 100%);">
      <div class="text-center mb-12 lg:mb-16">
         <h2 class="text-[28px] lg:text-[40px] text-center mb-[13px] font-bold">Portefeuille et Avantages</h2>
         <div class=" w-[100px] lg:w-[130px] h-[5px] bg-gradient-to-r from-[#F2522E] to-[#205A8C] rounded mt-[2px] lg:mt-[5px] mb-5 lg:mb-10 m-auto"></div>
      </div>
      <div class="max-w-4xl md:max-w-2xl lg:max-w-4xl  mx-auto px-6 text-start text-[#0d4677] space-y-6">
         <p class="text-lg leading-8 text-justify"> AXECO SRL gère des copropriétés qui regroupent principalement des immeubles à destination résidentielle mais également commerciale, de bureaux, parkings et des bâtiments à usage mixte. La diversité de notre portefeuille de gestion, nous permet de faire appel et de compter à tout moment sur des fournisseurs, entrepreneurs et corps de métier fidèles et de premier ordre. En outre, notre société fait bénéficier les copropriétaires de conditions avantageuses négociées sur certains contrats de fournitures en énergie (électricité, gaz et mazout de chauffage).</p>
      </div>
   </section>
   <section class='engagements py-20 lg:py-28 px-6 lg:px-12 bg-[#F0F6FC]'>
      <div class="text-center mb-12 lg:mb-16">
         <h2 class="text-[28px] lg:text-[45px] font-bold text-[#0d4677] mb-4">Nos Engagements</h2>
         <div class=" w-[100px] lg:w-[130px] h-[5px] mx-auto bg-gradient-to-r from-[#F2522E] to-[#205A8C] rounded mt-[2px] lg:mt-[5px] mb-5 lg:mb-10"></div>
         <p class='text-xl text-[#0d4677]/80 font-medium'>Nous nous engageons :</p>
      </div>
      <div class="max-w-6xl md:max-w-2xl lg:max-w-6xl mx-auto">
         <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
            <article class='bg-white p-8 rounded-[32px] shadow-[0_10px_30px_rgba(13,70,119,0.05)] border border-white hover:border-[#F2522E]/30 transition-all duration-300 flex flex-col gap-5'>
               <div class='bg-gradient-to-br from-[#F2522E] to-[#d94827] w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg shadow-[#F2522E]/20'>
                  <svg aria-hidden="true" focusable="false" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                  </svg>
               </div>
               <p class='text-[#0d4677] text-lg'>À ne percevoir aucune ristourne ou rémunération autre que celle prévue au contrat.</p>
            </article>
            <article class='bg-white p-8 rounded-[32px] shadow-[0_10px_30px_rgba(13,70,119,0.05)] border border-white hover:border-[#205A8C]/30 transition-all duration-300 flex flex-col gap-5'>
               <div class='bg-gradient-to-br from-[#4c6e9a] to-[#2E5383] w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-900/20'>
                  <svg aria-hidden="true" focusable="false" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                  </svg>
               </div>
               <p class='text-[#0d4677] text-lg'>À pratiquer une politique de maîtrise des charges rigoureuse.</p>
            </article>
            <article class='bg-white p-8 rounded-[32px] shadow-[0_10px_30px_rgba(13,70,119,0.05)] border border-white hover:border-[#2e7eed]/30 transition-all duration-300 flex flex-col gap-5 md:col-span-2 lg:col-span-1'>
               <div class='bg-gradient-to-br from-[#2e7eed] to-[#0454C3] w-12 h-12 rounded-2xl flex items-center justify-center shadow-lg shadow-[#2e7eed]/20'>
                  <svg aria-hidden="true" focusable="false" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                  </svg>
               </div>
               <p class='text-[#0d4677] text-lg'>À mettre périodiquement les fournisseurs en concurrence loyale pour obtenir les meilleurs prix.</p>
            </article>
         </div>
         <div class="relative bg-white/50 backdrop-blur-sm border-l-4 border-[#F2522E] p-8 rounded-r-3xl max-w-4xl mx-auto group hover:bg-white transition-colors">
            <div class="flex flex-col md:flex-row gap-6 items-center">
               <p class='text-[#0d4677] italic text-base leading-relaxed'>Pour les <strong> gros travaux </strong> (étanchéité et techniques spéciales notamment), nous conseillons le recours à un expert extérieur choisi par la copropriété ou qui peut être conseillé par nos soins. Cette pratique donne toutes les garanties et couvre correctement les responsabilités pour les dépenses importantes.</p>
            </div>
         </div>
      </div>
   </section>
</div>
</MainLayout>
</template>
<style>
    .swiper{
    width:90%;
    }
    .swiper-pagination-bullet{
    border:solid 3px #C6E0FA;
    background-color:white;
    }
    .swiper-pagination-bullet-active{
    background-color:#C6E0FA
    }
</style>