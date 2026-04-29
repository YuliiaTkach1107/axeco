<script setup>
   import ArrowRightIconVue from '@/components/icons/ArrowRightIcon.vue'
   import MainLayout from '@/layouts/MainLayout.vue'
   import { Link,Head } from '@inertiajs/vue3'
   import { route } from 'ziggy-js'
   
   defineProps({
         faqs:{
            type: Array,
               default: () => []
         }
      })
</script>
<template>
    <Head>
      <title>FAQ's | Axeco Syndic Bruxelles</title>
      <meta name="description" content="Trouvez des réponses à vos questions sur la gestion de copropriété, les charges et le rôle du syndic en Belgique. Axeco vous accompagne avec transparence." />
      <meta property="og:title" content="FAQ - Axeco Syndic Immobilier" />
      <meta property="og:description" content="Toutes les réponses à vos questions sur la gestion de votre immeuble à Bruxelles." />
      <link rel="canonical" href="https://axeco.be/faq" />
   </Head>
   <MainLayout>
      <div class="mx-auto pt-50 lg:pt-55 px-4 max-w-7xl relative">
         
         <Link 
            :href="route('PageAccueil')" 
            aria-label="Retour à la page d'accueil" 
            class="absolute z-20 top-30 md:top-35 lg:top-46 left-4 md:left-6 text-white flex items-center gap-2 bg-[#0D4677]/90 px-3 py-2 md:px-4 md:py-2 text-sm md:text-base rounded-full backdrop-blur hover:bg-[#0D4677] transition focus:outline-double focus:outline-offset-2"
         >
            <span aria-hidden="true">←</span> 
            <span>Retour à l'accueil</span>
         </Link>

         <div class="text-center">
            <h1 class="text-[28px] lg:text-[40px] mb-[13px] text-[color:var(--text-blue-dark)] font-bold">
               FAQ's
            </h1>
            <div class="w-[130px] h-[5px] bg-gradient-to-r from-[#F2522E] to-[#205A8C] rounded mt-[2px] lg:mt-[5px] mb-8 lg:mb-12 mx-auto" aria-hidden="true"></div>
         </div>

         <section class="space-y-6 pb-20" aria-label="Liste des questions fréquemment posées">
            <div 
               v-for="(item, index) in faqs" 
               :key="item.id" 
               class="w-[95%] md:w-[85%] lg:w-[70%] mx-auto mb-6 border-2 border-[#C6E0FA] rounded-[20px] p-6 bg-gradient-to-r from-white to-[#E0EFFF]/50 shadow-sm"
               itemscope 
               itemtype="https://schema.org/Question"
            >
               <h2 class="text-[18px] lg:text-[20px] font-semibold text-[#0d4677]" itemprop="name">
                  {{ item.question }}
               </h2>

               <div class="w-full h-[1px] bg-[#D9D9D9] rounded mt-6 mb-4" aria-hidden="true"></div>

               <div 
                  itemscope 
                  itemtype="https://schema.org/Answer" 
                  itemprop="acceptedAnswer"
               >
                  <p class="text-[color:var(--text-blue-light)] text-[15px] lg:text-base leading-relaxed" itemprop="text">
                     {{ item.answer }}
                  </p>
               </div>
            </div>
         </section>
      </div>
   </MainLayout>
</template>