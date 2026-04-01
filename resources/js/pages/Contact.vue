<script setup>  
  import {ref, reactive, watch, computed, onMounted} from 'vue'
  import MainLayout from '@/layouts/MainLayout.vue'
  import ArrowRight from '@/components/icons/ArrowRightIcon.vue'
  import { useForm, usePage,Link, Head } from '@inertiajs/vue3'
  import { route } from 'ziggy-js'

  const contactInfo = [
    {
      titre: "Téléphone",
      color: "#0E9727",
      icon:`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#0E9727" d="M6.62 10.79c1.44 2.83 3.76 5.15 6.59 6.59l2.2-2.2c.28-.28.67-.36 1.02-.25c1.12.37 2.32.57 3.57.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z" stroke-width="0.1" stroke="#fff"/></svg>`,
      text: "+32 2 897 20 08",
      type: "tel",
      link: "tel:+3228972008",
      type: "tel",
      multiline: false,
      link:'tel:+3228972008'
    },
    {
      titre: "Email",
      color: "#0d4677",
      icon:`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#0d4677" d="M4.616 19q-.691 0-1.153-.462T3 17.384V6.616q0-.691.463-1.153T4.615 5h14.77q.69 0 1.152.463T21 6.616v10.769q0 .69-.463 1.153T19.385 19zM12 12.116L4 6.885v10.5q0 .269.173.442t.443.173h14.769q.269 0 .442-.173t.173-.443v-10.5zM12 11l7.692-5H4.308zM4 6.885V6v11.385q0 .269.173.442t.443.173H4z" stroke-width="1" stroke="#0d4677"/></svg>`,
      text: "info@axeco.immo",
      type: "email",
      link: "mailto:info@axeco.be",
      multiline: false,
    },
    {
      titre: "Adresse",
      color: "#f2522e",
      icon:`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#f2522e" d="M11.5 7A2.5 2.5 0 0 1 14 9.5a2.5 2.5 0 0 1-2.5 2.5A2.5 2.5 0 0 1 9 9.5A2.5 2.5 0 0 1 11.5 7m0 1A1.5 1.5 0 0 0 10 9.5a1.5 1.5 0 0 0 1.5 1.5A1.5 1.5 0 0 0 13 9.5A1.5 1.5 0 0 0 11.5 8m-4.7 4.36l4.7 7.73l4.7-7.73c.51-.86.8-1.81.8-2.86A5.5 5.5 0 0 0 11.5 4A5.5 5.5 0 0 0 6 9.5c0 1.05.29 2 .8 2.86m10.25.52L11.5 22l-5.55-9.12C5.35 11.89 5 10.74 5 9.5A6.5 6.5 0 0 1 11.5 3A6.5 6.5 0 0 1 18 9.5c0 1.24-.35 2.39-.95 3.38" stroke-width="1.2" stroke="#f2522e"/></svg>`,
      text: "Chaussée de La Hulpe 150 1170 Bruxelles – Belgique",
      type: "map",
      link: "https://maps.app.goo.gl/ciFDMCpNPhs6KVs5A",
      multiline: false,
      link:'https://maps.app.goo.gl/ciFDMCpNPhs6KVs5A'
    },
    {
      titre:"Horaires",
      color: "#2E7EED",
      icon:`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="#2E7EED" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M11 8v5h5"/></g></svg>`,
      text: "Lun-Ven: 9h00 - 18h00",
      type: "map",
      link: "https://maps.app.goo.gl/ciFDMCpNPhs6KVs5A",
      multiline: false,
      link:null
    },
  ]

  const data = useForm({
                  frname: '',
                  name: '',
                  email: '',
                  message: '',
                  subject: 'info',
                  telephone: '',
                  adresse_immeuble: '',
                  numero_police: '',
                  code_postal: '',
                  nombre_lots: '',
                  file:null
              })
  const selectedFile = ref(null)
  function handleFileUpload(e) {
      const file = e.target.files[0]
      selectedFile.value = file
      data.file = file 
  }
  function submit(){
      data.post(route('contact.send'), {
          forceFormData: true,
          preserveScroll: true,
          onSuccess: () => {
              data.reset()
              selectedFile.value = null
          },
          onError: (errors) => {
              console.log(errors)
          }
      })
  }
  const page = usePage()
  const flash = computed(() => page.props.flash)

  const show = ref(false)

  watch(
      flash,
      (newFlash) => {
          if (newFlash?.success || newFlash?.error) {
              show.value = true

              setTimeout(() => {
                  show.value = false
              }, 4000)
          }
      },
      { immediate: true }
  )
  onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const subjectParam = urlParams.get('subject');

    if(subjectParam){
      data.subject = subjectParam;
    }
  } )
