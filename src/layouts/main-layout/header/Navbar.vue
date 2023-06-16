<template>
  <!--begin::Navbar-->
  <div class="app-navbar flex-shrink-0">
    <!--begin::Search-->
    <!-- <div class="app-navbar-item align-items-stretch ms-1 ms-lg-3">
      <KTSearch />
    </div> -->
    <!--end::Search-->
    <!--begin::Activities-->
    <!-- <div class="app-navbar-item ms-1 ms-lg-3"> -->
      <!--begin::Drawer toggle-->
      <!-- <div
        class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
        id="kt_activities_toggle"
      >
        <span class="svg-icon svg-icon-1">
          <inline-svg src="/media/icons/duotune/general/gen032.svg" />
        </span>
      </div> -->
      <!--end::Drawer toggle-->
    <!-- </div> -->
    <!--end::Activities-->
    <!-- begin::language -->
     <div class="app-navbar-item ms-1 ms-lg-3">
   <!-- begin::Menu toggle -->
      <a
        
        class="btn btn-icon btn-active-light btn-active-color-primary btn-custom w-150px h-30px w-md-150px h-md-40px"
        data-kt-menu-trigger="{default:'click', lg: 'hover'}"
        data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-end"
      >
      <!-- <router-link to="" class="menu-link px-5"> -->
        <span class="menu-title position-relative">
       
          <!-- <span class="fs-8  px-3 py-2 position-absolute translate-middle-y top-50 end-0"> -->
          <!-- {{currentLangugeLocale}} -->
            <span class="symbol symbol-20px me-4">   <img
              class="w-20px h-20px rounded-1 ms-2"
              :src="currentLangugeLocale.flag"
              alt="metronic"
            /></span>
            <span style="font-size: 14px;"> {{ currentLangugeLocale.name }}</span>
         
          <!-- </span> -->
         
        </span>
      <!-- </router-link> -->
      </a> 
      <div
      class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-muted menu-active-bg menu-state-primary fw-semibold py-4 fs-base w-175px"
      data-kt-menu="true"
      data-kt-element="language-mode-menu">
  

     
        <div class="menu-item px-3" v-for="(l, index) in countries"
            :key="index">
            <!-- {{ l }} -->
          <a
          
            @click="changeLocale(l.id, l.direction)"
            href="#"
            class="menu-link d-flex px-5"
            :class="{ active: currentLanguage === l.id }"
          >
   
            <span class="symbol symbol-20px me-4">
              <img
                class="rounded-1"
                :src="l.flag"
                alt="metronic"
              />
            </span>
            {{l.name}}
          </a>
        </div>
      
    </div>
      <!--begin::Menu toggle-->
      <!-- <KTLanguageMenu /> -->
    </div>
    <!-- end::language -->
    <!--begin::Notifications-->
    <div class="app-navbar-item ms-1 ms-lg-3">
      <!--begin::Menu- wrapper-->
      <div
        class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
        data-kt-menu-trigger="click"
        data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-end"
      >
        <span class="svg-icon svg-icon-1">
          <inline-svg src="/media/icons/duotune/general/gen022.svg" />
        </span>
      </div>
      <KTNotificationMenu />
      <!--end::Menu wrapper-->
    </div>
    <!--end::Notifications-->
    <!--begin::Chat-->
    <!-- <div class="app-navbar-item ms-1 ms-lg-3"> -->
      <!--begin::Menu wrapper-->
      <!-- <div
        class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px position-relative"
        id="kt_drawer_chat_toggle"
      >
        <span class="svg-icon svg-icon-1">
          <inline-svg src="/media/icons/duotune/communication/com012.svg" />
        </span>
        <span
          class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"
        ></span>
      </div> -->
      <!--end::Menu wrapper-->
    <!-- </div> -->
    <!--end::Chat-->
    <!--begin::Quick links-->
    <div class="app-navbar-item ms-1 ms-lg-3" v-if="role !== 'admin'">
      <!--begin::Menu wrapper-->
      <div
        class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
        data-kt-menu-trigger="click"
        data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-end"
      >
        <span class="svg-icon svg-icon-1">
          <inline-svg src="/media/icons/duotune/general/gen025.svg" />
        </span>
      </div>
      <KTQuickLinksMenu />
      <!--end::Menu wrapper-->
    </div>
    <!--end::Quick links-->
    <!--begin::Theme mode-->
    <div class="app-navbar-item ms-1 ms-lg-3">
      <!--begin::Menu toggle-->
      <a
        href="#"
        class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px"
        data-kt-menu-trigger="{default:'click', lg: 'hover'}"
        data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-end"
      >
        <span
          v-if="themeMode === 'light'"
          class="svg-icon theme-dark-hide svg-icon-2"
        >
          <inline-svg src="/media/icons/duotune/general/gen060.svg" />
        </span>
        <span v-else class="svg-icon theme-light-hide svg-icon-2">
          <inline-svg src="/media/icons/duotune/general/gen061.svg" />
        </span>
      </a>
      <!--begin::Menu toggle-->
      <KTThemeModeSwitcher />
    </div>
    <!--end::Theme mode-->
    <!--begin::User menu-->
    <div class="app-navbar-item ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
      <!--begin::Menu wrapper-->
      <div
        class="cursor-pointer symbol symbol-35px symbol-md-40px"
        data-kt-menu-trigger="click"
        data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-end"
      >
        <img :src="avtar" alt="user" />
      </div>
      <KTUserMenu />
      <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->
    <!--begin::Header menu toggle-->
    <!-- <div class="app-navbar-item d-lg-none ms-2 me-n3" title="Show header menu">
      <div
        class="btn btn-icon btn-active-color-primary w-35px h-35px"
        id="kt_app_header_menu_toggle"
      >
        <span class="svg-icon svg-icon-1">
          <inline-svg src="/media/icons/duotune/text/txt001.svg" />
        </span>
      </div>
    </div> -->
    <!--end::Header menu toggle-->
  </div>
  <!--end::Navbar-->
