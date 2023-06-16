<template>
  <div class="dropdown">
  <button class=" dropdown-toggle btn btn-icon btn-active-light btn-active-color-primary btn-custom w-150px h-30px w-md-150px h-md-40px" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    <span class="symbol symbol-20px me-4">   
      <img
              class="w-20px h-20px rounded-1 ms-2"
              :src="currentLangugeLocale.flag"
              alt="metronic"
            /></span>
            <span style="font-size: 14px;"> {{ currentLangugeLocale.name }}</span>
  </button>
  <ul class="dropdown-menu fw-semibold py-4 fs-base w-175px" aria-labelledby="dropdownMenuButton1"  >
    <li class="px-3" v-for="(l, index) in countries"
            :key="index">
            <a class="dropdown-item" href="#"  
            @click="changeLocale(l.id, l.direction)"
            >
              <span class="symbol symbol-20px me-4">
              <img
                class="rounded-1"
                :src="l.flag"
                alt="metronic"
              />
            </span>
            {{l.name}}
          </a></li>
  </ul>
</div>
  <!-- <select
        name="status"
        data-control="select2"
        data-hide-search="true"
        class="form-select form-select-white form-select-sm btn-active-light btn-active-color-primary btn-custom w-150px h-30px w-md-150px h-md-40px"
        style="font-size:14px;"
        v-model="currentLangugeLocale.name" 
       :options="countries"
       @change="changeLocale($event)"
      >
      <template v-for="(l, index) in countries" :key="index">
                  <option :value="l.name" > <img
              class="w-20px h-20px rounded-1 ms-2"
              :src="currentLangugeLocale.flag"
              alt="metronic"
            />
            {{l.name}}</option>
                </template>
      </select> -->
  <!--begin::Wrapper-->
  <div class="w-lg-500px p-10">
    <!--begin::Form-->
    <VForm
      class="form w-100"
      id="kt_login_signin_form"
      @submit="onSubmitLogin"
      :validation-schema="login"
     
    >
     <!-- :initial-values="{ email: 'admin@demo.com', password: 'demo' }" -->
      <!--begin::Heading-->
      <div class="text-center mb-10">
        <!-- <div
        class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100"
      > -->
        <!--begin::Logo-->
        <!-- <router-link to="/" class="mb-0 mb-lg-12">
          <img
            alt="Logo"
            src="../../../../assets/logos/black.png"
            class="h-60px h-lg-75px"
          />
        </router-link> -->
        <!-- </div> -->
        <!--begin::Title-->
        <h1 class="text-dark mb-3">{{$t('signin')}}</h1>
        <!--end::Title-->

        <!--begin::Link-->
        <!-- <div class="text-gray-400 fw-semobold fs-4">
          New Here?

          <router-link to="/sign-up" class="link-primary fw-bold">
            Create an Account
          </router-link>
        </div> -->
        <!--end::Link-->
      </div>
      <!--begin::Heading-->

      <!-- <div class="mb-10 bg-light-info p-8 rounded">
        <div class="text-info"> -->
          <!-- Use account <strong>admin@demo.com</strong> and password
          <strong>demo</strong> to continue. -->
          <!-- <strong>{{}}</strong>
        </div>
      </div> -->

      <!--begin::Input group-->
      <div class="fv-row mb-10">
        <!--begin::Label-->
        <label class="form-label fs-6 fw-bold required text-dark">{{$t('e_mail')}}/{{ $t('mobile') }}</label>
        <!--end::Label-->

        <!--begin::Input-->
        <Field
          tabindex="1"
          class="form-control form-control-lg form-control-solid"
          type="text"
          name="email_or_phone"
          autocomplete="off"
        />
        <!--end::Input-->
        <div class="fv-plugins-message-container">
          <div class="fv-help-block" style="color: #d72626;">
            <ErrorMessage name="email_or_phone" />
          </div>
        </div>
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="fv-row mb-10">
        <!--begin::Wrapper-->
        <div class="d-flex flex-stack mb-2">
          <!--begin::Label-->
          <label class="form-label fw-bold required text-dark fs-6 mb-0">{{$t('password')}}</label>
          <!--end::Label-->

          <!--begin::Link-->
          <!-- <router-link to="/" class="link-primary fs-6 fw-bold">
            Forgot Password ?
          </router-link> -->
          <!--end::Link-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Input-->
        <Field
          tabindex="2"
          class="form-control form-control-lg form-control-solid"
          type="password"
          name="password"
          autocomplete="off"
        />
        <!--end::Input-->
        <div class="fv-plugins-message-container">
          <div class="fv-help-block" style="color: #d72626;">
            <ErrorMessage name="password" />
          </div>
        </div>
      </div>
      <!--end::Input group-->

      <!--begin::Actions-->
      <div class="text-center">
        <!--begin::Submit button-->
        <button
          tabindex="3"
          type="submit"
          ref="submitButton"
          id="kt_sign_in_submit"
          class="btn btn-lg btn-primary w-100 mb-5"
        >
          <span class="indicator-label"> {{$t('continue')}} </span>

          <span class="indicator-progress">
            {{$t("pleasewait")}}
            <span
              class="spinner-border spinner-border-sm align-middle ms-2"
            ></span>
          </span>
        </button>
        <!--end::Submit button-->

        <!--begin::Separator-->
        <!-- <div class="text-center text-muted text-uppercase fw-bold mb-5">or</div> -->
        <!--end::Separator-->

        <!--begin::Google link-->
        <!-- <a
          href="#"
          class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5"
        >
          <img
            alt="Logo"
            src="/media/svg/brand-logos/google-icon.svg"
            class="h-20px me-3"
          />
          Continue with Google
        </a> -->
        <!--end::Google link-->

        <!--begin::Google link-->
        <!-- <a
          href="#"
          class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5"
        >
          <img
            alt="Logo"
            src="/media/svg/brand-logos/facebook-4.svg"
            class="h-20px me-3"
          />
          Continue with Facebook
        </a> -->
        <!--end::Google link-->

        <!--begin::Google link-->
        <!-- <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100">
          <img
            alt="Logo"
            src="/media/svg/brand-logos/apple-black.svg"
            class="h-20px me-3"
          />
          Continue with Apple
        </a> -->
        <!--end::Google link-->
      </div>
      <!--end::Actions-->
    </VForm>
    <!--end::Form-->
  </div>
  <!--end::Wrapper-->
