<script setup>
   import { Link } from '@inertiajs/vue3'
   import { route } from 'ziggy-js'
   import { ref, onMounted } from 'vue'

   const backSection = ref('form')
      onMounted(() => {
         if (window.location.hash) {
            backSection.value = window.location.hash.replace('#', '')
         }
      })

</script>

<template>
   <footer class="bg-[#f0f6fc] w-full py-8 relative">
      <div class="w-[90%] max-w-[1400px] mx-auto">
         <!-- Main content -->
         <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-8">
            <!-- Logo + description -->
            <div class="flex flex-col gap-6">
               <div class="w-[160px] h-auto">
                  <img src="/images/logo/AXECO_Logo.png" alt="AXECO – syndic et gestion de copropriété à Bruxelles" class="w-full h-full object-cover" />
               </div>
               <div class="max-w-[260px]">
                  <p class="text-[var(--text-blue-light)] leading-relaxed text-[14px]">Votre partenaire de confiance pour une gestion transparente et rigoureuse de votre copropriété.</p>
               </div>
               <Link :href="route('Contact', { subject: 'demande' }) + '#' + backSection" class="cursor-pointer bg-[#f2522e] text-[#f9f9f9] rounded-full px-8 py-4 flex items-center justify-center gap-3 w-fit hover:bg-[#d94827] transition-colors active:scale-[0.97] focus:outline-none touch-manipulation ">
                  <span class="text-[14px] font-semibold">Demander une offre</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                     <path fill="#fff" d="M17.073 12.5H5.5q-.213 0-.357-.143T5 12t.143-.357t.357-.143h11.573l-3.735-3.734q-.146-.147-.152-.345t.152-.363q.166-.166.357-.168t.357.162l4.383 4.383q.13.13.183.267t.053.298t-.053.298t-.183.268l-4.383 4.382q-.146.146-.347.153t-.367-.159q-.16-.165-.162-.354t.162-.354z" stroke="#fff" stroke-width="1.2" />
                  </svg>
               </Link>
            </div>
            <!-- Divider -->
            <div class="flex w-full h-[1px] bg-[#205A8C] lg:hidden"></div>
            <!-- Quick links -->
            <div aria-label="Liens rapides du pied de page" class="flex flex-col justify-center">
               <ul class="flex flex-col gap-6 text-[16px]">
                  <li><Link :href="route('A_propos')" class="font-semibold cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">À propos</Link></li>
                  <li><Link :href="route('Services')" class="font-semibold cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Nos services</Link></li>
                  <li><Link :href="route('Notre_equipe')" class="font-semibold cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Notre équipe</Link></li>
                  <li><Link :href="route('Actualites')" class="font-semibold cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Actualités</Link></li>
                  <li><Link :href="route('Contact')" class="font-semibold cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">Contact</Link></li>
                  <li><Link :href="route('FAQ')" class="font-semibold cursor-pointer hover:[color:var(--text-orange)] active:[color:var(--text-orange)]">FAQ</Link></li>
               </ul>
            </div>
            <!-- Contact -->
            <div class="flex flex-col gap-6 max-w-[240px]">
               <h4 class="text-[#0d4677] lg:text-[16px] font-semibold">Contact</h4>
               <div v-for="(item, index) in $page.props.footerContacts.filter(i => i.title !== 'Horaires')" :key="index" class="flex flex-col gap-2 font-semibold" >
                  <div class="flex items-start" >
                     <!-- <div  aria-hidden='true' class=" border w-9 h-9 rounded-[10px] shrink-0 flex items-center justify-center" :style="{ borderColor: item.color, backgroundColor: item.color + '15' }" v-html="item.icon"></div> -->
                     <!-- TEXT / LINK -->
                     <component
                        :is="item.link ? 'a' : 'p'"
                        :href="item.link"
                        :target="item.type === 'map' ? '_blank' : null"
                        :rel="item.type === 'map' ? 'noopener' : null"
                        :aria-label="
                           item.type === 'tel'
                           ? 'Appeler ' + item.text
                           : item.type === 'email'
                           ? 'Envoyer un email à ' + item.text
                           : 'Ouvrir l’adresse sur Google Maps'
                        "
                        class="text-[#205a8c] text-[14px] leading-normal pt-2 hover:underline"
                        >
                        {{ item.content }}
                     </component>
                  </div>
               </div>
            </div>
         </div>
         <!-- Divider -->
         <div class="hidden lg:flex w-full h-[1px] bg-[#205A8C] mt-10 mb-10"></div>
         <!-- Bottom section -->
         <div class="flex flex-col md:flex-row items-center justify-between mt-10 gap-3 text-center md:text-left">
            <p class="text-[var(--text-blue-light)] text-[14px]">© 2025 Axeco. Tous droits réservés.</p>
            <div class="flex flex-wrap items-center justify-center gap-8 md:gap-14">
               <a href="#" class="text-[var(--text-blue-light)] text-[14px] underline hover:text-[#205a8c] transition-colors">Mentions légales</a>
               <a href="#" class="text-[var(--text-blue-light)] text-[14px] underline hover:text-[#205a8c] transition-colors">Politique de confidentialité</a>
            </div>
         </div>
      </div>
   </footer>

</template>

<style scoped>
</style>
