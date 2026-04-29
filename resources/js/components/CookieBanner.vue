<script setup>
   import { ref,watch, onMounted } from 'vue'
   let analyticsLoaded = false
   
   // État de la bannière
   const cookieDecision = ref(localStorage.getItem('cookies_banner'))
   const showBanner = ref(!cookieDecision.value)
   
   // Paramètres
   const settingsOpen = ref(false)
   const functionalCookies = ref(false)
   const analyticsCookies = ref(localStorage.getItem('cookies_analytics') === 'true')
   const performanceCookies = ref(false)
   
   const loadAnalytics = () => {
     if (analyticsLoaded) return
     if (typeof window === 'undefined') return
     analyticsLoaded = true
     const script = document.createElement('script')
     script.src = 'https://www.googletagmanager.com/gtag/js?id=G-P0DSZ1PNEV'
     script.async = true
     script.onload = () => {
       window.dataLayer = window.dataLayer || []
       function gtag() {
         window.dataLayer.push(arguments)
       }
       window.gtag = gtag
       gtag('js', new Date())
       gtag('config', 'G-P0DSZ1PNEV')
     }
     document.head.appendChild(script)
   }
   
   const applyCookies = () => {
   
     if (analyticsCookies.value) {
       loadAnalytics()
     }
   
     document.documentElement.classList.toggle(
       'functional-on',
       functionalCookies.value
   
     )
   
     document.documentElement.classList.toggle(
       'perf-on',
       performanceCookies.value
   
     )
   
   }
   
   onMounted(() => {
     analyticsCookies.value =
       localStorage.getItem('cookies_analytics') === 'true'
   
     functionalCookies.value =
       localStorage.getItem('cookies_functional') === 'true'
   
     performanceCookies.value =
       localStorage.getItem('cookies_performance') === 'true'
   
        if (analyticsCookies.value) {
       loadAnalytics()
     }
     applyCookies()
   })
   
   // Méthodes
   const acceptAll = () => {
     localStorage.setItem('cookies_banner', 'accepted')
   
     localStorage.setItem('cookies_analytics', 'true')
     localStorage.setItem('cookies_functional', 'true')
     localStorage.setItem('cookies_performance', 'true')
   
     functionalCookies.value = true
     performanceCookies.value = true
     analyticsCookies.value = true
   
     applyCookies()
   
     loadAnalytics() 
     showBanner.value = false
     cookieDecision.value = 'accepted'
   }
   
   const rejectAll = () => {
     localStorage.setItem('cookies_banner', 'rejected')
     localStorage.setItem('cookies_analytics', 'false')
     localStorage.setItem('cookies_functional', 'false')
     localStorage.setItem('cookies_performance', 'false')
   
     analyticsCookies.value = false
     functionalCookies.value = false
     performanceCookies.value = false
     applyCookies()
     showBanner.value = false
     cookieDecision.value = 'rejected'
   }
   
   // const openSettings = () => settingsOpen.value = true
   const openSettings = () => {
     console.log('CLICK OK')
     settingsOpen.value = true
   }
   const closeSettings = () => settingsOpen.value = false
   
   const saveSettings = () => {
     localStorage.setItem(
       'cookies_analytics',
       analyticsCookies.value ? 'true' : 'false'
     )
     localStorage.setItem(
       'cookies_functional',
       functionalCookies.value ? 'true' : 'false'
     )
     localStorage.setItem(
       'cookies_performance',
       performanceCookies.value ? 'true' : 'false'
     )
   
     localStorage.setItem('cookies_banner', 'accepted')
     applyCookies()
     if (analyticsCookies.value) {
       loadAnalytics()
     }
     showBanner.value = false
     settingsOpen.value = false
   
   }