</template>

<script lang="ts">
import { computed, defineComponent, onMounted, ref, watch } from "vue";
import { ErrorMessage, Field, Form as VForm } from "vee-validate";
import { useAuthStore, type User } from "@/stores/auth";
import { useRouter } from "vue-router";
import Swal from "sweetalert2";
import * as Yup from "yup";
import { useI18n } from "vue-i18n";
import { getDirection, setDirection } from "@/utils";

export default defineComponent({
  name: "sign-in",
  components: {
    Field,
    VForm,
    ErrorMessage,
  },
  setup() {
    const store = useAuthStore();
    const router = useRouter();
    const { t, te } = useI18n();
  const i18n = useI18n();
  const authstore = useAuthStore();
    const submitButton = ref<HTMLButtonElement | null>(null);
   
    const translate = (text: string|any) => {
          if (te(text)) {
            return t(text);
          } else {
            return text;
          }
        };

    //Create form validation object
    const login = Yup.object().shape({
      email_or_phone: Yup.string()
      .required(translate('emailmobile'))
      .test('email_or_phone', translate('emailphoneinvalid'), (value) => {
         return validateEmail(value) || validatePhone(parseInt(value ?? '0'));
      }),
      // email: Yup.string().required(() => translate("emailreq")),
      password: Yup.string().required(translate('passreq')),
    });
  
    const validateEmail = (email: string | undefined) => {
   return Yup.string().email().isValidSync(email)
};

    const validatePhone = (phone: number | undefined) => {
   return Yup.number().integer().positive().test(
      (phone) => {
        return (phone && phone.toString().length >= 8 && phone.toString().length <= 14) ? true : false;
      }
    ).isValidSync(phone);
};

    

    //Form submit function
    const onSubmitLogin = async (values: any) => {
      values = {
        'email' : values.email_or_phone,
       'password':values.password,
      }
       
      // Clear existing errors
      store.logout();

      if (submitButton.value) {
        // eslint-disable-next-line
        submitButton.value!.disabled = true;
        // Activate indicator
        submitButton.value.setAttribute("data-kt-indicator", "on");
      }

      // Send login request
      await store.login(values);
      const error = store.errors;
      if (!error) {
        Swal.fire({
          text: translate('successloggedin'),
          icon: "success",
          buttonsStyling: false,
          confirmButtonText: translate('okgotit'),
          heightAuto: false,
          customClass: {
            confirmButton: "btn fw-semobold btn-light-primary",
          },
        }).then(() => {
          // Go to page after successfully login
          router.push({ name: "dashboard" });
        });
      } else {
        Swal.fire({
          text: error  as any,
          icon: "error",
          buttonsStyling: false,
          confirmButtonText: translate('tryagain'),
          heightAuto: false,
          customClass: {
            confirmButton: "btn fw-semobold btn-light-danger",
          },
        }).then(() => {
          store.errors = "";
        });
      }

      //Deactivate indicator
      submitButton.value?.removeAttribute("data-kt-indicator");
      // eslint-disable-next-line
        submitButton.value!.disabled = false;
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
    //  arrtl: {
    //   id:'arrtl',
    //   flag: "/media/flags/saudi-arabia.svg",
    //   name: "Arabic LTR",
    //   direction:'ltr',
    // },
    ar: {
      id:'ar',
      flag: "/media/flags/saudi-arabia.svg",
      name: "Arabic",
      direction:'rtl',
    }
  };
  
  onMounted(() => {
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

 

    watch(i18n.locale, (to, from) => {
       if(from !== to){
          router.go(0);
       }
    });

    return {
      onSubmitLogin,
      login,
      submitButton,
      setLang,
      currentLanguage,
      currentLangugeLocale,
      countries,
      changeLocale,
      translate
    };
  },
});
</script>