</script>
<template>
<MainLayout>
  <Head>
    <title>Contactez Axeco | Syndic de Copropriété à Bruxelles</title>
    <meta name="description" content="Une question ? Besoin d'un devis pour la gestion de votre copropriété ? Contactez l'équipe d'Axeco par téléphone, email или via notre formulaire en ligne." />
    <link rel="canonical" href="https://axeco.be/contact" />
    
    <meta property="og:title" content="Contactez Axeco - Votre Syndic à Bruxelles" />
    <meta property="og:description" content="Notre équipe est à votre écoute pour toute demande d'information ou de gestion immobilière." />
    <meta property="og:image" content="https://axeco.be/images/contact-og.jpg" />
  </Head>
  <transition name="fade">
    <div v-if="show && flash.success" role="status" aria-live="polite" class="fixed top-24 lg:top-5 right-0 md:right-5 bg-[#0d4677] text-white px-6 py-3 rounded-xl shadow-lg z-50">
      {{ flash.success }}
    </div>
  </transition>
  <transition name="fade">
    <div v-if="show && flash.error" role="alert" aria-live="assertive" class="fixed top-24 lg:top-5 right-0 md:right-5 bg-[#f2522e] text-white px-6 py-3 rounded-xl shadow-lg z-50">
      {{ flash.error }}
    </div>
  </transition>
   <div id="contact" role="main">
   <section class='relative min-h-[700px] h-screen w-full flex flex-col items-center justify-center gap-10 pt-15 lg:pt-30 overflow-hidden  px-6 lg:px-12' style="background: linear-gradient(rgba(224,239,255) 0%, rgba(255,255,255) 100%)">
      <h1 class='hero-h1 text-center'>Discutons de votre demande</h1>
      <p class='hero-paragraph text-center'>Notre équipe d'experts en gestion immobilière est à votre écoute. Contactez-nous pour une consultation personnalisée.</p>
   </section>
   <section style="background: linear-gradient(rgba(255,255,255) 0%, rgba(255,176,158,0.2) 100%)" class='px-2 lg:px-12 py-16 lg:py-20 '>
      <div class="section-container flex flex-col items-center">
         <h2 class='section-h2'>INFORMATIONS DE CONTACT</h2>
         <h3 class="section-h3 text-center">Comment nous joindre</h3>
         <div class='line bg-gradient-to-r from-[#F2522E] to-[#205A8C]'></div>
      </div>
      <div class='flex flex-col  md:grid grid-cols-2'>
         <a :href="info.link" target="_blank" v-for="info in contactInfo" :key="info.text" class='w-full mb-8' :aria-label="info.link ? info.titre + ': ' + info.text : ''">
            <div class='group flex bg-white shadow-xl rounded-[15px] p-6 gap-6 mx-auto items-center h-25 w-[90%] transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 focus-within:shadow-2xl focus-within:-translate-y-1"' >
               <div v-html="info.icon" aria-hidden="true" class="border rounded-[10px] p-3 bg-white w-fit" :style="{ borderColor: info.color, backgroundColor: info.color + '15' }"></div>
               <div>
                  <h4 class='section-h4 text-base lg:text-lg'>{{ info.titre }}</h4>
                  <p class='text-sm md:text-xs lg:text-base text-[#205A8C] leading-relaxed'>{{ info.text }}</p>
               </div>
            </div>
         </a>
      </div>
   </section>
   <section style="background: linear-gradient(rgba(255,176,158,0.2) 0%, rgba(255,176,158,0.05) 100%)" class='px-6 lg:px-12 py-16 lg:py-20'>
      <div class="flex flex-col gap-6 md:flex-row">
         <div class="section-container">
            <h2 class='section-h2 text-center md:text-left'>NOTRE LOCALISATION</h2>
            <h3 class="section-h3 text-center md:text-left">Venez nous rendre visite</h3>
            <div class='line bg-gradient-to-r from-[#F2522E] to-[#205A8C] mx-auto lg:mx-0'></div>
            <p class='description'>Notre bureau est situé au cœur de Bruxelles, facilement accessible en transport en commun ou en voiture.</p>
            <div class='flex items-center gap-8 bg-white border-1 border-[#f2522e] rounded-[15px] p-6 w-fit mt-10'>
               <div class='bg-[#f2522e]/20 rounded-full p-3 w-fit h-fit flex items-center justify-center'>
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16">
                     <path fill="#f2522e" fill-rule="evenodd" d="M14.7 12a.376.376 0 0 0 .49-.5l-1.22-2.69c1.23-.773 2-2.04 2-3.91c0-3.48-2.69-4.87-6-4.87C7.28.03 5 .948 4.24 3.16q.844-.13 1.73-.128c1.77 0 3.51.37 4.83 1.32c1.37.987 2.17 2.52 2.17 4.55c0 .76-.113 1.45-.325 2.07l2.05 1.03zM2.9 13.23a1 1 0 0 0-.378-1.26c-.923-.58-1.54-1.52-1.54-3.06c0-1.45.538-2.35 1.34-2.93c.853-.616 2.12-.943 3.66-.943s2.8.327 3.66.943c.804.58 1.34 1.49 1.34 2.93s-.538 2.35-1.34 2.93c-.853.616-2.12.943-3.66.943q-.13 0-.257-.003a1 1 0 0 0-.472.105l-2.85 1.42l.49-1.08zM.84 15.92a.375.375 0 0 0 .416.082l4.45-2.22q.14.004.281.004c3.31 0 6-1.39 6-4.88c0-3.48-2.69-4.87-6-4.87s-6 1.39-6 4.87c0 1.87.774 3.14 2 3.91l-1.22 2.69a.38.38 0 0 0 .073.418z" clip-rule="evenodd"/>
                  </svg>
               </div>
               <div class='flex flex-col gap-2'>
                  <h4 class='text-lg'> Rendez-vous</h4>
                  <p class='description'>Contactez-nous pour prendre rendez-vous et éviter l'attente</p>
               </div>
            </div>
         </div>
         <div class='border-5 border-white rounded-[20px] overflow-hidden w-full'>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d40352.37881881486!2d4.390074563491565!3d50.7936697946478!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f0b2e7d5f3ce5fb%3A0xd492f4265615de1e!2saxeco%20srl!5e0!3m2!1sru!2sbe!4v1772889414855!5m2!1sru!2sbe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" target="_blank" class="w-full"></iframe>
         </div>
      </div>
   </section>
   <section id='form' class='py-16 lg:py-20 scroll-mt-24 lg:scroll-mt-32' style="background: linear-gradient(rgba(255,176,158,0.05) 0%, rgba(255,255,255) 100%)" >
      <div class="section-container flex flex-col items-center">
         <h2 class='section-h2'>ÉCRIVEZ-NOUS</h2>
         <h3 class="section-h3 text-center">Envoyez-nous un message</h3>
         <div class='line bg-gradient-to-r from-[#F2522E] to-[#205A8C] '></div>
         <p class='description text-center'>Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais</p>
      </div>
      <form id="contact" @submit.prevent="submit" class="w-[80%] m-auto bg-[#F0F6FC]/50 px-8 py-10 mt-10 border-2 rounded-xl border-[#B9D6FE]">
         <div class="flex flex-col md:grid grid-cols-2 gap-6 items-center">
            <!-- Nom -->
            <div class="champ">
               <label for="fname" class="after:content-['*'] after:text-[#0d4677] after:ml-1">Nom</label>
               <input type="text" id="fname" name="fname" v-model="data.frname" placeholder="Entrez votre nom" :aria-invalid="data.errors.frname ? 'true' : 'false'" :aria-describedby="data.errors.frname ? 'fname-error' : ''" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0D4677] focus:border-[#0D4677] outline-none transition placeholder:text-base" />
               <span v-if="data.errors.frname" id="fname-error" role="alert" class="text-red-500 text-xs mt-1">Veuillez renseigner votre nom</span>
            </div>
            <!-- Prenom -->
            <div class="champ">
               <label for="name" class="after:content-['*'] after:text-[#0d4677] after:ml-1">Prenom</label>
               <input type="text" id="name" name="name" v-model="data.name" placeholder="Entrez votre prénom" :aria-invalid="data.errors.name ? 'true' : 'false'" :aria-describedby="data.errors.name ? 'name-error' : ''" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0D4677] focus:border-[#0D4677] outline-none transition placeholder:text-base" />
               <span v-if="data.errors.name" id="name-error" role="alert" class="text-red-500 text-xs mt-1"> Veuillez renseigner votre prénom </span>
            </div>
            <!-- Email -->
            <div class="champ col-span-2">
               <label for="email" class="after:content-['*'] after:text-[#0d4677] after:ml-1">Email</label>
               <input type="email" id="email" name="email" v-model="data.email" placeholder="exemple@domain.com" :aria-invalid="data.errors.email ? 'true' : 'false'" :aria-describedby="data.errors.email ? 'email-error' : ''" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0D4677] focus:border-[#0D4677] outline-none transition placeholder:text-base" />
               <span v-if="data.errors.email" id="email-error" role="alert" class="text-red-500 text-xs mt-1">Veuillez renseigner votre email</span>
            </div>
         </div>
         <!-- Sujet -->
         <fieldset class="subject rounded-md mt-6" :aria-invalid="data.errors.subject ? 'true' : 'false'" aria-describedby="subject-error">
            <legend class="after:content-['*'] after:text-[#0d4677] after:ml-1">Sujet</legend>
            <div class="flex flex-col md:flex-row md:gap-6 mt-2">
               <label class="flex items-center gap-2">
               <input type="radio" id="information_generale" name="subject" value="info" v-model="data.subject" checked>
                  Information générale
               </label>
               <label class="flex items-center gap-2">
               <input type="radio" id="commande_plaquette" name="subject" value="commande" v-model="data.subject">
                  Commande plaquette(s)
               </label>
               <label class="flex items-center gap-2">
               <input type="radio" id="demande_offre" name="subject" value="demande" v-model="data.subject">
                  Demande offre
               </label>
               <label class="flex items-center gap-2">
               <input type="radio" id="demande_stage" name="subject" value="stage" v-model="data.subject">
                  Demande de stage
               </label>
            </div>
            <span v-if="data.errors.subject" id="subject-error" role="alert" class="text-red-500 text-xs mt-2 font-medium">Veuillez sélectionner le sujet de votre demande.</span>
         </fieldset>
         <!-- Message -->
         <div class="flex flex-col gap-2 mt-6">
            <label for="message">Votre message</label>
            <textarea id="message" rows="6" v-model="data.message" :aria-invalid="data.errors.message ? 'true' : 'false'" aria-describedby="message-error" placeholder="Écrivez votre message ici..." class="w-full px-6 py-5 bg-white border border-gray-200 rounded-[22px] shadow-sm text-[#0d4677] focus:ring-2 focus:ring-[#0D4677] focus:border-[#0D4677] outline-none transition placeholder:text-base mt-4 hover:shadow-md transition-all duration-300 resize-none"></textarea>
            <span v-if='data.errors.message' id="message-error" role="alert" class="text-red-500 text-xs mt-1">Veuillez écrire votre message</span>
         </div>
         <div v-if="data.subject === 'stage'" class="mt-6">
            <label tabindex="0" class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-[#0D4677] transition-colors focus-within:ring-2 focus-within:ring-[#0D4677] focus-within:border-[#0D4677] outline-none transition">
               <span v-if="!selectedFile" class="text-gray-500 text-base text-center">Cliquez pour téléverser votre CV ou glissez-le ici</span>
               <span v-else class="text-[#0D4677] font-semibold text-base text-center">Fichier sélectionné: {{ selectedFile.name }}</span>
               <input type="file" class="hidden" @change="handleFileUpload" :aria-invalid="data.errors.file ? 'true' : 'false'" aria-describedby="file-error" required />
               <p v-if="data.errors.file" class="text-red-500 mt-2 text-base">{{ data.errors.file }}</p>
            </label>
            <span v-if="data.errors.file" id="file-error" role="alert" class="text-red-500 mt-2 text-sm text-center font-medium">Veuillez sélectionner un fichier (CV) au format PDF ou Word.</span>
         </div>
         <div v-if="data.subject === 'demande'" class="flex flex-col md:grid grid-cols-2 gap-6 items-center mt-6">
            <div class="champ">
               <label for="telephone" class="after:content-['*'] after:text-[#0d4677] after:ml-1">Téléphone</label>
               <input type="text" id="telephone" name="telephone" v-model="data.telephone" placeholder="Ex: +33 6 12 34 56 78" :aria-invalid="data.errors.telephone ? 'true' : 'false'" aria-describedby="telephone-error" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0D4677] focus:border-[#0D4677] outline-none transition placeholder:text-base" />
               <span v-if="data.errors.telephone" id="telephone-error" role="alert" class="text-red-500 mt-2 text-sm text-center font-medium">Veuillez renseigner votre numéro de téléphone </span>
            </div>
            <div class="champ">
               <label for="adresse_immeuble" class="after:content-['*'] after:text-[#0d4677] after:ml-1">Adresse immeuble</label>
               <input type="text" id="adresse_immeuble" name="adresse_immeuble" v-model="data.adresse_immeuble" placeholder="Rue / Numéro / Ville" :aria-invalid="data.errors.adresse_immeuble ? 'true' : 'false'" aria-describedby="adresse_immeuble-error" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0D4677] focus:border-[#0D4677] outline-none transition placeholder:text-base" />
               <span v-if="data.errors.adresse_immeuble" id="adresse_immeuble-error" role="alert" class="text-red-500 mt-2 text-sm text-center font-medium">Veuillez renseigner l'adresse de l'immeuble </span>
            </div>
            <div class="champ">
               <label for="numero_police" class="after:content-['*'] after:text-[#0d4677] after:ml-1">Numéro de police</label>
               <input type="text" id="numero_police" name="numero_police" v-model="data.numero_police" placeholder="Ex: 123456789" :aria-invalid="data.errors.numero_police ? 'true' : 'false'" aria-describedby="numero_police-error" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0D4677] focus:border-[#0D4677] outline-none transition placeholder:text-base" />
               <span v-if="data.errors.numero_police" id="numero_police-error" role="alert" class="text-red-500 mt-2 text-sm text-center font-medium"> Veuillez renseigner le numéro de police</span>
            </div>
            <div class="champ">
               <label for="code_postal" class="after:content-['*'] after:text-[#0d4677] after:ml-1">Code postal</label>
               <input type="text" id="code_postal" name="code_postal" v-model="data.code_postal" placeholder="Ex: 75001" :aria-invalid="data.errors.code_postal ? 'true' : 'false'" aria-describedby="code_postal-error" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0D4677] focus:border-[#0D4677] outline-none transition placeholder:text-base" />
               <span v-if="data.errors.code_postal" id="code_postal-error" role="alert" class="text-red-500 mt-2 text-sm text-center font-medium">Veuillez renseigner le code postal</span>
            </div>
            <div class="champ">
               <label for="nombre_lots" class="after:content-['*'] after:text-[#0d4677] after:ml-1">Nombre de lots</label>
               <input type="text" id="nombre_lots" name="nombre_lots" v-model="data.nombre_lots" placeholder="Ex: 5" :aria-invalid="data.errors.nombre_lots ? 'true' : 'false'" aria-describedby="nombre_lots-error" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0D4677] focus:border-[#0D4677] outline-none transition placeholder:text-base" />
               <span v-if="data.errors.nombre_lots" id="nombre_lots-error" role="alert" class="text-red-500 mt-2 text-sm text-center font-medium">Veuillez renseigner le nombre de lots </span>
            </div>
         </div>
         <div class="mt-6 text-center md:col-span-2">
            <button type="submit" :disabled="data.processing" class="bg-[#f2522e] text-white px-6 py-3 rounded-full cursor-pointer text-lg font-semibold hover:bg-[#0b3b62] transition focus:ring-2 focus:ring-[#0D4677] focus:border-[#0D4677] outline-none transition ">Envoyer le message</button>
         </div>
      </form>
   </section>
   <section >
      <div class="bg-gradient-to-b py-10 from-[rgb(32,90,140)] to-[rgb(32,90,140,0.8)] max-w-[100%] mx-auto py-10 text-center text-white flex flex-col items-center gap-8 lg:gap-6 ">
         <h3 class="text-[25px] lg:text-[30px]">Prêt à améliorer la gestion de votre copropriété ?</h3>
         <p class="text-[16px] lg:text-[16px] lg:text-[18px] w-[90%]" >Contactez-nous dès aujourd'hui pour une consultation gratuite et découvrez comment nos services peuvent transformer la gestion de votre bien. </p>
         <Link :href="route('FAQ')" class='button text-white bg-[#ffffff]/20 border-2 border-white w-fit px-20 text-sm lg:text-base'>
            FAQ's <ArrowRight/>
         </Link>
      </div>
   </section>
</div>
</MainLayout>
</template>
<style scoped>
  .fade-enter-active,
  .fade-leave-active {
      transition: opacity 0.4s ease, transform 0.4s ease;
  }

  .fade-enter-from,
  .fade-leave-to {
      opacity: 0;
      transform: translateY(-10px);
  }
</style>