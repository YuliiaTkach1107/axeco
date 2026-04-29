<script setup>
   import MainLayout from '@/layouts/MainLayout.vue'
   import { route } from 'ziggy-js'
   import { Head, Link } from '@inertiajs/vue3'
   
</script>
<template>
   <MainLayout>
      <Head>
         <title>Politique de cookies | Axeco</title>
         <meta name="description" content="Politique de cookies du site Axeco : informations sur l’utilisation des cookies, leur finalité, leur gestion et votre consentement conformément au RGPD." />
         <link rel="canonical" href="https://axeco.immo/cookie-policy" />
         <meta name="robots" content="index, follow" />
         <meta property="og:title" content="Politique de cookies | Axeco" />
         <meta property="og:description" content="Informations sur l’utilisation des cookies." />
         <meta property="og:type" content="website" />
         <meta property="og:url" content="https://axeco.immo/cookie-policy" />
      </Head>
      <div class="max-w-4xl mx-auto px-6 py-12 pt-35 md:pt-38 lg:pt-56 text-[#0d4677] leading-relaxed">
         <h1 class="text-3xl font-bold mb-10"> Politique de cookies </h1>
         <!-- 1 -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">1. Qu’est-ce qu’un cookie ?</h2>
            <p class='text-base'> Un cookie est un petit fichier texte enregistré sur votre appareil (ordinateur, tablette ou smartphone) lors de la visite d’un site internet. Il permet de mémoriser certaines informations afin d’améliorer votre expérience de navigation. </p>
         </section>
         <!-- 2 -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">2. Types de cookies utilisés</h2>
            <h3 class="font-semibold mt-4 text-lg">Cookies strictement nécessaires</h3>
            <p class="text-base"> Ces cookies sont essentiels au bon fonctionnement du site et ne peuvent pas être désactivés. </p>
            <h3 class="font-semibold mt-4 text-lg">Cookies fonctionnels</h3>
            <p class="text-base"> Ils permettent de mémoriser vos préférences, notamment le thème d’affichage (clair/sombre). </p>
            <h3 class="font-semibold mt-4 text-lg">Cookies analytiques</h3>
            <p class="text-base"> Ils permettent de mesurer l’audience du site via Google Analytics (pages visitées, durée, etc.). Ces cookies sont utilisés uniquement avec votre consentement. </p>
            <h3 class="font-semibold mt-4 text-lg">Cookies de performance</h3>
            <p class="text-base"> Ces cookies peuvent être utilisés pour améliorer les performances du site. Ils ne sont actuellement pas activés. </p>
         </section>
         <!-- 3 -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">3. Consentement</h2>
            <p class='text-base'> Lors de votre première visite, un bandeau vous informe de l’utilisation des cookies. Vous pouvez accepter ou refuser les cookies non essentiels. </p>
            <p class="mt-3 text-base"> Vous pouvez modifier votre choix à tout moment en cliquant sur l’icône de gestion des cookies présente sur le site. </p>
            <p class="mt-3 text-base">
               Pour plus d’informations sur la protection des données personnelles, consultez notre
               <a href="/privacy-policy" class="underline text-[#0d4677]" aria-label='Consulter la politique de confidentialité'> politique de confidentialité </a>.
            </p>
         </section>
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">4. Durée de conservation</h2>
            <p class="text-base"> Les cookies sont conservés pour une durée maximale de 13 mois conformément à la réglementation en vigueur. </p>
         </section>
         <!-- 4 -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">5. Gestion des cookies</h2>
            <p class='text-base'>  Vous pouvez configurer votre navigateur pour bloquer ou supprimer les cookies. Cependant, certaines fonctionnalités du site peuvent ne plus fonctionner correctement. </p>
         </section>
         <!-- 5 -->
         <section class="mb-8">
            <h2 class="text-xl font-semibold mb-3">6. Cookies tiers</h2>
            <p class='text-base'> Le site utilise des services tiers tels que Google Analytics. Ces services peuvent déposer leurs propres cookies, soumis à leurs politiques de confidentialité. </p>
         </section>
         <!-- 6 -->
         <section class="mb-10">
            <h2 class="text-xl font-semibold mb-3">7. Contact</h2>
            <p class='text-base'> Pour toute question relative à l’utilisation des cookies : </p>
            <p class="mt-3 text-base"> <strong>AXECO SRL</strong><br> 150 Chaussée de la Hulpe<br> 1170 Bruxelles, Belgique<br> Email : info@axeco.immo </p>
         </section>
      </div>
   </MainLayout>
</template>