</template>

<script lang="ts">
import { defineComponent, computed, onMounted, watch } from "vue";
import KTSearch from "@/layouts/main-layout/search/Search.vue";
import KTNotificationMenu from "@/layouts/main-layout/menus/NotificationsMenu.vue";
import KTQuickLinksMenu from "@/layouts/main-layout/menus/QuickLinksMenu.vue";
import KTUserMenu from "@/layouts/main-layout/menus/UserAccountMenu.vue";
import KTThemeModeSwitcher from "@/layouts/main-layout/theme-mode/ThemeModeSwitcher.vue";
import { useThemeStore } from "@/stores/theme";

import { useAuthStore } from "@/stores/auth";
import { useI18n } from "vue-i18n";
import { useRoute } from "vue-router";
import { getDirection, setDirection } from "@/utils";
import router from "@/router";
export default defineComponent({
  name: "header-navbar",
  components: {
    KTSearch,
    KTNotificationMenu,
    KTQuickLinksMenu,
    KTUserMenu,
    KTThemeModeSwitcher,
   
  },
  setup() {
    const store = useThemeStore();
     const avtar="/media/avatars/300-1.jpg"; 
    
 
    const route = useRoute();
  
   const role = localStorage.getItem('user_role');
  const i18n = useI18n();
  const authstore = useAuthStore();
  const { t, te } = useI18n();
  i18n.locale.value = localStorage.getItem("lang")
    ? (localStorage.getItem("lang") as string)
    : "en";

    // es: {
    //   id:'es',
    //   flag: "/media/flags/spain.svg",
    //   name: "Spanish",
    //   direction:'ltr',
    // },
    const translate = (text: string|any) => {
          if (te(text)) {
            return t(text);
          } else {
            return text;
          }
        }; 

  const countries = {
    en: {
      id:'en',
      flag: "/media/flags/united-states.svg",
      name: "English",
      direction:'ltr',
    },
    enrtl: {
      id:'enrtl',
      flag: "/media/flags/united-states.svg",
      name: "English RTL",
      direction:'rtl',
    },
  
    ar: {
      id:'ar',
      flag: "/media/flags/saudi-arabia.svg",
      name: "Arabic",
      direction:'rtl',
    },
    
  };
  const themeMode = computed(() => {
      return store.mode;
    });
   
    const setLang = (lang: string) => {
    localStorage.setItem("lang", lang);
    i18n.locale.value = lang;
  };

  const currentLanguage = computed(() => {
    return i18n.locale.value;
  });

  const currentLangugeLocale = computed(() => {
    return countries[i18n.locale.value as keyof typeof countries];
  });
 

  const changeLocale = (locale, direction) => {
      const currentDirection = getDirection().direction;
      if (direction !== currentDirection) {
        setDirection(direction);
      }

      setLang(locale);
    }

    onMounted(() => {
    });

    watch(i18n.locale, (to, from) => {
        if(from !== to){
           router.go(0);
        }
    });

    return {
      themeMode,
      avtar,
      setLang,
      currentLanguage,
      currentLangugeLocale,
      countries,
      changeLocale,
      translate,
      role
    };
  },
});
</script>
