<script setup>
   import MainLayout from '@/layouts/MainLayout.vue'
   import { Head } from '@inertiajs/vue3'
   import { useI18n } from 'vue-i18n'
   
   const { t, locale } = useI18n()
</script>
<template>
   <MainLayout>
      <Head>
         <title>Politique de confidentialité | Axeco</title>
         <meta name="description" content="Politique de confidentialité d’Axeco : informations sur la collecte, le traitement et la protection de vos données personnelles conformément au RGPD en Belgique." />
         <meta name="robots" content="index, follow" />
         <meta property="og:title" content="Politique de confidentialité | Axeco" />
         <meta property="og:description" content="Protection des données personnelles conforme RGPD." />
         <meta property="og:type" content="website" />
         <meta property="og:url" content="https://axeco.immo/privacy-policy" />
         <link rel="canonical" href="https://axeco.immo/privacy-policy" />
      </Head>
      <div class="max-w-4xl mx-auto px-6 py-12 pt-35 md:pt-38 lg:pt-56 text-[#0d4677] leading-relaxed">
         <!-- <ul class='flex items-center justify-end gap-4 mr-15 h-15 '>
            <li><a href="#" @click.prevent="locale = 'fr'" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">FR</a></li>
            <li><a href='#'  @click.prevent="locale = 'nl'" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">NL</a></li>
            <li><a href="#" @click.prevent="locale = 'en'" class="cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">EN</a></li>
         </ul> -->
         <h1 class="text-3xl font-bold mb-8"> {{ t('privacy.title') }} </h1>
         <!-- INTRO -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">{{ t('privacy.section1.title') }}</h2>
            <p class="text-base"> {{ t('privacy.section1.p1') }} </p>
            <p class="mt-3 text-base"> {{ t('privacy.section1.p2') }}</p>
            <p class="mt-3 text-base">{{ t('privacy.section1.p3') }} </p>
            <p class="mt-3 text-base">
               {{ t('privacy.section1.cookies_text') }}
               <a href="/cookie-policy" class="underline text-[#0d4677]" aria-label="Consulter la politique de cookies"> {{ t('privacy.section1.cookies_link') }} </a>.
            </p>
         </section>
         <!-- RESPONSABLE -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">{{ t('privacy.section2.title') }}</h2>
            <p class="text-base"> {{ t('privacy.section2.p1') }} </p>
            <p class="mt-3 text-base"><strong>{{ t('privacy.section2.company.name') }}</strong><br> {{ t('privacy.section2.company.number') }}<br>{{ t('privacy.section2.company.address') }}<br>{{ t('privacy.section2.company.website') }}<br>{{ t('privacy.section2.company.email') }} info@axeco.immo </p>
         </section>
         <!-- CHAMP -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">{{ t('privacy.section3.title') }}</h2>
            <p class="text-base"> {{ t('privacy.section3.p1') }} </p>
            <ul class="list-disc ml-6 mt-3">
               <li>{{ t('privacy.section3.list.0') }}</li>
               <li>{{ t('privacy.section3.list.1') }}</li>
               <li>{{ t('privacy.section3.list.2') }}</li>
            </ul>
         </section>
         <!-- DONNEES -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">{{ t('privacy.section4.title') }}</h2>
            <p class="text-base"> {{ t('privacy.section4.p1') }} </p>
            <h3 class="font-semibold text-lg mt-4">{{ t('privacy.section4.physical_title') }}</h3>
            <ul class="list-disc ml-6">
               <li>{{ t('privacy.section4.physical.0') }}</li>
               <li>{{ t('privacy.section4.physical.1') }}</li>
               <li>{{ t('privacy.section4.physical.2') }}</li>
               <li>{{ t('privacy.section4.physical.3') }}</li>
               <li>{{ t('privacy.section4.physical.4') }}</li>
            </ul>
            <h3 class="font-semibold text-lg mt-4">{{ t('privacy.section4.legal_title') }}</h3>
            <ul class="list-disc ml-6">
               <li>{{ t('privacy.section4.legal.0') }}</li>
               <li>{{ t('privacy.section4.legal.1') }}</li>
               <li>{{ t('privacy.section4.legal.2') }}</li>
               <li>{{ t('privacy.section4.legal.3') }}</li>
            </ul>
         </section>
         <!-- FINALITES -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">{{ t('privacy.section5.title') }}</h2>
            <h3 class="font-semibold text-lg mt-4">{{ t('privacy.section5.consent_title') }}</h3>
            <ul class="list-disc ml-6">
               <li>{{ t('privacy.section5.consent.0') }}</li>
               <li>{{ t('privacy.section5.consent.1') }}</li>
            </ul>
            <h3 class="font-semibold text-lg mt-4">{{ t('privacy.section5.execution_title') }}</h3>
            <ul class="list-disc ml-6">
               <li>{{ t('privacy.section5.execution.0') }}</li>
               <li>{{ t('privacy.section5.execution.1') }}</li>
               <li>{{ t('privacy.section5.execution.2') }}</li>
            </ul>
            <h3 class="font-semibold text-lg mt-4">{{ t('privacy.section5.legal_title') }}</h3>
            <ul class="list-disc ml-6">
               <li>{{ t('privacy.section5.legal.0') }}</li>
               <li>{{ t('privacy.section5.legal.1') }}</li>
            </ul>
         </section>
         <!-- PARTAGE -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">{{ t('privacy.section6.title') }}</h2>
            <p class="text-base"> {{ t('privacy.section6.p1') }} </p>
         </section>
         <!-- UE -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">{{ t('privacy.section7.title') }}</h2>
            <p class="text-base"> {{ t('privacy.section7.p1') }} </p>
         </section>
         <!-- DUREE -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">{{ t('privacy.section8.title') }}</h2>
            <p class="text-base"> {{ t('privacy.section8.p1') }} </p>
         </section>
         <!-- SECU -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">{{ t('privacy.section9.title') }}</h2>
            <p class="text-base"> {{ t('privacy.section9.p1') }} </p>
         </section>
         <!-- DROITS -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">{{ t('privacy.section10.title') }}</h2>
            <p class="text-base"> {{ t('privacy.section10.p1') }} </p>
            <ul class="list-disc ml-6 mt-3">
               <li>{{ t('privacy.section10.list.0') }}</li>
               <li>{{ t('privacy.section10.list.1') }}</li>
               <li>{{ t('privacy.section10.list.2') }}</li>
               <li>{{ t('privacy.section10.list.3') }}</li>
               <li>{{ t('privacy.section10.list.4') }}</li>
            </ul>
         </section>
         <!-- CONTACT -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">{{ t('privacy.section11.title') }}</h2>
            <p class="text-base"> {{ t('privacy.section11.p1') }} </p>
            <p class="mt-3 text-base"> {{t('privacy.section11.contact.email')}} info@axeco.immo<br><strong>{{t('privacy.section11.contact.company')}}</strong><br> 150 Chaussée de la Hulpe<br> 1170 Bruxelles, Belgique </p>
         </section>
         <!-- RECLAMATION -->
         <section>
            <h2 class="text-xl font-semibold mb-3">{{t('privacy.section12.title')}}</h2>
            <p class="text-base"> {{t('privacy.section12.p1')}} </p>
            <p class="text-base mt-3"> {{t('privacy.section12.address')}}<br>
               <a href="https://www.autoriteprotectiondonnees.be" target="_blank" rel="noopener noreferrer" class="underline text-[#0d4677]"  aria-label="Site de l’Autorité de protection des données (ouvre dans un nouvel onglet)">
                     {{t('privacy.section12.link')}}
               </a>
            </p>
         </section>
      </div>
   </MainLayout>
</template>