</script>
<template>
   <button @click="openSettings"  title="Gérer les préférences en matière de cookies" aria-label="Ouvrir les paramètres des cookies" class="fixed bottom-6 left-6 bg-[#0d4677] text-white px-2 py-2 rounded-full shadow-lg z-[9999] pointer-events-auto cursor-pointer">
      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
         <path fill="white" d="M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12q0-2.025.838-3.937T5.163 4.7T8.7 2.5t4.5-.45q.375.05.575.313t.225.712q.05 1.6 1.188 2.738T17.9 7q.525.025.8.3t.3.85q.05 1.05.638 1.725t1.637 1.025q.35.125.538.363t.187.587q.05 2.075-.725 3.925t-2.125 3.238t-3.2 2.187T12 22m0-2q3.05 0 5.413-2.1T20 12.55q-1.25-.55-1.963-1.5t-.962-2.125q-1.925-.275-3.3-1.65t-1.7-3.3q-2-.05-3.512.725T6.037 6.688T4.512 9.325T4 12q0 3.325 2.338 5.663T12 20m-1.5-10q.625 0 1.063-.437T12 8.5t-.437-1.062T10.5 7t-1.062.438T9 8.5t.438 1.063T10.5 10m-2 5q.625 0 1.063-.437T10 13.5t-.437-1.062T8.5 12t-1.062.438T7 13.5t.438 1.063T8.5 15m6.5 1q.425 0 .713-.288T16 15t-.288-.712T15 14t-.712.288T14 15t.288.713T15 16"/>
      </svg>
   </button>
   <div v-if="showBanner" class="fixed bottom-8 right-8 w-150 bg-[#ffffff] px-4 py-8 border border-[#0d4677] flex flex-col rounded-2xl justify-between items-center h-auto shadow-[0_10px_40px_rgba(0,0,0,0.15)] z-50" role="dialog" aria-modal="true" aria-live="polite" aria-label="Bannière de consentement aux cookies">
      <div class="text-sm text-center space-y-2">
         <h3 class="font-semibold text-base"> Nous respectons votre vie privée. </h3>
         <p class="text-base"> Nous utilisons des cookies pour améliorer votre expérience de navigation, diffuser des publicités ou des contenus personnalisés et analyser notre trafic. </p>
         <p class="text-base"> En cliquant sur « Tout accepter », vous consentez à notre utilisation des cookies. </p>
      </div>
      <div class="space-x-2 mt-4 flex flex-wrap justify-center gap-2">
         <button @click="acceptAll" type='button' class="px-4 py-3 bg-background cursor-pointer border border-[#0d4677] rounded hover:cursor-pointer" aria-label="Accepter tous les cookies" >
            Tout accepter
         </button>
         <button @click="rejectAll" type='button' class="bg-[#0d4677] cursor-pointer text-white px-4 py-3 rounded hover:cursor-pointer" aria-label="Refuser tous les cookies">
            Refuser
         </button>
         <button @click="openSettings" type='button' class="underline px-2 cursor-pointer" aria-label="Personnaliser les préférences en matière de cookies" >
            Personnaliser
         </button>
      </div>
   </div>
   <!-- Fenêtre modale des paramètres -->
   <div v-if="settingsOpen" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
      <div class="bg-white w-[90%] md:w-[700px] max-h-[85vh] overflow-y-auto p-8 rounded-2xl shadow-2xl">
         <!-- TITLE -->
         <h2 class="text-xl font-bold mb-2"> Personnaliser les préférences en matière de consentement </h2>
         <p class="text-sm text-gray-600 mb-6">Nous utilisons des cookies pour améliorer votre expérience et analyser le trafic.</p>
         <!-- NECESSAIRE -->
         <div class="border-t pt-4">
            <div class="flex justify-between items-center">
               <h3 class="font-semibold text-lg">Nécessaire</h3>
               <span class="text-sm text-gray-500">Toujours actif</span>
            </div>
            <p class="text-sm text-gray-600 mt-2"> Essentiels au fonctionnement du site.</p>
         </div>
         <!-- FUNCTIONAL -->
         <div class="border-t pt-4 mt-4">
            <div class="flex justify-between items-center">
               <h3 class="font-semibold text-lg">Fonctionnelle</h3>
               <button role="switch" :aria-checked='functionalCookies' @click="functionalCookies = !functionalCookies" :class="functionalCookies ? 'bg-[#0d4677]' : 'bg-gray-300'" class="relative w-12 h-6 rounded-full transition" >
                  <span :class="functionalCookies ? 'translate-x-1' : 'translate-x-[-20px]'" class="absolute top-1 w-4 h-4 bg-white rounded-full transition cursor-pointer"></span>
               </button>
            </div>
            <p class="text-sm text-gray-600 mt-2">Fonctionnalités supplémentaires et réseaux sociaux.</p>
         </div>
         <!-- ANALYTICS -->
         <div class="border-t pt-4 mt-4">
            <div class="flex justify-between items-center">
               <h3 class="font-semibold text-lg">Analytique</h3>
               <button @click="analyticsCookies = !analyticsCookies" role='switch' :aria-checked='analyticsCookies' :class="analyticsCookies ? 'bg-[#0d4677]' : 'bg-gray-300'" class="relative w-12 h-6 rounded-full transition" >
                  <span :class="analyticsCookies ? 'translate-x-1' : 'translate-x-[-20px]'" class="absolute top-1 w-4 h-4 bg-white rounded-full transition cursor-pointer"></span>
               </button>
            </div>
            <p class="text-sm text-gray-600 mt-2">Analyse du trafic et comportement utilisateur.</p>
         </div>
         <!-- PERFORMANCE -->
         <div class="border-t pt-4 mt-4">
            <div class="flex justify-between items-center">
               <h3 class="font-semibold text-lg">Performance</h3>
               <!-- <button
                  @click="performanceCookies = !performanceCookies"
                  :class="performanceCookies ? 'bg-[#0d4677]' : 'bg-gray-300'"
                  class="relative w-12 h-6 rounded-full transition"
                  >
                  
                  <span
                    :class="performanceCookies ? 'translate-x-1' : 'translate-x-[-20px]'"
                    class="absolute top-1 w-4 h-4 bg-white rounded-full transition"
                  ></span>
                  </button> -->
            </div>
            <p class="text-sm text-gray-600 mt-2">Amélioration des performances du site.</p>
         </div>
         <!-- BUTTONS -->
         <div class="flex justify-end gap-3 mt-6">
            <button @click="closeSettings" class="px-4 py-2 border rounded cursor-pointer" type='button' > 
                Annuler
            </button>
            <button @click="saveSettings" type='button' class="bg-[#0d4677] text-white px-5 py-2 rounded-lg cursor-pointer" >
                Sauvegarder
            </button>
         </div>
      </div>
   </div>
</template>